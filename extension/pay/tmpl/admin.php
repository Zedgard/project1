<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Покупки </h2>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-lg">
                            <div class="">
                                <input type="text" class="form-control search_pay_user" value="<?= $_SESSION['admin_pay_filter']['search_pay_user_str'] ?>" placeholder="Поиск по ID, email и телефону...">
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="">
                                <input type="text" value="<?= $_SESSION['admin_pay_filter']['search_pay_info_str'] ?>" class="form-control search_pay_info" placeholder="Поиск по товарам...">
                            </div>
                        </div>
                        <div class="col-lg text-right">

                            <div class="btn-group" role="group" aria-label="Basic example">
                                <label style="margin-top: 0.6rem;margin-right: 10px;">начало</label>
                                <input type="text" name="from" value="<?= $_SESSION['admin_pay_filter']['excel_from'] ?>" class="form-control excel-from">
                                <label style="margin-top: 0.6rem;margin-left: 10px;margin-right: 10px;">до</label>
                                <input type="text" name="to" value="<?= $_SESSION['admin_pay_filter']['excel_to'] ?>" class="form-control excel-to">
                                <a href="javascript:void(0)" class="btn btn-primary btn-export-exel" target="_blank" title="Выгрузить период в Exel *.CSV"><i class="fas fa-file-excel"></i></a>
                            </div>
                            <script>
                                $(function () {
                                    $.datepicker.setDefaults(
                                            {
                                                closeText: 'Закрыть',
                                                prevText: '',
                                                currentText: 'Сегодня',
                                                monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                                                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                                                monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
                                                    'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
                                                dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
                                                dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
                                                dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                                                weekHeader: 'Не',
                                                dateFormat: 'dd.mm.yy',
                                                firstDay: 1,
                                                isRTL: false,
                                                showMonthAfterYear: false,
                                                yearSuffix: ''
                                            });

                                    var dateFormat = "mm/dd/yy";
                                    var date = new Date();
                                    $(".excel-from").datepicker({
                                        defaultDate: "+1w",
                                        //changeMonth: true,
                                        numberOfMonths: 3
                                    }).on("change", function () {
                                        $(".excel-to").datepicker("option", "minDate", getDate(this));
                                    });

                                    $(".excel-to").datepicker({
                                        defaultDate: "+1w",
                                        //changeMonth: true,
                                        numberOfMonths: 3
                                    }).on("change", function () {
                                        $(".excel-from").datepicker("option", "maxDate", getDate(this));
                                    });

                                    $(".excel-from").datepicker("setDate", '<?= $_SESSION['admin_pay_filter']['excel_from'] ?>');
                                    $(".excel-to").datepicker("setDate", '<?= $_SESSION['admin_pay_filter']['excel_to'] ?>');

                                    function getDate(element) {
                                        var date;
                                        try {
                                            var date = $(element).val();
                                        } catch (error) {
                                            date = null;
                                        }
                                        return date;
                                    }

                                    $(".btn-export-exel").unbind('hover').hover(function () {
                                        var from = $(".excel-from").val();
                                        var to = $(".excel-to").val();
                                        //alert("from: " + from + " to: " + to);
                                        $(this).attr("href", "/upload/site_export_pay.php?from=" + from + "&to=" + to);
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-lg">
                                <table class="table table-striped pay_data">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">ID <span class="pay_col"></span></th>
                                            <th class="text-center">Клиент</th>
                                            <th class="text-center">
                                                <select name="pay_select_type" class="form-control pay_select_type">
                                                    <option value="">Тип</option>
                                                </select>
                                            </th>
                                            <th class="text-center">Дата</th>
                                            <th class="text-center">
                                                <select name="pay_select_status" class="form-control pay_select_status">
                                                    <option value="">Статус</option>
                                                </select>
                                            </th>
                                            <th class="text-center">Товары <span class="pay_summ_all"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <a href="javascript:void(0)" class="btn btn-primary get_next_page" style="display: none;">Дальше...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top ">

                </div>

            </div> 
        </div>
    </div>
</div>
<script src="/extension/pay/js/pay_js.js<?= $_SESSION['rand'] ?>"></script>

