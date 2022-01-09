<!-- Large Modal -->
<div class="modal fade" id="form_edit_wares_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_save_wares">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление товаром</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
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
                    <select class="form-select wares_categorys" name="states[]" multiple="multiple" style="width: 100%">

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

                <div class="mb-3" style="padding: 1%;background-color: #f7f7f7;">
                    <h3>Закрытый клуб</h3>
                    <div class="form-group">
                        <label for="club_month_period">Колличество месяцев для доступа к закрытому клубу</label>
                        <select id="club_month_period" name="club_month_period" class="form-control club_month_period">
                            <option value="0">Не предоставлено</option>
                            <option value="1">1 месяц</option>
                            <option value="2">2 месяц</option>
                            <option value="3">3 месяц</option>
                            <option value="4">4 месяц</option>
                            <option value="5">5 месяц</option>
                            <option value="6">6 месяц</option>
                            <option value="7">7 месяц</option>
                            <option value="8">8 месяц</option>
                            <option value="9">9 месяц</option>
                            <option value="10">10 месяц</option>
                            <option value="11">11 месяц</option>
                            <option value="12">12 месяц</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="club_days_period">Колличество дней для доступа к закрытому клубу</label>
                        <select id="club_days_period" name="club_days_period" class="form-control club_days_period">
                            <option value="0">Не предоставлено</option>
                            <?
                            for ($day_i = 0;$day_i<28;$day_i++) {
                                ?>
                                <option value="<?= $day_i ?>"><?= $day_i ?></option>
                                <?
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="wares_id" class="wares_id" id="wares_id" value="0" />
                <button type="button" class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn_save_wares">Сохранить</button>
            </div>
        </div>
    </div>
</div>
<script src="/assets/plugins/tinymce/tinymce.js"></script>


