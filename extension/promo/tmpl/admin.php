<div class="card">
    <div class="card-header card-header-border-bottom">
        <h2 class="col-lg-6">Промо акции</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <?
                if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
                    foreach ($_SESSION['errors'] as $value) {
                        echo '<div class="alert alert-danger">' . $value . "</div>\n";
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <a href="?edit=0" class="btn btn-primary">Добавить промо акцию</a>
                    <a href="?promo_modal=1" class="btn btn-primary">Промо текст приветствия</a>
                    <div class="float-right btn-group">
                        <input type="text" class="form-control find_str" name="find_str" value="<?= $find_str ?>" />
                        <input type="button" class="btn btn-outline-secondary" value="Поиск" />
                    </div>
                </div>
                <div class="table-responsive-lg">
                    <table class="table table-striped table-bordered wares_arrays_data" style="width:100%;background-color: #FFFFFF;">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Код</th>
                                <th>Наименование</th>
                                <th>Дата начала</th>
                                <th>Дата окончания</th>
                                <th>Скидка</th>
                                <th>Объединение</th>
                                <th>Статус</th>
                                <th>Кол.</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="category_all">
                            <?
                            foreach ($promos as $value) {
                                $status = 'Отключена';
                                if ($value['status'] == 1) {
                                    $status = 'Активна';
                                }
                                $promo = $value['amount'] . 'p';
                                if ($value['percent'] > 0) {
                                    $promo = $value['percent'] . '%';
                                }
                                $alliance = 'Запрещено';
                                if ($value['alliance'] == 1) {
                                    $alliance = 'Разрешено';
                                }
                                ?>
                                <tr>
                                    <td class="text-center"><?= $value['id'] ?></td>
                                    <td class="text-center"><?= $value['code'] ?></td>
                                    <td><?= $value['title'] ?></td>
                                    <td class="text-center"><?= $value['date_start'] ?></td>
                                    <td class="text-center"><?= $value['date_end'] ?></td>
                                    <td class="text-center"><?= $promo ?></td>
                                    <td class="text-center"><?= $alliance ?></td>
                                    <td class="text-center"><?= $status ?></td>
                                    <td class="text-center"><?= $value['number_uses'] ?></td>
                                    <td class="text-center">
                                        <a href="?edit=<?= $value['id'] ?>" class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="?promo_delete=<?= $value['id'] ?>" class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                <?
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="form-footer pt-4 pt-5 mt-4 border-top">

    </div>

</div> 

<script>
    $(document).ready(function () {
        $(".find_str").change(function () {
            location.href = '?find_str=' + $(this).val();
        });
        
        
    });
</script>    