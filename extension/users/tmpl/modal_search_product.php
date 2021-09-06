<!-- true alert -->
<div class="modal fade" id="modal_add_new_product_in_pay" tabindex="-1" role="dialog" aria-labelledby="modal_add_new_product_in_pay" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h4 class="modal-title">Поиск товара</h4>
                </div>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 1.8rem;">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col">
                        <input type="text" class="form-control search_products" value="<?= $_SESSION['product']['searchStr'] ?>" placeholder="Поиск...">    
                    </div>
                    <div class="col">
                        <select name="visible" class="form-control float-left visible_products">
                            <option value="1" <?= (isset($_SESSION['product']['active']) && $_SESSION['product']['active'] == 1) ? 'selected="selected"' : '' ?>>Отображаемые</option>
                            <option value="0" <?= (isset($_SESSION['product']['active']) && $_SESSION['product']['active'] == 0) ? 'selected="selected"' : '' ?>>Не отображаемые</option>
                            <option value="9" <?= (isset($_SESSION['product']['active']) && $_SESSION['product']['active'] == 9) ? 'selected="selected"' : '' ?>>Удаленные</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col search_products_result">
                        <div class="table-responsive-lg">
                            <table class="table table-striped table-bordered" style="width:100%;background-color: #FFFFFF;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;"></th>
                                        <th>Наименование</th>
                                        <th style="text-align: center;">Цена</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    var searchStr = '';
    var visible_products = 1;
    $(document).ready(function () {
        $("#modal_not_insta_login").modal('show');

        searchStr = $(".search_products").val();

        $(".search_products").delayKeyup(function () {
            var v = $(".search_products").val();
            searchStr = v;
            getSearchProductsArray();
        }, 700);

        $(".visible_products").change(function () {
            visible_products = $(this).val();
            getSearchProductsArray();
        });




    });

    function getSearchProductsArray() {
        $(".search_products_result tbody").html(ajax_spinner);
        sendPostLigth('/jpost.php?extension=products',
                {
                    "getProductsArray": '1',
                    "searchStr": searchStr,
                    "visible_products": visible_products,
                    "product_edit": ''
                }, function (e) {
            $(".search_products_result tbody").html('');
            var data = e['data'];
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    var price = data[i]['price'];
                    if (data[i]['price_promo'] > 0) {
                        price = data[i]['price_promo'] + ' <span class="price_promo">promo</span>';
                    }

                    $(".search_products_result tbody").append(
                            '<tr elm_id="' + data[i]['id'] + '"> \n\
                                <td style="text-align: center;"><img src="' + data[i]['images_str'] + '" style="width: 100px;" /></td>\n\
                                <td style="vertical-align: middle;">' + data[i]['title'] + '</td>\n\
                                <td style="vertical-align: middle;text-align: center;">' + price + '</td>\n\
                                <td style="vertical-align: middle;text-align: center;white-space: nowrap;">\n\
                            <a href="javascript:void(0)" product_id="' + data[i]['id'] + '" class="btn btn-sm btn-primary btn_select_product" title="Выбрать">\n\
                                <i class="mdi mdi-share-outline"></i>\n\
                            </a>\n\
                            </td>\n\
                            </tr>');
                }
                init_btn_select_product();
            }
        });
    }

    function init_btn_select_product() {
        if ($(".btn_select_product").length > 0) {
            $(".btn_select_product").unbind('click').click(function () {
                var product_id = $(this).attr("product_id");
                sendPostLigth('/jpost.php?extension=pay',
                        {
                            "insert_pay_products": '1',
                            "pay_id": transaction_id,
                            "product_id": product_id
                        }, function (e) {
                    if (e['success'] == 1) {
                        document.location.reload();
                    }
                });
            });
        }
    }
</script>