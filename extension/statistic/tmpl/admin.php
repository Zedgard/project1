<div class="row">
    <div class="col-xl-6">
        <?php
        include 'users.php';
        ?>
    </div>
    <div class="col-xl-6">
        <?php
        include 'wares_video_see.php';
        ?>
    </div>

</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Последние продажи</h2>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="table-responsive-xl">
                        <table class="table table-striped table-bordered pay_data">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Клиент</th>
                                    <th class="text-center">Тип</th>
                                    <th class="text-center">Платеж</th>
                                    <th class="text-center">Дата</th>
                                    <th class="text-center">Статус</th>
                                    <th class="text-center">Идентификатор</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-12 text-center">
                            <a href="javascript:void(0)" class="btn btn-primary get_next_page" style="display: none;">Дальше...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="/extension/pay/js/pay_js.js<?= $_SESSION['rand'] ?>"></script>