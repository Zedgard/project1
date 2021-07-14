<!-- Large Modal -->
<div class="modal fade" id="form_pay_info_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content form_pay_info">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLarge">Информация по транзакции</h5>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div style="font-size: 1.4rem;">Информация</div>
                        <div class="table-responsive-lg">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="pay_info_data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div style="font-size: 1.4rem;">Продукты</div>
                        <div class="table-responsive-lg">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="pay_info_data_products">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="pay_id" class="pay_id" id="pay_id" value="0" />
                <span class="btn btn-danger" data-dismiss="modal">Закрыть</span>
                <!-- <span class="btn btn-primary btn_save_pay_info">Сохранить</span> -->
            </div>
        </div>
    </div>
</div>



