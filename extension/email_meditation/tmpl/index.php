<link id="sleek-css" rel="stylesheet" href="/extension/email_meditation/css/email_meditation.css<?= $_SESSION['rand'] ?>" />
<div class="get_emails_container">
    <div class="container">
        <div class="row pt-2 pb-2">
            <div class="col-lg-6">
                <span class="get_emails_text1 mb-1">Введи имайл и получи медитацию</span>
            </div>
            <div class="col-lg-6" style="margin-top: 0.5rem;margin-bottom: 0.4rem;">
                <input type="button" value="я готов!" class="get_emails_btn_submit" />
                <input type="text" name="set_email" value="" class="get_emails_input" placeholder="ВВЕДИТЕ ПОЧТУ" />
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="get_emails_modal_center" tabindex="-1" role="dialog" aria-labelledby="get_emails_modal_center" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Отправка электронного адреса</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body get_emails_modal_body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>