<!-- true alert -->
<div class="modal fade" id="modal_consultation_pay" tabindex="-1" role="dialog" aria-labelledby="modal_consultation_pay" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Онлайн-консультация</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #FFFFFF;display: none;">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <div class="mb-2 text-center">Добрый человек, проверь <strong>внимательно все детали</strong> заказа</div>
                <div class="block_consultation_pay_info mb-4">
                    <div class="block_consultation_pay_info_title mb-2">консультация</div>
                    <table class="block_consultation_pay_info_table text-center" style="margin: 0 auto;width: 220px;">
                        <tr>
                            <td>
                                <i class="far fa-calendar-alt"></i>
                            </td>
                            <td>
                                <span class="consultation_date"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="far fa-clock"></i>
                            </td>
                            <td>
                                <span class="consultation_period"></span> <span style="font-size: 1.2rem;">(МСК)</span>
                            </td>
                        </tr>
                    </table>
                    
                    <div class="consultation_price_block">
                        <span class="consultation_price"></span>&#8381;
                    </div>
                </div>
                <div class="text-center mb-3" style="color: #595959;font-size: 1.2rem;">Твои данные</div>
                <div class="consultation_price_block_user_info">Если ты <b>новый пользователь</b>, система автоматически тебя зарегистрирует</div>
                <div class="consultation_price_block_user_info mb-4">Если у тебя <b>есть аккаунт</b> - автоматически войдешь</div>
                <div class="block_consultation_user_info mb-2">
                    <form>
                        <div class="form-group">
                            <label>Имя</label> 
                            <input type="hidden" name="consultation_user_fio_h" value="<?= (strlen($_SESSION['consultation_user_fio']) > 0) ? $_SESSION['consultation_user_fio'] : $consultation_fio ?>" class="form-control" />
                            <input type="text" name="consultation_user_fio" value="<?= (strlen($_SESSION['consultation_user_fio']) > 0) ? $_SESSION['consultation_user_fio'] : $consultation_fio ?>" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="tel" name="consultation_user_phone" value="<?= (strlen($_SESSION['consultation_user_phone']) > 0) ? $_SESSION['consultation_user_phone'] : $consultation_phone ?>" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Почта</label>
                            <input type="text" name="consultation_user_email" value="<?= (strlen($_SESSION['consultation_user_email']) > 0) ? $_SESSION['consultation_user_email'] : $consultation_email ?>" class="form-control" />
                        </div>
                        <?
                        if ($consultation_pass == 1) {
                            ?>
                            <div class="form-group">
                                <label>Пароль</label>
                                <input type="password" name="consultation_user_pass" value="<?= (strlen($_SESSION['consultation_user_pass']) > 0) ? $_SESSION['consultation_user_pass'] : '' ?>" class="form-control">
                            </div>
                            <?
                        }
                        ?>
                        <div class="text-center mt-2">
                            <input type="button" value="Оплатить" class="btn btn-success btn_consultation_pay_show" />
                            <div class="btn_consultation_pay_text">Выбери способ оплаты ниже:</div>
                        </div>
                    </form>
                </div>
                <div class="btn_consultation_pay_block mb-3" style="display: none;">
                    <div class="col-12">
                        <?
                        include $_SERVER['DOCUMENT_ROOT'] . '/extension/cart/tmpl/pay_metods_line.php';
                        ?>
                    </div>
                </div>
                <div class="fast_auth_block mb-3" style="display: none;">
                    <div class="col-12">
                        <?
                        include $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/tmpl/fast_login.php';
                        ?>
                    </div>
                </div>
                <div class="block_consultation_pay_agreement"">
                    <input type="checkbox" class="form-check-input" name="consultation_pay_agreement" disabled="disabled" checked="checked"> <strong>Оплачивая консультацию, я принимаю следующие условия:</strong>
                    оплаченное время <strong>НЕ переносится</strong> на другую дату и времяжденьги за 
                    оплаченное время <strong>НЕ озвращаются;</strong>ответственность за мою готовность
                    быть в доступе на телефоне полностьюлежит на мне
                </div>
            </div>
        </div>
    </div>
</div>