<!-- Large Modal -->
<div class="modal fade" id="form_edit_menu_modal" tabindex="-1" role="dialog" aria-labelledby="form_edit_menu_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_save_menu">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление меню</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="menu_title">Название</label>
                            <input type="text" class="form-control menu_title" id="menu_title" placeholder="Наименование меню..." required>
                        </div>

                        <div class="form-group">
                            <label for="menu_code">Код</label>
                            <input type="text" class="form-control menu_code" id="menu_code" onkeyup="this.value = this.value.replace(/[^a-z_+]/, '')" placeholder="Код меню для вставки..." required>
                        </div>
                        
                        <div class="form-group">
                            <label for="menu_descr">Описание (кратко)</label>
                            <textarea name="menu_descr" id="menu_descr" class="form-control menu_descr w-100 h-5" placeholder="Текст описания..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="config_code">Доступ</label>
                            <select class="form-control menu_role w-100" name="states">
                                
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="menu_id" class="menu_id" id="menu_id" value="0" />
                <span class="btn btn-danger" data-dismiss="modal">Закрыть</span>
                <span class="btn btn-primary btn_save_menu">Сохранить</span>
            </div>
        </div>
    </div>
</div>



