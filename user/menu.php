<ul class="menu-inner py-1">

    <?php
    function isActive($pageName) {
        return basename($_SERVER['PHP_SELF']) == $pageName ? 'active' : '';
    }
    ?>
    <!-- Dashboard -->
    <li class="menu-item <?= isActive('index.php') ?>">
        <a href="/user" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    <li class="menu-item <?= isActive('land_allot.php') ?>">
        <a href="/user/land_allot.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Land Allotment</div>
        </a>
    </li>
    <li class="menu-item <?= isActive('profile.php') ?>">
        <a href="/user/profile.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">My Profile</div>
        </a>
    </li>
    <li class="menu-item <?= isActive('/logout.php') ?>">
        <a href="/logout.php" class="menu-link">
            <i class="bx bx-power-off me-2"></i>
            <div data-i18n="Analytics">Logout</div>
        </a>
    </li>
    
</ul>