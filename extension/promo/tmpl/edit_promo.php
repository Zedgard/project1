<div class="card">
    <div class="card-header card-header-border-bottom">
        <h2 class="col-lg-6">Промо акции - Редактирование</h2>
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

                <form method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="config_title">Название</label>
                                <input type="text" class="form-control promo_title" name="promo_title" value="<?= (isset($promo_data['title'])) ? $promo_data['title'] : '' ?>" placeholder="Наименование...">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="config_title">Код промо</label>
                                <input type="text" class="form-control promo_code" name="promo_code" value="<?= (isset($promo_data['code'])) ? $promo_data['code'] : '' ?>" placeholder="Код промо...">
                            </div>
                        </div>  
                    </div>

                    <div class="form-group">
                        <label for="config_title">Дата начала</label>
                        <input type="text" class="form-control promo_date_start inp_datepicker" value="<?= (isset($promo_data['date_start'])) ? $promo_data['date_start'] : '' ?>" name="promo_date_start">
                    </div>

                    <div class="form-group">
                        <label for="config_title">Дата окончания</label>
                        <input type="text" class="form-control promo_date_end inp_datepicker" value="<?= (isset($promo_data['date_end'])) ? $promo_data['date_end'] : '' ?>" name="promo_date_end">
                    </div>

                    <div class="form-group">
                        <label for="config_title">Сумма скидки в рублях</label>
                        <input type="text" class="form-control promo_amount" value="<?= (isset($promo_data['amount'])) ? $promo_data['amount'] : '0' ?>" name="promo_amount">
                    </div>

                    <div class="form-group">
                        <label for="config_title">Сумма скидки в процентах</label>
                        <input type="text" class="form-control promo_percent" value="<?= (isset($promo_data['percent']) && $promo_data['percent'] > 0) ? $promo_data['percent'] : '0' ?>" name="promo_percent">
                    </div>

                    <div class="form-group">
                        <label for="product_new">Статус</label><br/>
                        <label class="switch switch-text switch-primary form-control-label">
                            <input type="checkbox" class="switch-input form-check-input promo_status" name="promo_status" value="1">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="promo_id" value="<?= $_GET['edit'] ?>" />
                        <input type="submit" value="Сохранить" class="btn btn-lg btn-primary" />
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="form-footer pt-4 pt-5 mt-4 border-top">

    </div>

</div> 
<script>
    $(document).ready(function () {
        init_datepicker(1);

        if ('1' === '<?= (isset($promo_data['status'])) ? $promo_data['status'] : '0' ?>') {
            if (!$(".promo_status").prop('checked')) {
                $(".promo_status").click();
            }
        }
    });
</script>    