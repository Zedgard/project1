<div class="card">
    <div class="card-header card-header-border-bottom">
        <h2 class="col-lg-6"><a href="/admin/promo/">Промо акции</a> - Редактирование</h2>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?
                    if (isset($_SESSION['page_errors']) && count($_SESSION['page_errors']) > 0) {
                        foreach ($_SESSION['page_errors'] as $value) {
                            echo '<div class="alert alert-danger">' . $value . "</div>\n";
                        }
                        $_SESSION['page_errors'] = array();
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <form method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="config_title">Название</label>
                                    <input type="text" class="form-control promo_title" name="promo_title" value="<?= (isset($promo_data['title'])) ? $promo_data['title'] : '' ?>" placeholder="Наименование...">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="config_title">Код промо</label>
                                    <input type="text" class="form-control promo_code" name="promo_code" value="<?= (isset($promo_data['code'])) ? $promo_data['code'] : '' ?>" placeholder="Код промо...">
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <label for="promo_products" class="label_products_wares">Товары участвующие в промо</label>
                            <select class="form-control promo_products" name="promo_products[]" multiple="multiple" style="width: 100%">

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="promo_date_start">Дата начала</label>
                            <input type="text" class="form-control promo_date_start inp_datepicker" value="<?= (isset($promo_data['date_start'])) ? $promo_data['date_start'] : '' ?>" name="promo_date_start">
                        </div>

                        <div class="form-group">
                            <label for="promo_date_end">Дата окончания</label>
                            <input type="text" class="form-control promo_date_end inp_datepicker" value="<?= (isset($promo_data['date_end'])) ? $promo_data['date_end'] : '' ?>" name="promo_date_end">
                        </div>

                        <div class="form-group">
                            <label for="promo_amount">Сумма скидки в рублях</label>
                            <input type="text" class="form-control promo_amount" value="<?= (isset($promo_data['amount'])) ? $promo_data['amount'] : '0' ?>" name="promo_amount">
                        </div>

                        <div class="form-group">
                            <label for="promo_percent">Сумма скидки в процентах</label>
                            <input type="text" class="form-control promo_percent" value="<?= (isset($promo_data['percent']) && $promo_data['percent'] > 0) ? $promo_data['percent'] : '0' ?>" name="promo_percent">
                        </div>

                        <div class="form-group">
                            <label for="number_uses">Колличество использований</label>
                            <input type="text" class="form-control number_uses" value="<?= (isset($promo_data['number_uses']) && $promo_data['number_uses'] > 0) ? $promo_data['number_uses'] : '99999' ?>" name="number_uses">
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="product_new">Возможность объединения с другими промо</label><br/>
                                    <label class="switch switch-text switch-primary form-control-label">
                                        <input type="checkbox" class="switch-input form-check-input promo_alliance" name="promo_alliance" value="1">
                                        <span class="switch-label" data-on="On" data-off="Off"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">

                            </div>
                            <div class="col-lg-4"></div>
                        </div>    

                        <div class="form-group">
                            <label for="product_new">Статус</label><br/>
                            <label class="switch switch-text switch-primary form-control-label">
                                <input type="checkbox" class="switch-input form-check-input promo_status" name="promo_status" value="1">
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>


                        <div class="form-group">
                            <input type="hidden" name="promo_id" value="<?= $_GET['edit'] ?>" />
                            <input type="submit" value="Сохранить" class="btn btn-primary" />
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="form-footer p-3 mt-4 border-top">
        <a href="/admin/promo/">назад</a>
    </div>

</div> 
<script>
    var promo_product_ids = '<?= $promo_data['product_ids'] ?>';
    $(document).ready(function () {

        var products_wares = $(".promo_products").select2({
            width: "style",
            placeholder: "Выберите продукты",
            allowClear: true
        });


        init_datepicker(1);

        if ('1' === '<?= (isset($promo_data['alliance'])) ? $promo_data['alliance'] : '0' ?>') {
            if (!$(".promo_alliance").prop('checked')) {
                $(".promo_alliance").click();
            }
        }

        if ('1' === '<?= (isset($promo_data['status'])) ? $promo_data['status'] : '0' ?>') {
            if (!$(".promo_status").prop('checked')) {
                $(".promo_status").click();
            }
        }

        console.log(promo_product_ids.split(','));
        getWaresArray(promo_product_ids.split(','));

        // товары
//        products_wares_array = [];
//        if (e['data']['products_wares'].length > 0) {
//            for (var i = 0; i < e['data']['products_wares'].length; i++) {
//                products_wares_array.push(e['data']['products_wares'][i]);
//            }
//        }

    });

    /**
     * Товары 
     * @returns {undefined}
     */
    function getWaresArray(vals) {
        if ($(".promo_products").length > 0) {
            $(".promo_products option").remove();
            sendPostLigth('/jpost.php?extension=products', {"getProductsArray": '1', "searchStr": ''}, function (e) {
                var data = e['data'];
                if (data.length > 0) {
                    var selected = '';
                    if (vals.indexOf('0') !== -1) {
                        selected = 'selected="selected"';
                    }
                    $(".promo_products").append('<option value="0" ' + selected + '>Онлайн консультации</option>');
                    for (var i = 0; i < data.length; i++) {
                        var selected = '';
                        if (vals.indexOf(data[i]['id']) !== -1) {
                            selected = 'selected="selected"';
                        }
                        $(".promo_products").append('<option value="' + data[i]['id'] + '" ' + selected + '>' + data[i]['id'] + ' ' + data[i]['title'] + ' цена: ' + data[i]['price'] + '</option>');
                    }

                }
            });
        }
    }
</script>    