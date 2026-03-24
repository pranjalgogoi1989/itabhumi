<ul class="menu-inner py-1">

    <?php
    function isActive($pageName) {
        return basename($_SERVER['PHP_SELF']) == $pageName ? 'active' : '';
    }
    ?>
    <!-- Dashboard -->
    <li class="menu-item <?= isActive('index.php') ?>">
        <a href="/staff" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    <li class="menu-item <?= isActive('districts.php') ?>">
        <a href="/staff/districts.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Districts</div>
        </a>
    </li>
    <li class="menu-item <?= isActive('circles.php') ?>">
        <a href="/staff/circles.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Circles</div>
        </a>
    </li>



    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i><div data-i18n="Layouts">Land Parcel</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item"><a href="/staff/new_allot.php" class="menu-link"><div data-i18n="Blank">Add New</div></a></li>
            <li class="menu-item"><a href="/staff/land_parcel_all.php" class="menu-link"><div data-i18n="Blank">All Records</div></a></li>
            <li class="menu-item"><a href="/staff/search_land_parcel.php" class="menu-link"><div data-i18n="Fluid">Search Land Parcel</div></a></li>
        </ul>
    </li>
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i><div data-i18n="Layouts">Chitha Register</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item"><a href="/staff/chitha_register.php" class="menu-link"><div data-i18n="Blank">Add New</div></a></li>
            <li class="menu-item"><a href="/staff/chitha_register_all.php" class="menu-link"><div data-i18n="Blank">All Records</div></a></li>
            <li class="menu-item"><a href="/staff/search_chitha_details.php" class="menu-link"><div data-i18n="Blank">Search Chitha Details</div></a></li>
        </ul>
    </li>
    
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i><div data-i18n="Layouts">Land Allot</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item"><a href="/staff/land_allot.php" class="menu-link"><div data-i18n="Blank">Add New</div></a></li>
            <li class="menu-item"><a href="/staff/land_allot_all.php" class="menu-link"><div data-i18n="Blank">All Records</div></a></li>
            <li class="menu-item"><a href="/staff/search_land_allot.php" class="menu-link"><div data-i18n="Blank">Search Land Details</div></a></li>
        </ul>
    </li>

    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i><div data-i18n="Layouts">Administration</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item"><a href="/staff/users.php" class="menu-link"><div data-i18n="Blank">Users</div></a></li>
        </ul>
    </li>
    <!-- <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i><div data-i18n="Layouts">Reports</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item"><a href="/staff/search_chitha_details.php" class="menu-link"><div data-i18n="Blank">Chitha</div></a></li>
            <li class="menu-item"><a href="/staff/search_land_parcel.php" class="menu-link"><div data-i18n="Fluid">Land Parcel</div></a></li>
            <li class="menu-item"><a href="/staff/search_land_allot.php" class="menu-link"><div data-i18n="Fluid">Land Allotment</div></a></li>
        </ul>
    </li> -->
    

    <li class="menu-item <?= isActive('/logout.php') ?>">
        <a href="/logout.php" class="menu-link">
            <i class="bx bx-power-off me-2"></i>
            <div data-i18n="Analytics">Logout</div>
        </a>
    </li>
</ul>