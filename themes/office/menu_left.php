<div class="sidebar-scrollbar">
    <!-- sidebar menu -->
    <ul class="nav sidebar-inner" id="sidebar-menu">
        <li  class="has-sub <?= ($_SESSION['page_url'] == 'office') ? 'active' : '' ?> expand" >
            <a class="sidenav-item-link" href="/office/" >
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span class="nav-text">Главная</span> 
            </a> 
        </li>
        <li  class="has-sub <?= ($_SESSION['page_url'] == 'webinars') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="	/office/webinars/">
                <i class="mdi mdi-message-video"></i>
                <span class="nav-text">Вебинары</span> 
            </a> 
        </li>
        <li  class="has-sub <?= ($_SESSION['page_url'] == 'userprofile_admin') ? 'active' : '' ?> ">
            <a class="sidenav-item-link" href="	/office/userprofile_admin/">
                <i class="mdi mdi-calendar-today"></i>
                <span class="nav-text">Настройки</span> 
            </a> 
        </li>
    </ul>
</div>