<!-- Large Modal -->
<div class="modal fade" id="form_category_edit_modal" tabindex="-1" role="dialog" aria-labelledby="form_category_edit_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_category_edit">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление настройкой</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="config_title">Название</label>
                    <input type="text" class="form-control category_title" id="config_title" placeholder="Наименование настройки" required>
                </div>
                
                <div class="form-group">
                    <label for="config_code">Код</label>
                    <input type="text" class="form-control category_code" id="config_code" placeholder="Код блока использования в системе" required>
                </div> 
                
                <div class="form-group">
                    <label for="config_code">Цвет</label>
                    <input type="text" class="form-control config_color" id="config_color" placeholder="Цвет" required>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="category_id" class="category_id" id="category_id" value="0" />
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn-pill btn_save_category">Сохранить</button>
            </div>
        </div>
    </div>
</div>