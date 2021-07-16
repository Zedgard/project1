<!-- Modal -->
<div class="modal bd-example-modal-lg fade" id="form_config_email" tabindex="-1" role="dialog" aria-labelledby="form_config_email" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Общие настройки отправки сообщений SMTP</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Пользователь</label>
                            <input type="text" class="form-control config_email_username" name="config_email_username" value="" placeholder="Email от которого будут отправляться письма..." required />
                        </div>
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="password" class="form-control config_email_password" name="config_email_password" value="" placeholder="Пароль..." required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn_config_email_save">Применить</button>
            </div>
        </div>

    </div>
</div>