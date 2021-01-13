<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Управление шаблонами</h2>
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
                                <tbody class="themes_all">

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
<script>
    $(document).ready(function () {
        init_themes_all();

    });

    function init_themes_all() {
        sendPostLigth('/jpost.php?extension=template',
                {"getThemesAll": 1},
                function (e) {
                    $(".themes_all").html("");
                    if (e['success'] == '1') {
                        if (e['data'].length) {
                            for (var i = 0; i < e['data'].length; i++) {
                                $(".themes_all").append('<tr>\n\
                                        <td>' + e['data'][i]['title'] + '</td>\n\
                                        <td class="text-center"><a href="?template=' + e['data'][i]['file'] + '" class="btn btn-sm btn-primary">файлы</a></td>\n\
                                    </tr>');
                            }
                        }
                    }
                });
    }

</script>    