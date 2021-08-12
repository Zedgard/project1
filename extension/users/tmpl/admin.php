<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col">Список пользователей</h2> 
                    <div class="col text-right">
                        Всего пользователей: <?= $user_count ?>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <a href="?edit_user=0" class="btn btn-primary">Создать нового пользователя</a>
                        </div>
                        <div class="col text-right">
                            <?
                            if ($user->isAdmin()):
                                ?>
                                <a href="?user_roles=1" class="btn btn-primary">Управление ролей пользователя</a>
                                <?
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <input type="text" class="form-control input_search w-100" value="<?= (strlen($_GET['search_str'] > 0)) ? $_GET['search_str'] : $_SESSION['input_search_str'] ?>" placeholder="Поиск...">
                        </div>
                        <div class="col">
                            <div class="form-check" style="padding-top: 0.8rem;">
                                <input class="input_search_close_club_users" type="checkbox" value="">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Участник закрытого клуба
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-lg">
                                <table class="table users_data">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">№</th>
                                            <th style="text-align: center;">email</th>
                                            <th style="text-align: center;">Телефон</th>
                                            <th style="text-align: center;">Роль</th>
                                            <th style="text-align: center;">Активность</th>
                                            <th style="text-align: center;">Дата последней активности</th>
                                            <th style="text-align: center;"></th>
                                            <th style="text-align: center;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>

            </div> 
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalGridTitle">Настройки пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?
                                include 'user_settings.php';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer mb-5">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn-pill btn_save_user_settings">Сохранить</button>
            </div>

            <div class="edit_close_club_block pl-5 pb-5 pr-5" style="display: none;">
                <h2 class="mb-3">Информация по закрытому клубу</h2>
                <div>
                    <div class="table-responsive-lg">
                        <table class="table">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="btn_close_club_insert pl-5 pb-5 pr-5">
                <a href="javascript:void(0)" class="btn btn-primary init_super_insert" func="">Добавить новую запись по закрытому клубу</a>
            </div>

            <div class="form_result" style="display: none;">

            </div>
        </div>
    </div>
</div>
<script>
    var page_num = 1;
    var input_search_str = '<?= $_GET['search_str'] ?>';
    var obj_id = 0;
    var user_edit = '<?= $_GET['edit'] ?>';
</script>
<script src="/extension/users/js/admin.js"></script>