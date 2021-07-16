<!-- Large Modal -->
<div class="modal fade" id="form_edit_products_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-xl" role="document">
        <div class="modal-content form_save_products">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="" style="padding: 1rem;background-color: #FFFFFF;position: fixed;top: 2rem;right: 5%;z-index: 9;">
                    <span class="btn btn-primary btn_save_products">Сохранить</span>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="config_title">Название</label>
                            <input type="text" class="form-control products_title" id="products_title" placeholder="Наименование..." required>
                        </div>

                        <div class="form-group">
                            <label for="products_wares" class="label_products_wares">Товары</label>
                            <select class="form-control products_wares" name="states[]" multiple="multiple" style="width: 100%">

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="config_code">Темы</label>
                            <select class="form-control products_topic" name="states[]" multiple="multiple" style="width: 100%">

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="config_code">Категории</label>
                            <select class="form-control products_category" name="states[]" style="width: 100%">

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="config_code">Тема продукта</label>
                            <select class="form-control product_theme" name="states[]" multiple="multiple" style="width: 100%">

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product_new">Новый товар (признак)</label><br/>
                            <label class="switch switch-text switch-primary form-control-label">
                                <input type="checkbox" class="switch-input form-check-input product_new" value="1">
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="config_code">Описание (кратко)</label>
                            <textarea name="products_desc_minimal" id="products_desc_minimal" class="form-control products_desc_minimal" placeholder="Текст описания (краткое)..." style="width: 100%;height: 50px;"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="products_desc">Текст полного описания</label>
                            <textarea name="products_desc" id="products_desc" class="form-control products_desc" placeholder="Текст полного описания..." style="width: 100%;height: 100px;"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="products_price">Продано</label>
                            <input type="text" class="form-control products_sold" id="products_sold" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Колличество продано..." required>
                        </div>

                        <div class="form-group">
                            <label for="products_active">Отображение</label><br/>
                            <label class="switch switch-text switch-primary form-control-label">
                                <input type="checkbox" class="switch-input form-check-input products_active" value="1" checked="checked">
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="products_price">Цена</label>
                            <input type="text" class="form-control products_price" id="products_price" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Цена продукта" required>
                        </div>

                        <div class="form-group">
                            <label for="products_price">Цена со скидкой</label>
                            <input type="text" class="form-control products_price_promo" id="products_price_promo" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Цена продукта" required>
                        </div>


                        <div class="form-group">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <label for="product_content">Содержание товара (Произвольный текст)</label>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <textarea name="product_content" id="product_content" class="form-control product_content" placeholder="Текст содержание товара..." style="width: 100%;height: 100px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?
                        importELFinder(1);
                        ?>

                        <?
                        include 'block_profit.php';
                        ?>

                        <?
                        include 'block_trailer.php';
                        ?>

                        <?
                        include 'block_feedback.php';
                        ?>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="products_id" class="products_id" id="products_id" value="0" />
                <span class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</span>
                <span class="btn btn-primary btn_save_products">Сохранить</span>
            </div>
        </div>
    </div>
</div>



