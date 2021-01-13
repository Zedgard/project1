<style>
    .ext_chat{
        position: static;
        right: 0;
        bottom: 0;
        margin-right: 0%;
        background-color: #ffffff;
        min-width: 100%;
        width: 16%;
        z-index: 1;
    }
    .chat_title{
        color: #ffffff;
        text-align: center;
        padding: 8px;
        font-size: 1rem;
        font-weight: 400;
        position: relative;
        display: block;
        background-color: #4c84ff;
    }
    .chat_title:hover{
        cursor: pointer;
    }
    .ext_chat .icon_show{
        float: right;
        font-size: 2rem;
        margin-top: -0.6rem;
    }
    .chat_body{
        flex-basis: auto;
        border-left: 1px solid #e5e9f2;
        border-right: 1px solid #e5e9f2;
        border-bottom: 1px solid #e5e9f2;
    }
    .chat_not_message{
        text-align: center;
        width: 100%;
    }
</style>
<div class="ext_chat chat-<?= $_SESSION['chat_code'] ?>">
    <div class="chat_title">Онлайн чат <span class="mdi mdi-chevron-up icon_show"></span></div>
    <div class="chat_body chat-right-side" style="display: block;">
        <div class="row bg-white no-gutters chat" style="width: 100%;">
            <!-- Chats -->
            <div class="chat-right-side" style="height: 367px;width: 100%;">
                <div class="chat-right-content" id="chat-<?= $_SESSION['chat_code'] ?>" style="min-height: 367px;width: 100%;">
                    
                    <div class="media media-chat media-left">
                        <i class="mdi mdi-account mr-2"></i>
                        <div class="media-body">
                            <div class="">Виктор</div>
                            <p class="message">Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>

                    <div class="media media-chat media-right">
                        <div class="media-body">
                            <div class="">Мария</div>
                            <p class="message">Consectetur adipisicing elit Odio ex.</p>
                        </div>
                        <i class="mdi mdi-account ml-2"></i>
                    </div>

                    <div class="media media-chat media-left">
                        <i class="mdi mdi-account mr-2"></i>
                        <div class="media-body">
                            <div class="">Дарья</div>
                            <p class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto dolor, exercitationem
                                earum natus doloremque explicabo.</p>
                            <p class="message">Accusamus laborum explicabo illum asperiores provident dolore perferendis cumque
                                incidunt possimus quia! Deleniti minus</p>
                        </div>
                    </div>

                    <div class="media media-chat media-right">
                        <div class="media-body">
                            <div class="">Кирил</div>
                            <p class="message">Lorem ipsum dolor sit amet.</p>
                        </div>
                        <i class="mdi mdi-account ml-2"></i>
                    </div>

                    <div class="media media-chat media-left">
                        <i class="mdi mdi-account mr-2"></i>
                        <div class="media-body">
                            <div class="">Виктор</div>
                            <p class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto dolor, exercitationem
                                earum natus
                                doloremque explicabo.</p>
                            <p class="message">Accusamus laborum explicabo illum asperiores provident dolore perferendis cumque
                                incidunt
                                possimus quia! Deleniti minus</p>
                        </div>
                    </div>

                    <div class="media media-chat media-right">
                        <div class="media-body">
                            <div class="">Мария</div>
                            <p class="message">Lorem ipsum dolor sit amet.</p>
                        </div>
                        <i class="mdi mdi-account ml-2"></i>
                    </div>

                </div>

                <div class="mt-1">
                    <input type="text" class="form-control ml-3 w-75 chat_input_send float-left" maxlength="1000" placeholder="Введите текст"> <a href="javascript:void(0)" class="btn btn-primary mr-3 chat_btn_send float-right"><i class="mdi mdi-send"></i></a>
                </div>
            </div>



        </div>
    </div>
</div>
<script>
    var chat_id = "chat-<?= $_SESSION['chat_code'] ?>";
    var clientId = "<?= $ClientId ?>";
    $(document).ready(function () {

        $(".chat_title").unbind("click").click(function () {
            $(".chat_body").toggle('slow');
        });

        init_chat();
        init_chat_send();
    });

    even = n => !(n % 2);

    /**
     * Получить сообщения
     * @returns {undefined}
     */
    function init_chat() {
        sendPostLigth('/jpost.php?extension=chat',
                {"get_messages": 1},
                function (e) {
                    $('#' + chat_id).html("");
                    if (e['success'] == '1') {
                        if (e['data'].length > 0) {
                            for (var i = 0; i < e['data'].length; i++) {
                                var h = '';
                                var btn_delete = '';
                                if (clientId == e['data'][i]['user_id']) {
                                    btn_delete = '<a href="javascript:void(0)"><i class="mdi mdi-delete chat_del_message" elm="' + e['data'][i]['id'] + '"></i></a>';
                                }

                                if (even(i)) {
                                    h += '<div class="media media-chat media-right" u="' + e['data'][i]['user_id'] + '">\n\
                                        <div class="media-body">\n\
                                            <div class="">' + e['data'][i]['first_name'] + '</div>\n\
                                            <p class="message">' + e['data'][i]['message'] + '</p>\n\
                                            <div class="date-time">' + e['data'][i]['last_date'] + '</div>\n\
                                        </div>\n\
                                        <i class="mdi mdi-account ml-2"></i>' + btn_delete + '\n\
                                    </div>';
                                } else {
                                    h += '<div class="media media-chat media-left" u="' + e['data'][i]['user_id'] + '">\n\
                                        ' + btn_delete + '<i class="mdi mdi-account mr-2"></i>\n\
                                        <div class="media-body">\n\
                                            <div class="">' + e['data'][i]['first_name'] + '</div>\n\
                                            <p class="message">' + e['data'][i]['message'] + '</p>\n\
                                            <div class="date-time">' + e['data'][i]['last_date'] + '</div>\n\
                                        </div>\n\
                                    </div>';
                                }

                                $('#' + chat_id).append(h);
                            }
                            init_chat_del();
                        } else {
                            $('#' + chat_id).html("<div class=\"chat_not_message\">Нет сообщений!</div>");
                        }

                        var chatRightContent = $('#' + chat_id);
                        if (chatRightContent.length != 0) {
                            chatRightContent.slimScroll({});
                        }
                    }
                });
    }

    /**
     * Отправить сообщение
     * @returns {undefined}
     */
    function init_chat_send() {
        $("." + chat_id).find(".chat_btn_send").unbind("click").click(function () {
            var message = $("." + chat_id).find(".chat_input_send").val();

            sendPostLigth('/jpost.php?extension=chat',
                    {"send_message": 1,
                        "message": message},
                    function (e) {
                        if (e['success'] == '1') {
                            init_chat();
                            $("." + chat_id).find(".chat_input_send").val("");
                        }
                    });
        });

    }

    /**
     * Удалить сообщение
     * @returns {undefined}
     */
    function init_chat_del() {
        $(".chat_del_message").unbind("click").click(function () {
            var message_id = $(this).attr("elm");

            sendPostLigth('/jpost.php?extension=chat',
                    {"del_messages": 1,
                        "message_id": message_id},
                    function (e) {
                        if (e['success'] == '1') {
                            init_chat();
                        }
                    });
        });

    }

</script>