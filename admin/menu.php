<ul class="menu-inner py-1">

    <?php
    function isActive($pageName) {
        return basename($_SERVER['PHP_SELF']) == $pageName ? 'active' : '';
    }
    ?>
    <!-- Dashboard -->
    <li class="menu-item <?= isActive('index.php') ?>">
        <a href="/admin" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    <li class="menu-item <?= isActive('districts.php') ?>">
        <a href="/admin/districts.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Districts</div>
        </a>
    </li>
    <li class="menu-item <?= isActive('circles.php') ?>">
        <a href="/admin/circles.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Circles</div>
        </a>
    </li>

    <li class="menu-item <?= isActive('new_allot.php') ?>">
        <a href="/admin/new_allot.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Land Parcel</div>
        </a>
    </li>

    <li class="menu-item <?= isActive('chitha_register.php') ?>">
        <a href="/admin/chitha_register.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Chitha Register</div>
        </a>
    </li>

    <li class="menu-item <?= isActive('land_allot.php') ?>">
        <a href="/admin/land_allot.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Land Allot</div>
        </a>
    </li>

    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-layout"></i><div data-i18n="Layouts">Reports</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item"><a href="/admin/search_chitha_details.php" class="menu-link"><div data-i18n="Blank">Chitha</div></a></li>
            <li class="menu-item"><a href="/admin/search_land_parcel.php" class="menu-link"><div data-i18n="Fluid">Land Parcel</div></a></li>
            <li class="menu-item"><a href="/admin/search_land_allot.php" class="menu-link"><div data-i18n="Fluid">Land Allotment</div></a></li>
        </ul>
    </li>
    
</ul>