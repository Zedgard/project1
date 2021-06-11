<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        UTM метки
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-lg mb-3">
                    <!--
                    <a href="javascript:void(0)" jpost_url="/jpost.php?extension=utm&utm_insert=1" func="init_utm()" class="btn btn-primary init_super_insert">Добавить</a>
                    -->
                    <select name="utm_list_filter" class="form-control utm_filter">
                        <option value="0">Все</option>
                        <?
                        foreach ($utm_list as $value) {
                            ?>
                            <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                            <?
                        }
                        ?>

                    </select>
                </div>
                <div class="col-lg mb-3">
                    <div class="btn-group">
                        <input type="text" class="form-control utm_date_start_filter inp_datepicker" value="<?= date('Y-m-01') ?>" placeholder="<?= date('Y-m-01') ?>"> 
                        <input type="text" class="form-control utm_date_end_filter inp_datepicker" value="<?= date('Y-m-t') ?>" placeholder="<?= date('Y-m-t') ?>">
                    </div>
                </div>
                <div class="col-lg mb-3 d-none">
                    <select name="utm_tags_list_filter" class="form-control utm_tags_list_filter">
                        <option value="0">Все</option>
                        <?
                        foreach ($utm_tags_list as $value) {
                            ?>
                            <option value="<?= $value['id'] ?>"><?= $value['code'] ?></option>
                            <?
                        }
                        ?>

                    </select>
                </div>
                <div class="col-lg mb-3 pt-2 text-right">
                    Всего: <span class="count_utm_list_filter"></span>
                </div> 
                <div class="col-lg mb-3 text-right">
                    <a href="?utm_creat=1" class="btn btn-info">Настроить UTM</a>
                </div> 
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive-lg">
                        <table class="table table-striped table-bordered w-100 table_utm_list_filter text-center">
                            <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th>Время</th>
                                    <th>Детали</th>
                                    <th>Стоимость</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-footer pt-4 pt-5 mt-4 border-top">

    </div>
</div>
<script src="/extension/utm/js/utm.js<?= $_SESSION['rand'] ?>"></script>
<script src="/extension/pay/js/pay_js.js<?= $_SESSION['rand'] ?>"></script>