<style>
    .block_feedback_title{
        font-size: 2rem;
        font-weight: 600;
        color: #000000;
    }
</style>
<div class="mb-3">
    <div class="mb-3 clearfix">
        <a href="javascript:void(0)" class="btn btn-secondary float-left w-25 btn_block_feedback">НАСТРОЙКА "Блок отзывы счастливых людей"</a>
        <input type="checkbox" name="block_feedback" value="1" class="form-control float-left w-25 block_checked block_feedback_checked" block_type="block_feedback" title="Отобразить блок" /> 
    </div>
    <div class="clearfix block_feedback" style="display: none;">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <h3 class="block_feedback_title mb-3">Отзывы счастливых людей</h3>
                <div class="mb-3">
                    <a href="javascript:void(0)" class="btn btn-primary btn_add_feedback">Добавить</a>
                </div>
                <div class="feedback">

                </div>
            </div>
        </div>
        <div class="mb-3 clearfix">
            <hr/>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".btn_block_feedback").unbind('click').click(function () {
            $(".block_feedback").toggle(200);
        });


        $(".btn_add_feedback").unbind('click').click(function () {
            var block_id = 0;
            var block_type = 'block_feedback';
            var row = 'feedback';
            var val = '';
            sendPostLigth('/jpost.php?extension=products',
                    {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": row, "val": val},
                    function (e) {
                        init_block_feedback_array();
                    });
        });



    });

    /*
     * Получить список "Вы получите"
     */
    function init_block_feedback_array() {
        var block_type = 'block_feedback';
        var row = 'feedback';
        sendPostLigth('/jpost.php?extension=products',
                {"block_data_array": 1, "products_id": products_id, "block_type": block_type, "row": row},
                function (e) {
                    $(".feedback").html("");
                    if (e['data'].length > 0) {
                        for (var i = 0; i < e['data'].length; i++) {
                            $(".feedback").append('<div class="mb-2 input-group">\n\
                                <input type="text" name="feedback_' + e['data'][i]['id'] + '" value="' + e['data'][i]['val'] + '" elm_id="' + e['data'][i]['id'] + '" block_type="block_feedback" row="feedback" class="form-control block_feedback_image_init block_data_edit" />\n\
                                <span class="btn btn-danger block_elm_delete" elm_id="' + e['data'][i]['id'] + '"><i class="mdi mdi-delete"></i></span>\n\
                                </div>');
                        }
                    }
                    block_data_edit_init(function () {
                        init_block_feedback_array();
                    });
                    block_data_delete_init(function () {
                        init_block_feedback_array();
                    });

                    initBlockFeedbackFilemanager();

                });
    }

    function initBlockFeedbackFilemanager() {
        $(".block_feedback_image_init").unbind('click').click(function () {
            obj = this;
            $('#form_elfinder_modal').show(200);
            $('#elfinder').elfinder(
                    // 1st Arg - options
                            {
                                cssAutoLoad: false, // Disable CSS auto loading
                                baseUrl: './', // Base URL to css/*, js/*
                                url: '/system/elfinder/php/connector.minimal.php', // connector URL (REQUIRED)
                                // , lang: 'ru'                    // language (OPTIONAL)
                                getFileCallback: function (file) { // editor callback
                                    //console.log(file.url); // pass selected file path to TinyMCE
                                    $(obj).val(file.url);

                                    console.log('block_data_edit_init');
                                    // сохраниение поля
                                    var block_id = $(obj).attr("elm_id");
                                    var block_type = $(obj).attr("block_type");
                                    var row = $(obj).attr("row");
                                    var val = $(obj).val();
                                    sendPostLigth('/jpost.php?extension=products',
                                            {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": row, "val": val},
                                            function (e) {
                                                init_block_feedback_array();
                                            });
                                    $('#elfinder').elfinder('destroy');
                                    $('#form_elfinder_modal').hide(200);

                                }
                            },
                            // 2nd Arg - before boot up function
                                    function (fm, extraObj) {
                                        // `init` event callback function
                                        fm.bind('init', function () {
                                            // Optional for Japanese decoder "encoding-japanese.js"
                                            if (fm.lang === 'ja') {
                                                fm.loadScript(
                                                        ['//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js'],
                                                        function () {
                                                            if (window.Encoding && Encoding.convert) {
                                                                fm.registRawStringDecoder(function (s) {
                                                                    return Encoding.convert(s, {to: 'UNICODE', type: 'string'});
                                                                });
                                                            }
                                                        },
                                                        {loadType: 'tag'}
                                                );
                                            }
                                        });
                                        // Optional for set document.title dynamically.
                                        var title = document.title;
                                        fm.bind('open', function () {
                                            var path = '',
                                                    cwd = fm.cwd();
                                            if (cwd) {
                                                path = fm.path(cwd.hash) || null;
                                            }
                                            document.title = path ? path + ':' + title : title;
                                        }).bind('destroy', function () {
                                            document.title = title;
                                        });
                                    }
                            );
                        });
            }
</script>