/* 
 * Отправка данных из формы
 */
var ajax_load = '<div class="ajax_load col-md-12 mb-4"><center><img src="/assets/img/ajax_load_2.svg" style="width: 40px;" /></center></div>';
(function ($) {

    /**
     * Отправка формы с серилизацией данные из нее
     * @param {type} func
     * @returns {ajaxL#5.$.fn@call;each}
     */
    $.fn.sendPost = function (func) {
        //console.log("sendPost init");
        var make = function () {
            // реализация работы метода с отдельным элементом страницы
            var obj = this;
            $(this).submit(function (e) {
                $('.form_result').hide(200);
                $('.form_result').after(ajax_load);

                var objid = $(obj)[0]['id'];
                //console.log("sendPost1 " + objid);
                e.preventDefault();

                // переменная, которая будет содержать данные серилизации
                var $data;
                // в зависимости от того какую нажали кнопку, выполняем
                // серилизацию тем или иным способом
                //if ($(this).attr('data-method') == 'serialize') {
                $data = $(obj).serialize();
                //} else {
                //    $data = $(this).parent('form').serializeArray();
                //}
                // для отправки данных будем использовать технологию ajax
                //   url - адрес скрипта, с помощью которого будем обрабатывать форму на сервере
                //   type - метод отправки запроса (POST)
                //   data - данные, которые необходимо передать серверу
                //   success - функция, которая будет вызвана, когда ответ прийдёт с сервера
                $.ajax({
                    url: $(obj).attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: $data,
                    success: function (result) {
                        /*
                         * Обработка ответа от сервера
                         */
                        $(".ajax_load").remove();
                        $('.form_result').html("");
                        var metod = 0;
                        if (result['success'] == 1) {
                            $('.form_result').removeClass("alert-danger");
                            $('.form_result').addClass("alert").addClass("alert-success");
                            $('.form_result').append(result['success_text']);
                            metod = 1;
                        }
                        if (result['success'] == 0) {
                            if (!!result['errors'] && result['errors'].length > 0) {
                                $('.form_result').removeClass("alert-success");
                                $('.form_result').addClass("alert").addClass("alert-danger");
                                for (var i = 0; i < result['errors'].length; i++) {
                                    $(obj).find(".form_result").append("<div>" + result['errors'][i] + "</div>\n");
                                }
                            }
                            if (!!result['success_text'] && result['success_text'].length > 0) {
                                $('.form_result').append("<div>" + result['success_text'] + "</div>\n");
                            }
                            metod = 2;
                        }
                        // Непредвиденная ошибка, если result['success'] не передали
                        if (metod == 0) {
                            if (!!result['errors'] && result['errors'].length > 0) {
                                $('.form_result').removeClass("alert-success");
                                $('.form_result').addClass("alert").addClass("alert-danger");
                                for (var i = 0; i < result['errors'].length; i++) {
                                    $(obj).find(".form_result").append("Error system №101 !");
                                }
                            }
                            if (!!result['success_text'] && result['success_text'].length > 0) {
                                $(obj).find('.form_result').append(result['success_text']);
                            }
                        }
                        $(obj).find('.form_result').show(200);
                        // Выполнить втроенную функцию
                        func(result);
                        // Выполнить переадресацию
                        if (!!result['action'] && result['action'].length > 0) {
                            var action_time = 2;
                            if (!!result['action_time'] && Number(result['action_time']) > 0) {
                                action_time = Number(result['action_time']);
                                setTimeout(function () {
                                    window.location.href = result['action'];
                                }, (action_time * 1000));
                            } else {
                                if (!!result['action']) {
                                    window.location.href = result['action'];
                                }
                            }


                        }

                        // Добавить кнопку закрыть
                        //$('.form_result').append('<button type="button" class="close"'
                        //        + ' data-dismiss="alert" aria-label="Close">'
                        //        + '<span aria-hidden="true">×</span></button>');

                        // Скроем ответы серез 20 сек.
                        setTimeout(function () {
                            $('.form_result').hide();
                        }, 20000);
                    }
                });
            });
        };

        return this.each(make);

    };




})(jQuery);



/**
 * Простая форма отправки POST запроса
 * @param {type} url
 * @param {type} data
 * @param {type} func
 * @returns {ajaxL#5.$.fn@call;each}
 */
function sendPostLigth(url, data, func) {
    //console.log("sendPostLigth init");

    // реализация работы метода с отдельным элементом страницы
    //var obj = this;
    $('.form_result').html("");
    $('.form_result').after(ajax_load);
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (result) {
            /*
             * Обработка ответа от сервера
             */
            $(".ajax_load").remove();
            var metod = 0;
            if (result['success'] == 1) {
                if (!!result['success_text'] && result['success_text'].length > 0) {
                    if (typeof toastr !== 'undefined') {
                        toastr.success(result['success_text'], 'Выполнено');

                    }
                    if (!!$('.form_result')) {
                        $('.form_result').append('<div>' + result['success_text'] + '</div>');
                    }
                }
                metod = 1;
            }
            if (result['success'] == 0) {
                if (typeof result['errors'] !== 'undefined' && result['errors'].length > 0) {
                    for (var i = 0; i < result['errors'].length; i++) {
                        if (typeof toastr !== 'undefined') {
                            toastr.success(result['errors'][i], 'ошибка!');
                        }
                        if (!!$('.form_result')) {
                            $('.form_result').append('<div>' + result['errors'][i] + '</div>');
                        }
                    }
                }
                metod = 2;
            }
            // Непредвиденная ошибка, если result['success'] не передали
            if (metod == 0) {
                if (!!result['errors'] && result['errors'].length > 0) {
                    for (var i = 0; i < result['errors'].length; i++) {
                        if (typeof toastr !== 'undefined') {
                            toastr.success("Error system №101 !", 'ошибка!');
                        }
                        if (!!$('.form_result')) {
                            $('.form_result').append("Error system №101 !");
                        }
                    }
                }
            }
            // Выполнить втроенную функцию
            func(result);

            // Выполнить переадресацию
            if (!!result['action'] && result['action'].length > 0) {
                var action_time = 2;
                if (!!result['action_time'] && Number(result['action_time']) > 0) {
                    action_time = Number(result['action_time']);
                }
                setTimeout(function () {
                    window.location.href = result['action'];
                }, (action_time * 1000));

            }

        }
    });

}

