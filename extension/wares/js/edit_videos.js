$(document).ready(function () {
    $(".material_info").unbind('click').dblclick(function () {
        $(this).closest(".material_tr").find(".material_info_none").toggle(200);
    });

    $(".form-control-material").on('keyup change focus', function () {
        if (!!$(this).attr('row_db') && !!$(this).attr('obj_id')) {
            var elm_type = $(this).get(0).tagName;
            var row_db = $(this).attr('row_db');
            var obj_id = $(this).attr('obj_id');
            var id = $(this).attr('id');
            var val = $(this).val();

            var asinc = '0';
            //console.log('elm_type: ' + elm_type);
            if (elm_type == 'textarea') {
                val = $(this).html();
            }
            if (!!$(this).attr('init_html')) {
                $(this).closest(".material_tr").find(".material_info").find("." + $(this).attr('init_html')).html(val); // material_info
                //$("." + $(this).attr('init_html')).html(val);
            }
            if (!!$(this).attr('init_href')) {
                $(this).closest(".material_tr").find(".material_info").find("." + $(this).attr('init_href')).attr("href", val);
            }
            if (!!$(this).attr('init_checked')) {
                asinc = '1';
                val = 0;
                if ($(this).prop('checked')) {
                    val = 1;
                }

                // Для аудио файла
                if ($(this).attr('init_checked') == 'audio_file_download_true') {
                    if (val == 1) {
                        $(this).closest(".material_tr").find(".material_info").find(".clmns--track-links").hide();
                    } else {
                        $(this).closest(".material_tr").find(".material_info").find(".clmns--track-links").show();
                    }
                    //'onclick="return false;"';
                }
            }
            console.log('val: ' + val);
            // переинициализация аудио плеера
            if (!!$(this).attr('init_audio')) {
                if ($(".calamansi-audio-" + obj_id).length > 0) {
                    $(".calamansi-audio-" + obj_id).attr("href", val);
                    $(".calamansi-audio-" + obj_id).html(val);
                }
//                new Calamansi(document.querySelector('#calamansi-player-' + id), {
//                    skin: '/assets/plugins/calamansi/skins/basic_download2',
//                    playlists: {
//                        'Classics': [
//                            {
//                                source: val
//                            }
//                        ]
//                    },
//                    defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png'
//                });
            }


            // Обработка видео    
            if (!!$(this).attr('init_youtube_src')) {
                if ($(".youtube-video-" + obj_id).length > 0) {
                    $(".youtube-video-" + obj_id).attr("href", val);
                    $(".youtube-video-" + obj_id).html(val);
                }
//                console.log('init_youtube_src');
//                $(this).closest(".material_tr").find(".material_info").find("." + $(this).attr('init_youtube_src')).attr("data-setup", '{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "' + val + '"}] }');
//                var options = {};
//                var player = videojs('video_' + id, options, function onPlayerReady() {
//                    // In this context, `this` is the player that was created by Video.js.
//                    //this.play();
//                    // How about an event listener?
//                    this.on('ended', function () {
//                    });
//                });
//                player.src({src: val, type: 'video/youtube'});
//
            }


            sendPostLigth('/jpost.php?extension=wares',
                    {
                        "editMaterials": 1,
                        "row_db": row_db,
                        "obj_id": obj_id,
                        "val": val
                    },
                    function (e) {
                        //console.log(elm_type);
                        if (e['success'] == '1') {
                            if (elm_type == 'SELECT') {
                                document.location.reload();
                            }
                        } else {
                            alert('Ошибка сохранения!');
                        }
                    }, asinc);
        }
    });

    // Селекн н материале 
    $(".form-control-material-select").change(function () {
        var elm_type = $(this).get(0).tagName;
        var row_db = $(this).attr('row_db');
        var obj_id = $(this).attr('obj_id');
        var id = $(this).attr('id');
        var val = $(this).val();
        sendPostLigth('/jpost.php?extension=wares',
                {
                    "editMaterials": 1,
                    "row_db": row_db,
                    "obj_id": obj_id,
                    "val": val
                },
                function (e) {
                    //console.log(elm_type);
                    if (e['success'] == '1') {
                        if (elm_type == 'SELECT') {
                            document.location.reload();
                        }
                    } else {
                        alert('Ошибка сохранения!');
                    }
                });
    });

    $(".form-control-video").change(function () {
        if (!!$(this).attr('row_db') && !!$(this).attr('obj_id')) {
            var elm_type = $(this).get(0).tagName;
            var row_db = $(this).attr('row_db');
            var obj_id = $(this).attr('obj_id');
            var val = $(this).val();
            sendPostLigth('/jpost.php?extension=wares',
                    {
                        "editMaterial": 1,
                        "row_db": row_db,
                        "obj_id": obj_id,
                        "val": val
                    },
                    function (e) {
                        //console.log(elm_type);
                        if (e['success'] == '1') {
                            if (elm_type == 'SELECT') {
                                document.location.reload();
                            }
                        } else {
                            alert('Ошибка сохранения!');
                        }
                    });
        }
    });

    $(".form-control-series").change(function () {
        if (!!$(this).attr('row_db') && !!$(this).attr('obj_id')) {
            var row_db = $(this).attr('row_db');
            var obj_id = $(this).attr('obj_id');
            var val = $(this).val();
            var obj_format = '';
            if (!!$(this).attr("obj_format")) {
                obj_format = $(this).attr("obj_format");
            }

            sendPostLigth('/jpost.php?extension=wares',
                    {
                        "editSeries": 1,
                        "row_db": row_db,
                        "obj_id": obj_id,
                        "obj_format": obj_format,
                        "val": val
                    },
                    function (e) {
                        if (e['success'] == '1') {
                            // специальные действия 
                            if (row_db == "title_top") {
                                $(".series_title_top_" + obj_id).html(val);
                            }
                        } else {
                            alert('Ошибка сохранения!');
                        }
                    });
        }
    });

    $(".position_up,.position_down").unbind('click').click(function () {
        var series_id = $(this).attr("series_id");
        var position = $(this).attr("position");
        var metod = $(this).attr("metod");
        sendPostLigth('/jpost.php?extension=wares',
                {
                    "setPositionVideoSeries": 1,
                    "position": position,
                    "series_id": series_id,
                    "metod": metod
                },
                function (e) {
                    document.location.reload();
                });
    });

    $(".material_position_up,.material_position_down").unbind('click').click(function () {
        var material_id = $(this).attr("material_id");
        var series_id = $(this).attr("series_id");
        var position = $(this).attr("position");
        var metod = $(this).attr("metod");
        sendPostLigth('/jpost.php?extension=wares',
                {
                    "material_position_set": 1,
                    "position": position,
                    "material_id": material_id,
                    "series_id": series_id,
                    "metod": metod
                },
                function (e) {
                    //document.location.reload();
                });
    });

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
        dateFormat: 'dd.mm.yy',
        maxDate: "+1M +10D",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);


});
function dateDBFormat(var_date) {
    var arr = var_date.split('-');
    return arr[2] + '/' + arr[1] + '/' + arr[0];
}