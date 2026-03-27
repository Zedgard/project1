<!-- Large Modal -->
<div class="modal fade" id="form_edit_account_modal" tabindex="-1" role="dialog" aria-labelledby="form_edit_account_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_save_menu">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление аккаунтом</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="account_name">Название</label>
                            <input type="text" class="form-control account_name" id="account_name" placeholder="Наименование аккаунта" required>
                        </div>

                        <div class="form-group">
                            <label for="account_category">Платежная категория</label>
                            <input type="text" class="form-control account_category" id="account_category" placeholder="Код категории платежных систем" required>
                        </div>
                        
                        <!-- <div class="form-group">
                            <label for="menu_descr">Описание (кратко)</label>
                            <textarea name="menu_descr" id="menu_descr" class="form-control menu_descr w-100 h-5" placeholder="Текст описания..."></textarea>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="config_code">Доступ</label>
                            <select class="form-control menu_role w-100" name="states">
                                
                            </select>
                        </div> -->

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="account_id" class="account_id" id="account_id" value="0" />
                <span class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</span>
                <span class="btn btn-primary btn_save_account">Сохранить</span>
            </div>
        </div>
    </div>
</div>



