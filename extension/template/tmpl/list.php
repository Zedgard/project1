<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Список файлов</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-bordered" style="width:100%;background-color: #FFFFFF;">
                                <thead>
                                    <tr>
                                        <th>Наименование</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="theme_files_all">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="pb-3 pt-3 pl-3 mt-2 border-top">
                    <a href="./" class="btn btn-secondary btn-default">&lt; назад</a>
                </div>

            </div> 
        </div>
    </div>
</div>
<script>
    var template = '<?= $_GET['template'] ?>';
    $(document).ready(function () {
        init_themes_files_all();

    });

    function init_themes_files_all() {
        sendPostLigth('/jpost.php?extension=template',
                {"getThemesFilesAll": template},
                function (e) {
                    $(".theme_files_all").html("");
                    if (e['success'] == '1') {
                        if (e['data'].length) {
                            for (var i = 0; i < e['data'].length; i++) {
                                $(".theme_files_all").append('<tr>\n\
                                        <td>' + e['data'][i]['title'] + '</td>\n\
                                        <td class="text-center"><a href="?template=' + template + '&file_edit=' + e['data'][i]['file'] + '" class="btn btn-sm btn-primary">редактировать</a></td>\n\
                                    </tr>');
                            }
                        }
                    }
                });
    }

</script>   