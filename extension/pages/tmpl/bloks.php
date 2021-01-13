<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2>Блоки сайта</h2>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <a href="javascript:void(0)" class="btn btn-primary mb-3 block_edit" data-toggle="modal" data-target="#form_edit_block_modal" block_id="0">Добавить блок</a>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th>Код блока (используеться в шаблонах)</th>
                                        <th>Роли</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="body_list_blocks">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="pb-3 pt-3 pl-3 mt-2 border-top">

                    <a href="./" class="btn btn-secondary btn-default"><?= $lang['pages'][$_SESSION['lang']]['back_link'] ?></a>

                </div>

            </div> 
        </div>
    </div>
</div>
<script>
    var block_role;
    var blockInfo = [];
    $(document).ready(function () {

        block_role = $(".block_role").select2({
            width: "style",
            placeholder: "Роли",
            allowClear: true
        });

        init_body_list_blocks();

    });


    function init_btn_edit() {
        $(".block_edit").click(function () {
            var block_id = $(this).attr('block_id');
            get_block_info(block_id);
        });
    }

    /**
     * Получим данные по блокам
     * @returns {undefined}
     */
    function init_body_list_blocks() {

        sendPostLigth('/jpost.php?extension=pages', {"init_body_list_blocks": 1}, function (e) {
            var blocks_list = e['data'];
            for (var i = 0; i < blocks_list.length; i++) {
                // Разберемся с ролями
                var r = [];
                if (blocks_list[i]['roles'].length > 0) {
                    for (var ii = 0; ii < blocks_list[i]['roles'].length; ii++) {
                        r.push(' ' + blocks_list[i]['roles'][ii]['role_name']);
                    }
                }
                var role_str = r.toString();
                var html = '<tr>';
                html += '<td>' + blocks_list[i]['block_name'] + '</td>';
                html += '<td>' + blocks_list[i]['block_code'] + '</td>';
                html += '<td>';
                html += role_str;
                html += '</td>';
                html += '<td class="text-center">';
                html += '<a href="javascript:void(0)" class="btn btn-primary mb-3 block_edit" block_id="' + blocks_list[i]['id'] + '"  data-toggle="modal" data-target="#form_edit_block_modal" >';
                html += '<i class="mdi mdi-pencil"></i>';
                html += '</a>';
                html += '</td>';
                html += '</tr>';
                $(".body_list_blocks").append(html);
            }
            init_btn_edit();
            $(".btn_save_blok").click(function () {
                save_block_form();
            });
        });
    }

    /**
     * Получить данные по блоку
     * @param {type} block_id
     * @returns {undefined}
     */
    function get_block_info(block_id) {
        sendPostLigth('/jpost.php?extension=pages', {"block_id_info": block_id}, function (e) {
            blockInfo = e['data'];
            if (block_id > 0) {
                $(".block_code").attr("disabled", "disabled");
            }
            init_roles();


        });
    }

    /**
     * Заполним форму имеющимеся данными 
     * @returns {undefined}
     */
    function init_edit_block_form() {
        var e = blockInfo;
        $(".form_save_block").find(".block_name").val(e['block_name']);
        $(".form_save_block").find(".block_code").val(e['block_code']);
        $(".form_save_block").find(".block_id").val(e['id']);
        get_roles_block_id(e['id']);
        //block_role.val(blockRoles).trigger("change");
    }

    function save_block_form() {
        var block_id = $(".form_save_block").find(".block_id").val();
        var block_name = $(".form_save_block").find(".block_name").val();
        var block_code = $(".form_save_block").find(".block_code").val();
        var block_role = $(".form_save_block").find(".block_role").val();
        sendPostLigth('/jpost.php?extension=pages', {"block_id_save_info": block_id,
            'block_name': block_name,
            'block_code': block_code,
            'block_role': block_role
        }, function (e) {
            if (e['success'] == '1') {
                document.location.reload();
            } else {
                alert("Ошибка операции");
            }
        });
    }

    /**
     * Получить доступные роли
     * @returns {undefined}
     */
    function init_roles() {
        $(".block_role").html("");
        sendPostLigth('/jpost.php?extension=users', {"get_roles_array": 1}, function (e) {
            //blockInfo = e['data'];
            //role_id
            for (var i = 0; i < e['data'].length; i++) {
                $(".block_role").append('<option value="' + e['data'][i]['id'] + '">' + e['data'][i]['role_name'] + '</option>');
            }
            init_edit_block_form();
        });
    }

    /**
     * Получить выбранные роли блока
     * @param {type} block_id
     * @returns {undefined}
     */
    function get_roles_block_id(block_id) {
        // get_roles_block_id
        sendPostLigth('/jpost.php?extension=pages', {"get_roles_block_id": block_id}, function (e) {
            blockInfo = e['data'];
            var roles = [];
            for (var i = 0; i < e['data'].length; i++) {
                roles.push(e['data'][i]['role_id']);
            }
            block_role.val(roles).trigger("change");
        });
    }

    // обнулить данные блока
    function clear_form_block() {
        $(".block_name").val("");
        $(".block_code").val("");
        block_role.val([]).trigger("change");
    }
</script>