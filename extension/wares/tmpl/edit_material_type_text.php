<div>Редактировать данные</div>
<div>
    <textarea name="material_descr" class="form-control form-control-material" 
              id="material_<?= $value['id'] ?>" 
              init_html="material_descr"
              row_db="material_descr" obj_id="<?= $value['id'] ?>" 
              placeholder="Текст..."
              style="width: 100%;min-height: 200px;display: none;"><?= $value['material_descr'] ?></textarea>


    <textarea name="textarea_material_tinymce" id="textarea_material_tinymce_<?= $value['id'] ?>" class="textarea_material_tinymce" 
              style="width: 100%;min-height: 200px;"><?= $value['material_descr'] ?></textarea>
    <?
    if ($GLOBALS["ImportWisiwyng"] == 0) {
        ?>
        <script src="/assets/plugins/tinymce/tinymce.js?v=1"></script>
        <?
        $GLOBALS["ImportWisiwyng"] = 1;
    }
    ?>
    <script>
        var tinymce_init = 0;
        tinymce.init({
            selector: '#textarea_material_tinymce_<?= $value['id'] ?>',
            theme: 'modern',
            directionality: 'ltr',
            language: 'ru',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            toolbar1: 'undo redo | pageembed template | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | insert link image media',
            toolbar2: 'formatselect fontselect fontsizeselect | removeformat | pagebreak | charmap | forecolor backcolor emoticons | codesample | preview fullscreen |',
            image_advtab: true,
            templates: [
                {title: 'Блок Container расположение по середине', content: '<div class="container"><div class="row"><div class="col-12">Container 1</div></div></div>'},
                {title: 'Блок row', content: '<div class="row"><div class="col-12">row 1</div></div>'}
            ],
            content_css: [
                '/assets/css/sleek.min.css',
                '/assets/plugins/bootstrap/css/bootstrap.css',
                '/themes/site1/css/style.css',
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            ],
            file_browser_callback: function (callback, value, meta) {
                tinyMCE.activeEditor.windowManager.open({
                    file: "/system/elfinder/elfinder.php", //"/system/elfinder/php/connector.minimal.php?cmd=open&target=l1_aW1hZ2U&init=1&tree=1&_=1617026792779",
                    title: 'elFinder',
                    width: 800,
                    height: 600,
                    resizable: true,
                    inline: true,
                    close_previous: false,
                    popup_css: false
                }, {
                    my_insert: function (url) {
                        document.getElementById(callback).value = url;
                    }
                });
            },
            init_instance_callback: function (editor) {
                // признак готовности
                tinymce_init = 1;
            },
            setup: function (ed) {
                ed.on('keyup', function (e) {
                    var elm_type = $("#material_<?= $value['id'] ?>").get(0).tagName;
                    var row_db = $("#material_<?= $value['id'] ?>").attr('row_db');
                    var obj_id = $("#material_<?= $value['id'] ?>").attr('obj_id');
                    var id = $("#material_<?= $value['id'] ?>").attr('id');
                    var val = ed.getContent();
                    //$("#material_<?= $value['id'] ?>").html(ed.getContent());
                    $("#material_<?= $value['id'] ?>").closest(".material_info").find("." + $("#material_<?= $value['id'] ?>").attr('init_html')).html(val); // material_info

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
            }
        });

        $(document).on('focusin', function (e) {
            if ($(e.target).closest(".mce-window").length)
                e.stopImmediatePropagation();
        });
    </script>
</div>    