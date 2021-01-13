<!-- 
Функция подписки на рассылку (имейл попадает к нам в базу, человеку отправляется подтверждающий имейл). 
Градиент (с левого верхнего угла #6bdd78 зеленый до правого нижнего угла 63a7d6 синий)
-->
<link id="sleek-css" rel="stylesheet" href="/extension/get_emails/css/get_emails.css<?= $_SESSION['rand'] ?>" />
<div class="get_emails_container">
    <div class="container">
        <div class="row pt-2 pb-2">
            <div class="col-lg-6">
                <span class="get_emails_text1">Подпишитесь на рассылку</span>
                <span class="get_emails_text2">и первым узнавайте о выгодных предложениях</span>
            </div>
            <div class="col-lg-6" style="margin-top: 0.5rem;margin-bottom: 0.4rem;">
                <input type="button" value="я готов!" class="get_emails_btn_submit" />
                <input type="text" name="set_email" value="" class="get_emails_input" placeholder="ПРОСТО ВВЕДИТЕ ПОЧТУ И ПОЛУЧИТЕ ВЫГОДУ" />
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body get_emails_modal_body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".get_emails_btn_submit").unbind("click").click(function () {
            var set_email = $(".get_emails_input").val();
            sendPostLigth('/jpost.php?extension=get_emails', {"set_email": set_email}, function (e) {
                $("#get_emails_modal_center").modal('show');

                if (e['success'] == 1) {
                    $(".get_emails_modal_body").html('<div class="">' + e['success_text'] + '</div>');
                } else {
                    if (e['errors'].length > 0) {
                        $(".get_emails_modal_body").html("");
                        for (var i = 0; i < e['errors'].length; i++) {
                            $(".get_emails_modal_body").append('<div class="get_emails_error_text">' + e['errors'][i] + '</div>');
                        }
                    } else {
                        $(".get_emails_modal_body").html('<div class="get_emails_error_text">Не отправлено, общая проблема!</div>');
                    }
                }
                
            });
        });
    });
</script>