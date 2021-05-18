<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <a href="./" class="btn btn-link">UTM метки</a>- Управление тегами
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                
            </div>

            <div class="form-group">
                <input type="hidden" name="promo_id" value="<?= $_GET['edit'] ?>" />
                <input type="submit" value="Сохранить" class="btn btn-primary" />
            </div>

        </form>
    </div>

    <div class="form-footer border-top">
        <a href="./" class="btn btn-link">назад</a>
    </div>
</div>
