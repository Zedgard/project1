<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <a href="./" class="btn btn-link">UTM метки</a>- Управление тегами
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <a href="javascript:void(0)" jpost_url="/jpost.php?extension=utm&utm_tag_insert=1" func="init_utm_tags()" class="btn btn-primary init_super_insert">Добавить</a>
            </div>
            <div class="form-group">
                <div class="table-responsive-lg">
                    <table class="table table-striped table-bordered w-100 utm_tags_list">
                        <thead>
                            <tr>
                                <th style="width: 12%;">Код тега</th>
                                <th style="width: 20%;">Наименование</th>
                                <th>Описание</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <div class="form-footer border-top">
        <a href="./" class="btn btn-link">назад</a>
    </div>
</div>
<script src="/extension/utm/js/utm.js<?= $_SESSION['rand'] ?>"></script>