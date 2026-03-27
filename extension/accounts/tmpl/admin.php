<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Управление аккаунтами</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary btn_account_edit" obj_i="">Добавление аккаунта</a>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-bordered wares_arrays_data" style="width:100%;background-color: #FFFFFF;">
                                <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th class="text-center">Категория</th>
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
<?include 'edit_account.php';?>
<script>
    var roles = [];
    var accounts = [];
    var account_id = 0;
    $(document).ready(function () {
        // init_roles_list();
        init_get_account_all();
        init_edit_account();
        console.log("READY");
    });

    /*
     * получить меню
     */
    function init_get_account_all() {
        sendPostLigth('/jpost.php?extension=accounts',
                {"get_accounts_all": 1},
                function (e) {
                    $(".menu_all").html("");
                    console.log(e['data']);
                    if (e['data'].length > 0) {
                        for (var i = 0; i < e['data'].length; i++) {
                            // if(!i in accounts)
                                accounts.push(e['data'][i]);
                            // получим роли
                            $(".menu_all").append('<tr>\n\
                                        <td>' + e['data'][i]['name'] + '</td>\n\
                                        <td class="text-center">' + e['data'][i]['category_id'] + '</td>\n\
                                        <td class="text-center">\n\
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn_account_edit" obj_i="' + i + '"><i class="mdi mdi-pencil"></i></a>\n\
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn_account_delete" obj_i="' + i + '"><i class="mdi mdi-delete"></i></a>\n\
                                        </td>\n\
                                    </tr>');
                        }
                        console.log("accounts");
                        console.log(accounts);

                        init_edit_account();
                        init_btn_account_delete();
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
                    init_get_account_all();
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
    function init_edit_account() {
        $(".btn_account_edit").unbind('click').click(function () {
            // if (roles.length > 0) {
            //     $(".menu_role").html("");
            //     for (var i = 0; i < roles.length; i++) {
            //         $(".menu_role").append('<option value="' + roles[i]['id'] + '">' + roles[i]['role_name'] + '</option>'); // roles[i]
            //     }
            // }

            var obj_i = $(this).attr("obj_i");
            account_id = 0;
            if (obj_i != '') {
                $(".account_name").val(accounts[account_id]['name']);
                $(".account_category").val(accounts[account_id]['category_id']);
                // $(".menu_descr").val(accounts[account_id]['menu_descr']);
                // $(".menu_role").val(accounts[account_id]['menu_role']);
                $(".account_id").val(accounts[account_id]['id']);
                account_id = accounts[account_id]['id'];
            }
            init_btn_save_account(obj_i);
            $("#form_edit_account_modal").modal('toggle');
        });
    }

    /*
     * Сохрание данных по меню
     */
    function init_btn_save_account() {
        $(".btn_save_account").unbind('click').click(function () {
            var account_name = $(".account_name").val();
            var account_category = $(".account_category").val();
            // var menu_descr = $(".menu_descr").val();
            // var menu_role = $(".menu_role").val();
            var account_id = $(".account_id").val();

            var errors = [];
            if (account_name.length < 3) {
                errors.push('Название не заполено');
            }
            if (account_category.length < 1) {
                errors.push('Код не заполено');
            }
            for (var i = 0; i < accounts.length; i++) {
                if (accounts[i]['account_category'] == account_category) {
                    errors.push('Код уже существует, используйте другой код');
                }
            }
            if (errors.length == 0) {
                sendPostLigth('/jpost.php?extension=accounts',
                        {
                            "edit_account": 1,
                            "account_name": account_name,
                            "account_category": account_category,
                            // "menu_descr": menu_descr,
                            // "menu_role": menu_role,
                            "account_id": account_id
                        },
                        function (e) {
                            if (e['success'] == '1') {
                                $("#form_edit_account_modal").modal('toggle');
                                accounts = [];
                                init_get_account_all();
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
    function init_btn_account_delete() {
        $(".btn_account_delete").unbind('click').click(function () {
            var obj_i = $(this).attr("obj_i");
            sendPostLigth('/jpost.php?extension=accounts',
                    {
                        "delete_account": 1,
                        "account_id": accounts[obj_i]['id']
                    },
                    function (e) {
                        if (e['success'] == '1') {
                            accounts = [];
                            init_get_account_all();
                        }
                    });
        });
    }
</script>    