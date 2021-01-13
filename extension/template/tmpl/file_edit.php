<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Редактирование файла <span class="file_edit_name"></span></h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="config_title">HTML</label>
                                <textarea name="fileText" id="fileText" class="form-control fileText" placeholder="Текст html..." style="width: 100%;min-height: 500px;"></textarea>
                            </div>
                            <div class="form_result mb-2"></div>
                            <a href="./?template=<?= $_GET['template'] ?>" class="btn btn-danger">Закрыть</a>
                            <button type="button" class="btn btn-primary btn_save_file">Сохранить</button>
                        </div>
                    </div>
                </div>

                <div class="pb-3 pt-3 pl-3 mt-2 border-top">
                    <a href="./?template=<?= $_GET['template'] ?>" class="btn btn-secondary btn-default">&lt; назад</a>
                </div>

            </div> 
        </div>
    </div>
</div>
<script>
    var template = '<?= $_GET['template'] ?>';
    var file_edit = '<?= $_GET['file_edit'] ?>';
    $(document).ready(function () {
        $(".file_edit_name").html(file_edit);
        init_file_text();
    });

    function init_file_text() {
        sendPostLigth('/jpost.php?extension=template',
                {
                    "getFileText": 1,
                    "template": template,
                    "file_edit": file_edit
                },
                function (e) {
                    $(".fileText").val("");
                    if (e['success'] == '1') {
                        if (e['data'].length) {
                            $(".fileText").val(e['data']);
                        }
                    }
                    init_btn_save_file();
                });
    }

    function init_btn_save_file() {
        $(".btn_save_file").unbind('click').click(function () {
            var fileText = $(".fileText").val();
            sendPostLigth('/jpost.php?extension=template',
                    {
                        "setFileText": 1,
                        "template": template,
                        "file_edit": file_edit,
                        "fileText": fileText
                    },
                    function (e) {
                        $(".theme_files_all").html("");
                        if (e['success'] == '1') {
                            
                        }
                    });
        });

    }


</script>   