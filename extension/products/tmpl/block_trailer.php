<style>
.block_trailer_title{
        font-size: 2rem;
        font-weight: 600;
        color: #000000;
    }
</style>
<div class="mb-3">
    <div class="mb-3 clearfix">
        <a href="javascript:void(0)" class="btn btn-secondary float-left w-25 btn_block_trailer">НАСТРОЙКА "Блок трейлер продукта"</a>
        <input type="checkbox" name="block_trailer" value="1" class="form-control float-left w-25 block_checked block_trailer_checked" block_type="block_trailer" title="Отобразить блок" /> 
    </div>
    <div class="clearfix block_trailer" style="display: none;">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <h3 class="block_trailer_title mb-3">Трейлер продукта:</h3>
                <div class="mb-3">
                    <a href="javascript:void(0)" class="btn btn-primary btn_add_trailer">Добавить</a>
                </div>
                <div class="trailer">
                    
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
        $(".btn_block_trailer").unbind('click').click(function () {
            $(".block_trailer").toggle(200);
        });


        $(".btn_add_trailer").unbind('click').click(function () {
            var block_id = 0;
            var block_type = 'block_trailer';
            var row = 'trailer';
            var val = '';
            sendPostLigth('/jpost.php?extension=products',
                    {"block_data_edit": 1, "block_id": block_id, "products_id": products_id, "block_type": block_type, "row": row, "val": val},
                    function (e) {
                        init_block_trailer_array();
                    });
        });
    });

    /*
     * Получить список "Вы получите"
     */
    function init_block_trailer_array() {
        var block_type = 'block_trailer';
        var row = 'trailer';
        sendPostLigth('/jpost.php?extension=products',
                {"block_data_array": 1, "products_id": products_id, "block_type": block_type, "row": row},
                function (e) {
                    $(".trailer").html("");
                    if (e['data'].length > 0) {
                        for (var i = 0; i < e['data'].length; i++) {
                            $(".trailer").append('<div class="mb-2 input-group">\n\
                                <input type="text" name="trailer_' + e['data'][i]['id'] + '" value="' + e['data'][i]['val'] + '" elm_id="' + e['data'][i]['id'] + '" block_type="block_trailer" row="trailer" class="form-control block_data_edit" />\n\
                                <span class="btn btn-danger block_elm_delete" elm_id="' + e['data'][i]['id'] + '"><i class="mdi mdi-delete"></i></span>\n\
                                </div>');
                        }
                    }
                    block_data_edit_init(function () {
                        init_block_trailer_array();
                    });
                    block_data_delete_init(function () {
                        init_block_trailer_array();
                    });
                });
    }
</script>