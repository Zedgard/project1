<!-- Large Modal -->
<div class="modal fade" id="form_fast_consultation_modal" tabindex="-1" role="dialog" aria-labelledby="fast_consultation" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content form_save_fast_consultation">
            <div class="modal-header">
                <h5 class="modal-title" id="fast_consultation">Заявка на быструю консультацию</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control fast_consultation_fio" placeholder="Имя" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control fast_consultation_email" placeholder="Адес электронной почты" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control fast_consultation_name_phone" placeholder="Телефон" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control fast_consultation_topic" placeholder="Тема консультации" required>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-12 fast_consultation_result">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="products_id" class="products_id" id="products_id" value="0" />
                <span class="btn btn-danger" data-dismiss="modal">Закрыть</span>
                <span class="btn btn-primary btn_send_fast_consultation">Отправить</span>
            </div>
        </div>
    </div>
</div>