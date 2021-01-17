<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Список пользователей</h2> 
                </div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12">
                            <input type="text" class="form-control input_search w-25" value="<?= $_GET['edit'] ?>" placeholder="Поиск...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-lg">
                                <table class="table users_data">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">ID</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalGridTitle">Настройки пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn-pill btn_save_user_settings">Сохранить</button>
            </div>
        </div>
    </div>
</div>
<script>
    var page_num = 1;
    var input_search_str = '<?= $_GET['search_str'] ?>';
    var obj_id = 0;
    var user_edit = '<?= $_GET['edit'] ?>';

    $(document).ready(function () {
        // поиск
        $(".input_search").change(function () {
            input_search_str = $(this).val();
            page_num = 1;
            initTable();
        });
        initTable();
    });


    function initTable() {
        //console.log('initTable');
        var h = $(".users_data tbody").height();
        $(".users_data tbody").height(h);
        $(".users_data tbody").html("");
        sendPostLigth('/jpost.php?extension=users', {"getUsersList": 1, 'page_num': page_num, 'input_search_str': input_search_str}, function (data) {
            for (var i = 0; i < data['data'].length; i++) {
                var active_text = '<span class="badge badge-danger">не активированный</span>';
                if (data['data'][i]['active'] == '1') {
                    var active_text = '<span class="badge badge-success">активированный</span>';
                }
                var user_online_text = '';
                if (data['data'][i]['user_online'] == '1') {
                    user_online_text = '<span class="badge badge-success">online</span>';
                }

                var active_subscriber = '';
                if (data['data'][i]['active_subscriber'] == '1') {
                    active_subscriber = '<span style="color: #FF0000;">ПОДПИСКА</span>';
                }
                $(".users_data tbody").append('<tr elmid="' + data['data'][i]['id'] + '" title="' + data['data'][i]['first_name'] + ' ' + data['data'][i]['last_name'] + '"> \
                                    <td style="text-align: center;">' + data['data'][i]['id'] + '</td> \
                                    <td style="text-align: center;">' + data['data'][i]['email'] + '</td> \
                                    <td style="text-align: center;">' + data['data'][i]['phone'] + '</td> \
                                        <td style="text-align: center;">' + data['data'][i]['role_name'] + '</td> \
                                    <td style="text-align: center;">' + active_text + '</td> \
                                    <td style="text-align: center;">' + data['data'][i]['active_lastdate'] +
                        ' ' + user_online_text + '</td> \
                <td style="text-align: center;">' + data['data'][i]['city'] +
                        ' ' + data['data'][i]['city_code'] + ' ' + active_subscriber + '</td> \
                                    <td style="text-align: center;"> \
                                    <div class="dropdown d-inline-block widget-dropdown"> \
                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-product" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"> \
                                    </a> \
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-product"> \
                                        <li class="dropdown-item"><i class="mdi mdi-account-edit"></i> <a href="#" class="userEdit" obj_id="' + data['data'][i]['id'] + '" data-toggle="modal" data-target="#editModal">Редактировать</a></li> \
                                        <li class="dropdown-item"><i class="mdi mdi-account-remove"></i> <a href="#" class="userDelete" obj_id="' + data['data'][i]['id'] + '">Удалить</a></li> \
                                        <li class="dropdown-item"><i class="mdi mdi-contact-mail"></i> <a href="#" class="userSendActivateEmail" obj_id="' + data['data'][i]['id'] + '">Отправить код активации повторно</a></li> \
                                        <li class="dropdown-item"><i class="mdi mdi-login-variant"></i> <a href="#" class="userAuth" obj_id="' + data['data'][i]['id'] + '">Войти в учетку</a></li> \
                                    </ul> \
                                    </div> \
                            </td> \
                                </tr>');
            }
            setTimeout(function () {
                $(".users_data").find('tr[elmid="' + user_edit + '"]').find(".userEdit").click();
            }, 1000);

            initUserEdit();
        });
    }

    function initUserEdit() {
        $(".userEdit").unbind('click').click(function () {
            obj_id = $(this).attr("obj_id");
            // получим данне по пользователю
            sendPostLigth('/jpost.php?extension=users', {"getUsersList": 1, 'page_num': page_num, "system_user_id": obj_id}, function (data) {
                $(".first_name").val(data['data']['first_name']);
                $(".last_name").val(data['data']['last_name']);
                $(".user_phone").val(data['data']['phone']);
                $(".user_email").val(data['data']['email']);
                init_roles(data['data']['role_id']);
                //$('.user_phone').mask('+7 (999) 999-9999');
            });

            $(".btn_save_user_settings").unbind('click').click(function () {
                var first_name = $(".user_settings .first_name").val();
                var last_name = $(".user_settings .last_name").val();
                var phone = $(".user_settings .user_phone").val();
                var email = $(".user_settings .user_email").val();
                var user_role = $(".user_settings .user_role").val();

//                    var oldPassword = $(".user_settings .oldPassword").val();
//                    var newPassword = $(".user_settings .newPassword").val();
                var conPassword = $(".user_settings .conPassword").val();

                $('.form_result').html("");
                sendPostLigth('/jpost.php?extension=users',
                        {"saveProfilSettings": 1,
                            "first_name": first_name,
                            "last_name": last_name,
                            "phone": phone,
                            "email": email,
                            "user_role": user_role,
                            //"newPassword": newPassword,
                            "conPassword": conPassword
                        }, function (result) {
                    //console.log("data: " + result);;
                    initTable();
                    var metod = 0;
                    if (result['success'] == 1) {
                        $('.form_result').append(result['success_text']);
                        metod = 1;
                    }
                    if (result['success'] == 0) {
                        if (result['errors'].length > 0) {
                            for (var i = 0; i < result['errors'].length; i++) {
                                $('.form_result').append(result['errors'][i]);
                            }
                        }
                        metod = 2;
                    }
                    // Непредвиденная ошибка, если result['success'] не передали
                    if (metod == 0) {
                        $('.form_result').append("Error system №101 !");
                    }
                    $('#editModal').modal('hide');
                });
            });

        });

        $(".userDelete").unbind('click').click(function () {
            obj_id = $(this).attr("obj_id");
            if (confirm('Вы действительно хотите удалить пользователя ID=' + obj_id + '?')) {
                //   alert('delete');
                sendPostLigth('/jpost.php?extension=users',
                        {"userDelete": 1, "system_user_id": obj_id},
                        function (data) {
                            initTable();
                        });
            }
        });


        $(".userSendActivateEmail").unbind('click').click(function () {
            var obj_id = $(this).attr("obj_id");
            sendPostLigth('/jpost.php?extension=users',
                    {"userSendActivateEmail": obj_id},
                    function (data) {
                        if (data['success'] == 1) {

                        }
                    });
        });

        $(".userAuth").unbind('click').click(function () {
            var obj_id = $(this).attr("obj_id");
            sendPostLigth('/jpost.php?extension=users',
                    {"userAuth": obj_id},
                    function (data) {

                    });
        });
    }

    /**
     * Получить доступные роли
     * @returns {undefined}
     */
    function init_roles(role_id) {
        $(".user_role").html("");
        sendPostLigth('/jpost.php?extension=users', {"get_roles_array": 1}, function (e) {
            //blockInfo = e['data'];
            //role_id
            for (var i = 0; i < e['data'].length; i++) {
                var selected = '';
                if (role_id == e['data'][i]['id']) {
                    selected = 'selected="selected"';
                }
                $(".user_role").append('<option value="' + e['data'][i]['id'] + '" ' + selected + ' >' + e['data'][i]['role_name'] + '</option>');
            }
        });
    }

</script>