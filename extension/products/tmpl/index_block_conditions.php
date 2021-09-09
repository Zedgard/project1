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
<div class="mb-5">
    <div class="row mb-5 condition_array"></div>
</div> 
<script>
    var condition = [];
    $(document).ready(function () {
        init_block_condition_data_array();

    });

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
                        if (condition[i]['id'] == condition[a]['parent']) {
                            if (condition[a]['row'] == 'text') {
                                $(".col_text_html_" + condition[i]['id']).html(condition[a]['val']);
                            }
                            if (condition[a]['row'] == 'icon') {
                                $(".col_icon_html_" + condition[i]['id']).html('<i class="' + condition[a]['val'] + '"></i>');
                            }
                        }
                    }
                }
                if (condition[i]['row'] == 'col') {
                    $(".col_col_html_" + condition[i]['id']).html(condition[i]['val']);
                }
            }

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
</script>