<div class="sign_up_consultation ">
    <div class="sign_up_consultation_back">
        <div class="container">
            <div class="row">
                <div class="col-md-12 top80 bottom100">
                    <div class="datetime_piker_select_block">
                        <div class="datetime_piker_select_title">
                            Записаться на консультацию
                        </div>  
                        <div style="width: 100%;">

                            <div style="margin-top: -50px;padding: 5% 8%;">

                                <!-- STEP 1 -->
                                <div class="step1">
                                    <div class="top50 text-left">
                                        <input type="text" name="consult_first_name" value="" placeholder="Ваше Имя и Фамилия" class="consult_form_input consult_first_name width70 fontfize150" />
                                    </div>
                                    <div class="top30 text-left">
                                        <input type="text" name="consult_user_phone" value="" placeholder="Телефон" data-mask="+7 (999) 999-9999" class="consult_form_input consult_user_phone width70 fontfize150" />
                                    </div>
                                    <div class="top30 text-left">
                                        <input type="text" name="consult_user_email" value="" placeholder="Email" class="consult_form_input consult_user_email width70 fontfize150" />
                                    </div>
                                    <div class="top50 text-left">
                                        <select name="consult_your_master" class="consult_form_input consult_your_master width70 fontfize150" >
                                            <option value="0">Выберите специалиста</option>
                                            <option value="1">Эдгард Зайцев</option>
                                            <option value="2">Сергей Александрович</option>
                                            <option value="3">Татьяна Владимировна</option>
                                            <option value="4">Кирил Зотов</option>
                                        </select>
                                    </div>

                                    <div style="text-align: right;padding: 30px 0;">
                                        <input type="button" value="Следующий шаг" step="2" class="btn btn-lg btn_next_step fontmedium font-size-18" />
                                    </div>

                                </div> 

                                <!-- STEP 2 -->
                                <div class="step2" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="top50 text-left">
                                            <div class="fontfize150" style="margin-bottom: 30px;">
                                                Выберите дату и время
                                            </div>
                                            <div class="datepicker" style="width: 300px;"></div>
                                            <input type="text" name="datepicker_data" value="" class="datepicker_data" style="display: none;" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="top50 text-left">
                                            <div>
                                                <div class="timepicker"></div>
                                                <input type="text" name="timepicker_data" value="" class="timepicker_data" style="display: none;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: right;padding: 30px 0;">
                                        <input type="button" value="Назад" step="1" class="btn btn-lg btn_last_step fontmedium font-size-18" />
                                        <input type="button" value="Следующий шаг" step="3" class="btn btn-lg btn_next_step fontmedium font-size-18" />
                                    </div>
                                </div>

                                <!-- STEP 3 -->
                                <div class="step3" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Ваше Имя и Фамилия</div>
                                                    <div class="first_name"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Телефон</div>
                                                    <div class="user_phone"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Email</div>
                                                    <div class="user_email"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Специалист</div>
                                                    <div class="your_master"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Дата проведения</div>
                                                    <div class="datepicker_data"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="fontmedium">Время</div>
                                                    <div class="timepicker_data"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2 class="defaultcolor fontfize150 textcenter">
                                                <span>Цена: 1500</span> <i class="fa fa-ruble"></i>
                                            </h2>
                                        </div>
                                    </div>
                                    <div style="text-align: right;padding: 30px 0;">
                                        <input type="button" value="Назад" step="2" class="btn btn-lg btn_last_step fontmedium font-size-18" />
                                        <input type="button" value="Записаться" step="3" class="btn btn-lg btn_step_end fontmedium font-size-18" />
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                <!-- true alert -->
                <div class="modal fade" id="consultation_send" tabindex="-1" role="dialog" aria-labelledby="consultation_send" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalSmallTitle">Данные успешно отправлены</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Встреча зарегистрирована, подробности в личном кабинете
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Отмена</button>
                                <button type="button" class="btn btn-primary btn-pill">Оплатить</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="/assets/js/consultation.js"></script>