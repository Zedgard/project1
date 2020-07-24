<div class="sidebar-scrollbar">

    <!-- sidebar menu -->
    <ul class="nav sidebar-inner" id="sidebar-menu">



        <li  class="has-sub <?= ($_SESSION['page_url'] == 'admin') ? 'active' : '' ?> expand" >
            <a class="sidenav-item-link" href="/admin/" >
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span class="nav-text">Статистика</span> 
            </a>
        </li>

        <li  class="has-sub <?= ($_SESSION['page_url'] == 'pages') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/pages/">
                <i class="mdi mdi-image-filter-none"></i>
                <span class="nav-text">Страницы</span> </b>
            </a>

        </li>
        <li  class="has-sub <?= ($_SESSION['page_url'] == 'admin_users') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/admin_users/">
                <i class="mdi mdi-image-filter-none"></i>
                <span class="nav-text">Пользователи</span> </b>
            </a>

        </li>



        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#system_configs"
               aria-expanded="false" aria-controls="system_configs">
                <i class="mdi mdi-pencil-box-multiple"></i>
                <span class="nav-text">Настройки</span> <b class="caret"></b>
            </a>
            <ul  class="collapse <?= ($_SESSION['page_url'] == 'system_configs') ? 'show' : '' ?>"  id="system_configs"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">


                    <li class="<?= ($_SESSION['page_url'] == 'system_configs') ? 'active' : '' ?>">
                        <a class="sidenav-item-link" href="/admin/system_configs/">
                            <span class="nav-text">Настройки сайта <?= $_SESSION['page_url'] ?></span>

                        </a>
                    </li>

                    <li >
                        <a class="sidenav-item-link" href="/admin/other_config/">
                            <span class="nav-text">Другие настройки</span>

                        </a>
                    </li>

                    <li >
                        <a class="sidenav-item-link" href="/admin/langs/">
                            <span class="nav-text">Переводы сайта</span>

                        </a>
                    </li>

                    <li >
                        <a class="sidenav-item-link" href="/metrix/">
                            <span class="nav-text">Метрики и счетчики</span>
                        </a>
                    </li>

                </div>
            </ul>
        </li>




    </ul>

</div>