<div class="sidebar-scrollbar">
    <!-- sidebar menu -->
    <ul style="margin: 0;padding: 0;" class="nav sidebar-inner" id="sidebar-menu">
        <li style="margin: 0;padding: 0;" class="has-sub">
            <a class="sidenav-item-link" href="/" >
                <i class="mdi mdi-home"></i>
                <span class="nav-text">На главную</span> 
            </a>
        </li>
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'office') ? 'active' : '' ?> expand" >
            <a class="sidenav-item-link <?= ($_GET['katalog'] == $value['id']) ? 'active' : '' ?>" href="javascript:void(0)" >
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span class="nav-text">Каталог</span> 
            </a> 
            <ul style="margin: 0;padding: 0;display: block;" class="collapse office_list_categorys <?=
            (isset($_GET['katalog'])) ? 'show' : ''
            ?>"  id="system_configs"
                 data-parent="#sidebar-menu">
                <div class="sub-menu" style="display: block;">
                    <li style="margin: 0;padding: 0;display: block;" class="<?= ($_GET['katalog'] == $value['id']) ? 'active' : '' ?>">
                        <a class="sidenav-item-link" href="/office/?katalog">
                            <span class="nav-text">Все</span>
                            (<span class="katalog_elm_col_all">0</span>)
                        </a>
                    </li>
                    <?
                    include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/category/inc.php';
                    $c_category = new \project\category();
                    $categorys = $categoryArray = $c_category->getCategoryArray('product_category', '');
                    foreach ($categorys as $key => $value) {
                        ?>
                        <li style="margin: 0;padding: 0;" class="<?= ($_GET['katalog'] == $value['id']) ? 'active' : '' ?>">
                            <a class="sidenav-item-link" href="/office/?katalog=<?= $value['id'] ?>">
                                <span class="nav-text"><?= $value['title'] ?></span>
                                (<span class="katalog_elm_col_<?= $value['id'] ?>">0</span>)
                            </a>
                        </li>
                        <?
                    }
                    ?>
                    <!--    
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
                    -->
                </div>
            </ul>
        </li>
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'webinars') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="	/office/webinars/">
                <i class="mdi mdi-message-video"></i>
                <span class="nav-text">Вебинары</span> 
            </a> 
        </li>
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'userprofile_admin') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="	/office/userprofile_admin/">
                <i class="mdi mdi-calendar-today"></i>
                <span class="nav-text">Настройки</span> 
            </a> 
        </li>
    </ul>
</div>