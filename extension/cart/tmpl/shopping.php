<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Список покупок</h2>
                </div>

                <div class="card-body">
                    <?
                    if (count($get_pay_user_list) > 0) {
                        ?>
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Дата и время</th>
                                        <th>Товары</th>
                                        <th>Сумма</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($get_pay_user_list as $value) {
                                        $wares_title = (strlen($value['wares_title']) > 0) ? $value['wares_title'] : $value['pay_descr'];
                                        if (strlen($wares_title) == 0) {
                                            $wares_title = 'Не найдено';
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $value['pay_date'] ?></td>
                                            <td><?= $wares_title ?></td>
                                            <td class="text-center"><?= $value['pay_sum'] ?> &#8381;</td>
                                        </tr>
                                        <?
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?
                    } else {
                        ?>
                        <div>Нет записей</div>
                        <?
                    }
                    ?>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top ">

                </div>
            </div> 
        </div>
    </div>
</div>