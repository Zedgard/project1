<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Управление меню</h2>
                </div>

                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary btn_menu_add_item" obj_i="">Добавление</a>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="menu_items_list"></div>
                        </div>
                    </div>
                </div>

                <div class="form-footer pt-3 pl-3 pb-3 border-top">
                    <a href="./" class="btn btn-secondary btn-default">&lt; назад</a>
                </div>
            </div> 
        </div>
    </div>
</div>
<?
include 'form_edit_item.php';
?>
<script>
    var menu_items = "<?= $_GET['menu_items'] ?>";
    var roles = [];
    var item_datas = [];
    var edit_item_id = 0;

    // сдвиг
    var parent_items = 0;
    var offset = 2;

    $(document).ready(function () {
        // Добавление
        $(".btn_menu_add_item").click(function () {
            clear_form_edit();
            init_list_items();
            init_roles_list();
            $("#form_edit_item_modal").modal('toggle');
            init_save_item();
        });
        init_form_list_items();
    });

    /**
     * Список всех пунктов
     * @returns {undefined}
     */
    function init_form_list_items() {
        sendPostLigth('/jpost.php?extension=menu',
                {"menu_items_list": menu_items},
                function (e) {
                    parent_items = 0;
                    offset = 2;
                    item_datas = [];
                    $(".menu_items_list").html("");
                    if (e['data'].length == 0) {
                        $(".menu_items_list").html("Нет записей");
                    } else {
                        if (e['data'].length > 0) {
                            parent_items = 0;
                            append_menu_items(e['data']);
                        }
                    }
                    init_edit_item();
                    init_delete_item();
                });
    }
    // Отображение меню
    function append_menu_items(data) {
        parent_items++;
        var offset_start = offset * parent_items;
        var position = 0;
        for (var i = 0; i < data.length; i++) {
            $(".menu_items_list").append('<div class="mb-2" style="margin-left: ' + offset_start + 'rem;">\n\
                    <span><a href="javascript:void(0)" elem="' + data[i]['id'] + '" ids="' + item_datas.length + '" class="btn btn-primary btn-sm edit_item"><i class="mdi mdi-pencil"></i></a></span>\n\
                    <span><a href="javascript:void(0)" elem="' + data[i]['id'] + '" class="btn btn-danger btn-sm delete_item"><i class="mdi mdi-delete"></i></a></span>\n\
                    <span><a href="javascript:void(0)" elem="' + data[i]['id'] + '" position="' + position + '" class="btn btn-outline-dark btn-sm position_up"><i class="mdi mdi-chevron-up"></i></a></span>\n\
                    <span><a href="javascript:void(0)" elem="' + data[i]['id'] + '" position="' + position + '" class="btn btn-outline-dark btn-sm position_down"><i class="mdi mdi-chevron-down"></i></a></span>\n\
                    &nbsp;&nbsp;&nbsp; <a href="' + data[i]['link'] + '" class="mr-2" target="_blank">' + data[i]['title'] + '</a> | <span class="ml-2">' + data[i]['link'] + '</span> \n\
                    </div>');

            item_datas.push(data[i]);
            if (data[i]['parent_items'].length > 0) {
                append_menu_items(data[i]['parent_items']);
            }
            position++;
        }
        init_set_position(0, 0);
    }


    /**
     * Получить все пункты меню
     * с сортировкой по наименованию
     * @returns {undefined}
     */
    function init_list_items(menu_item_id) {
        if (menu_item_id == undefined) {
            menu_item_id = 0;
        }
        sendPostLigth('/jpost.php?extension=menu',
                {"list_items": 1},
                function (e) {
                    $(".item_parents").html("");
                    $(".item_parents").append('<option value="0">Основная</option>');
                    if (e['data'].length > 0) {
                        for (var i = 0; i < e['data'].length; i++) {
                            s = "";
                            if (e['data'][i]['id'] == menu_item_id) {
                                s = 'selected="selected"';
                            }
                            console.log("edit_item_id: " + edit_item_id);
                            if (edit_item_id != e['data'][i]['id']) {
                                $(".item_parents").append('<option value="' + e['data'][i]['id'] + '" ' + s + '>' + e['data'][i]['title'] + '</option>');
                            }
                        }
                    }
                });
    }



    /**
     * Редактирование меню
     * @returns {undefined}
     */
    function init_edit_item() {
        $(".edit_item").unbind('click').click(function () {
            clear_form_edit();
            var ids = $(this).attr("ids");
            edit_item_id = item_datas[ids]['id'];
            $(".edit_item_id").val(edit_item_id);
            $(".item_title").val(item_datas[ids]['title']);
            $(".item_link").val(item_datas[ids]['link']);
            $(".item_css").val(item_datas[ids]['css']);
            init_list_items(item_datas[ids]['parent_id']);
            console.log("role: " + item_datas[ids]['role']);
            init_roles_list(item_datas[ids]['role']);
            $("#form_edit_item_modal").modal('toggle');
            init_save_item();
        });
    }

    /**
     * Сохраниение пункта меню
     * @type Arguments
     */
    function init_save_item() {
        $(".btn_save_edit_item").unbind('click').click(function () {
            var edit_item_id = $(".edit_item_id").val();
            var item_title = $(".item_title").val();
            var item_link = $(".item_link").val();
            var item_css = $(".item_css").val();
            var parent_id = $(".item_parents").val();
            var menu_item_role = $(".menu_item_role").val();
            sendPostLigth('/jpost.php?extension=menu',
                    {
                        "edit_item": edit_item_id,
                        "menu_id": menu_items,
                        "title": item_title,
                        "link": item_link,
                        "css": item_css,
                        "parent_id": parent_id,
                        "menu_item_role": menu_item_role
                    },
                    function (e) {
                        if (e['success'] == '1') {
                            $("#form_edit_item_modal").modal('toggle');
                            init_form_list_items();
                        }
                    });
        });
    }

    /**
     * Удаление пункта меню
     * @returns {undefined}
     */
    function init_delete_item() {
        $(".delete_item").unbind('click').click(function () {
            if (confirm("Уверены что хотите удалить?")) {
                var elem = $(this).attr("elem");
                if (elem > 0) {
                    sendPostLigth('/jpost.php?extension=menu',
                            {
                                "delete_item": elem
                            },
                            function (e) {
                                if (e['success'] == '1') {
                                    init_form_list_items();
                                } else {
                                    alert("Ошибка удаления");
                                }
                            });
                }
            }
        });
    }



    /**
     * Получить роли
     * @returns {undefined}
     */
    function init_roles_list(role_id) {
        if (role_id == undefined) {
            role_id = 0;
        }
        // Получить информацию по роли
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
        sendPostLigth('/jpost.php?extension=users',
                {"get_roles_array": 1},
                function (e) {
                    $(".menu_item_role").html("");
                    if (e['data'].length > 0 && roles.length == 0) {
                        for (var i = 0; i < e['data'].length; i++) {
                            roles.push(e['data'][i]);
                        }
                    }
                    if (roles.length > 0) {
                        for (var i = 0; i < roles.length; i++) {
                            $(".menu_item_role").append('<option value="' + roles[i]['id'] + '">' + roles[i]['role_name'] + '</option>');
                        }
                    }
                    if (role_id > 0) {
                        var role = get_role_info(role_id);
                        $(".menu_item_role").find('option[value="' + role['id'] + '"]').attr("selected", "selected");
                    }
                });
    }

    /**
     * Меняет позиции 
     
     * @param {type} item_id
     * @param {type} position
     * @param {type} metod
     * @returns {undefined} */
    function init_set_position(item_id, position, metod) {
        if (metod == undefined) {
            metod = 0;
        } else {
            metod = 1;
        }
        if (item_id > 0) {
            sendPostLigth('/jpost.php?extension=menu',
                    {
                        "set_position": position,
                        "item_id": item_id,
                        "menu_id": menu_items
                    },
                    function (e) {
                        if (metod == 1) {
                            init_form_list_items();
                        }
                    });
        }
        $(".position_up").unbind('click').click(function () {
            var elem = $(this).attr("elem");
            var position = Number($(this).attr("position")) - 1;
            init_set_position(elem, position, 1);
        });
        $(".position_down").unbind('click').click(function () {
            var elem = $(this).attr("elem");
            var position = Number($(this).attr("position")) + 1;
            init_set_position(elem, position, 1);
        });
    }

//    function init_position_up_and_down(){
//        $()
//    }

    /**
     * Отчистим форму menu_item_role
     * @returns {undefined}
     */
    function clear_form_edit() {
        edit_item_id = 0;
        $(".edit_item_id").val(edit_item_id);
        $(".item_title").val("");
        $(".item_link").val("");
        $(".menu_item_role").val("");
        $(".item_css").val("");
    }

</script>