<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <!--
                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Управление категориями</h2>
                </div>
                -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-primary btn_category_edit" obj_i="">Добавление категории</a>
                        </div>
                    </div>
                    <div class="form_category_add" style="display: none;">
                        <div class="form-group">
                            <label for="config_code">Тип</label>
                            <input type="text" class="form-control category_type" id="config_type" placeholder="Тип" required>
                        </div>
                        <div class="form-group">
                            <label for="config_title">Значение</label>
                            <input type="text" class="form-control category_title" id="config_title" placeholder="Наименование" required>
                        </div>
                        <div class="form-group">
                            <label for="config_code">Цвет</label>
                            <input type="text" class="form-control category_color" id="config_color" placeholder="Цвет" required>
                        </div>
                        <input type="button" value="Добавить" class="btn btn-primary btn_category_add" />
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-bordered wares_arrays_data" style="width:100%;background-color: #FFFFFF;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Тип</th>
                                        <th>Наименование</th>
                                        <th>Цвет</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="category_all">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>

            </div> 
        </div>
    </div>
</div>
<?
include 'edit.php';
?>
<script>

    $(document).ready(function () {
        $(".btn_category_edit").click(function () {
            $(".form_category_add").toggle(200);
            init_categories_add();
        });
        init_categories_all();
    });

    function init_categories_all() {
        //console.log('init_categories_all');
        sendPostLigth('/jpost.php?extension=category',
                {"getCategoryAllArray": 1},
                function (e) {
                    $(".category_all").html("");
                    if (e['success'] == '1') {
                        if (e['data'].length > 0) {
                            for (var i = 0; i < e['data'].length; i++) {
                                $(".category_all").append('<tr>\n\
                                    <td>' + e['data'][i]['id'] + '</td>\n\
                                    <td><input type="text" name="category_type" value="' + e['data'][i]['type'] + '" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_category" elm_row="type" class="form-control init_elm_edit" /></td>\n\
                                    <td><input type="text" name="category_title" value="' + e['data'][i]['title'] + '" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_category" elm_row="title" class="form-control init_elm_edit" /></td>\n\
                                    <td><input type="text" name="category_color" value="' + e['data'][i]['color'] + '" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_category" elm_row="color" class="form-control init_elm_edit" /></td>\n\
                                    <td><span class="btn btn-danger init_elm_delete" elm_id="' + e['data'][i]['id'] + '" elm_table="zay_category" func="init_categories_all()"><i class="mdi mdi-delete"></i></span></td>\n\
                                </tr>');
                            }
                        }
                    }

                });
    }

    function init_categories_add() {
        $(".btn_category_add").unbind('click').click(function () {
            var type = $(".category_type").val();
            var title = $(".category_title").val();
            var color = $(".category_color").val();
            sendPostLigth('/jpost.php?extension=category',
                    {
                        "categories_add": 1,
                        "type": type,
                        "title": title,
                        "color": color
                    },
                    function (e) {
                        if (e['success'] == '1') {
                            $(".form_category_add").hide(200);
                            init_categories_all();
                        }
                    });
        });
    }


</script>    