<!-- Large Modal -->
<div class="modal fade" id="form_edit_email_modal" tabindex="-1" role="dialog" aria-labelledby="form_edit_email_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Управление сообщением</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="email_subject">Тема</label>
                    <input type="text" class="form-control email_subject" id="email_subject" value="" placeholder="Тема сообщения..." required>
                </div>

                <div class="form-group">
                    <label for="email_descr">Описание</label>
                    <textarea name="email_descr" class="form-control w-100 h-5 email_descr" id="email_descr" placeholder="Текст описания для пояснения..."></textarea>
                </div>


                <div class="form-group">
                    <label for="email_body_file">Фаил</label>
                    <input type="text" class="form-control email_body_file" id="config_title" value="" placeholder="Наименование файла..." required>
                </div>

                <div class="form-group">
                    <label for="email_reply_to">Ответ</label>
                    <input type="text" class="form-control email_reply_to" id="email_reply_to" value="" placeholder="Куда отправлять ответ..." required>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label for="email_text">Текст</label>
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary btn_show_body_text_message float-right" style="display: none;">просмотреть</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-3 mb-3 show_body_text_message" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <textarea name="email_text" id="email_text" class="form-control email_text" placeholder="Текст сообщения" style="width: 100%;height: 200px;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="ml-3 form-group">
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input email_send" value="1">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Активировать</label>
                    </div>
                </div>

                
                
            </div>
            <div class="modal-footer">
                <input type="hidden" name="email_id" class="email_id" id="email_id" value="0" />
                <button type="button" class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn_save_email">Сохранить</button>
            </div>
        </div>
    </div>
</div>