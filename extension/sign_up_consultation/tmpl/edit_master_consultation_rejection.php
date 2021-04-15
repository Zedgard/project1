<div class="row mb-2">
    <a href="javascript:void(0)" class="btn btn-primary btn-sm ml-3 edit_master_consultation_rejection" obj_i="0"><i class="mdi mdi-plus-box-outline"></i> Добавить исключение</a>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>День</th>
                    <th>Период</th>
                </tr>
            </thead>
            <tbody class="master_consultation_rejections">

            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {

    });

    vsr = master_consultation_id = 0;
    /**
     * Список исключений
     * @param {type} master_id
     * @returns {undefined}
     */
    var master_consultation_rejections = [];
    function init_master_consultation_rejection(master_id) {
        master_consultation_id = master_id;
        init_add_master_consultation_rejection();

        sendPostLigth('/jpost.php?extension=sign_up_consultation', {
            "get_master_consultation_rejections": 1,
            "master_id": master_id
        }, function (e) {
            $(".master_consultation_rejections").html("");
            master_consultation_rejections = [];
            for (var i = 0; i < e['data'].length; i++) { // periods_minute
                master_consultation_rejections.push(e['data'][i]);
                $(".master_consultation_rejections").append('<tr elm_id="' + e['data'][i]['id'] + '">\n\
                            <td><input type="text" name="m_c_p_rejection_day" class="form-control inp_datepicker m_c_p_rejection_day" value="' + e['data'][i]['rejection_day'] + '" obj_i="' + i + '" /></td>\n\
                            <td><select name="m_c_p_rejection_period" class="form-control periods_list m_c_p_rejection_period" obj_i="' + i + '"></select></td>\n\
                            <td><a href="javascript:void(0)" class="btn mt-2 btn-sm btn-danger btn_delete_consultation_rejection" obj_i="' + i + '" title="Удалить"><i class="mdi mdi-delete"></i></a></td>\n\
                    </tr>');
            }
            //<option></option> <input type="text" name="m_c_p_rejection_period" class="form-control m_c_p_rejection_period" value="' + e['data'][i]['rejection_period'] + '" obj_i="' + i + '" />
            init_datepicker(3);
            init_actions_master_consultation_rejection();

            init_select_periods_list();
            // отметим выбранные периоды
            setTimeout(function () {
                for (var i = 0; i < master_consultation_rejections.length; i++) {
                    $('.m_c_p_rejection_period[obj_i="' + i + '"]').find('option[value="' + e['data'][i]['rejection_period'] + '"]').attr("selected", "selected");
                }
            }, 500);
            // удаление исключения
            $(".btn_delete_consultation_rejection").unbind('click').click(function () {
                var obj_i = $(this).attr("obj_i");
                var master_consultation_rejections_id = master_consultation_rejections[obj_i]['id'];
                sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                    "delete_master_consultation_rejection": master_consultation_rejections_id
                }, function (e) {
                    init_master_consultation_rejection(master_consultation_id);
                });
            });
        });

    }

    /**
     * Кнопка добавления исключения
     * @returns {undefined}
     */
    function init_add_master_consultation_rejection() {
        $(".edit_master_consultation_rejection").unbind('click').click(function () {
            //var obj_i = $(this).attr('obj_i');
            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                "edit_master_consultation_rejection": 1,
                "elm_id": 0,
                "master_id": master_consultation_id,
                "rejection_day": '',
                "rejection_period": '0'
            }, function (e) {
                init_master_consultation_rejection(master_consultation_id);
            });
        });
    }

    // редактирование исключения
    function init_actions_master_consultation_rejection() {
        $(".m_c_p_rejection_day, .m_c_p_rejection_period").change(function () {
            var obj_i = $(this).attr("obj_i");
            var master_consultation_rejections_id = master_consultation_rejections[obj_i]['id'];
            var rejection_day = $('.m_c_p_rejection_day[obj_i=' + obj_i + ']').val();
            var rejection_period = $('.m_c_p_rejection_period[obj_i=' + obj_i + ']').val();

            sendPostLigth('/jpost.php?extension=sign_up_consultation', {
                "edit_master_consultation_rejection": 1,
                "master_id": master_consultation_id,
                "elm_id": master_consultation_rejections_id,
                "rejection_day": rejection_day,
                "rejection_period": rejection_period
            }, function (e) {
                init_master_consultation_rejection(master_consultation_id);
            });
        });

    }


</script>