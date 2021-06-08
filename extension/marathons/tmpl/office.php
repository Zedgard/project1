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
        margin-top: 1rem;
        font-size: 1rem;
        color: #000000;
        text-transform: uppercase;
        text-align: left;
    }
</style>
<div>
    <div class="card card-default">

        <div class="card-header card-header-border-bottom">
            <h2 class="col-lg-6">Марафоны</h2>
        </div>

        <div class="card-body">
            <div class="container_mix webinar_products_arrays_data">

            </div>
        </div>

        <div class="form-footer pt-4 pt-5 mt-4 border-top ">

        </div>

    </div> 
</div>
<script>
    $(document).ready(function () {
        getClientMarathonsProducts();
    });

    /*
     * Настройки значения список
     */
    function getClientMarathonsProducts() {
        $(".webinar_products_arrays_data tbody tr").remove();
        $(".webinar_products_arrays_data").html('<div class="w-100 text-center"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></div>');
        sendPostLigth('/jpost.php?extension=wares', {"getClientMarathonsProducts": '1'}, function (e) {
            $(".webinar_products_arrays_data").html("");
            var data = e['data'];
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    var wcc_color = data[i]['wcc_color'];
                    var wares_cat_name = '<span class="class_category" style="color: ' + wcc_color + ';">' + data[i]['wcc_title'] + '</span>';
                    $(".webinar_products_arrays_data").append(
                            '<div class="col-lg-3 mb-3 pt-4 pb-4 product_info item" style="border: 1px solid #e5e9f2;">\n\
                                <a href="?wares_id=' + data[i]['id'] + '">\n\
                                <div class="mb-2 text-center"><img src="' + data[i]['images'] + '" style="max-width: 200px;max-height: 160px;"/></div>\n\
                                <div class="mb-3 wares_title text-center"><span class="">' + data[i]['title'] + '</span></div>\n\
                                </div>\n\
                                </a>\n\
                                </div>');
                }
            } else {
                $(".webinar_products_arrays_data").html("Нет записей");
            }
        });
    }
</script>    