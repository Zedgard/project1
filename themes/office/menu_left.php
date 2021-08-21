<div class="sidebar-scrollbar" style="overflow: auto;">
    <!-- sidebar menu -->
    <ul style="margin: 0;padding: 0;" class="nav sidebar-inner" id="sidebar-menu">
        <!-- 
        <li style="margin: 0;padding: 0;" class="has-sub">
            <a class="sidenav-item-link" href="/" >
                <i class="mdi mdi-home"></i>
                <span class="nav-text">На главную</span> 
            </a>
        </li>
        -->
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'office') ? 'active' : '' ?> expand" >
            <a class="sidenav-item-link <?= ($_GET['katalog'] == $value['id']) ? 'active' : '' ?>" href="/office/?katalog">
                <i class="mdi mdi-basket"></i>
                <span class="nav-text">Мои товары</span> 
            </a> 
            <ul style="margin: 0;padding: 0;display: none;" class="collapse office_list_categorys <?=
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
                        if (trim($value['title']) == 'Вебинары' || trim($value['title']) == 'Марафоны') {
                            continue;
                        }
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
                </div>
            </ul>
        </li>
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'keise') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/office/keise/">
                <i class="mdi mdi-message-video"></i>
                <span class="nav-text">Кейсы</span> 
            </a> 
        </li>
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'online_trenings') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/office/online_trenings/">
                <i class="mdi mdi-message-video"></i>
                <span class="nav-text">Тренинги</span> 
            </a> 
        </li>
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'marathons') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/office/marathons/">
                <i class="mdi mdi-message-video"></i>
                <span class="nav-text">Марафоны</span> 
            </a> 
        </li>
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'webinars') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/office/webinars/">
                <i class="mdi mdi-message-video"></i>
                <span class="nav-text">Вебинары</span> 
            </a> 
        </li>
        <li style="margin: 0;padding: 0;display: block;" class="has-sub <?= ($_SESSION['page_url'] == 'club') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/office/club/">
                <i class="mdi mdi-cloud-alert"></i>
                <span class="nav-text">Закрытый<br/>КЛУБ</span> 
            </a> 
        </li>
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'shopping') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/office/shopping/">
                <i class="mdi mdi-cart"></i>
                <span class="nav-text">Покупки</span> 
            </a> 
        </li>
        <li style="margin: 0;padding: 0;" class="has-sub <?= ($_SESSION['page_url'] == 'userprofile_admin') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="/office/userprofile_admin/">
                <i class="mdi mdi-calendar-today"></i>
                <span class="nav-text">Настройки</span> 
            </a> 
        </li>
    </ul>
</div>