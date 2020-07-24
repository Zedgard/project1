<div>
    <?
    importWisiwyng('content_descr');
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <form id="content_edit" action="/jpost.php?extension=pages" method="POST">

                    <div class="card-header card-header-border-bottom">
                        <h2><?= $lang['pages'][$_SESSION['lang']]['editing'] ?></h2>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label><?= $lang['pages'][$_SESSION['lang']]['content_title'] ?></label>
                            <input class="form-control" name="content_title" id="content_title" value="<?= $content['content_title'] ?>" placeholder="<?= $lang['pages'][$_SESSION['lang']]['title'] ?>..." <?= (strlen($content['content_title']) > 0) ? 'readonly="readonly"' : '' ?> type="text" required>
                            <div class="valid-feedback">
                                <?= $lang['pages'][$_SESSION['lang']]['accepted'] ?>
                            </div>
                            <div class="invalid-feedback">
                                <?= $lang['pages'][$_SESSION['lang']]['name_page_is_true'] ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Выбирите расширение</label>
                            <div>
                                <?
                                $checked_null = (strlen($content['extension']) == 0) ? 'checked="checked"' : '';
                                ?>
                                <input type="radio" name="ext_urls" value="0" class="ext_urls" <?= $checked_null ?> /> Обычные HTML <?= $checked_null ?><br/>
                                <? for ($i = 0; $i < count($extensions); $i++): ?>
                                    <?
                                    $checked = ($content['extension'] == $extensions[$i]['eu_id']) ? 'checked="checked"' : '';
                                    ?>
                                    <input type="radio" name="ext_urls" value="<?= $extensions[$i]['eu_id'] ?>" class="ext_urls" <?= $checked ?> /> <?= $extensions[$i]['conf']['title'] ?> <?= $extensions[$i]['url'] ?><br/>
                                <? endfor; ?>
                            </div>
                            <span class="mt-2 d-block"><?= $lang['pages'][$_SESSION['lang']]['choose_available_options'] ?></span>
                        </div>
                        <div class="form-group content_descr_block" style="<?= (strlen($checked_null)>0)?'display: block;':'display: none;' ?>">
                            <label><?= $lang['pages'][$_SESSION['lang']]['theme_title'] ?></label>
                            <textarea id="content_descr" name="content_descr" id="content_descr" style="width: 100%;height: 140px;"><?= $content['content_descr'] ?></textarea>
                        </div>


                        <div class="form_result" style="display: none;"></div>
                        <div class="form-footer pt-4 pt-5 mt-4 border-top">
                            <input type="hidden" name="page_id" value="<?= ($_GET['content'] > 0) ? $_GET['content'] : 0 ?>" />
                            <input type="hidden" name="block_id" value="<?= ($_GET['block_id'] > 0) ? $_GET['block_id'] : 0 ?>" />
                            <input type="hidden" name="edit_material" value="<?= ($_GET['edit_material'] > 0) ? $_GET['edit_material'] : 0 ?>" />
                            <button type="submit" class="btn btn-primary btn-default"><?= $lang['pages'][$_SESSION['lang']]['apply'] ?></button>
                            <a href="./?content=<?= $_GET['content'] ?>" class="btn btn-secondary btn-default"><?= $lang['pages'][$_SESSION['lang']]['cancel'] ?></a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#content_edit').sendPost(function (result) {
            //console.log("authorization ok");
        });

        $('.ext_urls').click(function () {
            var v = $(this).val();
            if (v === '0') {
                $(".content_descr_block").show(200);
            } else {
                $(".content_descr_block").hide(200);
            }
        });
    });
</script> 