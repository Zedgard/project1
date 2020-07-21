<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2>Блоки сайта</h2>
                </div>

                <div class="card-body">

                    <? for ($i = 0; $i < count($blocks); $i++): ?>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>
                                    <a href="?content=<?= $_GET['content'] ?>&block_id=<?= $blocks[$i]['id'] ?>&edit_material=0" class="btn-sm btn-primary">добавить материал</a>
                                    <?= $blocks[$i]['block_name'] ?>
                                </label>
                                <ul id="sortable<?= $i ?>" class="list-group col drag_elements">
                                    <? for ($a = 0; $a < count($contents); $a++): ?>
                                        <? if ($blocks[$i]['id'] == $contents[$a]['block_id']): ?>
                                            <li class="list-group-item" contents_id="<?= $contents[$a]['id'] ?>">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="?content=<?= $_GET['content'] ?>&block_id=<?= $blocks[$i]['id'] ?>&edit_material=<?= $contents[$a]['id'] ?>" class="btn-sm btn-primary">редактировать</a>
                                                        <?= $contents[$a]['content_title'] ?></div>
                                                    <div class="col-6" style="text-align: right;"><i class="fas fa-arrows-alt" style="font-size: 48px;"></i></div>
                                                    <?
                                                    /*
                                                     * Не отображаем сам материал
                                                      if ($contents[$a]['extension'] > 0) {
                                                      echo $theme->getExtensionContentsReturn($contents[$a]['extension']);
                                                      } else {
                                                      echo $contents[$a]['content_descr '];
                                                      }
                                                     */
                                                    ?>

                                            </li>
                                        <? endif; ?>
                                    <? endfor; ?>
                                </ul>
                                <script>
                                    new Sortable(sortable<?= $i ?>, {
                                        animation: 150,
                                        ghostClass: 'blue-background-class',
                                        onUpdate: function (/**Event*/evt) {

                                            var elms = $("#sortable<?= $i ?>").find("li");
                                            var data = [];
                                            for (var i = 0; i < elms.length; i++) {
                                                var objid = $(elms[i]).attr("contents_id");
                                                var sort = i;
                                                data.push({"content_id": objid, "sort": sort});
                                                var json_data = {data: data}
                                                //console.log("json_str: " + JSON.stringify(json_data));
                                            }

                                            $.ajax({
                                                url: '/jpost.php?extension=pages',
                                                method: 'post',
                                                dataType: 'json',
                                                data: {'sortable': '1', 'json_data': JSON.stringify(json_data)},
                                                success: function (data) {

                                                }
                                            });

                                        },
                                    });
                                </script>

                            </div>
                        </div>
                        <hr/>
                    <? endfor; ?>

                </div>

                <div class="pb-3 pt-3 pl-3 mt-2 border-top">
                    <a href="./" class="btn btn-secondary btn-default"><?= $lang['pages'][$_SESSION['lang']]['back_link'] ?></a>
                </div>

            </div> 
        </div>
    </div>
</div>