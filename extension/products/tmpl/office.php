<link rel="stylesheet" href="/extension/products/product.css<?= $_SESSION['rand'] ?>">
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
                    <h2 class="col-lg-6">Мои покупки</h2>
                </div>

                <div class="card-body">
                    <div class="row" style="margin-top: -30px;">
                        <div class="col-12">
                            <!-- Sorted block -->    
                            <div class="row mt-4 mb-4">
                                <div class="col-12">
                                    <div class="row controls fast_control_btn">
                                        <div class="col-lg-3">
                                            <button type="button" elm='0' data-filter="all" class="btn_category_controll btn_category_controll_active border_radius3 mb-2">Все</button>
                                        </div>
                                        <?
                                        foreach ($categoryArray as $value) {
                                            ?>
                                            <div class="col-lg-3">
                                                <button type="button" elm="<?= $value['id'] ?>" data-filter=".category-<?= $value['id'] ?>" class="btn_category_controll border_radius3 mb-2"><?= $value['title'] ?></button>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Sorted block end --> 
                        </div>
                    </div>
                    <br/>
                    <div class="row row-cols-0">
                        <div class="col-12 container_mix" data-ref="mixitup-container">
                            <div class="card-deck w-100 products_arrays_data">

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
 
<script src="/assets/plugins/mixitup/mixitup.min.js<?= $_SESSION['rand'] ?>"></script>
<script src="/extension/products/js/products.js<?= $_SESSION['rand'] ?>"></script>
<script src="/extension/products/js/office.js<?= $_SESSION['rand'] ?>"></script>
<script>
    var category_id = '<?= (isset($_GET['katalog']) && strlen($_GET['katalog']) > 0) ? $_GET['katalog'] : '' ?>';
</script>    