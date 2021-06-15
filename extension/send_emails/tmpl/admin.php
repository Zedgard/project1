<div>
    <style>
        /*
        .CodeMirror-line span[role="presentation"] {
            padding-left: 30px;
        }
        */
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <div class="row w-100">
                        <div class="col-md-6">
                            <h2>Email оповещения и рассылки</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="javascript:void(0)" class="btn btn-primary float-right form_config_email" data-toggle="modal">Настройки</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-primary add_send_email" obj_i='' data-toggle="modal">Добавить оповещение</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Тема письма</th>
                                        <th>Фаил</th>
                                        <th class="text-center">Установлен ответ на</th>
                                        <th class="text-center">Активность</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="emails_arrays_data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <i class="">
                </div>
            </div> 
        </div>
    </div>
</div>
<?
include 'config_email.php';
?>
<?
include 'edit.php';
?>
<link rel=stylesheet href="/assets/plugins/codemirror/lib/codemirror.css">
<link rel=stylesheet href="/assets/plugins/codemirror/theme/3024-day.css"> 
<script src="/assets/plugins/codemirror/lib/codemirror.js"></script>
<script src="/assets/plugins/codemirror/addon/edit/matchbrackets.js"></script>
<script src="/assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="/assets/plugins/codemirror/mode/css/css.js"></script>
<script src="/assets/plugins/codemirror/mode/xml/xml.js"></script>
<script src="/assets/plugins/codemirror/mode/javascript/javascript.js"></script>

<script src="/assets/plugins/codemirror/mode/clike/clike.js"></script>
<script src="/assets/plugins/codemirror/mode/php/php.js"></script>
<script src="/assets/plugins/codemirror/mode/sql/sql.js"></script>

<script>
    $(document).ready(function () {
        init_get_emails();
        init_form_config_email();

    });// 380896

