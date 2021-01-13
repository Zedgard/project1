<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6"><?= $lang['pages'][$_SESSION['lang']]['descr'] ?></h2>
                    <div class="col-lg-6" style="text-align: right;">
                        <a href="?bloks=1" class="btn btn-info">Блоки сайта</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">
                        <? if (!isset($_GET['edit'])): ?>
                            <a href="?edit=0" class="btn btn-primary"><?= $lang['pages'][$_SESSION['lang']]['add_new_page'] ?></a>
                        <? endif; ?>
                    </div>
                    <br/>
                    <div class="row">
                        <table class="table table-striped table-bordered w-100" style="background-color: #FFFFFF;">
                            <thead>
                                <tr>
                                    <th><?= $lang['pages'][$_SESSION['lang']]['page_title'] ?></th>
                                    <th><?= $lang['pages'][$_SESSION['lang']]['url'] ?></th>
                                    <th style="text-align: center;"><?= $lang['pages'][$_SESSION['lang']]['theme_title'] ?></th>
                                    <th style="text-align: center;">видимость</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? for ($i = 0; $i < count($pages); $i++): ?>
                                    <tr>
                                        <td><?= $pages[$i]['page_title'] ?></td>
                                        <td>
                                            <a href="<?= $pages[$i]['url_a_href'] ?>"><?= $pages[$i]['url_a_href'] ?></a> 
                                            <!--<?= $pages[$i]['url_a_href_bread'] ?>-->
                                        </td>
                                        <td style="text-align: center;"><?= $pages[$i]['theme_title'] ?></td>
                                        <td style="text-align: center;"><?= ($pages[$i]['visible'] == '1') ? '<span class="badge badge-success">' . $lang['pages'][$_SESSION['lang']]['s_opened'] . '</span>' : '<span class="badge badge-danger">' . $lang['pages'][$_SESSION['lang']]['s_close'] . '</span>' ?></td>
                                        <td style="text-align: center;"><a href="?content=<?= $pages[$i]['id'] ?>" class="btn-sm btn-primary">материалы</a></td>
                                        <td style="text-align: center;">
                                            <a href="?edit=<?= $pages[$i]['id'] ?>" class="btn-sm btn-primary"><?= $lang['pages'][$_SESSION['lang']]['edit'] ?></a>
                                            
                                            <!--
                                            <a href="/<?= $pages[$i]['url'] ?>/" target="_blank" class="btn-sm btn-primary"><?= $lang['pages'][$_SESSION['lang']]['show'] ?></a>
                                            <input type="button" value="<?= $lang['pages'][$_SESSION['lang']]['role'] ?>" class="btn-sm btn-primary"/>
                                            -->
                                        </td>
                                    </tr>
                                <? endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>

            </div> 
        </div>
    </div>
</div>