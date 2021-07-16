<!-- Large Modal -->
<div class="modal fade" id="form_edit_item_modal" tabindex="-1" role="dialog" aria-labelledby="form_edit_item_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_save_edit_item">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление меню</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="menu_title">Название</label>
                            <input type="text" class="form-control item_title" id="item_title" value="" placeholder="Наименование меню..." required>
                        </div>
                        <div class="form-group">
                            <label for="menu_title">Ссылка</label>
                            <input type="text" class="form-control item_link" id="item_link" value="" placeholder="Наименование меню..." required>
                        </div> 
                        <div class="form-group">
                            <label for="menu_title">Стили</label>
                            <input type="text" class="form-control item_css" id="item_css" value="" placeholder="Стили для ссылки..." required>
                        </div>
                        <div class="form-group">
                            <label for="menu_title">Принадлежность</label>
                            <select class="form-control item_parents w-100" name="menu_items">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="config_code">Доступ</label>
                            <select class="form-control menu_item_role w-100" name="menu_item_role">
                                
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="menu_id" class="edit_item_id" id="edit_item_id" value="0" />
                <span class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</span>
                <span class="btn btn-primary btn_save_edit_item">Сохранить</span>
            </div>
        </div>
    </div>
</div>



