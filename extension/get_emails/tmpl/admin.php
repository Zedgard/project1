<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Список Email адресов подписчиков</h2>
                </div>

                <div class="card-body">
                    <table border="0" class="table table-striped table-bordered w-100" style="background-color: #FFFFFF;">
                        <thead>
                            <tr>
                                <th style="width: 2%;">Идт.</th>
                                <th>Адрес почты</th>
                                <th class="text-center">Активирован</th>
                                <th class="text-center">Признак</th>
                                <th class="text-center">Дата</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                            foreach ($emails as $value) {
                                ?>
                                <tr elm="<?= $value['id'] ?>">
                                    <td class="text-center"><?= $value['id'] ?></td>
                                    <td><?= $value['get_email'] ?></td>
                                    <td class="text-center"><?= $value['activate'] ?></td>
                                    <td class="text-center"><?
                                        if ($value['send_active'] == '1') {
                                            ?>
                                            <a href="javascript:void(0)" objid="<?= $value['id'] ?>" send_active="<?= $value['send_active'] ?>" class="btn btn-success btn-pill btn_send_active btn-sm text-nowrap">обработано</a>
                                            <?
                                        } else {
                                            ?>
                                            <a href="javascript:void(0)" objid="<?= $value['id'] ?>" send_active="<?= $value['send_active'] ?>" class="btn btn-danger btn-pill btn_send_active btn-sm text-nowrap">не просмотрено</a>
                                            <?
                                        }
                                        ?>

                                    </td>
                                    <td class="text-center"><?= $value['lastdate'] ?></td>
                                </tr>
                                <?
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".btn_send_active").unbind("click").click(function () {
            var o = this;
            var objid = $(this).attr("objid");
            var send_active = $(this).attr("send_active");
            if (send_active == '1') {
                send_active = '0';
            } else {
                send_active = '1';
            }
            sendPostLigth('/jpost.php?extension=get_emails', {"send_active": send_active, "objid": objid}, function (e) {
                if (e['success'] == '1') {
                    if (send_active == '1') {
                        $(o).html("обработано");
                        $(o).attr('send_active', '1');
                        $(o).removeClass("btn-danger");
                        $(o).addClass("btn-success");
                    } else { 
                        $(o).html("не просмотрено");
                        $(o).attr('send_active', '0');
                        $(o).removeClass("btn-success");
                        $(o).addClass("btn-danger");
                    }
                }
                init_get_emails_col();
            });
        });
    });
</script>