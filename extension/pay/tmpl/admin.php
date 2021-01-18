<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Покупки</h2> 
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control search_pay_user" placeholder="Поиск...">
                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <!-- элемент input с id = datetimepicker1 -->
                                <div class="input-group" id="datetimepicker10">
                                    <input type="text" class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                            <!-- Инициализация виджета "Bootstrap datetimepicker" -->
                            <script>
                                $(function () {
                                    // идентификатор элемента (например: #datetimepicker1), для которого необходимо инициализировать виджет Bootstrap DateTimePicker
                                    $('#datetimepicker10').datetimepicker({
                                        autoUpdateInput: false,
                                        singleDatePicker: true,
                                        locale: {
                                            cancelLabel: 'Clear'
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-lg">
                                <table class="table table-striped pay_data">
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
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <a href="javascript:void(0)" class="btn btn-primary get_next_page" style="display: none;">Дальше...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top ">

                </div>

            </div> 
        </div>
    </div>
</div>
<script src="/extension/pay/js/pay_js.js<?= $_SESSION['rand'] ?>"></script>

