var input_search_close_club_users = 0;
$(document).ready(function () {
    $(".input_search").delayKeyup(function () {
        initTable();
    }, 700);
    $(".input_search_close_club_users").change(function () {
        if ($(".input_search_close_club_users").prop('checked')) {
            input_search_close_club_users = 1;
        } else {
            input_search_close_club_users = 0;
        }
        initTable();
    });
    initTable();
});


function initTable() {
    //console.log('initTable');
    if ($(".users_data").length > 0) {
        var input_search = $(".input_search").val();
        //var h = $(".users_data tbody").height();
        //$(".users_data tbody").height(h);
        sendPostLigth('/jpost.php?extension=users', {
            "getUsersList": 1,
            'page_num': page_num,
            'input_search_str': input_search,
            'input_search_close_club_users': input_search_close_club_users
        }, function (data) {
            $(".users_data tbody").html("");
            var a = 1;
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

                var close_club = '';
                var close_club_status = 0;
                var close_club_text = '';
                var close_club_status_text = '';
                var close_club_end_date = '';
                if (data['data'][i]['close_club_true'] == '1') {
                    close_club_status = data['data'][i]['close_club_status'];
                    close_club_text = '<span class="alert-success">Участник закрытого клуба</span>';
                    if (close_club_status == 1) {
                        close_club_status_text = '<span class="alert-success">Активен</span>';
                    } else {
                        close_club_status_text = '<span class="alert-danger">Не продлен</span>';
                    }
                    close_club_end_date = data['data'][i]['close_club_end_date'];
                    close_club = '<br/>' + close_club_text + '<br/>' + close_club_status_text + '<br/>' + close_club_end_date;
                }


                $(".users_data tbody").append('<tr elmid="' + data['data'][i]['id'] + '" title="' + data['data'][i]['id'] + ' ' + data['data'][i]['first_name'] + ' ' + data['data'][i]['last_name'] + '"> \
                                    <td style="text-align: center;">' + a + '</td> \
                                    <td style="text-align: center;">' + data['data'][i]['email'] + '</td> \
                                    <td style="text-align: center;">' + data['data'][i]['phone'] + '</td> \
                                        <td style="text-align: center;">' + data['data'][i]['role_name'] + '</td> \
                                    <td style="text-align: center;">' + active_text + '</td> \
                                    <td style="text-align: center;">' + data['data'][i]['active_lastdate'] + '<br/>' + user_online_text + '</td> \
                            <td style="text-align: center;">' + data['data'][i]['city'] + '<br/>' + data['data'][i]['city_code'] + '<br/>' + active_subscriber + close_club + '</td> \
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
                a++;
            }
            setTimeout(function () {
                $(".users_data").find('tr[elmid="' + user_edit + '"]').find(".userEdit").click();
            }, 1000);
            initUserEdit();
        });
    }
}

function initUserEdit() {
    if ($(".userEdit").length > 0) {
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

            init_edit_close_club(obj_id);
            init_btn_save_user_settings();

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
}

function init_btn_save_user_settings(func) {
    if ($(".btn_save_user_settings").length > 0) {
        $(".btn_save_user_settings").unbind('click').click(function () {
            var first_name = $(".user_settings .first_name").val();
            var last_name = $(".user_settings .last_name").val();
            var phone = $(".user_settings .user_phone").val();
            var email = $(".user_settings .user_email").val();
            var login_instagram = $(".user_settings .login_instagram").val();
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
                        "login_instagram": login_instagram,
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
                    if (user_edit.length > 0) {
                        document.location.href = '/admin/admin_users/?search_str=' + input_search_str;
                    }
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

                if (typeof func !== 'undefined') {
                    func();
                }
            });
        });
    }
}

/**
 * Получить доступные роли
 * @returns {undefined}
 */
function init_roles(role_id) {
    if ($(".user_role").length > 0) {
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
}

function init_edit_close_club(user_id) {
    console.log('init_edit_close_club: ' + user_id);
    if (user_id > 0) {
        $(".edit_close_club_block").hide();
        $(".btn_close_club_insert").hide();
        $(".edit_close_club_block .table tbody").html("");
        sendPostLigth('/jpost.php?extension=close_club', {
            "get_close_club_user_info": 1,
            'user_id': user_id
        }, function (e) {
            if (e['data'].length > 0) {
                $(".edit_close_club_block").show();
                for (var i = 0; i < e['data'].length; i++) {
                    $(".edit_close_club_block .table tbody").append('<tr>\n\
                                <td>Дата окончания обонемента</td>\n\
                                <td><input type="text" name="close_club_end_date" value="' + e['data'][0]['end_date'] + '" elm_id="' + e['data'][0]['id'] + '" elm_table="zay_close_club" elm_row="end_date" class="form-control inp_datepicker init_elm_edit"></td>\n\
                            </tr>');
                    $(".edit_close_club_block .table tbody").append('<tr>\n\
                                <td>Дата Заморозки</td>\n\
                                <td><input type="text" name="close_club_freeze_date" value="' + e['data'][0]['freeze_date'] + '" elm_id="' + e['data'][0]['id'] + '" elm_table="zay_close_club" elm_row="freeze_date" class="form-control inp_datepicker init_elm_edit"></td>\n\
                            </tr>');
                    $(".edit_close_club_block .table tbody").append('<tr>\n\
                                <td>Дни заморозки</td>\n\
                                <td><input type="text" name="close_club_freeze_date" value="' + e['data'][0]['freeze_day'] + '" elm_id="' + e['data'][0]['id'] + '" elm_table="zay_close_club" elm_row="freeze_day" class="form-control init_elm_edit"></td>\n\
                            </tr>');

                }

                super_init();
                init_datepicker(3);
            } else {
                $(".btn_close_club_insert").show();
                $(".btn_close_club_insert .init_super_insert").attr('jpost_url', '/jpost.php?extension=close_club&close_club_insert=1&user_id=' + user_id);
                $(".btn_close_club_insert .init_super_insert").attr('func',"init_edit_close_club('" + user_id + "')");
            }
        });
    }
}