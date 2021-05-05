<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <form id="page_edit" action="/jpost.php?extension=pages" method="POST">

                <div class="card-header card-header-border-bottom">
                    <h2><?= $lang['pages'][$_SESSION['lang']]['editing'] ?></h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label><?= $lang['pages'][$_SESSION['lang']]['title_page'] ?></label>
                        <input class="form-control" name="page_title" id="page_title" value="<?= $obj['page_title'] ?>" placeholder="<?= $lang['pages'][$_SESSION['lang']]['title'] ?>..."  type="text" required>
                        <div class="valid-feedback">
                            <?= $lang['pages'][$_SESSION['lang']]['accepted'] ?>
                        </div>
                        <div class="invalid-feedback">
                            <?= $lang['pages'][$_SESSION['lang']]['name_page_is_true'] ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= $lang['pages'][$_SESSION['lang']]['link_to_page'] ?></label>
                        <input class="form-control" name="url" id="url" value="<?= $obj['url'] ?>" 
                               onkeyup="this.value = this.value.replace(/[^a-z_+]/, '')"
                               placeholder="<?= $lang['pages'][$_SESSION['lang']]['internet_address'] ?>..." <?= (strlen($obj['url']) > 0) ? 'readonly="readonly"' : '' ?> type="text" required>
                        <div class="valid-feedback">
                            <?= $lang['pages'][$_SESSION['lang']]['accepted'] ?>
                        </div>
                        <span class="mt-2 d-block"><?= $lang['pages'][$_SESSION['lang']]['must_be_lowercase_only_in_latin'] ?></span>
                    </div>
                    <div class="form-group">
                        <label>Описание страницы</label>
                        <input class="form-control" name="description" id="description" value="<?= $obj['description'] ?>" 
                               placeholder="description" type="text">
                        <div class="valid-feedback">
                            Описание страницы тег description
                        </div>
                        <span class="mt-2 d-block"><?= $lang['pages'][$_SESSION['lang']]['must_be_lowercase_only_in_latin'] ?></span>
                    </div>

                    <div class="form-group">
                        <label>Наследование</label>
                        <select class="form-control select_higter w-100" id="higter" name="higter">

                        </select>
                        <input type="hidden" name="higter_val" class="higter_val" value="<?= ($obj['higter'] > 0) ? $obj['higter'] : 0 ?>" 
                               </div>

                        <div class="form-group">
                            <label><?= $lang['pages'][$_SESSION['lang']]['theme_title'] ?></label>
                            <select name="theme_id" class="form-control">
                                <? for ($i = 0; $i < count($themes); $i++): ?>
                                    <?
                                    $selected = ($obj['theme_id'] == $themes[$i]['id']) ? 'selected="selected"' : '';
                                    ?>
                                    <option value="<?= $themes[$i]['id'] ?>" <?= $selected ?>><?= $themes[$i]['theme_title'] ?></option>
                                <? endfor; ?>
                            </select>
                            <span class="mt-2 d-block"><?= $lang['pages'][$_SESSION['lang']]['choose_available_options'] ?></span>
                        </div>

                        <div class="form-group">
                            <label for="page_role">Роли которые будут видеть этот блок</label>
                            <select class="form-control page_role" name="page_role[]" multiple="multiple" style="width: 100%">

                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= $lang['pages'][$_SESSION['lang']]['visible'] ?></label>
                            <select name="visible" class="form-control">
                                <option value="1" <?= ($obj['visible'] == '1') ? 'selected="selected"' : '' ?>><?= $lang['pages'][$_SESSION['lang']]['s_opened'] ?></option>
                                <option value="0" <?= ($obj['visible'] == '0') ? 'selected="selected"' : '' ?>><?= $lang['pages'][$_SESSION['lang']]['s_close'] ?></option>
                            </select>
                            <span class="mt-2 d-block"><?= $lang['pages'][$_SESSION['lang']]['show_internet'] ?></span>
                        </div>

                        <div class="form_result" style="display: none;">

                        </div>

                        <div class="form-footer pt-4 pt-5 mt-4 border-top">
                            <input type="hidden" name="page_edit" class="page_edit" value="<?= ($obj['id'] > 0) ? $obj['id'] : 0 ?>" />
                            <button type="submit" class="btn btn-primary btn-default"><?= $lang['pages'][$_SESSION['lang']]['apply'] ?></button>
                            <a href="./" class="btn btn-secondary btn-default"><?= $lang['pages'][$_SESSION['lang']]['cancel'] ?></a>
                        </div>

                    </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    var pages = [];
    var page_id = '0';
    $(function () {
        page_id = $(".page_edit").val();
        page_role = $(".page_role").select2({
            width: "style",
            placeholder: "Роли",
            allowClear: true
        });

        // Отправить данные
        $('#page_edit').sendPost(function (result) {
            //console.log("authorization ok");
        });

        init_roles();
        init_get_pages();
    });

    /**
     * Получить доступные роли
     * @returns {undefined}
     */
    function init_roles() {
        $(".page_role").html("");
        sendPostLigth('/jpost.php?extension=users', {"get_roles_array": 1}, function (e) {
            //blockInfo = e['data'];
            //role_id
            for (var i = 0; i < e['data'].length; i++) {
                $(".page_role").append('<option value="' + e['data'][i]['id'] + '">' + e['data'][i]['role_name'] + '</option>');
            }
            if (Number(page_id) > 0) {
                get_roles_page_id(page_id);
            }
        });
    }

    /**
     * Получить выбранные роли блока
     * @param {type} block_id
     * @returns {undefined}
     */
    function get_roles_page_id(id) {
        // get_roles_block_id
        sendPostLigth('/jpost.php?extension=pages', {"get_roles_page_id": id}, function (e) {
            blockInfo = e['data'];
            var roles = [];
            for (var i = 0; i < e['data'].length; i++) {
                roles.push(e['data'][i]['role_id']);
            }
            page_role.val(roles).trigger("change");
        });
    }

    function init_get_pages() {
        var higter_val = $(".higter_val").val();
        sendPostLigth('/jpost.php?extension=pages', {"adminList": 0}, function (e) {
            $(".select_higter").html("");
            $(".select_higter").append('<option value="0">Страница наследования...</option>');
            pages = [];
            for (var i = 0; i < e['data'].length; i++) {
                pages.push(e['data'][i]);
                var s = '';
                if (higter_val == e['data'][i]['id']) {
                    var s = 'selected="selected"';
                }
                $(".select_higter").append('<option value="' + e['data'][i]['id'] + '" ' + s + '>/' + e['data'][i]['url'] + '/ => ' + e['data'][i]['page_title'] + '</option>');
            }
        });
    }


</script> 