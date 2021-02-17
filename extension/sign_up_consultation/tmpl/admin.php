<?
// https://developers.google.com/calendar/quickstart/js
?>
<link href='/assets/plugins/fullcalendar/lib/main.css?v=1' rel='stylesheet' />
<style>
    .ui-timepicker-div dt {
        margin-bottom: 17px;
    }

    #loading {
        display: none;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    #calendar {
        max-width: 1100px;
        margin: 0 auto;
    }
</style>
<div class="row">
    <div class="col-xxl-12">
        <div class="card card-default w-100">
            <div class="card-header card-header-border-bottom">
                <div class="row w-100">
                    <div class="col-12">
                        <h2 class="font-bold float-left">Календарь событий</h2>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm float-right update_calendar">Обновить календарь</a>
                        <br/>
                        <select name="init_master" class="form-control init_master" style="width: 200px;">
                            <? foreach ($consultation_masters as $value): ?>
                                <option value="<?= $value['id'] ?>" <?= ($_SESSION['consultation_id'] == $value['id']) ? 'selected="selected"' : '' ?>><?= $value['master_name'] ?></option>
                            <? endforeach; ?>
                        </select>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id='loading'>loading...</div>
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xxl-12">
        <div class="card card-default w-100">
            <div class="card-header card-header-border-bottom">
                <div class="row w-100">
                    <div class="col-12">
                        <h2 class="font-bold float-left">Настройки консультант</h2>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div id="accordion3" class="accordion accordion-bordered ">
                    <div class="card">
                        <div class="card-header" id="heading3">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                Настройки консультантов
                            </button>
                        </div>
                        <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion3">
                            <div class="card-body card-default w-100">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm add_consult_masters mb-3">Добавить</a>
                                <div class="consult_masters"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="display: none;">
                        <div class="card-header" id="heading2">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                Toddler Shoes, Gucci Watch
                            </button>
                        </div>
                        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion3" style="">
                            <div class="card-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.enim
                                ad minim veniam quis nostrud exer citation ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute.
                            </div>
                        </div>
                    </div>
                    <div class="card" style="display: none;">
                        <div class="card-header" id="heading3">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                Консультанты
                            </button>
                        </div>
                        <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion3">
                            <div class="card-body card-default w-100">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm add_consult_masters mb-3">Добавить</a>
                                <div class="consult_masters"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?
