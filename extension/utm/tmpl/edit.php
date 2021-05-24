<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        UTM метки
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="config_title">Название</label>
                        <input type="text" class="form-control promo_title" name="promo_title" value="<?= (isset($utm_data['title'])) ? $utm_data['title'] : '' ?>" placeholder="Наименование...">
                    </div>
                </div> 
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="config_title">Код метки</label>
                        <input type="text" class="form-control promo_code" name="promo_code" value="<?= (isset($utm_data['code'])) ? $utm_data['code'] : '' ?>" placeholder="Код промо...">
                    </div>
                </div>  
            </div>

            <div class="form-group">
                <label for="promo_products" class="label_products_wares">Товары участвующие в промо</label>
                <select class="form-control promo_products" name="promo_products[]" multiple="multiple" style="width: 100%">

                </select>
            </div>

            <div class="form-group">
                <input type="hidden" name="promo_id" value="<?= $_GET['edit'] ?>" />
                <input type="submit" value="Сохранить" class="btn btn-primary" />
            </div>

        </form>
    </div>

    <div class="form-footer pt-4 pt-5 mt-4 border-top">

    </div>
</div>
