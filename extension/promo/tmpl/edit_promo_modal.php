<div class="card">
    <div class="card-header card-header-border-bottom">
        <h2 class="col-lg-6"><a href="/admin/promo/">Промо акции</a> - Редактирование модального окна</h2>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="form-group">
                <label for="config_title">Заголовок модального окна</label>
                <input type="text" class="form-control promo_modal_title init_elm_edit" value="<?= $modal_data[0]['title'] ?>" elm_id="<?= $modal_data[0]['id'] ?>" elm_table="zay_promo_modal" elm_row="title">
            </div>
            <div class="form-group">
                <label for="config_title">Текст</label>
                <textarea name="promo_modal_descr" id="promo_modal_descr" class="form-control promo_modal_descr init_elm_edit" elm_id="<?= $modal_data[0]['id'] ?>" elm_table="zay_promo_modal" elm_row="descr" style="width: 100%;height: 300px;"><?= $modal_data[0]['descr'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="config_title">ID продукта который будет продаваться</label>
                <input type="text" class="form-control promo_modal_product_id init_elm_edit" value="<?= $modal_data[0]['product_id'] ?>" elm_id="<?= $modal_data[0]['id'] ?>" elm_table="zay_promo_modal" elm_row="product_id">
            </div>
            <div class="form-group">
                <label for="product_new">Отображать при первом входе на сайт</label><br/>
                <label class="switch switch-text switch-primary form-control-label">
                    <input type="checkbox" class="switch-input form-check-input promo_modal_first_load init_elm_edit" elm_id="<?= $modal_data[0]['id'] ?>" elm_table="zay_promo_modal" elm_row="active" value="1">
                    <span class="switch-label" data-on="On" data-off="Off"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="form-footer p-4 border-top">
        <a href="?promo_modal=<?= $_GET['promo_modal'] ?>&modal=1" class="btn btn-primary">Просмотреть модальное окно</a>
    </div>
</div> 
<script>
    var active_select = "<?= ($modal_data[0]['active'] == 1) ? 1 : 0 ?>";
    $(document).ready(function () {
        if (active_select == "1") {
            if (!$(".promo_modal_first_load").prop("checked")) {
                $(".promo_modal_first_load").click();
            }
        }


    });

</script>    