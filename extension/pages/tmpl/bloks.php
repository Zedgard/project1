<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2>Блоки сайта</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th>Код блока (используеться в шаблонах)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <? for($i=0;$i<count($blocks);$i++): ?>
                                <tr>
                                    <td><?= $blocks[$i]['block_name'] ?></td>
                                    <td><?= $blocks[$i]['block_code'] ?></td>
                                </tr>
                                <? endfor; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="pb-3 pt-3 pl-3 mt-2 border-top">

                    <a href="./" class="btn btn-secondary btn-default"><?= $lang['pages'][$_SESSION['lang']]['back_link'] ?></a>

                </div>

            </div> 
        </div>
    </div>
</div>