//    var editor = CodeMirror.fromTextArea(document.getElementById("email_text"), {
//                mode: "javascript",
//                lineNumbers: true,
//                matchBrackets: true,
//                mode: "application/x-httpd-php",
//                indentUnit: 4,
//                indentWithTabs: true,
////                changes: function (e) {
////                    console.log(e);
////                }
//            });
    /*
     * Рерактирование рассылок
     * @returns {undefined}
     */
    function init_form_edit_email_modal() {
        $(".add_send_email, .btn_email_edit").unbind('click').click(function () {
            //editor.refresh();
            $(".show_body_text_message").html("");

            var id = $(this).attr("obj_i");

            if (id != '') {
                $(".btn_show_body_text_message").attr("obj_i", id);
                $(".btn_show_body_text_message").show();
                init_show_body_text_message();

                var edit_email_id = get_emails[id]['id'];
                $("#form_edit_email_modal").find(".email_id").val(get_emails[id]['id']);
                $("#form_edit_email_modal").find(".email_subject").val(get_emails[id]['email_subject']);
                $("#form_edit_email_modal").find(".email_descr").val(get_emails[id]['email_descr']);
                $("#form_edit_email_modal").find(".email_body_file").val(get_emails[id]['email_body_file']);
                if (edit_email_id > 0) {
                    $("#form_edit_email_modal").find(".email_body_file").attr('disabled', 'disabled');
                } else {
                    $("#form_edit_email_modal").find(".email_body_file").removeAttr('disabled');
                }
                $("#form_edit_email_modal").find(".email_reply_to").val(get_emails[id]['email_reply_to']);
                //$("#form_edit_email_modal").find(".email_text").val(get_emails[id]['email_text']);
                //$(".email_text").val(get_emails[id]['email_text']);
                //editor.setValue(get_emails[id]['email_text']);

                if (Number(get_emails[id]['email_send']) === 0) {
                    $(".email_send").removeAttr('checked');
                } else {
                    if (!$(".email_send").prop('checked')) {
                        $(".email_send").click();
                    }
                }
                get_file_body(id);
            } else {
                $(".show_body_text_message").hide();
            }
            $("#form_edit_email_modal").modal('toggle');



            // Сохранение
            $(".btn_save_email").unbind('click').click(function () {
                //console.log(editor.getValue());
                var email_id = edit_email_id;
                var email_subject = $(".email_subject").val();
                var email_descr = $(".email_descr").val();
                var email_body_file = $(".email_body_file").val();
                var email_reply_to = $(".email_reply_to").val();
                var email_text = $(".email_text").val();//editor.getValue();
                var email_send = 1;
                if (!$(".email_send").prop('checked')) {
                    email_send = 0;
                }
                if (email_subject.length < 4) {
                    alert('Тема сообщения слишком короткая');
                }
                if (email_body_file.length < 4) {
                    alert('Наименование файла не заполнено');
                }

                if (email_subject.length > 3 && email_body_file.length > 3) {
                    sendPostLigth('/jpost.php?extension=send_emails', {
                        "edit_email_smtp": 1,
                        "email_id": email_id,
                        "email_subject": email_subject,
                        "email_descr": email_descr,
                        "email_body_file": email_body_file,
                        "email_reply_to": email_reply_to,
                        "email_text": email_text,
                        "email_send": email_send
                    }, function (e) {
                        if (e['success'] == '1') {
                            //$("#form_edit_email_modal").modal('toggle');
                            init_get_emails();
                        }
                    });
                }

            });


        });
    }

    /*
     * Предпросмотр сообщения
     * @returns {undefined}
     */
    function init_show_body_text_message() {
        // просмотр сообщения
        $(".btn_show_body_text_message").unbind('click').click(function () {
            $(".show_body_text_message").html('<div class="spinner-border" role="status"><span class="visually-hidden"></span></div>');
            var id = $(this).attr('obj_i');

            var edit_email_id = get_emails[id]['id'];
            var email_id = edit_email_id;
            var email_subject = $(".email_subject").val();
            var email_descr = $(".email_descr").val();
            var email_body_file = $(".email_body_file").val();
            var email_reply_to = $(".email_reply_to").val();
            var email_text = $(".email_text").val();//editor.getValue();
            var email_send = 1;
            if (!$(".email_send").prop('checked')) {
                email_send = 0;
            }
            if (email_subject.length < 4) {
                alert('Тема сообщения слишком короткая');
            }
            if (email_body_file.length < 4) {
                alert('Наименование файла не заполнено');
            }


            if (email_subject.length > 3 && email_body_file.length > 3) {
                sendPostLigth('/jpost.php?extension=send_emails', {
                    "edit_email_smtp": 1,
                    "email_id": email_id,
                    "email_subject": email_subject,
                    "email_descr": email_descr,
                    "email_body_file": email_body_file,
                    "email_reply_to": email_reply_to,
                    "email_text": email_text,
                    "email_send": email_send
                }, function (e) {

                    if (e['success'] == '1') {
                        /*
                         * Просмотри что у нас получилось
                         * @param {type} e
                         * @returns {undefined}
                         */
                        sendPostLigth('/jpost.php?extension=send_emails', {
                            "show_body_text_message": get_emails[id]['email_body_file']
                        }, function (e) {
                            $(".show_body_text_message").html("");
                            if (e['success'] == '1') {
                                $(".show_body_text_message").html('<hr/>' + e['data'] + '<hr/>');
                                $(".show_body_text_message").show(200);
                                $(".show_body_text_message").append('<input type="text" name="test_send_email" class="test_send_email w-100" value="" placeholder="email для тестового письма..." />');
                                $(".show_body_text_message").append('<div class="text-center mt-2 mb-2"><a href="javascript:void(0)" class="btn btn-sm btn-primary btn_test_send_email">Отправить на почту для просмотра</a></div>');
                                //move(".show_body_text_message");
                                $(".btn_test_send_email").unbind("click").click(function () {
                                    var test_email = $(".test_send_email").val();
                                    var email_body_file = $(".email_body_file").val();
                                    sendPostLigth('/jpost.php?extension=send_emails', {
                                        "send_test_email": test_email,
                                        "email_code": email_body_file//get_emails[id]['id']
                                    }, function (e) {
                                        if (e['success'] == '1') {
                                            alert('Успешно отправлено на ' + test_email + ' ');
                                        } else {
                                            alert("Ошибка отправки сообщения!");
                                        }
                                    });
                                });
                            } else {
                                $(".show_body_text_message").html('<hr/>Ошибка получения тела письма!<hr/>');
                            }
                        });
                    }
                });
            } else {
                alert("Не заполениы 'Тема' или 'файла'!");
            }



        });
    }

    /*
     * Получение тела файла
     * @param {type} id
     * @returns {undefined}
     */
    function get_file_body(id) {
        var get_file_body = get_emails[id]['email_body_file'];
        sendPostLigth('/jpost.php?extension=send_emails', {
            "get_file_body": get_file_body
        }, function (e) {
            if (e['success'] == '1') {
                get_emails[id]['email_body_file_text'] = e['data'];
                $("#form_edit_email_modal").find(".email_text").val(get_emails[id]['email_body_file_text']);

                //editor.setValue(get_emails[id]['email_body_file_text']);
                //editor.refresh();
            }
        });
    }

    var get_emails = [];
    /*
     * Получить список имеющийхся рассылок
     * @type jQuery
     */
    function init_get_emails() {
        sendPostLigth('/jpost.php?extension=send_emails', {
            "get_emails": 1
        }, function (e) {
            get_emails = [];
            if (e['data'].length > 0) {
                $('.emails_arrays_data').html("");
                for (var i = 0; i < e['data'].length; i++) {
                    get_emails.push(e['data'][i]);
                    var email_send = '<span class="badge badge-danger">не рабочий</span>';
                    if (e['data'][i]['email_send'] == '1') {
                        email_send = '<span class="badge badge-success">работает</span>';
                    }
                    $('.emails_arrays_data').append('<tr objid="' + e['data'][i]['id'] + '" obj_i="' + i + '">\n\
                                                <th class="text-center">' + e['data'][i]['id'] + '</th>\n\
                                                <th>' + e['data'][i]['email_subject'] + '</th>\n\
                                                <th>' + e['data'][i]['email_body_file'] + '</th>\n\
                                                <th class="text-center">' + e['data'][i]['email_reply_to'] + '</th>\n\
                                                <th class="text-center">' + email_send + '</th>\n\
                                                <th class="text-center"><span class="btn btn-sm btn-primary btn_email_edit" obj_i="' + i + '" title="Редактировать"><i class="mdi mdi-pencil"></i></span></th>\n\
                                                </tr>');
                }
                init_form_edit_email_modal();
            }
        });
    }


    /*
     * управление настройками SMTP 
     */
    function init_form_config_email() {
        $(".form_config_email").unbind('click').click(function () {
            sendPostLigth('/jpost.php?extension=send_emails', {
                "get_smtp_user_info": 1
            }, function (e) {

                $(".config_email_username").val(e['data']['user_email']);
                $(".config_email_password").val(e['data']['user_password']);
                $('#form_config_email').modal('toggle');
            });
        });
        $(".btn_config_email_save").unbind('click').click(function () {
            var config_email_username = $(".config_email_username").val();
            var config_email_password = $(".config_email_password").val();
            sendPostLigth('/jpost.php?extension=send_emails', {
                "edit_smtp_user_info": 1,
                "config_email_username": config_email_username,
                "config_email_password": config_email_password
            }, function (e) {
                if (e['success'] == '1') {
                    $("#form_config_email").modal('toggle');
                }
            });
        });
    }
</script>