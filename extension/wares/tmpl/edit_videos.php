<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css?v=<?= rand() ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css?v=<?= rand() ?>" 
              integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" 
              crossorigin="anonymous">
        <!-- FAVICON -->
        <link href="/assets/img/favicon.png" rel="shortcut icon" />
        <script src="/assets/plugins/jquery/jquery.js?v=?v=<?= rand() ?>"></script>
        <link href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.min.css?v=?v=<?= rand() ?>" rel="stylesheet" />
        <script src="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.js?v=?v=<?= rand() ?>"></script>
        <link href="/assets/css/sleek.css?v=?v=<?= rand() ?>" rel="stylesheet">
        <script src="/assets/js/ajax.js?v=<?= rand() ?>"></script>   

        <link href="/assets/css/sleek.css?v=?v=<?= rand() ?>" rel="stylesheet">
        <script src="/assets/js/sleek.bundle.js?v=?v=<?= rand() ?>"></script>
        <script src="/assets/js/sleek.js?v=?v=<?= rand() ?>"></script>
        <style>
            .webinar_head_bg{
                background: linear-gradient(140deg, #63A7D6, #0BC496);
                background-position: center;
                background-size: cover;
                width: 100%;
                height: 35vh;
            }
            .webinar_head_logo{
                text-align: center;
                background-color: #e3e3e3;
                position: absolute;
                margin-left: 5vw;
                margin-top: 6vh;
                z-index: 9;
            }
            .webinar_head_title{
                text-align: left;
                position: absolute;
                margin-left: 18vw;
                color: #FFFFFF;
                font-size: 2rem;
                margin-top: 6vh;
                z-index: 9;
            }
            .webinar_head_file{
                text-align: left;
                position: absolute;
                margin-left: 18vw;
                color: #FFFFFF;
                font-size: 2rem;
                margin-top: 24vh;
                z-index: 9;
            }
            .webinar_head_logo_img{
                padding: 0.25rem;
                background-color: #e3e3e3;
                border: 1px solid #dee2e6;
                max-height: 24vh;
                max-width: 15vw;
            }

            .video_u_block_left{
                width: 300px;
                height: 100px;
                position: absolute;
                z-index: 9;
            }
            .video_u_block_right{
                float: right;
                width: 300px;
                height: 100px;
                margin-bottom: -100px;
                position: relative;
                z-index: 9;
            }
            .accordion .card .card-header button:after{
                font-size: 3rem;
            }
        </style>
    </head>
    <body class="header-fixed sidebar-fixed sidebar-dark header-light">

        <div class="mb-4 webinar_head_bg">
            <?
            if (strlen($wares_info['images']) > 0):
                ?>
                <div class="webinar_head_logo">
                    <img src="<?= $wares_info['images'] ?>" class="webinar_head_logo_img"/>    
                </div>
                <div class="webinar_head_title">
                    <?= $wares_info['title'] ?>
                </div>
                <div class="webinar_head_file">
                    <?
                    if (strlen($wares_info['url_file']) > 0) {
                        ?>
                        <a href="<?= $wares_info['url_file'] ?>" class="btn btn-primary">Скачать файлы</a>
                        <?
                    }
                    ?>
                </div>
                <?
            endif;
            ?>
        </div>
        <br/>


        <div class="row mt-5 mb-2">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="mb-5 clearfix">
                            <a href="?wares_id=<?= $wares_id ?>&add_video=1" class="btn btn-primary float-left">Добавить видео материал</a> 
                            <a href="?wares_id=<?= $wares_id ?>&add_series=1" class="btn btn-primary float-right">Новая серия</a>
                        </div>
                        <div class="mb-2 clearfix">
                            <?= $wares_info['descr'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?
        $video_i = 0;

        /*
         * Уроки без серии
         */
        foreach ($videos as $key => $value) {
            if ($value['series_id'] == '0' || $value['series_id'] == '') {
                $video_i++;
                ?>
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="card card-default">
                            <div class="card-body">
                                <div>
                                    <h3>Видео материал №<?= $video_i ?> <a href="?wares_id=<?= $wares_id ?>&delete_video=<?= $value['id'] ?>" class="btn btn-danger">Удалить</a></h3>
                                    <hr/>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="float-left ml-2 w-50">
                                                <label>Серия</label>
                                                <select name="series" class="form-control form-control-video w-100 h-5" 
                                                        row_db="series_id" 
                                                        obj_id="<?= $value['id'] ?>" >
                                                    <option value="0">...</option>
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

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2" style="display: none;">
                                        <div class="col-12">
                                            <div class="float-left ml-2 w-50">
                                                <label>Фаил .mp4</label>
                                                <?
                                                importELFinderSelectFile('video_mp4_' . $value['id'], $value['id'], $value['video_mp4'], 'video_mp4', 'wares', 'editMaterial');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2" style="display: none;">
                                        <div class="col-12">
                                            <div class="float-left ml-2 w-50">
                                                <label>Фаил .ogv</label>
                                                <?
                                                importELFinderSelectFile('video_ogv_' . $value['id'], $value['id'], $value['video_ogv'], 'video_ogv', 'wares', 'editMaterial');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2" style="display: none;">
                                        <div class="col-12">
                                            <div class="float-left ml-2 w-50">
                                                <label>Фаил .webm</label>
                                                <?
                                                importELFinderSelectFile('video_webm_' . $value['id'], $value['id'], $value['video_webm'], 'video_webm', 'wares', 'editMaterial');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <div>Ссылка на видео из YOUTUBE (Приоритет)</div>
                                            <div class="mb-2">
                                                <input type="text" 
                                                       name="video_youtube_<?= $value['video_youtube'] ?>" 
                                                       value="<?= $value['video_youtube'] ?>" 
                                                       id="video_youtube_<?= $value['id'] ?>" 
                                                       class="form-control form-control-video w-100 h-5 video_youtube_<?= $value['id'] ?>" 
                                                       row_db="video_youtube" obj_id="<?= $value['id'] ?>" 
                                                       placeholder="Текст заголовка видео..." />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>Заголовок перед видео</div>
                                                <div class="mb-2">
                                                    <input type="text" 
                                                           name="video_title<?= $value['id'] ?>" 
                                                           value="<?= $value['video_title'] ?>" 
                                                           id="video_title_<?= $value['id'] ?>" 
                                                           class="form-control form-control-video w-100 h-5 video_title_<?= $value['id'] ?>" 
                                                           row_db="video_title" 
                                                           obj_id="<?= $value['id'] ?>" 
                                                           placeholder="Текст заголовка видео..." />
                                                </div>
                                                <div>Описание перед видео</div>
                                                <div>
                                                    <textarea 
                                                        name="video_Descr_<?= $value['id'] ?>" 
                                                        id="video_Descr_<?= $value['id'] ?>" 
                                                        class="form-control form-control-video w-100 h-5 video_Descr_<?= $value['id'] ?>" 
                                                        row_db="video_descr" obj_id="<?= $value['id'] ?>" 
                                                        placeholder="Текст описания для видео..."><?= $value['video_descr'] ?></textarea>
                                                </div>
                                                <div>Продолжительность видео</div>
                                                <div>
                                                    <input 
                                                        name="video_time_<?= $value['id'] ?>" 
                                                        value="<?= $value['video_time'] ?>"
                                                        id="video_time_<?= $value['id'] ?>" 
                                                        class="form-control form-control-video w-100 h-5 video_time_<?= $value['id'] ?>" 
                                                        row_db="video_time" obj_id="<?= $value['id'] ?>" 
                                                        placeholder="Продолжительность видео..."/>
                                                </div>

                                            </div>
                                        </div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?
            }
        }


        /*
         * Если указана серия уроков
         */
        foreach ($series as $series_key => $series_value) {
            ?>
            <div id="accordion<?= $series_value['id'] ?>" class="accordion accordion-bordered">
                <div class="card">
                    <div class="card-header" id="heading<?= $series_value['id'] ?>">
                        <button class="btn btn-link collapsed" video_id="<?= $series_value['id'] ?>" data-toggle="collapse" data-target="#collapse<?= $series_value['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $series_value['id'] ?>">
                            <h3>
                                <input type="text" 
                                       name="series_title<?= $value['id'] ?>" 
                                       value="<?= $series_value['title'] ?>" 
                                       id="series_title_<?= $value['id'] ?>" 
                                       class="form-control form-control-series w-50 series_title_<?= $value['id'] ?>" 
                                       row_db="title" 
                                       obj_id="<?= $series_value['id'] ?>" 
                                       placeholder="Название серии уроков..." />
                            </h3> 

                        </button>
                    </div>
                    <div style="margin-top: -60px;margin-left: 51%;z-index: 3;width: 142px;">
                        <span><a href="javascript:void(0)" series_id="<?= $series_value['id'] ?>" position="<?= $series_value['position'] ?>" metod="up" class="btn btn-outline-dark btn-sm position_up"><i class="mdi mdi-chevron-up"></i></a></span>
                        <span><a href="javascript:void(0)" series_id="<?= $series_value['id'] ?>" position="<?= $series_value['position'] ?>" metod="down" class="btn btn-outline-dark btn-sm position_down"><i class="mdi mdi-chevron-down"></i></a></span>
                        <span><a href="?wares_id=<?= $wares_id ?>&delete_series=<?= $series_value['id'] ?>" class="btn btn-danger btn-sm">удалить</a></span>
                    </div>
                    <div style="height: 18px;"></div>

                    <div id="collapse<?= $series_value['id'] ?>" class="collapse" aria-labelledby="heading<?= $series_value['id'] ?>" data-parent="#accordion<?= $series_value['id'] ?>" style="">
                        <div class="card-body">
                            <?
                            foreach ($videos as $key => $value) {
                                if ($value['series_id'] == $series_value['id']) {
                                    $video_i++;
                                    ?>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="card card-default">
                                                <div class="card-body">
                                                    <div>
                                                        <h3>Видео материал №<?= $video_i ?> <a href="?wares_id=<?= $wares_id ?>&delete_video=<?= $value['id'] ?>" class="btn btn-danger">Удалить</a></h3>
                                                        <hr/>
                                                        <div class="row mb-2">
                                                            <div class="col-12">
                                                                <div class="float-left ml-2 w-50">
                                                                    <label>Серия</label>
                                                                    <select name="series" class="form-control form-control-video w-100 h-5" 
                                                                            row_db="series_id" 
                                                                            obj_id="<?= $value['id'] ?>" >
                                                                        <option value="0">...</option>
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

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2" style="display: none;">
                                                            <div class="col-12">
                                                                <div class="float-left ml-2 w-50">
                                                                    <label>Фаил .mp4</label>
                                                                    <?
                                                                    importELFinderSelectFile('video_mp4_' . $value['id'], $value['id'], $value['video_mp4'], 'video_mp4', 'wares', 'editMaterial');
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2" style="display: none;">
                                                            <div class="col-12">
                                                                <div class="float-left ml-2 w-50">
                                                                    <label>Фаил .ogv</label>
                                                                    <?
                                                                    importELFinderSelectFile('video_ogv_' . $value['id'], $value['id'], $value['video_ogv'], 'video_ogv', 'wares', 'editMaterial');
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2" style="display: none;">
                                                            <div class="col-12">
                                                                <div class="float-left ml-2 w-50">
                                                                    <label>Фаил .webm</label>
                                                                    <?
                                                                    importELFinderSelectFile('video_webm_' . $value['id'], $value['id'], $value['video_webm'], 'video_webm', 'wares', 'editMaterial');
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2 mb-2">
                                                            <div class="col-12">
                                                                <div>Ссылка на видео из YOUTUBE (Приоритет)</div>
                                                                <div class="mb-2">
                                                                    <input type="text" 
                                                                           name="video_youtube_<?= $value['video_youtube'] ?>" 
                                                                           value="<?= $value['video_youtube'] ?>" 
                                                                           id="video_youtube_<?= $value['id'] ?>" 
                                                                           class="form-control form-control-video w-100 h-5 video_youtube_<?= $value['id'] ?>" 
                                                                           row_db="video_youtube" obj_id="<?= $value['id'] ?>" 
                                                                           placeholder="Текст заголовка видео..." />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div>Заголовок перед видео</div>
                                                                    <div class="mb-2">
                                                                        <input type="text" 
                                                                               name="video_title<?= $value['id'] ?>" 
                                                                               value="<?= $value['video_title'] ?>" 
                                                                               id="video_title_<?= $value['id'] ?>" 
                                                                               class="form-control form-control-video w-100 h-5 video_title_<?= $value['id'] ?>" 
                                                                               row_db="video_title" 
                                                                               obj_id="<?= $value['id'] ?>" 
                                                                               placeholder="Текст заголовка видео..." />
                                                                    </div>
                                                                    <div>Описание перед видео</div>
                                                                    <div>
                                                                        <textarea 
                                                                            name="video_Descr_<?= $value['id'] ?>" 
                                                                            id="video_Descr_<?= $value['id'] ?>" 
                                                                            class="form-control form-control-video w-100 h-5 video_Descr_<?= $value['id'] ?>" 
                                                                            row_db="video_descr" obj_id="<?= $value['id'] ?>" 
                                                                            placeholder="Текст описания для видео..."><?= $value['video_descr'] ?></textarea>
                                                                    </div>
                                                                    <div>Продолжительность видео</div>
                                                                    <div>
                                                                        <input 
                                                                            name="video_time_<?= $value['id'] ?>" 
                                                                            value="<?= $value['video_time'] ?>"
                                                                            id="video_time_<?= $value['id'] ?>" 
                                                                            class="form-control form-control-video w-100 h-5 video_time_<?= $value['id'] ?>" 
                                                                            row_db="video_time" obj_id="<?= $value['id'] ?>" 
                                                                            placeholder="Продолжительность видео..."/>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?
                                }
                            }
                            ?>
                        </div>
                    </div>

                </div>

            </div>
            <?
        }
        ?>
    </body>
</html>
<script>
    $(document).ready(function () {
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
                sendPostLigth('/jpost.php?extension=wares',
                        {
                            "editSeries": 1,
                            "row_db": row_db,
                            "obj_id": obj_id,
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
    });

</script>