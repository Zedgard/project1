<div class="row mb-2">
    <a href="javascript:void(0)" class="btn btn-primary btn-sm ml-3 add_master_consultation_period" obj_i=""><i class="mdi mdi-plus-box-outline"></i> Добавить период</a>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Время</th>
                    <th>Часы</th>
                    <th>Минуты</th>
                    <th>Стоимость</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="master_consultation_periods">

            </tbody>
        </table>
    </div>
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
        if (master_id > 0) {
            $(".add_master_consultation_period").removeClass('disabled');

            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                "get_master_consultation_periods": 1,
                "master_id": master_consultation_id
            }, function (e) {
                $(".master_consultation_periods").html("");
                master_consultation_periods = [];
                for (var i = 0; i < e['data'].length; i++) { // periods_minute
                    master_consultation_periods.push(e['data'][i]);
                    var period_active_checked = '';
                    if (e['data'][i]['period_active'] == '1') {
                        period_active_checked = 'checked="checked"';
                    }

                    $(".master_consultation_periods").append('<tr>\n\
                            <td><input type="text" name="m_c_p__period_hour" class="form-control m_c_p_period_time" value="' + e['data'][i]['period_time'] + '" obj_i="' + i + '" /></td>\n\
                            <td><input type="text" name="m_c_p__period_hour" class="form-control m_c_p_period_hour" value="' + e['data'][i]['period_hour'] + '" obj_i="' + i + '" /></td>\n\
                            <td><input type="text" name="m_c_p__periods_minute" class="form-control m_c_p_periods_minute" value="' + e['data'][i]['periods_minute'] + '" obj_i="' + i + '" /></td>\n\
                            <td><input type="text" name="m_c_p__period_price" class="form-control m_c_p_period_price" value="' + e['data'][i]['period_price'] + '" obj_i="' + i + '" /></td>\n\
                            <td><input type="checkbox" name="m_c_p_period_active" class="form-check-input ml-3 m_c_p_period_active" value="1" obj_i="' + i + '" ' + period_active_checked + ' style="margin-top: 12px;" /></td>\n\
                            <td><a href="javascript:void(0)" class="btn btn-sm btn-danger mt-2 btn_delete_consultation_period" obj_i="' + i + '" title="Удалить"><i class="mdi mdi-delete"></i></a></td>\n\
                    </tr>');
                }

                init_add_master_consultation_period();
                init_actions_master_consultation_period();
                setTimeout(function () {
                    init_select_periods_list();
                }, 500);

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
                "master_id": master_consultation_id
            }, function (e) {
                init_master_consultation_periods(master_consultation_id);
            });
        });
    }

    // редактирование периода
    function init_actions_master_consultation_period() {
        $(".m_c_p_period_hour, .m_c_p_periods_minute, .m_c_p_period_price, .m_c_p_period_time, .m_c_p_period_active").change(function () {
            var obj_i = $(this).attr("obj_i");
            var consultation_period = master_consultation_periods[obj_i]['id'];
            var period_time = $('.m_c_p_period_time[obj_i=' + obj_i + ']').val();
            var period_hour = $('.m_c_p_period_hour[obj_i=' + obj_i + ']').val();
            var periods_minute = $('.m_c_p_periods_minute[obj_i=' + obj_i + ']').val();
            var period_price = $('.m_c_p_period_price[obj_i=' + obj_i + ']').val();
            var period_active = 0;
            if ($('.m_c_p_period_active[obj_i=' + obj_i + ']').prop("checked")) {
                period_active = 1;
            }
            //console.log('period_hour: ' + period_hour + ' periods_minute: ' + periods_minute + ' period_price: ' + period_price);

            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                "edit_master_consultation_period": 1,
                "master_id": master_consultation_id,
                "consultation_period": consultation_period,
                "period_time": period_time,
                "period_hour": period_hour,
                "periods_minute": periods_minute,
                "period_price": period_price,
                "period_active": period_active
            }, function (e) {
                init_master_consultation_periods(master_consultation_id);
            });
        });

        // удаление периода
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


    function init_select_periods_list() {
        if (!!$(".periods_list")) {
            $(".periods_list").html("");
            $(".periods_list").append('<option value="0">Все</option>');
            if (master_consultation_periods.length > 0) {
                for (var i = 0; i < master_consultation_periods.length; i++) {
                    $(".periods_list").append('<option value="' + master_consultation_periods[i]['id'] + '">"' + master_consultation_periods[i]['period_time'] + '"</option>');
                }
            }
        }
    }

</script>