include 'edit_event.php';
?>
<?
include 'edit_consult_master.php';
?>
<script src='/assets/plugins/fullcalendar/lib/main.js?v=1'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/locales-all.js'></script>
<script>
    var data = [];
    var list_times;
    var master_consultation_id = 0;
    var data_local_events = [];
    $(document).ready(function () {
        init_master();

        $(".update_calendar").unbind('click').click(function () {
            $("#calendar").html('loading...');
            init_calendar_user_data();
        });


        init_consultation_master();

        $(".add_consult_masters").unbind('click').click(function () {
            clear_master_init();
            init_master_consultation_periods(0);
            $("#edit_consult_master_form").modal('toggle');
            save_btn_master_init();
        });

        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            timeOnly: true,
            hourMin: 8,
            hourMax: 18,
            stepHour: 1,
            stepMinute: 15,
            showButtonPanel: false,
            //controlType: 'select',
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

    function init_calendar_user_data() {
        sendPostLigth('/jpost.php?extension=sign_up_consultation', {"get_allevents_local": 1}, function (data) {
            data_local_events = [];
            //data_local_events = data['data'];
            //console.log(data_local_events);
            for (var i = 0; i < data['data'].length; i++) {
                var consultation_date = data['data'][i]['consultation_date'];
                var consultation_time = data['data'][i]['consultation_time'];
                //var datetime = new Date(consultation_date + 'T' + consultation_time);// '1995-12-17T03:24:00'
                //console.log('datetime' + datetime);
                data_local_events[i] =new Object({
                    'attendees': [],
                    'hangoutLink': null,
                    'id':  data['data'][i]['id'],
                    'iCalUID': data['data'][i]['id'],
                    'description': data['data'][i]['pay_descr'],
                    'end': consultation_date + 'T' + consultation_time + "+03:00",
                    'start': consultation_date + 'T' + consultation_time + "+03:00",
                    'status': "confirmed",
                    'status_ru': "подтверждено",
                    'summary': data['data'][i]['pay_descr'],
                    'title': "консультация"}); //[ 'description' = data['data'][i]['pay_descr'] ]
            }
            
//description: "<table><colgroup><col></colgroup><tbody><tr><td>Ирина Антошкина</td></tr><tr><td>89153987344</td></tr><tr><td></td></tr></tbody></table><table><colgroup><col></colgroup><tbody><tr><td></td></tr></tbody></table>"
//end: "2021-02-18T05:00:00+03:00"
//hangoutLink: null
//iCalUID: "4jsvbdqbgb1btv72ave7a1q6js@google.com"
//id: "4jsvbdqbgb1btv72ave7a1q6js_20210218T010000Z"
//start: "2021-02-18T04:00:00+03:00"
//status: "confirmed"
//status_ru: "подтверждено"
//summary: "консультация"
//title: "консультация"
            sendPostLigth('/jpost.php?extension=sign_up_consultation', {"get_allevents": 1}, function (e) {
//                console.log(data_local_events);
//                console.log(e['data']);
                $("#calendar").html('');
//                    var year = new Date().getFullYear();
//                    var month = new Date().getMonth();
//                    var day = new Date().getDay();
                var to_date = new Date();
//                    to_date.setDate(1);
//                    console.log("year: " + year + " month: " + month);
//                    console.log("to_date: " + to_date);
//                    console.log('data: ' + data);

                //var to_date = new Date();
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'ru',
                    themeSystem: 'bootstrap',
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    dayMaxEvents: true,
                    select: function (arg) {
                        var title = prompt('Event Title:');
                        if (title) {
                            calendar.addEvent({
                                title: title,
                                start: arg.start,
                                end: arg.end,
                                allDay: arg.allDay
                            })
                        }
                        calendar.unselect()
                    },
                    // THIS KEY WON'T WORK IN PRODUCTION!!!
                    // To make your own Google API key, follow the directions here:
                    // http://fullcalendar.io/docs/google_calendar/
                    googleCalendarApiKey: 'AIzaSyANZP_b-17592Im7o0o41WYvU4I-GiIBHY ',
                    // US Holidays
                    events: data_local_events,//e['data'], //data_local_events, //e['data'],
//                            [
////                                {
////                                    title: 'All Day Event 111',
////                                    description: 'description for All Day Event',
////                                    start: year + '-' + month + '-' + day + '+01'
////                                },
//                                {
//                                    title: 'All Day Event  22',
//                                    description: 'description for All Day Event',
//                                    start: to_date
//                                }
//                            ], 
//                            //'en.usa#koman1706@gmail.com.v.calendar.google.com', // events: 'en.usa#holiday@group.v.calendar.google.com',

                    eventClick: function (arg) {
                        
                         $("#edit_event_form").modal('toggle');
                         //init_date_time_form_elements();
                         //$("#edit_event_form").find(".event_publicId").val(arg.event.id);
                         get_event_local_data(arg.event.id);
                         
                    },
                    loading: function (bool) {
                        document.getElementById('loading').style.display =
                                bool ? 'block' : 'none';
                    }
                });
                calendar.render();
            });
        });
    }
    /**
     * Активируем форму
     * @returns {undefined}
     */
    function init_date_time_form_elements() {
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
         * Выбор 
         */

        //--- Дата начала ---------------
        $('.date_start').datepicker({
            changeMonth: false,
            changeYear: false,
            //maxDate: dateToday,
            minDate: minDate,
            numberOfMonths: 3,
            showButtonPanel: false,
            onSelect: function (selectedDate) {
                //console.log("onSelect: " + selectedDate);
                //$(".datepicker_data").datepicker("option", "maxDate", selectedDate);
                $(".date_start").val(selectedDate);
                $(".date_end").val(selectedDate);
            }
        });

        $('.timepicker_start').timepicker({
            timeFormat: 'HH:mm',
            timeOnly: true,
            hourMin: 0,
            hourMax: 24,
            stepHour: 1,
            stepMinute: 15,
            showButtonPanel: false,
            controlType: 'select',
            timeOnlyTitle: 'Выберите время',
            timeText: 'Время',
            hourText: 'Часы',
            minuteText: 'Минуты',
            secondText: 'Секунды',
            currentText: 'Сейчас',
            closeText: 'Закрыть',
            onSelect: function (selectedTime) {
                //console.log("selectedTime: " + selectedTime);
                $(".date_time_start").val(selectedTime);
                var t = selectedTime.split(':');
                // автоматически проставим
                // часы
                $(".timepicker_end_form").find('[data-unit="hour"]').find('option').each(function (e) {
                    //console.log('g: ' + t[0] + ' === ' + $(this).val());
                    if ((Number(t[0]) + 1) === Number($(this).val())) {
                        $(this).attr("selected", "selected");//
                    }
                });
                // минуты
                $(".timepicker_end_form").find('[data-unit="minute"]').find('option').each(function (e) {
                    //console.log('g: ' + t[0] + ' === ' + $(this).val());
                    if (Number(t[1]) === Number($(this).val())) {
                        $(this).attr("selected", "selected");//
                    }
                });

            }
        });

        //--- Дата окончания ---------------
        $('.date_end').datepicker({
            changeMonth: false,
            changeYear: false,
            //maxDate: dateToday,
            minDate: minDate,
            numberOfMonths: 3,
            showButtonPanel: false,
            onSelect: function (selectedDate) {
                //console.log("onSelect: " + selectedDate);
                //$(".datepicker_data").datepicker("option", "maxDate", selectedDate);
                $(".date_end").val(selectedDate);
            }
        });

        $('.timepicker_end').timepicker({
            timeFormat: 'HH:mm',
            timeOnly: true,
            hourMin: 0,
            hourMax: 24,
            stepHour: 1,
            stepMinute: 15,
            showButtonPanel: false,
            controlType: 'select',
            timeOnlyTitle: 'Выберите время',
            timeText: 'Время',
            hourText: 'Часы',
            minuteText: 'Минуты',
            secondText: 'Секунды',
            currentText: 'Сейчас',
            closeText: 'Закрыть',
            onSelect: function (selectedTime) {
                //console.log("selectedTime: " + selectedTime);
                $(".date_time_end").val(selectedTime);
            }
        });


    }

    /**
     * Получение данных по событию
     * @param {type} event_id
     * @returns {undefined}
     */
    function get_event_data(event_id) {
        clear_event_form();
        sendPostLigth('/jpost.php?extension=sign_up_consultation', {"get_allevents": 1, "event_id": event_id}, function (e) {

            var obj_date_start = new Date(e['data'][0]['start']);
            var obj_date_end = new Date(e['data'][0]['end']);
            $("#edit_event_form").find(".event_publicId").val(event_id);
            $("#edit_event_form").find(".event_url").attr("href", e['data'][0]['url']);
            $("#edit_event_form").find(".event_url_conferens").attr("href", e['data'][0]['hangoutLink']);
            $("#edit_event_form").find(".event_summary").val(e['data'][0]['title']);
            $("#edit_event_form").find(".event_description").val(e['data'][0]['description']);

            $("#edit_event_form").find('.date_start').datepicker("setDate", obj_date_start);
            $("#edit_event_form").find(".timepicker_start").timepicker("setTime", obj_date_start);
            $("#edit_event_form").find('.date_time_start').val($("#edit_event_form").find('.timepicker_start').timepicker().val());

            $("#edit_event_form").find(".date_end").datepicker("setDate", obj_date_end);
            $("#edit_event_form").find(".timepicker_end").timepicker("setTime", obj_date_end);
            $("#edit_event_form").find('.date_time_end').val($("#edit_event_form").find('.timepicker_end').timepicker().val());

            $("#edit_event_form").find(".attendees_email").val(e['data'][0]['attendees']);

            if (!!e['data'][0]['url'] && e['data'][0]['url'].length > 0) {
                $("#edit_event_form").find(".event_url").show();
            }
            if (!!e['data'][0]['hangoutLink'] && e['data'][0]['hangoutLink'].length > 0) {
                $("#edit_event_form").find(".event_url_conferens").show();
            }
            init_save_event();
        });
    }
    
    /**
     * Получение данных по событию
     * @param {type} event_id
     * @returns {undefined}
     */
    function get_event_local_data(event_id) {
        clear_event_form();
        sendPostLigth('/jpost.php?extension=sign_up_consultation', {"get_consultations_id": event_id, "event_id": event_id}, function (e) {
            $(".event_start_and_block").remove();
            var obj_date_start = new Date(e['data'][0]['consultation_date']+'T'+e['data'][0]['consultation_time']);
            var obj_date_end = new Date(e['data'][0]['consultation_date']+'T'+e['data'][0]['consultation_time']);
            $("#edit_event_form").find(".event_publicId").val(event_id);
            $("#edit_event_form").find(".event_url").attr("href", e['data'][0]['url']);
            $("#edit_event_form").find(".event_url_conferens").attr("href", e['data'][0]['hangoutLink']);
            $("#edit_event_form").find(".event_summary").val('Консультация ' + e['data'][0]['first_name'] + ' ' + e['data'][0]['user_phone'] );
            $("#edit_event_form").find(".event_description").val(e['data'][0]['pay_descr']);

            $("#edit_event_form").find('.date_start').datepicker("setDate", obj_date_start);
            $("#edit_event_form").find(".timepicker_start").timepicker("setTime", obj_date_start);
            $("#edit_event_form").find('.date_time_start').val($("#edit_event_form").find('.timepicker_start').timepicker().val());

            $("#edit_event_form").find(".date_end").datepicker("setDate", obj_date_end);
            $("#edit_event_form").find(".timepicker_end").timepicker("setTime", obj_date_end);
            $("#edit_event_form").find('.date_time_end').val($("#edit_event_form").find('.timepicker_end').timepicker().val());

            $("#edit_event_form").find(".attendees_email").val(e['data'][0]['user_email']);

            if (!!e['data'][0]['url'] && e['data'][0]['url'].length > 0) {
                $("#edit_event_form").find(".event_url").show();
            }
            if (!!e['data'][0]['hangoutLink'] && e['data'][0]['hangoutLink'].length > 0) {
                $("#edit_event_form").find(".event_url_conferens").show();
            }
            init_save_event();
        });
    }

    /**
     * Почистим форму
     * @returns {undefined}
     */
    function clear_event_form() {
        $("#edit_event_form").find(".event_publicId").val("");
        $("#edit_event_form").find(".event_url").attr("href", "");
        $("#edit_event_form").find(".event_url_conferens").attr("href", "");
        $("#edit_event_form").find(".event_summary").val("");
        $("#edit_event_form").find(".event_description").val("");
        $("#edit_event_form").find('.date_start').datepicker("setDate", "");
        $("#edit_event_form").find('.date_time_start').val("");
        $("#edit_event_form").find(".timepicker_start").timepicker("setTime", "");
        $("#edit_event_form").find(".date_end").datepicker("setDate", "");
        $("#edit_event_form").find(".timepicker_end").timepicker("setTime", "");
        $("#edit_event_form").find('.date_time_end').val("");
        $("#edit_event_form").find(".attendees_email").val("");

        $("#edit_event_form").find(".event_url").hide();
        $("#edit_event_form").find(".event_url_conferens").hide();

    }

    /**
     * Сохранение данных по событию
     * @returns {undefined}
     */
    function init_save_event() {
        $(".btn_event_save").unbind('click').click(function () {
            var event_id = $("#edit_event_form").find(".event_publicId").val();
            var summary = $("#edit_event_form").find(".event_summary").val();
            var event_description = $("#edit_event_form").find(".event_description").val();

            var date_start = $("#edit_event_form").find('.date_start').val();
            var date_time_start = $("#edit_event_form").find('.date_time_start').val();

            var date_end = $("#edit_event_form").find(".date_end").val();
            var date_time_end = $("#edit_event_form").find('.date_time_end').val();

            var attendees_email = $("#edit_event_form").find(".attendees_email").val();

            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                "edit_events": 1,
                "event_id": event_id,
                "summary": summary,
                "description": event_description,
                "date_start": date_start,
                "date_time_start": date_time_start,
                "date_end": date_end,
                "date_time_end": date_time_end,
                "attendees_email": attendees_email
            }, function (e) {
                if (e['success'] == '1') {
                    $("#edit_event_form").modal('toggle');
                }
            });
        });
    }

    /**
     * Список консультантов
     * @returns {undefined}
     */
    function init_consultation_master() {
        $(".consult_masters").html("");
        var masters = []; // Данные по мастерам
        clear_master_init();
        sendPostLigth('/jpost.php?extension=sign_up_consultation', {"get_consultation_master": 1}, function (e) {

            for (var i = 0; i < e['data'].length; i++) {
                masters.push(e['data'][i]);
                $(".consult_masters").append('<div class="row mb-3" objid="' + e['data'][i]['id'] + '"><div class="col-12"><span class="float-left">' + e['data'][i]['master_name'] + '</span><span class="float-right"><a href="javascript:void(0)" class="btn btn-primary btn-sm btn_edit_consultation" obj_i="' + i + '" title="Редактировать"><i class="mdi mdi-pencil"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger btn_delete_consultation" obj_i="' + i + '" title="Удалить"><i class="mdi mdi-delete"></i></a></span></div></div>');
            }

            /**
             * Активируем кнопку редактирования
             */
            $(".btn_edit_consultation").unbind('click').click(function () {
                var obj_i = $(this).attr("obj_i");
                $("#edit_consult_master_form").modal('toggle');
                $("#edit_consult_master_form").find(".master_id").val(masters[obj_i]['id']);
                $("#edit_consult_master_form").find(".master_name").val(masters[obj_i]['master_name']);
                $("#edit_consult_master_form").find(".token_file_name").val(masters[obj_i]['token_file_name']);
                $("#edit_consult_master_form").find(".credentials_file_name").val(masters[obj_i]['credentials_file_name']);
                $("#edit_consult_master_form").find(".list_times").val(masters[obj_i]['list_times']);
                var list_times_array = masters[obj_i]['list_times'].split(',');
                init_list_times(list_times_array);
                init_master_consultation_periods(masters[obj_i]['id']);
                save_btn_master_init();
            });

            /**
             * Активируем кнопку удаления
             */
            $(".btn_delete_consultation").unbind('click').click(function () {
                var obj_i = $(this).attr("obj_i");
                if (confirm('Вы действительно хотите удалить консультанта "' + masters[obj_i]['master_name'] + '"')) {
                    sendPostLigth('/jpost.php?extension=sign_up_consultation', {"master_delete": masters[obj_i]['id']}, function (e) {
                        init_consultation_master();
                    });
                }
            });
            list_times = $(".list_times").select2({
                width: "style",
                placeholder: "Список доступного времени",
                allowClear: true
            });

        });
    }

    /**
     * Инициализация кнопки консультации
     
     * @returns {undefined}     */
    function save_btn_master_init() {
        $(".btn_master_save").unbind('click').click(function () {
            var master_id = $("#edit_consult_master_form").find(".master_id").val();
            var master_name = $("#edit_consult_master_form").find(".master_name").val();
            var token_file_name = $("#edit_consult_master_form").find(".token_file_name").val();
            var credentials_file_name = $("#edit_consult_master_form").find(".credentials_file_name").val();
            var list_times = $("#edit_consult_master_form").find(".list_times").val();
            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                'master_edit': master_id,
                'master_name': master_name,
                'token_file_name': token_file_name,
                'credentials_file_name': credentials_file_name,
                'list_times': list_times
            }, function (e) {
                if (e['success'] == '1') {
                    $("#edit_consult_master_form").modal('toggle');
                    init_consultation_master();
                    clear_master_init();
                }
            });
        });
    }

    /**
     * Отчистить форму консультанта
     
     * @returns {undefined}     */
    function clear_master_init() {
        $("#edit_consult_master_form").find(".master_id").val(0);
        $("#edit_consult_master_form").find(".master_name").val('');
        $("#edit_consult_master_form").find(".token_file_name").val('');
        $("#edit_consult_master_form").find(".credentials_file_name").val('');
        $("#edit_consult_master_form").find(".list_times").val('');
        $(".master_consultation_periods").html("");
        master_consultation_id = 0;
    }

    /**
     * Получить доступное время
     * @returns {undefined}
     */
    function init_list_times(list_times_array) {
        $(".list_times").html("");
        var dateTime = new Date();
        dateTime.setHours('00');
        dateTime.setMinutes('00');
        for (var i = 0; i < 96; i++) {
            let hour = (dateTime.getHours().toString().length == 1) ? '0' + dateTime.getHours() : dateTime.getHours();
            let minute = (dateTime.getMinutes().toString().length == 1) ? '0' + dateTime.getMinutes() : dateTime.getMinutes();//dateTime.getMinutes();
            //console.log(hour + ':' + minute);
            $(".list_times").append('<option value="' + hour + ':' + minute + '">' + hour + ':' + minute + '</option>');
            dateTime.setMinutes(dateTime.getMinutes() + 15);
        }
        //$(".page_role").append('<option value="' + e['data'][i]['id'] + '">' + e['data'][i]['role_name'] + '</option>');

        list_times.val(list_times_array).trigger("change");
    }

    /**
     * Определение консультанта
     * @returns {undefined}
     */
    function init_master() {
        $(".init_master").unbind('change').change(function () {
            var master_id = $(this).val();
            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                'set_consultation_config': master_id
            }, function (e) {
                if (e['success'] == '1') {
                    init_calendar_user_data();
                }
            });
        });

        var master_id = $(".init_master").val();
        sendPostLigth('/jpost.php?extension=sign_up_consultation', {
            'set_consultation_config': master_id
        }, function (e) {
            if (e['success'] == '1') {
                init_calendar_user_data();
            }
        });
    }
    function dateJSFormat(var_date) {
        var arr = var_date.split('-');
        return arr[2] + '/' + arr[1] + '/' + arr[0];
    }
</script>