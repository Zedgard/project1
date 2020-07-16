<div>
    <div class="row">
        <? if (!isset($_GET['edit'])): ?>
            <a href="?edit=0" class="mb-1 btn btn-primary">Добавить новую страницу</a>
        <? endif; ?>
    </div>
    <div class="row">
        <div class="basic-data-table">

            <table class="table mb-1 table-striped table-bordered" style="width:100%;background-color: #FFFFFF;">
                <thead>
                    <tr>
                        <th>наименование</th>
                        <th>адрес</th>
                        <th>дизайн</th>
                        <th>видимость</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <? for ($i = 0; $i < count($pages); $i++): ?>
                        <tr>
                            <td><?= $pages[$i]['page_title'] ?></td>
                            <td><?= $pages[$i]['url'] ?></td>
                            <td><?= $pages[$i]['theme_title'] ?></td>
                            <td><?= $pages[$i]['visible'] ?></td>
                            <td><a href="?edit=<?= $pages[$i]['id'] ?>" class="mb-1 btn btn-primary">редактировать</a></td>
                        </tr>
                    <? endfor; ?>
                </tbody>
            </table>

        </div> 
    </div>
</div> 