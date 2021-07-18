<link rel="stylesheet" href="/extension/products/product.css<?= $_SESSION['rand'] ?>">

<div style="display: none;">
    <div class="card card-default">
        <div class="card-body">
            <?= $config->getConfigParam('user_office_top_message') ?>
        </div>
    </div>
</div>

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2 class="col-lg-6">Продукты</h2>
    </div>
    <div class="card-body pt-2 pb-2">
        <div class="container-fluid">
            <!-- Sorted block -->    
            <div class="row mt-4 mb-4">
                <div class="col-12">
                    <div class="row controls fast_control_btn">
                        <div class="col-12 col-lg">
                            <button type="button" elm='0' data-filter="all" class="btn_category_controll btn_category_controll_active border_radius3 mb-2">Все</button>
                        </div>
                        <?
                        foreach ($categoryArray as $value) {
                            ?>
                            <div class="col-12 col-lg">
                                <button type="button" elm="<?= $value['id'] ?>" data-filter=".category-<?= $value['id'] ?>" class="btn_category_controll border_radius3 mb-2"><?= $value['title'] ?></button>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Sorted block end --> 
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 container_mix products_arrays_data"></div>
        </div>
        <br/>
    </div>


</div> 

<script src="/assets/plugins/mixitup/mixitup.min.js<?= $_SESSION['rand'] ?>"></script>
<script src="/extension/products/js/products.js<?= $_SESSION['rand'] ?>"></script>
<script src="/extension/products/js/office.js<?= $_SESSION['rand'] ?>"></script>
<script>
    var category_id = '<?= (isset($_GET['katalog']) && strlen($_GET['katalog']) > 0) ? $_GET['katalog'] : '' ?>';
</script>    