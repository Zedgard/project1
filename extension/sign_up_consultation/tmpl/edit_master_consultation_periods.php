<div class="row mb-2">
    <a href="javascript:void(0)" class="btn btn-primary btn-sm ml-3 add_master_consultation_period" obj_i=""><i class="mdi mdi-plus-box-outline"></i> Добавить период</a>
</div>
<div class="row">
    <div class="col-12">
        <div class="float-left w-25">Часы</div>
        <div class="float-left w-25">Минуты</div>
        <div class="float-left w-25">Стоимость</div>
    </div>
</div>
<div class="row master_consultation_periods">

</div>
<script>
    $(document).ready(function () {

    });

    /**
     * Список периодов
     * @param {type} master_id
     * @returns {undefined}
     */
    var master_consultation_periods = [];
    function init_master_consultation_periods(master_id) {
        master_consultation_id = master_id;
        console.log("master_id: " + master_id);
        if (master_id > 0) {
            $(".add_master_consultation_period").removeClass('disabled');
            $(".master_consultation_periods").html('');

            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                "get_master_consultation_periods": 1,
                "master_id": master_id,
            }, function (e) {
                $(".master_consultation_periods").html("");
                master_consultation_periods = [];
                for (var i = 0; i < e['data'].length; i++) { // periods_minute
                    master_consultation_periods.push(e['data'][i]);
                    $(".master_consultation_periods").append('<div class="row mt-2">\n\
                     <div class="col-12">\n\
                        <span class="float-left">\n\
                            <input type="text" name="m_c_p__period_hour" class="form-control ml-3 float-left w-25 m_c_p_period_hour" value="' + e['data'][i]['period_hour'] + '" obj_i="' + i + '" />\n\
                            <input type="text" name="m_c_p__periods_minute" class="form-control ml-3 float-left w-25 m_c_p_periods_minute" value="' + e['data'][i]['periods_minute'] + '" obj_i="' + i + '" />\n\
                            <input type="text" name="m_c_p__period_price" class="form-control ml-3 float-left w-25 m_c_p_period_price" value="' + e['data'][i]['period_price'] + '" obj_i="' + i + '" />\n\
                        </span> \n\
                        <span class="float-right"> \n\
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger btn_delete_consultation_period" obj_i="' + i + '" title="Удалить"> \n\
                                <i class="mdi mdi-delete"></i> \n\
                            </a> \n\
                        </span> \n\
                    </div> \n\
                </div>');
                }

                console.log('log: ' + e['data'].length);
                init_add_master_consultation_period();
                init_actions_master_consultation_period();
            });

        } else {
            $(".add_master_consultation_period").addClass('disabled');
            $(".master_consultation_periods").html('Добавлять периоды можно только после того как создадите запись!');
        }
    }

    /**
     * Кнопка добавления периода
     * @returns {undefined}
     */
    function init_add_master_consultation_period() {
        $(".add_master_consultation_period").unbind('click').click(function () {
            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                "add_master_consultation_period": 1,
                "master_id": master_consultation_id,
            }, function (e) {
                init_master_consultation_periods(master_consultation_id);
            });
        });
    }

    function init_actions_master_consultation_period() {
        $(".m_c_p_period_hour, .m_c_p_periods_minute, .m_c_p_period_price").change(function () {
            var obj_i = $(this).attr("obj_i");
            var consultation_period = master_consultation_periods[obj_i]['id'];
            var period_hour = $('.m_c_p_period_hour[obj_i=' + obj_i + ']').val();
            var periods_minute = $('.m_c_p_periods_minute[obj_i=' + obj_i + ']').val();
            var period_price = $('.m_c_p_period_price[obj_i=' + obj_i + ']').val();
            //console.log('period_hour: ' + period_hour + ' periods_minute: ' + periods_minute + ' period_price: ' + period_price);

            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                "edit_master_consultation_period": 1,
                "master_id": master_consultation_id,
                "consultation_period": consultation_period,
                "period_hour": period_hour,
                "periods_minute": periods_minute,
                "period_price": period_price,
            }, function (e) {
                init_master_consultation_periods(master_consultation_id);
            });
        });
        $(".btn_delete_consultation_period").unbind('click').click(function () {
            var obj_i = $(this).attr("obj_i");
            var consultation_period = master_consultation_periods[obj_i]['id'];
            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                "delete_master_consultation_period": 1,
                "consultation_period": consultation_period
            }, function (e) {
                init_master_consultation_periods(master_consultation_id);
            });
        });
    }


</script>

