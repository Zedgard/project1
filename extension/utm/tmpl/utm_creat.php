<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <a href="./">UTM метки</a>&nbsp;-&nbsp;Управление UTM метками
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col">
                    <a href="javascript:void(0)" jpost_url="/jpost.php?extension=utm&utm_insert=1" func="init_utm()" class="btn btn-primary init_super_insert">Добавить</a>
                </div>
                <div class="col text-right">
                    <a href="?utm_creat=1&edit_tags=1" class="btn btn-info">Управление тегами</a>
                </div> 
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive-lg">
                        <table class="table table-striped table-bordered w-100 text-center utm_list">
                            <thead>
                                <tr>
                                    <th>Наименование</th>
                                    <th></th>
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

    </div>
    <div class="form-footer pt-4 pt-5 mt-4 border-top">

    </div>
</div>
<script src="/extension/utm/js/utm.js<?= $_SESSION['rand'] ?>"></script>