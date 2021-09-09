<style>
    .list_icons{
        width: 80px;
        float: left;
        margin-left: 1%;
        margin-bottom: 2%;
    }
    .list_icons .fa{
        font-size: 2rem;
    }
</style>
<!-- Icons Modal -->
<div class="modal fade" id="form_modal_icons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Иконки</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body body_modal_icons overflow-auto" style="height: 400px;" title="Кликните по иконке 2 раза чтобы выбрать">

            </div>
            <div class="modal-footer">
                <span class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</span>
                <span class="btn btn-primary btn_select_icons">Выбрать</span>
            </div>
        </div>
    </div>
</div>

<script>
    var icons_elm;
    var icons_elm_id = 0;
    $(document).ready(function () {
        init_open_icons();
        $(".btn_select_icons").unbind('click').click(function () {
            console.log('icons_elm_id: ' + icons_elm_id);
        });

    });

    // init
    function init_open_icons(e) {
        if ($(e).length > 0) {
            $(e).unbind('click').click(function () {
                icons_elm = this;
                icons_elm_id = $(this).attr("elm_id");
                $("#form_modal_icons").modal('show');
                $(".body_modal_icons").html(ajax_spinner);
                sendPostLigth('/jpost.php?extension=products',
                        {"fontawesome_icons": 1},
                        function (e) {
                            $(".body_modal_icons").html("");
                            for (var i = 0; i < e['data'].length; i++) {
                                $(".body_modal_icons").append('<div class="list_icons" icon_class="' + e['data'][i] + '"><i class="' + e['data'][i] + '"></i></div>');
                            }
                            btn_click_icons();
                        });
            });
        }
    }

    function btn_click_icons() {
        $(".list_icons").unbind('dblclick').dblclick(function () {
            var h = $(this).attr("icon_class");
            $(icons_elm).closest("div").find(".form-control").val(h);
            $(icons_elm).closest("div").find(".form-control").trigger("change");
            $("#form_modal_icons").modal('hide');
        });
    }
</script>