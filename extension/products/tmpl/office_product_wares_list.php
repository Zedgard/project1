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
        <h2><a href="/office/?katalog">Мои покупки</a> - <?= $product_data[0]['title'] ?></h2>
    </div>

    <div class="card-body">
        <div class="mb-3">Список</div>
        <div class="table-responsive-lg">
            <table class="table table-striped table-hover table-bordered" >
                <tbody>
                    <?
                    if (count($wares_list) > 0) {
                        foreach ($wares_list as $value) {
                            ?>
                            <tr>
                                <td class="text-center">
                                    <a href="?katalog&product_id=<?= $_GET['product_id'] ?>&wares_id=<?= $value['id'] ?>"><img src="<?= $value['images'] ?>" style="max-width: 100px;" />
                                </td>
                                <td class="align-middle"><a href="?katalog&product_id=<?= $_GET['product_id'] ?>&wares_id=<?= $value['id'] ?>"><?= $value['title'] ?></td>
                            </tr>
                            <?
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="form-footer mt-4 border-top">
        <a href="/office/?katalog" class="btn btn-link">назад</a>
    </div>

</div> 
