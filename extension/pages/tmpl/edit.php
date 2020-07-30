<div>
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
                            <input class="form-control" name="page_title" id="page_title" value="<?= $obj['page_title'] ?>" placeholder="<?= $lang['pages'][$_SESSION['lang']]['title'] ?>..." <?= (strlen($obj['page_title']) > 0) ? 'readonly="readonly"' : '' ?> type="text" required>
                            <div class="valid-feedback">
                                <?= $lang['pages'][$_SESSION['lang']]['accepted'] ?>
                            </div>
                            <div class="invalid-feedback">
                                <?= $lang['pages'][$_SESSION['lang']]['name_page_is_true'] ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= $lang['pages'][$_SESSION['lang']]['title_page'] ?></label>
                            <input class="form-control" name="page_title" id="page_title" value="<?= $obj['page_title'] ?>" placeholder="<?= $lang['pages'][$_SESSION['lang']]['title'] ?>..." <?= (strlen($obj['page_title']) > 0) ? 'readonly="readonly"' : '' ?> type="text" required>
                            <div class="valid-feedback">
                                <?= $lang['pages'][$_SESSION['lang']]['accepted'] ?>
                            </div>
                            <div class="invalid-feedback">
                                <?= $lang['pages'][$_SESSION['lang']]['name_page_is_true'] ?>
                            </div>
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
                            <input type="hidden" name="page_edit" value="<?= ($obj['id'] > 0) ? $obj['id'] : 0 ?>" />
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
    $(function () {
        $('#page_edit').sendPost(function (result) {
            //console.log("authorization ok");
        });
    });
</script> 