<style>
    @font-face {
        font-family: 'Montserrat';
        src: url('/assets/css/montserrat/Montserrat-Regular.ttf');
    }
    /* Жирный */
    @font-face {
        font-family: 'MontserratBold';
        src: url('/assets/css/montserrat/Montserrat-Bold.ttf');
    }
    .block_profit_question{
        background-color: #f2F6fa;
        padding: 2%;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
    }
    .block_profit_plus{
        background-color: #f7FCf7;
        padding: 2%;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
    }
    .block_profit_title{
        font-family: 'MontserratBold', "Open Sans", sans-serif;
        margin-left: 4%;
        margin-top: 6%;
        font-size: 2.3rem;
        font-weight: 700;
        color: #000000;
    }
    .questions i{
        font-size: 1.5rem;
        color: #447CAB;
    }

    .block_profit_question .fa-question,
    .block_profit_plus .fa-plus{
        float: right;
        margin-top: -4%;
        margin-right: 5%;
        color: #FFFFFF;
        font-size: 5rem;

    }
    .block_profit_line{
        margin-top: 0px;
        font-weight: 500;
        align-items: center;
        color: #000000;
    }

    .flexbox-wrapper {
        display: -webkit-flex;
        display: -ms-flex;
        display: flex;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .pluss .fa-plus{
        float: none;
        font-size: 1.7rem;
        color: #45B045;
    }
    .pluss, .questions{
        padding: 6% 5%;
        font-size: 1rem;
    }
    .flex-box{
        display: flex;
    }
    .flex-item {
        height: 100%;
    }
</style>

<div class="row mb-5 flex-box">
    <div class="col-lg-6 mb-4">
        <div class="block_profit_question flex-item">
            <i class="fas fa-question" style="font-size: 7rem;"></i>
            <div class="block_profit_title">Кому подходит:</div>
            <div class="questions"></div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="block_profit_plus flex-item">
            <i class="fas fa-plus" style="font-size: 8rem;"></i>
            <div class="block_profit_title">Ты получишь:</div>
            <div class="pluss"></div>
        </div>
    </div>
</div>     

<script>
    /*
     * Получить список "Кому подходит"
     */
    function init_block_profit_questions_array() {
        console.log('init_block_profit_questions_array');
        var block_type = 'block_profit';
        var row = 'question';
        sendPostLigth('/jpost.php?extension=products',
                {"block_data_array": 1, "products_id": products_id, "block_type": block_type, "row": row},
                function (e) {
                    $(".questions").html("");
                    if (!!e['data'] && e['data'].length > 0) {
                        for (var i = 0; i < e['data'].length; i++) {
                            $(".questions").append('<div class="mb-4" style="height: 20px;display: flex;">\n\
                                    <div class="block_profit_line flexbox-wrapper">\n\
                                        <i class="fas fa-check mr-3" style="float: left;"></i> ' + e['data'][i]['val'] + '\n\
                                    </div></div>');
                        }
                    }
                });
    }

    /*
     * Получить список "Вы получите"
     */
    function init_block_profit_plus_array() {
        console.log('init_block_profit_plus_array');
        var block_type = 'block_profit';
        var row = 'plus';
        sendPostLigth('/jpost.php?extension=products',
                {"block_data_array": 1, "products_id": products_id, "block_type": block_type, "row": row},
                function (e) {
                    $(".pluss").html("");
                    if (!!e['data'] && e['data'].length > 0) {
                        for (var i = 0; i < e['data'].length; i++) {
                            $(".pluss").append('<div class="mb-4" style="height: 20px;display: flex;">\n\
                                    <div class="block_profit_line flexbox-wrapper">\n\
                                        <i class="fas fa-plus mr-3" style="float: left;"></i> ' + e['data'][i]['val'] + '\n\
                                    </div></div>');
//                                                    .append('<div class="mb-4" style="height: 20px;display: flex;">\n\
//            <i class="fas fa-plus mr-3" style="float: left;"></i> <div class="block_profit_line flex-center">' + e['data'][i]['val'] + '</div></div>');
                        }
                    }
                });
    }
    init_block_profit_questions_array();
    init_block_profit_plus_array();
</script>