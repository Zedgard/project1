<!-- true alert -->
<div class="modal fade" id="modal_not_insta_login" tabindex="-1" role="dialog" aria-labelledby="modal_not_insta_login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h4 class="modal-title">Внимание!</h4>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 1.8rem;">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <div class="mb-2 text-center">Добрый человек, чтобы учавствовать в закрытом клубе необходимо заполнить твой логин Instagram аккаунта</div>
                <div class="mb-2 text-center"><a href="/office/userprofile_admin/">Перейти в настройки</a></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#modal_not_insta_login").modal('show');
    });
</script>