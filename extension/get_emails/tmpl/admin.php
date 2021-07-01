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
                                <th class="text-center">Дата</th>
                                <th class="text-center"></th>
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
                                    <td class="text-center"><?= $value['lastdate'] ?></td>
                                    <td class="text-center"><a href="javascript:void(0)" elm_activate="<?= $value['activate'] ?>" elm_email ="<?= $value['get_email'] ?>" elm_id="<?= $value['id'] ?>" elm_table="zay_get_emails" elm_table_tr_hide="1" class="btn btn-danger btn_remove_email btn-sm text-nowrap">Удалить</a></td>
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
        $(".btn_remove_email").unbind("click").click(function () {
            var o = this;
            var elm_id = $(this).attr("elm_id");
            var elm_email = $(this).attr("elm_email");
            var elm_activate = $(this).attr("elm_activate");
            sendPostLigth('/jpost.php?extension=get_emails', {"remove_email": elm_email, "elm_id": elm_id, "elm_activate": elm_activate}, function (e) {
                if (e['success'] == '1') {
                    $(o).closest("tr").hide(200);
                }
                init_get_emails_col();
            });
        });
    });
</script>