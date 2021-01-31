<!-- Large Modal -->
<div class="modal fade" id="form_edit_wares_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_save_wares">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление товаром</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="config_title">Название</label>
                    <input type="text" class="form-control wares_title" id="wares_title" placeholder="Наименование товара..." required>
                </div>

                <div class="form-group">
                    <label for="config_code">Категории</label>
                    <select class="form-control wares_categorys" name="states[]" multiple="multiple" style="width: 100%">

                    </select> 
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="config_code">Код товара</label>
                        <input type="text" class="form-control wares_ex_code" id="wares_ex_code" placeholder="Код..." required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="config_code">Артикул</label>
                        <input type="text" class="form-control wares_articul" id="wares_articul" placeholder="Артикул..." required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="config_code">Количество</label>
                    <input type="text" class="form-control wares_col" id="wares_col" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Количество товара в наличии..." required>
                </div>

                <div class="form-group">
                    <label for="wares_descr">Подробное описание</label>
                    <textarea name="wares_descr" id="wares_descr" class="form-control wares_descr" placeholder="Текст описания..." style="width: 100%;height: 100px;"></textarea>
                </div>

                <!--
                <div class="form-group">
                    <label for="wares_active">Отображение</label><br/>
                    <label class="switch switch-text switch-primary form-control-label">
                        <input type="checkbox" class="switch-input form-check-input wares_active" value="1" checked="checked">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
                -->

                <?
                importELFinder(1);
                ?>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="wares_id" class="wares_id" id="wares_id" value="0" />
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn_save_config">Сохранить</button>
            </div>
        </div>
    </div>
</div>


