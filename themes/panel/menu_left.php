<div class="sidebar-scrollbar">

    <!-- sidebar menu -->
    <ul class="nav sidebar-inner" id="sidebar-menu">

        <li  class="has-sub <?= ($_SESSION['page_url'] == 'admin') ? 'active' : '' ?> expand" >
            <a class="sidenav-item-link" href="/admin/" >
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span class="nav-text">Статистика</span> 
            </a> 
        </li>

        <li  class="has-sub <?= ($_SESSION['page_url'] == 'consultation_edit') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/consultation_edit/">
                <i class="mdi mdi-calendar-today"></i>
                <span class="nav-text">Консультации</span> 
            </a> 
        </li>

        <li  class="has-sub <?= ($_SESSION['page_url'] == 'pay') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/pay/">
                <i class="mdi mdi-cart"></i>
                <span class="nav-text">Покупки </span> <span class="not_processed_col"></span>
            </a> 
        </li>

        <li  class="has-sub <?= ($_SESSION['page_url'] == 'products') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/products/">
                <i class="mdi mdi-shopping"></i>
                <span class="nav-text">Каталог</span> 
            </a> 
        </li>

        <li  class="has-sub <?= ($_SESSION['page_url'] == 'wares') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/wares/">
                <i class="mdi mdi-basket"></i>
                <span class="nav-text">Товары</span> 
            </a>
        </li>


        <li  class="has-sub <?= ($_SESSION['page_url'] == 'pages') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/pages/">
                <i class="mdi mdi-library-books"></i>
                <span class="nav-text">Страницы</span> 
            </a>
        </li>
        <li  class="has-sub <?= ($_SESSION['page_url'] == 'menu') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/menu/">
                <i class="mdi mdi-menu"></i>
                <span class="nav-text">Меню</span> 
            </a>
        </li>

        <li  class="has-sub <?= ($_SESSION['page_url'] == 'admin_users') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/admin_users/">
                <i class="mdi mdi-account-box"></i>
                <span class="nav-text">Пользователи</span> 
            </a>
        </li>

        <li  class="has-sub <?= ($_SESSION['page_url'] == 'get_emails') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/admin/get_emails/">
                <i class="mdi mdi-email-open"></i>
                <span class="nav-text">Подписчики</span> <span class="get_emails_col"></span>
            </a>
        </li>

        <li  class="has-sub" >
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#system_configs"
               aria-expanded="false" aria-controls="system_configs">
                <i class="mdi mdi-pencil-box-multiple"></i>
                <span class="nav-text">Настройки</span> <b class="caret"></b>
            </a>
            <ul  class="collapse <?=
            (
            $_SESSION['page_url'] == 'system_configs' ||
            $_SESSION['page_url'] == 'config_emails' ||
            $_SESSION['page_url'] == 'template'
            ) ? 'show' : ''
            ?>"  id="system_configs"
                 data-parent="#sidebar-menu">
                <div class="sub-menu">


                    <li class="<?= ($_SESSION['page_url'] == 'system_configs') ? 'active' : '' ?>">
                        <a class="sidenav-item-link" href="/admin/system_configs/">
                            <span class="nav-text">Настройки сайта</span>

                        </a>
                    </li>

                    <li class="<?= ($_SESSION['page_url'] == 'config_emails') ? 'active' : '' ?>" >
                        <a class="sidenav-item-link" href="/admin/config_emails/">
                            <span class="nav-text">Почтовые оповещения</span>
                        </a>
                    </li>
                    <li class="<?= ($_SESSION['page_url'] == 'template') ? 'active' : '' ?>" >
                        <a class="sidenav-item-link" href="/admin/template/">
                            <span class="nav-text">Шаблоны</span>
                        </a>
                    </li>

                    <!--
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
                    -->
                </div>
            </ul>
        </li>
        <li  class="has-sub <?= ($_SESSION['page_url'] == 'help') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/help/" target="_blank">
                <i class="mdi mdi-wikipedia"></i>
                <span class="nav-text">Справка</span> 
            </a>
        </li>
    </ul>
    <div style="height: 300px;"></div>
</div>