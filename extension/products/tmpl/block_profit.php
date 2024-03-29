<style>
    .block_profit_question{
        background-color: #f2F6fa;
        padding: 2%;
    }
    .block_profit_plus{
        background-color: #f7FCf7;
        padding: 2%;
    }
    .block_profit_title{
        font-size: 2rem;
        font-weight: 600;
        color: #000000;
    }
</style>
<div class="mb-3">
    <div class="mb-3 clearfix">
        <a href="javascript:void(0)" class="btn btn-secondary float-left w-25 btn_block_profit">НАСТРОЙКА "Блок выгода"</a>
        <input type="checkbox" name="block_profit" value="1" class="form-check-input float-left ml-lg-3 block_checked block_profit_checked" block_type="block_profit" title="Отобразить блок" /> 
    </div>
    <div class="clearfix block_profit" style="display: none;">
        <div class="row">
            <div class="col-lg-6 mb-3 block_profit_question">
                <div class="mb-3 block_profit_title">Кому подходит</div>
                <div class="mb-3">
                    <a href="javascript:void(0)" class="btn btn-primary btn_add_question">Добавить</a>
                </div>
                <div class="questions">

                </div>
            </div>
            <div class="col-lg-6 mb-3 block_profit_plus">
                <div class="mb-3 block_profit_title">Вы получите</div>
                <div class="mb-3">
                    <a href="javascript:void(0)" class="btn btn-primary btn_add_plus">Добавить</a>
                </div>
                <div class="pluss">

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
        $(".btn_block_profit").unbind('click').click(function () {
            $(".block_profit").toggle(200);
        });



        // Добавить "Кому подходит"
        $(".btn_add_question").unbind('click').click(function () {
            var block_id = 0;
            var block_type = 'block_profit';
            var row = 'question';
            var val = '';
            sendPostLigth('/jpost.php?extension=products',
                    {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": row, "val": val},
                    function (e) {
                        init_block_profit_questions_array();
                    });
        });

        $(".btn_add_plus").unbind('click').click(function () {
            var block_id = 0;
            var block_type = 'block_profit';
            var row = 'plus';
            var val = '';
            sendPostLigth('/jpost.php?extension=products',
                    {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": row, "val": val},
                    function (e) {
                        init_block_profit_plus_array();
                    });
        });
    });

    /*
     * Получить список "Кому подходит"
     */
    function init_block_profit_questions_array() {
        var block_type = 'block_profit';
        var row = 'question';
        if ($(".questions").length > 0) {
            $(".questions").html(ajax_spinner);
            sendPostLigth('/jpost.php?extension=products',
                    {"block_data_array": 1, "products_id": products_id, "block_type": block_type, "row": row},
                    function (e) {
                        $(".questions").html("");
                        if (e['data'].length > 0) {
                            for (var i = 0; i < e['data'].length; i++) {
                                $(".questions").append('<div class="mb-2 input-group">\n\
                                <input type="text" name="question_' + e['data'][i]['id'] + '" value="' + e['data'][i]['val'] + '" elm_id="' + e['data'][i]['id'] + '" block_type="block_profit" row="question" class="form-control block_data_edit" />\n\
                                <span class="btn btn-danger block_elm_delete" elm_id="' + e['data'][i]['id'] + '"><i class="mdi mdi-delete"></i></span>\n\
                                </div>');
                            }
                        }
                        block_data_edit_init(function () {
                            init_block_profit_questions_array();
                            init_block_profit_plus_array();
                        });
                        block_data_delete_init(function () {
                            init_block_profit_questions_array();
                            init_block_profit_plus_array();
                        });
                    });
        }
    }

    /*
     * Получить список "Вы получите"
     */
    function init_block_profit_plus_array() {
        var block_type = 'block_profit';
        var row = 'plus';
        if ($(".pluss").length > 0) {
            $(".pluss").html(ajax_spinner);
            sendPostLigth('/jpost.php?extension=products',
                    {"block_data_array": 1, "products_id": products_id, "block_type": block_type, "row": row},
                    function (e) {
                        $(".pluss").html("");
                        if (e['data'].length > 0) {
                            for (var i = 0; i < e['data'].length; i++) {
                                $(".pluss").append('<div class="mb-2 input-group">\n\
                                <input type="text" name="plus_' + e['data'][i]['id'] + '" value="' + e['data'][i]['val'] + '" elm_id="' + e['data'][i]['id'] + '" block_type="block_profit" row="plus" class="form-control block_data_edit" />\n\
                                <span class="btn btn-danger block_elm_delete" elm_id="' + e['data'][i]['id'] + '"><i class="mdi mdi-delete"></i></span>\n\
                                </div>');
                            }
                        }
                        block_data_edit_init(function () {
                            init_block_profit_questions_array();
                            init_block_profit_plus_array();
                        });
                        block_data_delete_init(function () {
                            init_block_profit_questions_array();
                            init_block_profit_plus_array();
                        });
                    });
        }
    }

</script>