/* 
 * Отправка данных из формы
 */

(function ($) {
    $.fn.sendPost = function (func) {

        var make = function () {
            // реализация работы метода с отдельным элементом страницы
            var obj = this;
            




            //$(this).submit(function (e) {
            //    e.preventDefault();
            //    '#' + $(this)[0]['id'] + ' input[type="submit"]'
            //});


            $(this).submit(function (e) {
                var objid = $(obj)[0]['id'];
                console.log("sendPost1 " + objid);
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
                console.log("click_id: " + $(obj)[0]['id']);
                $.ajax({
                    url: $(obj).attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: $data,
                    success: function (result) {
                        if (result['success'] === 0) {
                            //$('#form_result_success').html(result['success']);
                            func(result);
                        } else {
                            for (var i = 0; i < result['errors'].length; i++) {
                                $('#form_result_error').html(result);
                            }
                        }
                    }
                });
            });




        };

        return this.each(make);

    };
})(jQuery);

/*
 * 
 * 
 * $(obj + ' input[type="submit"').click(function (e) {
 //alert("click");
 console.log("click");
 // отменяем стандартное поведение браузера
 e.preventDefault();
 // переменная, которая будет содержать данные серилизации
 var $data;
 // в зависимости от того какую нажали кнопку, выполняем
 // серилизацию тем или иным способом
 //if ($(this).attr('data-method') == 'serialize') {
 $data = $(this).parent('form').serialize();
 //} else {
 //    $data = $(this).parent('form').serializeArray();
 //}
 // для отправки данных будем использовать технологию ajax
 //   url - адрес скрипта, с помощью которого будем обрабатывать форму на сервере
 //   type - метод отправки запроса (POST)
 //   data - данные, которые необходимо передать серверу
 //   success - функция, которая будет вызвана, когда ответ прийдёт с сервера
 $.ajax({
 url: $(this).parent('form').attr('action'),
 type: 'post',
 dataType: 'json',
 data: $data,
 success: function (result) {
 if (result['success'] === 1) {
 //$('#form_result_success').html(result['success']);
 func();
 } else {
 for (var i = 0; i < result['errors'].length; i++) {
 $('#form_result_error').html(result);
 }
 }
 }
 });
 });
 
 
 
 // при нажатию на кнопку с типом submit + ' input[type="submit"]' input[type="submit"
 $(elm + ' input[type="submit"').click(function (e) {
 //alert("sendPost");
 //console.log("sendPost");
 // отменяем стандартное поведение браузера
 e.preventDefault();
 // переменная, которая будет содержать данные серилизации
 var $data;
 // в зависимости от того какую нажали кнопку, выполняем
 // серилизацию тем или иным способом
 //if ($(this).attr('data-method') == 'serialize') {
 $data = $(this).parent('form').serialize();
 //} else {
 //    $data = $(this).parent('form').serializeArray();
 //}
 // для отправки данных будем использовать технологию ajax
 //   url - адрес скрипта, с помощью которого будем обрабатывать форму на сервере
 //   type - метод отправки запроса (POST)
 //   data - данные, которые необходимо передать серверу
 //   success - функция, которая будет вызвана, когда ответ прийдёт с сервера
 $.ajax({
 url: $(this).parent('form').attr('action'),
 type: 'post',
 dataType: 'json',
 data: $data,
 success: function (result) {
 if (result['success'] === 1) {
 //$('#form_result_success').html(result['success']);
 func();
 } else {
 for (var i = 0; i < result['errors'].length; i++) {
 $('#form_result_error').html(result);
 }
 }
 }
 });
 });
 */
