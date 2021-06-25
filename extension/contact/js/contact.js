$(document).ready(function () {
    init_btn_send_message();
});

function init_btn_send_message() {
    if (!!$(".btn_send_user_message")) {
        $(".form_send_user_message").find(".user_email").keyup(function () {
            $(".form_send_user_message").find(".user_email").css("border-color", "");
        });
        $(".form_send_user_message").find(".user_message").keyup(function () {
            $(".form_send_user_message").find(".user_message").css("border-color", "");
        });
        $(".btn_send_user_message").click(function () {
            var user_fio = $(".form_send_user_message").find(".user_fio").val();
            var user_email = $(".form_send_user_message").find(".user_email").val();
            var user_subject = $(".form_send_user_message").find(".user_subject").val();
            var user_message = $(".form_send_user_message").find(".user_message").val();
            var user_check_indicator = ($(".form_send_user_message").find('[name="user_check_indicator"]').prop("checked")) ? 1 : 0;

            if (user_email.length > 2 && user_message.length > 10 && user_check_indicator > 0) {
                sendPostLigth('/jpost.php?extension=contact', {
                    "user_send_message": 1,
                    "user_fio": user_fio,
                    "user_email": user_email,
                    "user_subject": user_subject,
                    "user_message": user_message,
                }, function (e) {
                    if (e['success'] == '1') {
                        alert("Успешно отправлено, ждите ответа.");
                        $(".form_send_user_message").find(".user_email").val("");
                    } else {
                        alert("Ошибка!");
                    }
                });
            } else {
                if (user_email.length <= 2) {
                    $(".form_send_user_message").find(".user_email").css("border-color", "#ff0000");
                }
                if (user_message.length <= 10) {
                    $(".form_send_user_message").find(".user_message").css("border-color", "#ff0000");
                }
                alert('Не заполнены поля или не стоят галочки!');
            }

        });
    }
}