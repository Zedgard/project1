<!-- Large Modal -->
<div class="modal fade" id="form_edit_config_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content form_save_config">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление настройкой</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Категория</label>
                    <select name="config_category" id="config_category" class="form-control config_category">

                    </select>
                </div>

                <div class="form-group">
                    <label for="config_code">Код</label>
                    <input type="text" class="form-control config_code" id="config_code" placeholder="Код блока использования в системе" required>
                </div>

                <div class="form-group">
                    <label for="config_title">Название</label>
                    <input type="text" class="form-control config_title" id="config_title" placeholder="Наименование настройки" required>
                </div>

                <div class="form-group">
                    <label for="config_descr">Описание</label>
                    <textarea name="config_descr" id="config_descr" class="form-control config_descr" placeholder="Текст описания" style="width: 100%;height: 100px;"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Тип блока</label>
                    <select name="config_type" id="config_type" class="form-control config_type">
                        <option value="">Выбирите...</option>
                        <option value="input">Простой текст</option>
                        <option value="textarea">Расширенный текст</option>
                        <option value="checkbox">Чек бокс</option>
                    </select>
                </div>

                <div class="block block_input" style="display: none;">
                    <div class="form-group">
                        <label for="config_val">Значение</label>
                        <input type="text" id="config_val" class="form-control config_input_val" placeholder="Значение настройки">
                    </div>
                </div>
                <div class="block block_textarea" style="display: none;">
                    <div class="form-group">
                        <label for="config_val">Значение</label>
                        <textarea name="config_val" id="config_val" class="form-control config_textarea_val" style="width: 100%;height: 100px;"></textarea>
                    </div>
                </div>
                <div class="block block_checkbox" style="display: none;">
                    <div class="form-group">
                        <label for="config_val">Значение</label>
                        <input type="checkbox" name="config_val" class="form-control config_checkbox_val" value="1" checked="checked" />
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="config_id" class="config_id" id="config_id" value="0" />
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn-pill btn_save_config">Сохранить</button>
            </div>
        </div>
    </div>
</div>