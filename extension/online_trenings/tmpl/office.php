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
            <h2 class="col-lg-6">Онлайн-тренинги</h2>
        </div>

        <div class="card-body">
            <div class="container-fluid">
                <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 container_mix products_arrays_data"></div>
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
        sendPostLigth('/jpost.php?extension=wares', {"getClientOnlineTreningsProducts": '1'}, function (e) {
            $(".webinar_products_arrays_data").html("");
            var data = e['data'];
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    var wcc_color = data[i]['wcc_color'];
                    var wares_cat_name = '<span class="class_category" style="color: ' + wcc_color + ';">' + data[i]['wcc_title'] + '</span>';
                    $(".products_arrays_data").append(
                            '<a href="?wares_id=' + data[i]['id'] + '">\n\
                                <div class="m-0 m-lg-2 p-2 p-lg-4 h-100 d-flex flex-column product_info item">\n\
                                <div class="mb-2 align-items-start text-center flex-fill"><img src="' + data[i]['images'] + '" style="width: 100%;"/></div>\n\
                                <div class="wares_title d-flex align-items-end text-center flex-fill">\n\
                                <div class="mt-0 mb-0 ml-auto mr-auto">' + data[i]['title'] + '</div>\n\
                                </div>\n\
                                </div>\n\
                                </a>');
                }
            } else {
                $(".webinar_products_arrays_data").html("Нет записей");
            }
        });
    }
</script>    