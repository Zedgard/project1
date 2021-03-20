<link rel="stylesheet" href="/extension/products/product.css<?= $_SESSION['rand'] ?>">
<style>
    .product_title{
        border-top: 1px solid #CCCCCC;
        color: #000000;
        margin-bottom: 1rem;
        clear: both;
        font-size: 1.4rem;
        font-weight: 600;
    }
    .products_arrays_data .product_title{
        border-top: none;
    }
    .wares_title{
        font-size: 0.9rem;
        color: #000000;
        text-align: left;
    }
</style>
<div>
    <div class="row" style="display: none;">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-body">
                    <?= $config->getConfigParam('user_office_top_message') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Покупки</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-8">

                        </div>
                    </div>
                    <br/>
                    <div class="row row-cols-0">
                        <div class="col-12">
                            <div class="card-deck w-100 products_arrays_data">
                                <div class="products_arrays_data w-100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top ">

                </div>

            </div> 
        </div>
    </div>
</div>
<?
/*
  <div class="col-12">
  <div class="table-responsive-md">
  <table class="table table-striped table-bordered products_arrays_data" style="width:100%;background-color: #FFFFFF;">
  <tbody>

  </tbody>
  </table>
  </div>
  </div>
 */
?>

<script>
    var category_id = '<?= (isset($_GET['katalog']) && strlen($_GET['katalog']) > 0) ? $_GET['katalog'] : '' ?>';
    $(document).ready(function () {
        getClientProducts();
    });

    /*
     * Настройки значения список
     */
    function getClientProducts() {
        $(".products_arrays_data div").remove();
        $(".products_arrays_data").html('<div class="w-100 text-center"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></div>');
        sendPostLigth('/jpost.php?extension=wares', {
            "getClientProducts": '1',
            "category_id": category_id
        }, function (e) {
            $(".products_arrays_data").html("");
            var data = e['data'];
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    if (!$(".products_arrays_data").find('.product_id_' + data[i]['product_id'])[0]) {

                        $(".products_arrays_data").append('<div class="product product_id_' + data[i]['product_id'] + ' w-100">\n\
                        <div class="product_title w-100">' + data[i]['product_title'] + '</div>\n\
                        <div class="product_elms row row-cols-2 row-cols-md-4 w-100" style="margin-right:0;padding-right:0;margin-left:0;padding-left:0;"></div>\n\
                        </div>');
                    }
                    var wcc_color = data[i]['wcc_color'];
                    var wares_cat_name = '<span class="class_category" style="color: ' + wcc_color + ';">' + data[i]['wcc_title'] + '</span>';
                    $('.products_arrays_data .product_id_' + data[i]['product_id'] + ' .product_elms').append(
                            '<div class="product_info container_mix row-cols-0 mb-4">\n\
                                <a href="?wares_id=' + data[i]['id'] + '">\n\
                                <div class="card item p-4 p-2 h-100 text-center">\n\
                                <span class="class_category_lbl opacity50" style="background-color: ' + wcc_color + ';margin-top: 0rem;">' + data[i]['wcc_title'] + '</span>\n\
                                <div class="mb-2"><img src="' + data[i]['images'] + '" style="max-width: 100%;max-height: 160px;"/></div>\n\
                                <div class="mb-3 wares_title h-100">' + wares_cat_name + ' <span class="">' + data[i]['title'] + '</span></div>\n\
                                </div>\n\
                                </a>\n\
                                </div>\n\
                                '); // <div class="col-lg-8 mb-3">' + data[i]['descr'] + '</div>
                    //$(".products_arrays_data").append('<div class="col-lg-12 mb-2"><hr/></div>');
//                    $(".products_arrays_data tbody").append(
//                            '<tr elm_id="' + data[i]['id'] + '"> \n\
//                                <td>\n\
//                                <div class="mb-3"><a href="?wares_id=' + data[i]['id'] + '">' + data[i]['title'] + '</a></div>\n\
//                                <div class="mb-3 text-center"><img src="' + data[i]['images'] + '" style="max-width: 200px;max-height: 160px;"/></div>\n\
//                                </td>\n\
//                                <td><div>' + data[i]['descr'] + '</div>\n\
//                                </td>\n\
//                            </tr>');
                    //  <div class="text-right"><a href="?product_id=' + data[i]['id'] + '" class="p-2 bd-highlight btn btn-primary">Перейти</a></div>\n\
                }
            } else {
                $(".products_arrays_data").html("Нет записей");
            }
        });
    }


</script>    