<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <META HTTP-EQUIV="Access-Control-Allow-Origin" CONTENT="https://www.youtube.com">
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css<?= $_SESSION['rand'] ?>" 
              integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" 
              crossorigin="anonymous">
        <!-- FAVICON -->
        <link href="/favicon.ico" rel="shortcut icon" />
        <script src="/assets/plugins/jquery/jquery.js<?= $_SESSION['rand'] ?>"></script>
        <link href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.min.css<?= $_SESSION['rand'] ?>" rel="stylesheet" />
        <script src="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.js<?= $_SESSION['rand'] ?>"></script>
        <link href="/assets/css/sleek.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
        <link href="/assets/plugins/video/css/videojs.css<?= $_SESSION['rand'] ?>" rel="stylesheet">

        <link href="/assets/css/sleek.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
        <script src="/assets/js/sleek.bundle.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/js/sleek.js<?= $_SESSION['rand'] ?>"></script>
        <script type="text/javascript" src="/assets/js/init.js<?= $_SESSION['rand'] ?>"></script>
        <script src="/assets/js/ajax.js<?= $_SESSION['rand'] ?>"></script>   
        <link rel="stylesheet" href="/extension/products/office.css<?= $_SESSION['rand'] ?>">
        <link href="/extension/wares/css/edit_videos.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
        <link rel="stylesheet" href="/assets/plugins/calamansi/calamansi.min.css">
        <script src="/assets/plugins/calamansi/calamansi.min.js"></script>
    </head>
    <body class="header-fixed sidebar-fixed sidebar-dark header-light">

        <div class="container-fluid">
            <div class="mb-4 webinar_head_bg">
                <div class="row webinar_head_bg pt-3 pb-3">
                    <div class="col-md-3">
                        <div class="webinar_head_logo2 mb-2 text-center">
                            <img src="<?= $wares_info['images'] ?>" class="webinar_head_logo_img mt-2"/>    
                        </div>
                    </div>
                    <div class="col-md-9 p-5">
                        <div class="webinar_head_title2 mb-4" style="display: none;">
                            <div class="h2"><?= $wares_info['title'] ?></div>
                        </div>
                        <div class="webinar_head_file2 mb-3">
                            <div>
                                <?
                                if (strlen($wares_info['url_file']) > 0) {
                                    $file_type = array_reverse(explode('.', $wares_info['url_file']))[0];
                                    if ($file_type == 'mp3') {
                                        ?>

                                        <div class="player-block float-left">
                                            <div id="calamansi-player-<?= $wares_info['id'] ?>">
                                                Загрузка плеера... 
                                            </div>
                                        </div>
                                        <script>
                                            Calamansi.autoload();
                                            // document.getElementById('full-demo-player')
                                            //document.querySelector('#calamansi-player-<?= $wares_info['id'] ?>')
                                            new Calamansi(
                                                    document.querySelector('#calamansi-player-<?= $wares_info['id'] ?>'), {
                                                skin: '/assets/plugins/calamansi/skins/basic_download2',
                                                playlists: {
                                                    'Classics': [
                                                        {
                                                            source: '<?= $wares_info['url_file'] ?>',
                                                        }
                                                    ],
                                                },
                                                defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png',
                                            });
                                            //player.destroy();
                                        </script>
                                        <div style="clear: both;height: 1rem;"></div>
                                        <?
                                    } else {
                                        ?>
                                        <a href="<?= $wares_info['url_file'] ?>" target="_blank" class="btn btn-primary">Скачать файлы</a>
                                        <?
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="webinar_head_articul mb-3">
                            Артикул: <span><?= $wares_info['articul'] ?></span>
                        </div>
                        <div class="wares_info_descr ulli">
                            <?= $wares_info['descr'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col-12" style="color: #000000;font-size: 1rem;font-weight: bold;">Добавить материал</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-8 mb-2">
                            <a href="?wares_id=<?= $wares_id ?>&material_type=material_type_text" class="btn btn-outline-primary float-left">Текст</a> 
                            <a href="?wares_id=<?= $wares_id ?>&material_type=material_type_file" class="btn btn-outline-primary ml-2 float-left">Фаил</a> 
                            <a href="?wares_id=<?= $wares_id ?>&material_type=material_type_audio" class="btn btn-outline-primary ml-2 float-left">Аудио</a> 
                            <a href="?wares_id=<?= $wares_id ?>&material_type=material_type_video" class="btn btn-outline-primary ml-2 float-left">Видео</a> 
                        </div>
                        <div class="col-md-4 mb-2">
                            <a href="?wares_id=<?= $wares_id ?>&add_series=1" class="btn btn-primary float-right">Новая серия</a>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="text-center" style="color: #000000;">Общие материалы</h2>

            <div class="row mb-2">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <ul class="sortable-ul" ajax-url="/jpost.php?extension=wares" ajax-metod="material_update_positions" db-table="wares_material" db-row="position">
                                <?
                                $video_i = 0;
                                /*
                                 * Уроки без серии
                                 */
                                foreach ($materials as $key => $value) {
                                    if ($value['series_id'] == '0') {
                                        $video_i++;
                                        $union_elm_id = mt_rand(100000, 999999) . $value['id'];
                                        ?>
                                        <li sortable-elm-id="<?= $value['id'] ?>">
                                            <div class="material_tr" data-bs-toggle="tooltip" data-bs-placement="top" title="Двойной клик откроет редактирование блока">
                                                <div class="material_info">
                                                    <div class="row mt-2 mb-2">
                                                        <div class="col-1 text-center">
                                                            <i class="mdi mdi-arrow-all handle" style="font-size: 2rem;"></i>
                                                        </div>
                                                        <div class="col-11">
                                                            <?
                                                            if ($value['material_type'] == 'material_type_text') {
                                                                include 'material_type_text.php';
                                                            }
                                                            if ($value['material_type'] == 'material_type_audio') {
                                                                include 'material_type_audio.php';
                                                            }
                                                            if ($value['material_type'] == 'material_type_file') {
                                                                include 'material_type_file.php';
                                                            }
                                                            if ($value['material_type'] == 'material_type_video') {
                                                                include 'material_type_video.php';
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2 mb-2 material_info_none">
                                                    <div class="col-12">
                                                        <div class="float-left" style="color: #000000;font-size: 1.5rem;margin-top: 0.3rem;"><?= $wares->type_material_is_name($value['material_type']) ?></div> 
                                                        <select name="series" class="form-control form-control-material-select float-left" style="max-width: 200px;margin-left: 100px;position: absolute;" 
                                                                row_db="series_id" 
                                                                obj_id="<?= $value['id'] ?>" >
                                                            <option value="0">Серия...</option>
                                                            <?
                                                            foreach ($series as $series_option_value) {
                                                                $series_selected = '';
                                                                if ($value['series_id'] == $series_option_value['id']) {
                                                                    $series_selected = 'selected="selected"';
                                                                }
                                                                ?>
                                                                <option value="<?= $series_option_value['id'] ?>" <?= $series_selected ?>><?= $series_option_value['title'] ?></option>
                                                                <?
                                                            }
                                                            ?>   
                                                        </select>
                                                        <a href="?wares_id=<?= $wares_id ?>&delete_material=<?= $value['id'] ?>" class="btn btn-danger btn-sm float-right">Удалить</a>
                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <?
                                                        if ($value['material_type'] == 'material_type_text') {
                                                            include 'edit_material_type_text.php';
                                                        }
                                                        if ($value['material_type'] == 'material_type_audio') {
                                                            include 'edit_material_type_audio.php';
                                                        }
                                                        if ($value['material_type'] == 'material_type_file') {
                                                            include 'edit_material_type_file.php';
                                                        }
                                                        if ($value['material_type'] == 'material_type_video') {
                                                            include 'edit_material_type_video.php';
                                                        }
                                                        // https://www.youtube.com/embed/hPXX4vzw0kk
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="text-center" style="color: #000000;">Серии</h2>
            <?
            /*
             * Если указана серия уроков
             */
            foreach ($series as $series_key => $series_value) {
                ?>
                <div id="accordion<?= $series_value['id'] ?>" class="accordion accordion-bordered">
                    <div class="card" style="overflow: inherit;">

                        <div class="card-header " style="padding: 1rem 0;" id="heading<?= $series_value['id'] ?>">
                            <button class="btn btn-link collapsed " video_id="<?= $series_value['id'] ?>" data-toggle="collapse" data-target="#collapse<?= $series_value['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $series_value['id'] ?>"></button>
                        </div>
                        <div class="ml-4" style="margin-top: -60px;width: 70%;z-index: 1;">
                            <div class="float-left w-25">
                                <input type="text" 
                                       name="series_title<?= $value['id'] ?>" 
                                       value="<?= $series_value['title'] ?>" 
                                       id="series_title_<?= $series_value['id'] ?>" 
                                       class="form-control form-control-series series_title_<?= $value['id'] ?>" 
                                       row_db="title" 
                                       obj_id="<?= $series_value['id'] ?>" 
                                       title="Название серии уроков..." style="float: left;width: 60%;" />
                                <input type="text" 
                                       name="series_date_<?= $value['id'] ?>" 
                                       value="<?= date_jquery_format($series_value['start_date']) ?>" 
                                       id="series_date_<?= $series_value['id'] ?>" 
                                       class="form-control form-control-series datepicker<?= $series_value['id'] ?> series_date_<?= $value['id'] ?>" 
                                       row_db="start_date" 
                                       obj_id="<?= $series_value['id'] ?>"
                                       obj_format="date"
                                       title="Дата старта урока..." style="float: left;width: 35%;margin-left: 5%;" />
                                <script>
                                    $(document).ready(function () {
                                        $(".datepicker<?= $series_value['id'] ?>").datepicker({
                                            changeMonth: false,
                                            changeYear: false,
                                            numberOfMonths: 1, // колличество отображаемых месяцев
                                            showButtonPanel: false,
                                            onSelect: function (selectedDate) {
                                                console.log("selectedDate: " + selectedDate);
                                                var elm_type = $(".datepicker<?= $series_value['id'] ?>").get(0).tagName;
                                                var row_db = $(".datepicker<?= $series_value['id'] ?>").attr('row_db');
                                                var obj_id = $(".datepicker<?= $series_value['id'] ?>").attr('obj_id');
                                                var val = selectedDate;

                                                var obj_format = '';
                                                if (!!$(this).attr("obj_format")) {
                                                    obj_format = $(this).attr("obj_format");
                                                }
                                                //$(".datepicker<?= $series_value['id'] ?>").val(selectedDate);
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

                                                            } else {
                                                                alert('Ошибка сохранения!');
                                                            }
                                                        });
                                            }
                                        });
                                    });
                                </script>
                            </div> 
                            <div class="float-left ml-3" style="margin-top: 7px;">
                                <span><a href="javascript:void(0)" series_id="<?= $series_value['id'] ?>" position="<?= $series_value['position'] ?>" metod="up" class="btn btn-outline-dark btn-sm position_up"><i class="mdi mdi-chevron-up"></i></a></span>
                                <span><a href="javascript:void(0)" series_id="<?= $series_value['id'] ?>" position="<?= $series_value['position'] ?>" metod="down" class="btn btn-outline-dark btn-sm position_down"><i class="mdi mdi-chevron-down"></i></a></span>
                                <span><a href="?wares_id=<?= $wares_id ?>&delete_series=<?= $series_value['id'] ?>" class="btn btn-danger btn-sm">удалить</a></span>
                            </div>
                        </div>

                        <div style="height: 18px;"></div>

                        <div id="collapse<?= $series_value['id'] ?>" class="collapse" aria-labelledby="heading<?= $series_value['id'] ?>" data-parent="#accordion<?= $series_value['id'] ?>" style="">
                            <div class="card-body">
                                <ul class="sortable-ul" ajax-url="/jpost.php?extension=wares" ajax-metod="material_update_positions" db-table="wares_material" db-row="position">    
                                    <?
                                    foreach ($materials as $key => $value) {
                                        if ($value['series_id'] == $series_value['id']) {
                                            $video_i++;
                                            $union_elm_id = mt_rand(100000, 999999) . $value['id'];
                                            ?>
                                            <li class="handle" sortable-elm-id="<?= $value['id'] ?>">
                                                <div class="material_tr">
                                                    <div class="material_info">
                                                        <div class="row mt-2 mb-2">
                                                            <div class="col-12">
                                                                <?
                                                                if ($value['material_type'] == 'material_type_text') {
                                                                    include 'material_type_text.php';
                                                                }
                                                                if ($value['material_type'] == 'material_type_audio') {
                                                                    include 'material_type_audio.php';
                                                                }
                                                                if ($value['material_type'] == 'material_type_file') {
                                                                    include 'material_type_file.php';
                                                                }
                                                                if ($value['material_type'] == 'material_type_video') {
                                                                    include 'material_type_video.php';
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-2 material_info_none">
                                                        <div class="col-12">
                                                            <div class="float-left" style="color: #000000;font-size: 1.5rem;margin-top: 0.3rem;"><?= $wares->type_material_is_name($value['material_type']) ?></div> 
                                                            <select name="series" class="form-control form-control-material-select float-left" style="max-width: 200px;margin-left: 100px;position: absolute;" 
                                                                    row_db="series_id" 
                                                                    obj_id="<?= $value['id'] ?>" >
                                                                <option value="0">Серия...</option>
                                                                <?
                                                                foreach ($series as $series_option_value) {
                                                                    $series_selected = '';
                                                                    if ($value['series_id'] == $series_option_value['id']) {
                                                                        $series_selected = 'selected="selected"';
                                                                    }
                                                                    ?>
                                                                    <option value="<?= $series_option_value['id'] ?>" <?= $series_selected ?>><?= $series_option_value['title'] ?></option>
                                                                    <?
                                                                }
                                                                ?>   
                                                            </select>
                                                            <a href="?wares_id=<?= $wares_id ?>&delete_material=<?= $value['id'] ?>" class="btn btn-danger btn-sm float-right">Удалить</a>
                                                        </div>
                                                        <div class="col-12 mt-5">
                                                            <?
                                                            if ($value['material_type'] == 'material_type_text') {
                                                                include 'edit_material_type_text.php';
                                                            }
                                                            if ($value['material_type'] == 'material_type_audio') {
                                                                include 'edit_material_type_audio.php';
                                                            }
                                                            if ($value['material_type'] == 'material_type_file') {
                                                                include 'edit_material_type_file.php';
                                                            }
                                                            if ($value['material_type'] == 'material_type_video') {
                                                                include 'edit_material_type_video.php';
                                                            }
                                                            // https://www.youtube.com/embed/hPXX4vzw0kk
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?
                                            }
                                        }
                                        ?>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
                <?
            }
            ?>
            <div style="height: 300px;"></div> 
        </div>
    </body>

    <script src="//vjs.zencdn.net/7.10.2/video.min.js<?= $_SESSION['rand'] ?>"></script>
    <script src="/assets/plugins/video/Youtube.js<?= $_SESSION['rand'] ?>"></script>
    <script>
                                $(document).ready(function () {
                                    $(".material_info").unbind('click').dblclick(function () {
                                        $(this).closest(".material_tr").find(".material_info_none").toggle(200);
                                    });

                                    $(".form-control-material").keyup(function () {
                                        if (!!$(this).attr('row_db') && !!$(this).attr('obj_id')) {
                                            var elm_type = $(this).get(0).tagName;
                                            var row_db = $(this).attr('row_db');
                                            var obj_id = $(this).attr('obj_id');
                                            var id = $(this).attr('id');
                                            var val = $(this).val();
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
                                            if (!!$(this).attr('init_href')) {
                                                $(this).closest(".material_tr").find(".material_info").find("." + $(this).attr('init_href')).attr("href", val);
                                            }

                                            //console.log('#calamansi-player-' + id);
                                            // переинициализация аудио плеера
                                            if (!!$(this).attr('init_audio')) {
                                                new Calamansi(document.querySelector('#calamansi-player-' + id), {
                                                    skin: '/assets/plugins/calamansi/skins/basic_download2',
                                                    playlists: {
                                                        'Classics': [
                                                            {
                                                                source: val
                                                            }
                                                        ]
                                                    },
                                                    defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png'
                                                });
                                            }

                                            if (!!$(this).attr('init_youtube_src')) {
                                                $(this).closest(".material_tr").find(".material_info").find("." + $(this).attr('init_youtube_src')).attr("data-setup", '{ "techOrder": ["youtube", "html5"], "sources": [{ "type": "video/youtube", "src": "' + val + '"}] }');
                                                var options = {};
                                                var player = videojs('video_' + obj_id, options, function onPlayerReady() {
                                                    // In this context, `this` is the player that was created by Video.js.
                                                    this.play();
                                                    // How about an event listener?
                                                    this.on('ended', function () {
                                                    });
                                                });
                                                player.src({src: val, type: 'video/youtube'});

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
                                                    });
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
    </script>
</html>
