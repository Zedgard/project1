<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        UTM метки
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <a href="javascript:void(0)" jpost_url="/jpost.php?extension=utm&utm_insert=1" func="init_utm()" class="btn btn-primary init_super_insert">Добавить</a>
            </div>
            <div class="col-6 text-right">
                <a href="?edit_tags=1" class="btn btn-info">Управление тегами</a>
            </div> 
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive-lg">
                    <table class="table table-striped table-bordered w-100 utm_list">
                        <thead>
                            <tr>
                                <th>Наименование</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="form-footer pt-4 pt-5 mt-4 border-top">

    </div>
</div>
<script src="/extension/utm/js/utm.js<?= $_SESSION['rand'] ?>"></script>