<div class="sign_up_consultation ">
    <div class="sign_up_consultation_back">
        <div class="container">
            <div class="row">
                <div class="col-md-6 top80 bottom100">
                    <div style="color: #00bfda;" class="fontfize200 fontweight500 bottom40">Записаться на консультацию</div>
                    <div class="datetime_piker_select_block">
                        <div class="datetime_piker_select_title">
                            Выберите дату и время
                        </div>
                        <div style="width: 100%;height: 400px;">
                            <div class="datepicker" style="width: 300px;"></div>
                            <input type="text" name="datepicker_data" value="" class="datepicker_data" style="display: none;" />
                            <div class="timepicker"></div>
                            <input type="text" name="timepicker_data" value="" class="timepicker_data" style="display: none;" />
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div> 
                <div class="col-md-6 top80 bottom100">
                    <div class="btn button btnprimary" style="float: right;clear: both;">Срочная консультация</div>
                    <div style="margin-top: 82px;">
                        <div class="top50 text-right"><input type="text" name="consult_first_name" value="" placeholder="Ваше Имя и Фамилия" class="consult_form_input width90 fontfize150" /></div>
                        <div class="top30 text-right"><input type="text" name="consult_user_phone" value="" placeholder="Телефон" class="consult_form_input width90 fontfize150" /></div>
                        <div class="top30 text-right"><input type="text" name="consult_user_email" value="" placeholder="Email" class="consult_form_input width90 fontfize150" /></div>
                        <div class="top50 text-right">
                            <select name="consult_your_master" class="consult_form_input width90 fontfize150">
                                <option value="">Выберите специалиста</option>
                                <option value="">Эдгард Зайцев</option>
                                <option value="">Сергей Александрович</option>
                                <option value="">Татьяна Владимировна</option>
                                <option value="">Кирил Зотов</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        var dateToday = new Date();
        var minDate = new Date();
        // Русифицируем
        $.datepicker.regional['ru'] = {

            closeText: 'Закрыть',
            prevText: 'Пред',
            nextText: 'След',
            currentText: 'Сегодня',
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
                'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
            dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
            dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            weekHeader: 'Нед',
            dateFormat: 'dd/mm/yy',
            maxDate: "+1M +10D",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ru']);
        /*
         $('#ps_second_input_from').datepicker({
         changeMonth: true,
         changeYear: true,
         maxDate: dateToday,
         onSelect: function (selectedDate) {
         $("#ps_second_input_to").datepicker("option", "minDate", selectedDate);
         },
         });
         */

        /*
         * Выбор числа
         */
        $('.datepicker').datepicker({
            changeMonth: false,
            changeYear: false,
            //maxDate: dateToday,
            minDate: minDate,
            showButtonPanel:false,
            onSelect: function (selectedDate) {
                //console.log("onSelect: " + selectedDate);
                //$(".datepicker_data").datepicker("option", "maxDate", selectedDate);
                $(".datepicker_data").val(selectedDate);
            }
        });
        /*
         * Время
         */
        $('.timepicker').timepicker({
            timeOnly: true,
            hourMin: 8,
            hourMax: 17,
            stepHour: 1,
            stepMinute: 10,
            showButtonPanel: false,
            timeOnlyTitle: 'Выберите время',
            timeText: 'Время',
            hourText: 'Часы',
            minuteText: 'Минуты',
            secondText: 'Секунды',
            currentText: 'Сейчас',
            closeText: 'Закрыть',
            onSelect: function (selectedTime) {
                //console.log("selectedTime: " + selectedTime);
                $(".timepicker_data").val(selectedTime);
            }
        });

    });
</script>