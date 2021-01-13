<div>
    <div class="row">
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
                    <h2 class="col-lg-6">Список вебинаров</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-8">

                        </div>
                    </div>
                    <br/>
                    <div class="row webinar_products_arrays_data">

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
  <table class="table table-striped table-bordered webinar_products_arrays_data" style="width:100%;background-color: #FFFFFF;">
  <tbody>

  </tbody>
  </table>
  </div>
  </div>
 */
?>
<script>
    $(document).ready(function () {
        getClientWebinarProducts();
    });

    /*
     * Настройки значения список
     */
    function getClientWebinarProducts() {
        $(".webinar_products_arrays_data tbody tr").remove();
        $(".webinar_products_arrays_data").html('<div class="w-100 text-center"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></div>');
        sendPostLigth('/jpost.php?extension=wares', {"getClientWebinarsProducts": '1'}, function (e) {
            $(".webinar_products_arrays_data").html("");
            var data = e['data'];
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    $(".webinar_products_arrays_data").append(
                            '<div class="col-lg-4 mb-3">\n\
                                <div class="mb-3"><h3><a href="?wares_id=' + data[i]['id'] + '">' + data[i]['title'] + '</a></h3></div>\n\
                                <div class="text-center"><img src="' + data[i]['images'] + '" style="max-width: 200px;max-height: 160px;"/></div>\n\
                                </div>\n\
                                <div class="col-lg-8 mb-3">' + data[i]['descr'] + '</div>');
                    $(".webinar_products_arrays_data").append('<div class="col-lg-12 mb-2"><hr/></div>');
//                    $(".webinar_products_arrays_data tbody").append(
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
                $(".webinar_products_arrays_data").html("Нет записей");
            }
        });
    }
</script>    