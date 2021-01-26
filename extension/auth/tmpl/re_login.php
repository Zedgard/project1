<!-- Large Modal -->
<div class="modal fade" id="form_re_password_modal" tabindex="-1" role="dialog" aria-labelledby="re_password_ModalLarge" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_re_password">
            <div class="modal-header">
                <h5 class="modal-title">Восстановление пароля</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="config_title">Адрес электронной почты</label>
                    <input type="text" class="form-control re_user_email" id="re_user_email" placeholder="email..." required>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn_re_password">Отправить</button>
            </div>
        </div>
    </div>
</div>

<?
if (isset($_GET['repassword']) && strlen($_GET['repassword']) > 0) {
    $_SESSION['repassword'] = $_GET['repassword'];
    ?>
    <!-- Large Modal -->
    <div class="modal fade" id="form_re_password2_modal" tabindex="-1" role="dialog" aria-labelledby="re_password_ModalLarge" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content form_re_password2">
                <div class="modal-header">
                    <h5 class="modal-title">Изменить пароль</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="config_title">Пароль</label>
                        <input type="password" class="form-control re_password" id="re_password">
                    </div>

                    <div class="form-group">
                        <label for="config_title">Повторить пароль</label>
                        <input type="password" class="form-control re_password2" id="re_password2">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn_re_password2">Отправить</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#form_re_password2_modal").modal("show");
        $(".btn_re_password2").unbind("click").click(function () {
            init_re_password();
        });
    </script>
    <?
}
?>

