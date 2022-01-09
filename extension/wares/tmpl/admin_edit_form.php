<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Управление товаром</h2>
                </div>

                <div class="card-body form_save_wares">
                    <button type="button" class="btn btn-primary btn_save_config" style="position: fixed;right: 3rem;top: 7rem;z-index: 999;">Сохранить</button>
                    <div class="form-group">
                        <label for="config_title">Название</label>
                        <input type="text" class="form-control wares_title" id="wares_title" placeholder="Наименование товара" required>
                    </div>

                    <div class="form-group">
                        <label for="config_code">Категории</label>
                        <select class="form-select wares_categorys" name="states[]" multiple="multiple"></select> 
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="config_code">Код товара</label>
                            <input type="text" class="form-control wares_ex_code" id="wares_ex_code" placeholder="Код" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="config_code">Артикул</label>
                            <input type="text" class="form-control wares_articul" id="wares_articul" placeholder="Артикул" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="config_code">Количество</label>
                        <input type="text" class="form-control wares_col" id="wares_col" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Количество товара в наличии..." required>
                    </div>

                    <div class="form-group">
                        <label for="wares_descr">Подробное описание</label>
                        <textarea name="wares_descr" id="wares_descr" class="form-control wares_descr" placeholder="Текст описания" style="width: 100%;height: 100px;"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="wares_url_file">Фаил с архивом</label>
                        <input type="text" class="form-control wares_url_file" id="wares_url_file" placeholder="Фаил" required>
                    </div>

                    <div class="form-group">
                        <label for="wares_active">Материалы</label><br/>
                        <a href="/extension/wares/videos.php?wares_id=<?= $wares_id ?>" class="btn btn-info mb-2 float-right" target="_blank">Редактировать материалы на отдельной странице</a>
                        <iframe src="/extension/wares/videos.php?wares_id=<?= $wares_id ?>" class="w-100" style="height: 600px;border: 0px;" ></iframe>
                    </div>

                    <div class="form-group">
                        <label for="wares_active">Отображение</label><br/>
                        <label class="switch switch-text switch-primary form-control-label">
                            <input type="checkbox" class="switch-input form-check-input wares_active" value="1" checked="checked">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <?
                    importELFinder(1);
                    ?>

                    <div class="mb-3" style="padding: 1%;background-color: #f7f7f7;">
                        <h3>Закрытый клуб</h3>
                        <div class="form-group">
                            <label for="club_month_period">Количество месяцев для доступа к закрытому клубу</label>
                            <select id="club_month_period" name="club_month_period" class="form-control club_month_period">
                                <option value="0">Не предоставлено</option>
                                <option value="1">1 месяц</option>
                                <option value="2">2 месяц</option>
                                <option value="3">3 месяц</option>
                                <option value="4">4 месяц</option>
                                <option value="5">5 месяц</option>
                                <option value="6">6 месяц</option>
                                <option value="7">7 месяц</option>
                                <option value="8">8 месяц</option>
                                <option value="9">9 месяц</option>
                                <option value="10">10 месяц</option>
                                <option value="11">11 месяц</option>
                                <option value="12">12 месяц</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="club_days_period">Количество дней</label>
                            <select id="club_days_period" name="club_days_period" class="form-control club_days_period">
                                <option value="0">Не предоставлено</option>
                                <?
                                for ($day_i = 1; $day_i < 29; $day_i++) {
                                    ?>
                                    <option value="<?= $day_i ?>"><?= $day_i ?></option>
                                    <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="wares_id" class="wares_id" id="wares_id" value="0" />
                    <!--<button type="button" class="btn btn-danger btn-pill" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</button>-->
                    <a href="./" class="btn btn-danger">Закрыть</a>
                    <button type="button" class="btn btn-primary btn_save_config">Сохранить</button>

                </div>
            </div>

            <div class="form-footer pt-4 pt-5 mt-4 border-top">

            </div>


        </div>
    </div>
</div>
<script src="/assets/plugins/tinymce/tinymce.js"></script> 
<?
importWisiwyng('wares_descr');
?>

<script>
    var wares_id = '<?= $wares_id ?>';

    var wares_categorys = '';


    $(document).ready(function () {

        wares_categorys = $(".wares_categorys").select2({
            width: "100%",
            placeholder: "Выбирете категории",
            allowClear: true
        });

        $(".btn_save_config").click(function () {
            var wares_id = $(".wares_id").val();
            var wares_title = $(".wares_title").val();
            var wares_ex_code = $(".wares_ex_code").val();
            var wares_articul = $(".wares_articul").val();
            var wares_col = $(".wares_col").val();
            var club_month_period = $(".club_month_period").val();
            var club_days_period = $(".club_days_period").val();
            var wares_descr = tinymce.get('wares_descr').getContent();
            var wares_url_file = $(".wares_url_file").val();
            var categorys = $(".wares_categorys").val();
            // tinymce.get('wares_descr').setContent("<p>Hello world!</p>")
            var wares_active = 1;
            if (!$(".form_save_wares").find(".wares_active").prop('checked')) {
                wares_active = 0;
            }
            //var wares_active = $(".form_save_wares").find(".wares_active").val();

            let images_col = $('.image_elm').length;
            var images_str = [];
            for (var i = 0; i < images_col; i++) {
                images_str.push($($('.image_elm')[i]).find(".image_obj_value").val());
            }

            sendPostLigth('/jpost.php?extension=wares',
                    {"edit_wares": wares_id,
                        "wares_title": wares_title,
                        "wares_ex_code": wares_ex_code,
                        "wares_articul": wares_articul,
                        "wares_col": wares_col,
                        "club_month_period": club_month_period,
                        "club_days_period": club_days_period,
                        "wares_descr": wares_descr,
                        "wares_url_file": wares_url_file,
                        "wares_active": wares_active,
                        "wares_images": images_str.toString(),
                        "wares_categorys": categorys
                    },
                    function (e) {
                        if (e['success'] == '1') {
                            //$(".form_save_wares").find('data-dismiss="modal"').click();
                            $('#form_edit_wares_modal').modal('hide');
                        }
                    });
        });

        save_wares_init();

    });

    // Инициализация кнопки редактирования
    function save_wares_init() {
        if (wares_id != '') {
            //clear_form_save_wares();
            //var wares_id = wares_id;
            sendPostLigth('/jpost.php?extension=wares',
                    {"getWaresElemId": wares_id},
                    function (e) {
                        if (e['success'] == '1') {
                            $(".wares_id").val(e['data']['id']);
                            $(".wares_title").val(e['data']['title']);
                            $(".wares_ex_code").val(e['data']['ex_code']);
                            $(".wares_articul").val(e['data']['articul']);
                            $(".wares_url_file").val(e['data']['url_file']);
                            //console.log("club_month_period: " + e['data']['club_month_period']);
                            $('.club_month_period option[value="' + e['data']['club_month_period'] + '"]').attr("selected", "selected");
                            $('.club_days_period option[value="' + e['data']['club_days_period'] + '"]').attr("selected", "selected");
                            

                            var interval = setInterval(function () {
                                if (tinymce_init == 1) {
                                    tinymce.get('wares_descr').setContent(e['data']['descr']);
                                    clearInterval(interval);
                                }
                            }, 300);

                            $(".wares_col").val(e['data']['col']);

                            if (e['data']['active'] > 0) {
                                if (!$(".wares_active").is(':checked')) {
                                    $(".wares_active").click();
                                }
                            } else {
                                $(".wares_active").removeAttr("checked");
                            }

                            // Каталоги
                            var wares_categorys_array = [];
                            if (e['data']['wares_category'].length > 0) {
                                for (var i = 0; i < e['data']['wares_category'].length; i++) {
                                    wares_categorys_array.push(e['data']['wares_category'][i]);
                                }
                            }

                            getCategoryArray(wares_categorys_array);

                            /* -- images -- */
                            var images = e['data']['images'].split(',');
                            for (var i = 0; i < images.length; i++) {
                                $(".images").append(get_html_images_block(images[i], i));
                            }
                            /* -- images end -- */
                            $('#form_edit_wares_modal').modal('show');
                        }
                        if (typeof block_checked_init == 'function') {
                            block_checked_init();
                        }
                    });
        } else {
            $(".btn_wares_edit").click(function () {
                clear_form_save_wares();
                var wares_id = $(this).closest("tr").attr("elm_id");
                sendPostLigth('/jpost.php?extension=wares',
                        {"getWaresElemId": wares_id},
                        function (e) {
                            if (e['success'] == '1') {
                                $(".wares_id").val(e['data']['id']);
                                $(".wares_title").val(e['data']['title']);
                                $(".wares_ex_code").val(e['data']['ex_code']);
                                $(".wares_articul").val(e['data']['articul']);
                                $(".wares_url_file").val(e['data']['url_file']);
                                // tinymce.get('wares_descr').setContent(e['data']['descr']);
                                $(".wares_col").val(e['data']['col']);
                                $('.club_month_period option[value="' + e['data']['club_month_period'] + '"]').attr("selected", "selected");
                                $('.club_days_period option[value="' + e['data']['club_days_period'] + '"]').attr("selected", "selected");

                                if (e['data']['active'] > 0) {
                                    if (!$(".wares_active").is(':checked')) {
                                        $(".wares_active").click();
                                    }
                                } else {
                                    $(".wares_active").removeAttr("checked");
                                }
                                /* -- images -- */
                                var images = e['data']['images'].split(',');
                                for (var i = 0; i < images.length; i++) {
                                    $(".images").append(get_html_images_block(images[i], i));
                                }
                                /* -- images end -- */
                                $('#form_edit_wares_modal').modal('show');
                            }
                        });
            });
        }


    }

    /**
     * Действия
     */
    function wares_delete_init() {
        $(".btn_wares_delete").click(function () {
            var wares_id = $(this).closest("tr").attr("elm_id");
            sendPostLigth('/jpost.php?extension=wares',
                    {"deleteWares": wares_id},
                    function (e) {
                    });
        });
    }


    function wares_switch_init() {
        $(".wares_active_switch").unbind("click").click(function () {
            var wares_id = $(this).attr("elm_id");
            var checked = 0;
            if ($(this).prop('checked')) {
                checked = 1;
            }
            sendPostLigth('/jpost.php?extension=wares',
                    {"setWaresActive": wares_id,
                        "active": checked},
                    function (e) {
                    });
        });
    }

    /**
     * Категории 
     * @returns {undefined}
     */
    function getCategoryArray(v) {
        if ($(".wares_categorys").length > 0) {
            $(".wares_categorys option").remove();
            sendPostLigth('/jpost.php?extension=category', {"getCategoryArray": '1', "searchStr": ''}, function (e) {
                var data = e['data'];
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        $(".wares_categorys").append('<option value="' + data[i]['id'] + '">' + data[i]['title'] + '</option>');
                    }
                    if (!!v && v.length > 0) {
                        wares_categorys.val(v).trigger("change");
                    }
                }
            });
        }
    }
    window.addEventListener("load", function(event) {
        tinymce.get('wares_descr').setContent(document.querySelector(".wares_descr").textContent);
  });
</script>    