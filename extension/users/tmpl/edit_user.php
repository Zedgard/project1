<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col">Редактирование пользователя</h2> 
                </div>

                <div class="card-body">
                    <?
                    $_SESSION['user_edit_obj_id'] = 0;
                    include 'user_settings.php';
                    ?>
                    <div class="row">
                        <div class="col">
                            <a href="./" class="btn btn-secondary btn-default">< назад</a>
                        </div>
                        <div class="col text-right">
                            <button type="button" class="btn btn-lg btn-primary btn_save_user_settings">Сохранить</button>
                        </div>
                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>

            </div> 
        </div>
    </div>
</div>

<script>
    var page_num = 1;
    var input_search_str = '<?= $_GET['search_str'] ?>';
    var obj_id = 0;
    var user_edit = '<?= $_GET['edit'] ?>';

    $(function () {

        init_btn_save_user_settings(function () {
            document.location.href = './';
        });
        init_roles(0);

    });
</script>
<script src="/extension/users/js/admin.js"></script>