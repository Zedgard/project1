<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-12">Настройки пользователя</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="form-group" <?= $user_phone_disabled_title ?>>
                                        <label for="first_name">Телефон</label>
                                        <input type="text" class="form-control user_phone" id="user_phone" <?= $user_phone_disabled ?> placeholder="Номер телефона..." required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first_name">Email</label>
                                        <input type="text" class="form-control user_email" id="user_email" <?= $user_phone_disabled ?> placeholder="Email..." required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first_name">Имя</label>
                                        <input type="text" class="form-control first_name" id="first_name" placeholder="Имя пользователя..." required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="last_name">Фамилия</label>
                                        <input type="text" class="form-control last_name" id="last_name" placeholder="Фамилия пользователя..." required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="login_instagram">Instagram login</label>
                                        <input type="text" class="form-control login_instagram " id="login_instagram " placeholder="Instagram login..." required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city">Город</label>
                                        <input type="text" class="form-control city" id="city" placeholder="Город..." required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="city_code">Индекс</label>
                                        <input type="text" class="form-control city_code" id="city_code" placeholder="Индекс города..." required>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="active_subscriber">Подписка</label><br/>
                                <label class="switch switch-text switch-primary form-control-label">
                                    <input type="checkbox" class="switch-input form-check-input active_subscriber" value="1" >
                                    <span class="switch-label" data-on="On" data-off="Off"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div>

                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div><label for="upload_file">
                                                    <?
                                                    if (strlen($avatar) > 0) {
                                                        ?>
                                                        <img src="<?= $avatar ?>" class="user-image img-thumbnail avatar_img mb-1" style="width: 100px;" title="Аватар">
                                                        <?
                                                    }
                                                    ?>
                                                </label>
                                            </div>
                                            <div class="">
                                                <input type="file" name="upload_file" class="form-control upload_file float-left w-75" />
                                                <input type="submit" value="Загрузить" class="btn btn-primary float-right w-25" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 text-right">
                                    <span class="btn btn-primary btn_save_user_info">Сохранить</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>
            </div> 
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        init_get_user_info();
    });
    var user_data = [];
    function init_get_user_info() {
        $(".active_subscriber").change(function () {
            if ($(".active_subscriber").is(':checked')) {
                console.log(1);
            } else {
                console.log(0);
            }
        });
        sendPostLigth('/jpost.php?extension=userprofile', {"get_user_info": '1'}, function (e) {
            user_data = e['data'];
            var avatar_img = user_data['avatar'];
            $(".user_phone").val(user_data['phone']);
            $(".user_email").val(user_data['email']);
            $(".first_name").val(user_data['first_name']);
            $(".last_name").val(user_data['last_name']);
            $(".login_instagram").val(user_data['login_instagram']);
            $(".city").val(user_data['city']);
            $(".city_code").val(user_data['city_code']);
            if (avatar_img.length > 0) {
                $(".avatar_img").attr("src", user_data['avatar']);
                $(".user-image").attr("src", user_data['avatar']);
            }
            if (Number(user_data['active_subscriber']) == 1) {
                console.log('ok');

                $(".active_subscriber").attr('checked', 'checked');
                if (!$(".active_subscriber").is(':checked')) {
                    $(".active_subscriber").click();
                }
            } else {
                console.log('noy');
                $(".active_subscriber").removeAttr('checked');
            }
            //console.log(user_data);
            init_btn_save_user_info();
        });
    }

    function init_btn_save_user_info() {
        $(".btn_save_user_info").unbind('click').click(function () {
            var user_phone = $(".user_phone").val();
            var user_email = $(".user_email").val();
            var first_name = $(".first_name").val();
            var last_name = $(".last_name").val();
            var login_instagram = $(".login_instagram").val();
            var city = $(".city").val();
            var city_code = $(".city_code").val();
            var active_subscriber = 0;
            if ($(".active_subscriber").is(':checked')) {
                active_subscriber = 1;
            }
            sendPostLigth('/jpost.php?extension=userprofile', {
                "save_user_info": '1',
                "user_phone": user_phone,
                "user_email": user_email,
                "first_name": first_name,
                "last_name": last_name,
                "login_instagram": login_instagram,
                "city": city,
                "city_code": city_code,
                "active_subscriber": active_subscriber
            }, function (e) {

            });
        });
    }
</script>