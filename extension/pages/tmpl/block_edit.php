<!-- Large Modal -->
<div class="modal fade" id="form_edit_block_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_save_block">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление продуктом</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="block_name" class="label_block_name">Наименование</label>
                            <input type="text" class="form-control block_name" id="block_name" placeholder="Наименование блока" required>
                        </div>

                        <div class="form-group">
                            <label for="block_code" class="label_block_code">Код блока (используеться в шаблонах)</label>
                            <input type="text" class="form-control block_code" id="block_code" placeholder="Код блока"  required>
                        </div>
                        
                        <div class="form-group">
                            <label for="block_role">Роли которые будут видеть этот блок</label>
                            <select class="form-control block_role" name="block_role" name="block_role[]" multiple="multiple" style="width: 100%">
                                
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="block_id" class="block_id" id="block_id" value="0" />
                <span class="btn btn-danger btn-pill" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</span>
                <span class="btn btn-primary btn-pill btn_save_blok">Сохранить</span>
            </div>
        </div>
    </div>
</div>



