<style>
    .css_condition_col{
        font-family: 'Montserrat';
        font-size: 6rem;
        font-weight: 900;
        color: #000000;
    }
    .css_condition_text{
        font-family: 'Montserrat';
        font-size: 1rem;
    }
    .css_condition_icon .fa{
        font-size: 3.5rem;
        color: #c1af75;
    }
</style>
<div class="mb-3">
    <div class="mb-3 clearfix">
        <a href="javascript:void(0)" class="btn btn-secondary float-left w-25 btn_block_conditions">НАСТРОЙКА "Блок условия"</a>
        <input type="checkbox" name="block_conditions" value="1" class="form-check-input float-left ml-lg-3 block_checked block_conditions_checked" block_type="block_conditions" title="Отобразить блок" /> 
    </div>

    <div class="clearfix block_conditions" style="display: none;">
        <div class="btn btn-primary btn_block_conditions_reload d-none"></div>
        <div class="row">
            <div class="col-lg-12 mb-3">
                <h3 class="block_conditions_title mb-3">Условия:</h3>
                <div class="mb-3">
                    <a href="javascript:void(0)" class="btn btn-primary btn_add_conditions">Добавить</a>
                </div>
                <div class="row condition_array">
                </div>
            </div>
        </div>
        <div class="mb-3 clearfix">
            <hr/>
        </div>
    </div>
</div> 

<?
require 'select_icons.php';
?>




<script>
    var condition = [];
    var icons_elm_id = 0;
    $(document).ready(function () {


        $(".btn_block_conditions").unbind('click').click(function () {
            $(".block_conditions").toggle(200);
            init_block_condition_data_array();
        });

        $(".btn_block_conditions_reload").unbind('click').click(function () {
            init_block_condition_data_array();
        });


        $(".btn_add_conditions").unbind('click').click(function () {
            add_condition();
        });

    });

    function add_condition() {
        var block_id = 0;
        var block_type = 'block_conditions';
        var val = '';
        sendPostLigth('/jpost.php?extension=products',
                {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": 'col', "val": val},
                function (e) {
                    if (e['success'] == 1 && Number(e['data']) > 0) {

                        sendPostLigth('/jpost.php?extension=products',
                                {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": 'text', "val": val, "parent": e['data']},
                                function (e) {

                                }, 1);
                        sendPostLigth('/jpost.php?extension=products',
                                {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": 'icon', "val": val, "parent": e['data']},
                                function (e) {
                                    init_block_condition_data_array();
                                }, 1);
                    }
                }, 1);
    }

    function init_block_conditions_rows() {
        $(".condition_array").html('');
        var block_id = 0;
        var block_type = 'block_conditions';
        var row = 'col';
        var val = '';
        if ($(".condition_array").length > 0) {
            console.log(condition);

            for (var i = 0; i < condition.length; i++) {
                if (condition[i]['row'] == 'col') {
                    $(".condition_array").append('<div class="col mb-2 text-center">\
                                <div class="btn btn-danger float-right block_condition_elm_delete" elm_id="' + condition[i]['id'] + '" style="margin-top: -3rem;"><i class="mdi mdi-delete"></i></div>\
                                <input type="text" name="condition_' + condition[i]['id'] + '" value="' + condition[i]['val'] + '" elm_id="' + condition[i]['id'] + '" block_type="block_conditions" row="col" class="form-control block_condition_data_edit" placeholder="Кличество...">\
                                <div class="col_text_' + condition[i]['id'] + '"></div>\
                                <div class="btn-group w-100 col_icon_' + condition[i]['id'] + '"></div>\
                                <div class=" css_condition_col col_col_html_' + condition[i]['id'] + '"></div>\
                                <div class="mb-4 css_condition_text col_text_html_' + condition[i]['id'] + '"></div>\
                                <div class="mb-3 css_condition_icon col_icon_html_' + condition[i]['id'] + '"></div>\
                                <div></div>\
                                </div>');
                }
            }
            for (var i = 0; i < condition.length; i++) {
                if (condition[i]['parent'] == 0) {
                    for (var a = 0; a < condition.length; a++) {
                        //console.log(condition[i]['id'] + ' == ' + condition[a]['parent'] + ' - ' + condition[a]['row']);
                        if (condition[i]['id'] == condition[a]['parent']) {
                            //console.log('id: ' + condition[a]['id'] + ' ' + condition[a]['row']);
                            if (condition[a]['row'] == 'text') {
                                $(".col_text_" + condition[i]['id']).html('<input type="text" name="condition_text_' + condition[a]['id'] + '" value="' + condition[a]['val'] + '" elm_id="' + condition[a]['id'] + '" block_type="block_conditions" row="text" parent="' + condition[a]['parent'] + '" class="form-control block_condition_data_edit" placeholder="Текст...">');
                                $(".col_text_html_" + condition[i]['id']).html(condition[a]['val']);
                            }
                            if (condition[a]['row'] == 'icon') {
                                $(".col_icon_" + condition[i]['id']).html('<input type="text" name="condition_icon_' + condition[a]['id'] + '" value="' + condition[a]['val'] + '" elm_id="' + condition[a]['id'] + '" block_type="block_conditions" row="icon" parent="' + condition[a]['parent'] + '" class="form-control w-100 block_condition_data_edit" placeholder="Иконка..."><a href="javascript:void(0)" class="btn btn-sm btn-primary btn_open_icons"><i class="fa fa-icons" elm_id="' + condition[i]['id'] + '" style="font-size:2rem;"></i></a>');
                                $(".col_icon_html_" + condition[i]['id']).html('<i class="' + condition[a]['val'] + '"></i>');
                            }

                        }

                    }
                }
                if (condition[i]['row'] == 'col') {
                    $(".col_col_html_" + condition[i]['id']).html(condition[i]['val']);
                }
            }

            block_condition_data_edit_init(function () {
                init_block_condition_data_array();
            });
            block_condition_elm_delete(function () {
                init_block_condition_data_array();
            });
            super_init();
            init_open_icons(".btn_open_icons");
        }
    }



    function init_block_condition_data_array() {
        $(".condition_array").html(ajax_spinner);
        sendPostLigth('/jpost.php?extension=products',
                {"block_condition_data_array": 1, "products_id": products_id},
                function (e) {
                    $(".condition_array").html("");
                    if (e['data'].length > 0) {
                        condition = e['data'];
                    }
                    init_block_conditions_rows();

                });
    }

    // Обновление
    function block_condition_data_edit_init(func) {
        if ($(".block_condition_data_edit").length > 0) {
            $(".block_condition_data_edit").unbind('change').change(function () {
                var block_id = $(this).attr("elm_id");
                var block_type = $(this).attr("block_type");
                var row = $(this).attr("row");
                var parent = $(this).attr("parent");
                var val = $(this).val();
                sendPostLigth('/jpost.php?extension=products',
                        {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": row, "val": val, "parent": parent},
                        function (e) {
                            func();
                        });
            });
        }
    }

    // Удаление
    function block_condition_elm_delete(func) {
        if ($(".block_condition_elm_delete").length > 0) {
            $(".block_condition_elm_delete").unbind('click').click(function () {
                var block_id = $(this).attr("elm_id");
                sendPostLigth('/jpost.php?extension=products',
                        {"block_condition_data_delete": 1, "block_id": block_id},
                        function (e) {
                            func();
                        });
            });
        }
    }

</script>