<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Список пользователей для синхронизации с SendPulse</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- <button class="btn btn-primary sendpulse_auth" onclick="sendpPulseAuthorize()">Войти в SendPulse</button> -->
                            <button class="btn btn-info" onclick="startPassData(this)">Передать данные пользователей</button>
                            <button class="btn btn-success" onclick="startPassData(this)">Передать данные за сутки</button>
                            <button class="btn btn-secondary disabled" onclick="setSomeStop()">Прервать процесс</button>
                        </div>
                    </div>
                    <br/>
                    <dl class="row">
                        <dt class="col-6">Количсество обработанных записей</dt>
                        <dd class="col-6 count"></dd>
                    </dl>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">

                </div>

            </div> 
        </div>
    </div>
</div>
<?//include 'edit_account.php';?>
<script>
    var roles = [];
    var accounts = [];
    var account_id = 0;
    {
        var someStop = false;
        var className = "";
    }
    $(document).ready(function () {
        // init_roles_list();

        // init_get_account_all();
        // init_edit_account();
        console.log("READY");
    });
    function enableStopBtn()
    {
    	var stopBtn = document.querySelector('.card-body .btn-secondary');
        stopBtn.classList.add("btn-danger");
        stopBtn.classList.remove("disabled");
        stopBtn.classList.remove("btn-secondary");
    }
    function disaleStopBtn()
    {
    	var stopBtn = document.querySelector('.card-body .btn-danger');
        stopBtn.classList.add("disabled");
        stopBtn.classList.remove("btn-danger");
        stopBtn.classList.add("btn-secondary");
    }
    function startPassData(button)
    {
        enableStopBtn();
        button.classList.add("disabled");
        button.classList.add("btn-secondary");
        if(button.classList.contains('btn-info'))
        {
        	className = "btn-info";
        	button.classList.remove("btn-info");
        }
        else if(button.classList.contains('btn-success'))
        {
        	className = "btn-success";
        	button.classList.remove("btn-success");
        }
        if(className == "btn-info")
        {
        	getUsersData();
        }
        else if(className == "btn-success")
        {
        	getUserDataToday();
        }
    }
    function setSomeStop()
    {
        someStop = true;
    }
    function stopPassData()
    {
        var someBtn = document.querySelector('.card-body .btn-secondary');
        someBtn.classList.remove("disabled");
        someBtn.classList.remove("btn-secondary");
        someBtn.classList.add(className);
        disaleStopBtn();
    }
    function getUserDataToday()
    {
    	console.log('userdatatoday');
        sendPostLigth('/jpost.php?extension=webhook',
            {"user_payments_today": 1},
            function (e) {
                console.log(e);
                if(e['data']['result'] == "end" || e['data']['result'] == true)
                {
                    stopPassData();
                    return false;
                }
                else
                {
                    var dd = document.querySelector(".count");
                    dd.innerHTML = "Данные переданы";
                    // setTimeout(getUsersData,200);
                }
            });
    }
    /*
     * получить данные пользователей по продажам и последним входам
     */
    function getUsersData()
    {
        console.log('userdata');
        sendPostLigth('/jpost.php?extension=webhook',
            {"user_payments": 1},
            function (e) {
                console.log(e);
                if(e['data'] == "end" || someStop)
                {
                    stopPassData();
                    return false;
                }
                else
                {
                    var dd = document.querySelector(".count");
                    dd.innerHTML = e['data']['count'];
                    setTimeout(getUsersData,200);
                }
                // var tkn = localStorage.getItem('token');
                // var tkn = 'sdfgaek;lg@#$%@#$Y$%Y';
                // if(!tkn)
                // {
                    // sendpPulseAuthorize();
                    // tkn = localStorage.getItem('token');
                // }
                // $.ajax({
                //     url: "https://api.sendpulse.com/addressbooks/89384270/emails",
                //     type: 'POST',
                //     data: e['data'],
                //     headers:{
                //         'X-Requested-With': 'XMLHttpRequest',
                //         // 'Access-Control-Allow-Origin':'*',
                //         // 'Access-Control-Allow-Methods':'GET, POST',
                //         // 'Access-Control-Allow-Headers':'Content-Type, Authorization',
                //         'Authorization':'Bearer '+tkn,
                //     },
                //     success: function(result)
                //     {
                //         console.log("some success");
                //     },
                //     error: function(request, status, error)
                //     {
                //         console.log("some error");
                //         console.log(request);
                //         console.log(status);
                //         console.log(error);
                //     }
                // });
            });
    }
    /*
     * авторизоваться в sendpulse
     */
    // function sendpPulseAuthorize()
    // {
    //     var authUrl = "https://api.sendpulse.com/oauth/access_token";
    //     $.ajax({
    //        url: authUrl,
    //        type: 'POST',
    //        data: {grant_type:"client_credentials", client_id:"1e2246d5cf334cf3490810cc11ecc80a", client_secret:"d2f5d50a9981d9d399abecc1c5d812f7"},
    //        // contentType: 'application/json',
    //        headers: {
    //           'X-Requested-With': 'XMLHttpRequest'
    //        },
    //        success: function (result) {
    //             console.log(result);
    //             localStorage.setItem('token',result['access_token']);
    //            // CallBack(result);
    //        },
    //        error: function (error) {
    //             console.log(error);
    //        }
    //     });
    // }
    
</script>    