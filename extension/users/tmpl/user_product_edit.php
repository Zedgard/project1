<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2 class="col"><a href="./">Список пользователей</a> 
                        <?
                        if (isset($user_href_data['email'])) {
                            ?>
                            - <a href="?user_product_edit=<?= $_GET['user_product_edit'] ?>">Продукты клиента</a> - <?= $user_href_data['email'] ?>
                            <?
                        } else {
                            ?>
                            - Продукты клиента
                            <?
                        }
                        ?></h2> 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="mb-3 mt-3"><?= $first_user_data['email'] ?></h3>

                            <?
                            if (count($get_pay_user_list) > 0) {
                                ?>
                                <div class="table-responsive-md">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr><th>Транзакция</th>
                                                <th>Дата и время</th>
                                                <th>Товары</th>
                                                <th>Сумма</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?
                                            foreach ($get_pay_user_list as $value) {
                                                $wares_title = (strlen($value['wares_title']) > 0) ? $value['wares_title'] : $value['pay_descr'];
                                                $wares_title = str_replace(',', "<br/>\n- ", $wares_title);
                                                if (strlen($wares_title) == 0) {
                                                    $wares_title = 'Не найдено';
                                                }
                                                ?>
                                                <tr transaction_id="<?= $value['id'] ?>">
                                                    <td style="vertical-align: middle;"><?= $value['id'] ?></td>
                                                    <td style="vertical-align: middle;"><?= $value['pay_date'] ?></td>
                                                    <td style="vertical-align: middle;"><?= $wares_title ?></td>
                                                    <td style="vertical-align: middle;" class="text-center"><?= $value['pay_sum'] ?> &#8381;</td>
                                                    <td style="vertical-align: middle;">
                                                        <a href="javascript:void(0)" transaction_id="<?= $value['id'] ?>" class="btn btn-sm btn-primary add_new_product_in_pay" title="Добавить новый товар к покупке">
                                                            <i class="mdi mdi-plus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?
                            } else {
                                ?>
                                <div>Нет записей</div>
                                <?
                            }
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-check" style="padding-top: 0.8rem;">
                                <?
                                if (!isset($user_href_data['email'])) {
                                    ?>
                                    <input type="text" class="form-control input_search w-100" value="<?= (isset($user_href_data['email']) ? $user_href_data['email'] : '') ?>" placeholder="Поиск клиента (по Email) для переноса его покупок...">
                                    <?
                                } else {
                                    ?>
                                    <h3 class="mb-3 mt-1"><?= $user_href_data['email'] ?></h3>
                                    <?
                                }
                                ?>
                            </div>
                            <?
                            if (!isset($user_href_data['email'])) {
                                ?>
                                <div class="table-responsive-lg">
                                    <table class="table users_data">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">№</th>
                                                <th style="text-align: center;">email</th>
                                                <th style="text-align: center;">Телефон</th>
                                                <th style="text-align: center;">Роль</th>
                                                <th style="text-align: center;">Активность</th>
                                                <th style="text-align: center;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <?
                            } else {
                                ?>
                                <?
                                if (count($get_pay_user_href_list) > 0) {
                                    ?>
                                    <div class="table-responsive-md">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr><th>Транзакция</th>
                                                    <th>Дата и время</th>
                                                    <th>Товары</th>
                                                    <th>Сумма</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                foreach ($get_pay_user_href_list as $value) {
                                                    $wares_title = (strlen($value['wares_title']) > 0) ? $value['wares_title'] : $value['pay_descr'];
                                                    $wares_title = str_replace(',', "<br/>\n- ", $wares_title);
                                                    if (strlen($wares_title) == 0) {
                                                        $wares_title = 'Не найдено';
                                                    }
                                                    ?>
                                                    <tr transaction_id="<?= $value['id'] ?>">
                                                        <td style="vertical-align: middle;"><?= $value['id'] ?></td>
                                                        <td style="vertical-align: middle;"><?= $value['pay_date'] ?></td>
                                                        <td style="vertical-align: middle;"><?= $wares_title ?></td>
                                                        <td style="vertical-align: middle;" class="text-center"><?= $value['pay_sum'] ?> &#8381;</td>
                                                        <td style="vertical-align: middle;">
                                                            <a href="javascript:void(0)" transaction_id="<?= $value['id'] ?>" pay_product_id="<?= $value['pay_product_id'] ?>" product_id="<?= $value['product_id'] ?>" class="btn btn-sm btn-primary btn_move_product" title="Переместить">
                                                                <i class="mdi mdi-share-outline"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?
                                } else {
                                    ?>
                                    <div>Нет записей</div>
                                    <?
                                }
                                ?>

                                <?
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>
            </div>
        </div>
    </div>
</div>
<?
include 'modal_search_product.php';
?>
<script>
    var page_num = 1;
    var list_col_true = 1;
    var transaction_id = 0;
    $(".add_new_product_in_pay").unbind('click').click(function () {
        transaction_id = $(this).attr("transaction_id");
        $("#modal_add_new_product_in_pay").modal("show");
        getSearchProductsArray();
    });

    $(document).ready(function () {
        $(".input_search").delayKeyup(function () {
            initTable2();
        }, 700);

        init_btn_move_product();
    });


    function initTable2() {
        //console.log('initTable');
        if ($(".users_data").length > 0) {
            var input_search = $(".input_search").val();
            $(".get_next_page").html(ajax_spinner);
            //var h = $(".users_data tbody").height();
            //$(".users_data tbody").height(h);
            sendPostLigth('/jpost.php?extension=users', {
                "getUsersList": 1,
                'page_num': page_num,
                'input_search_str': input_search,
                'input_search_close_club_users': 0
            }, function (data) {
                var data_col = 0;
                $(".users_data tbody").html("");
                $(".get_next_page").html("Дальше...");
                var a = 1;
                for (var i = 0; i < data['data'].length; i++) {
                    var active_text = '<span class="badge badge-danger">не активированный</span>';
                    if (data['data'][i]['active'] == '1') {
                        var active_text = '<span class="badge badge-success">активированный</span>';
                    }

                    $(".users_data tbody").append('<tr elmid="' + data['data'][i]['id'] + '" email="' + data['data'][i]['email'] + '" title="' + data['data'][i]['id'] + ' ' + data['data'][i]['first_name'] + ' ' + data['data'][i]['last_name'] + '"> \
                                    <td style="text-align: center;">' + a + '</td> \
                                    <td style="text-align: center;">' + data['data'][i]['email'] + '</td> \
                                    <td style="text-align: center;">' + data['data'][i]['phone'] + '</td> \
                                        <td style="text-align: center;">' + data['data'][i]['role_name'] + '</td> \
                                    <td style="text-align: center;">' + active_text + '</td> \
                                    <td style="text-align: center;"> \
                                    <a href="?user_product_edit=<?= $_GET['user_product_edit'] ?>&user_href=' + data['data'][i]['id'] + '" class="btn btn-sm btn-primary "><i class="mdi mdi-human-male-height"></i></a>\
                                    </div> \
                            </td> \
                                </tr>');
                    a++;
                }
                if (list_col_true === 1 && data_col == data['data'].length) {
                    $(".get_next_page").hide();
                } else {
                    $(".get_next_page").show();
                    data_col = data['data'].length;
                }
            }, '1');
        }
    }

    function init_btn_move_product() {
        if ($(".btn_move_product").length > 0) {
            $(".btn_move_product").unbind("click").click(function () {
                var product_id = $(this).attr("product_id");
                var pay_product_id = $(this).attr("pay_product_id");
                var transaction_id = $(this).attr("transaction_id");
                console.log("transaction_id: " + transaction_id);
                console.log("product_id: " + product_id);
                console.log("pay_product_id: " + pay_product_id);


                sendPostLigth('/jpost.php?extension=pay',
                        {
                            "move_pay_products": '1',
                            "pay_id": transaction_id,
                            "user_id": "<?= $_GET['user_product_edit'] ?>"
                        }, function (e) {
                    if (e['success'] == 1) {
                        document.location.reload();
                    }
                });

            });
        }
    }
</script>