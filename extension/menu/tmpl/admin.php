<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Управление меню</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary btn_menu_edit" obj_i="">Добавление меню</a>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-bordered wares_arrays_data" style="width:100%;background-color: #FFFFFF;">
                                <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th class="text-center">Код</th>
                                        <th>Описание</th>
                                        <th class="text-center">Роль</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="menu_all">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>

            </div> 
        </div>
    </div>
</div>
<?
include 'edit_menu.php';
?>
<script>
    var roles = [];
    var menus = [];
    var menu_id = 0;
    $(document).ready(function () {
        init_roles_list();
        init_edit_menu();
    });

    /*
     * получить меню
     */
    function init_get_menu_all() {
        sendPostLigth('/jpost.php?extension=menu',
                {"get_menu_all": 1},
                function (e) {
                    $(".menu_all").html("");
                    if (e['data'].length > 0) {
                        for (var i = 0; i < e['data'].length; i++) {
                            menus.push(e['data'][i]);
                            // получим роли
                            var role = get_role_info(e['data'][i]['menu_role']);
                            $(".menu_all").append('<tr>\n\
                                        <td>' + e['data'][i]['menu_title'] + '</td>\n\
                                        <td class="text-center">' + e['data'][i]['menu_code'] + '</td>\n\
                                        <td>' + e['data'][i]['menu_descr'] + '</td>\n\
                                        <td class="text-center">' + role['role_name'] + '</td>\n\
                                        <td class="text-center">\n\
                                        <a href="?menu_items=' + e['data'][i]['id'] + '" class="btn btn-sm btn-primary" obj_i="' + i + '">редактировать</a>\n\
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn_menu_edit" obj_i="' + i + '"><i class="mdi mdi-pencil"></i></a>\n\
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn_menu_delete" obj_i="' + i + '"><i class="mdi mdi-delete"></i></a>\n\
                                        </td>\n\
                                    </tr>');
                        }
                        init_edit_menu();
                        init_btn_menu_delete();
                    }
                });
    }

    /*
     * Получить роли
     */
    function init_roles_list() {
        sendPostLigth('/jpost.php?extension=users',
                {"get_roles_array": 1},
                function (e) {
                    if (e['data'].length > 0) {
                        for (var i = 0; i < e['data'].length; i++) {
                            roles.push(e['data'][i]);
                        }
                    }
                    init_get_menu_all();
                });
    }

    /*
     * Получить информацию по роли
     */
    function get_role_info(role_id) {
        if (roles.length > 0) {
            for (var i = 0; i < roles.length; i++) {
                if (role_id == roles[i]['id']) {
                    return roles[i];
                }
            }
        }
        return [];
    }

    /*
     * Форма редактирования меню
     */
    function init_edit_menu() {
        $(".btn_menu_edit").unbind('click').click(function () {
            if (roles.length > 0) {
                $(".menu_role").html("");
                for (var i = 0; i < roles.length; i++) {
                    $(".menu_role").append('<option value="' + roles[i]['id'] + '">' + roles[i]['role_name'] + '</option>'); // roles[i]
                }
            }

            var obj_i = $(this).attr("obj_i");
            menu_id = 0;
            if (obj_i != '') {
                $(".menu_title").val(menus[menu_id]['menu_title']);
                $(".menu_code").val(menus[menu_id]['menu_code']);
                $(".menu_descr").val(menus[menu_id]['menu_descr']);
                $(".menu_role").val(menus[menu_id]['menu_role']);
                $(".menu_id").val(menus[menu_id]['id']);
                menu_id = menus[menu_id]['id'];
            }
            init_btn_save_menu();
            $("#form_edit_menu_modal").modal('toggle');
        });
    }

    /*
     * Сохрание данных по меню
     */
    function init_btn_save_menu() {
        $(".btn_save_menu").unbind('click').click(function () {
            var menu_title = $(".menu_title").val();
            var menu_code = $(".menu_code").val();
            var menu_descr = $(".menu_descr").val();
            var menu_role = $(".menu_role").val();
            var menu_id = $(".menu_id").val();

            var errors = [];
            if (menu_title.length < 3) {
                errors.push('Название не заполено');
            }
            if (menu_code.length < 3) {
                errors.push('Код не заполено');
            }
            for (var i = 0; i < menus.length; i++) {
                if (menus[i]['menu_code'] == menu_code) {
                    errors.push('Код уже существует, используйте другой код');
                }
            }
            if (errors.length == 0) {
                sendPostLigth('/jpost.php?extension=menu',
                        {
                            "edit_menu": 1,
                            "menu_title": menu_title,
                            "menu_code": menu_code,
                            "menu_descr": menu_descr,
                            "menu_role": menu_role,
                            "menu_id": menu_id
                        },
                        function (e) {
                            if (e['success'] == '1') {
                                $("#form_edit_menu_modal").modal('toggle');
                                init_get_menu_all();
                            }
                        });

            } else {
                var html = "";
                for (var i = 0; i < errors.length; i++) {
                    html += errors[i] + "\n";
                }
                alert(html);
            }
        });
    }

    /*
     * Удаление меню
     */
    function init_btn_menu_delete() {
        $(".btn_menu_delete").unbind('click').click(function () {
            var obj_i = $(this).attr("obj_i");
            sendPostLigth('/jpost.php?extension=menu',
                    {
                        "delete_menu": 1,
                        "menu_id": menus[obj_i]['id']
                    },
                    function (e) {
                        if (e['success'] == '1') {
                            init_get_menu_all();
                        }
                    });
        });
    }
</script>    