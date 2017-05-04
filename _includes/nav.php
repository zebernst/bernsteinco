<!-- main navigation -->
<nav>
    <ol>
        <?php
        include $root . "/_lib/navitem.php";
        navitem($rootFolder . '/home.php','Home');
		navitem($rootFolder . '/about.php','About');
        navitem($rootFolder . '/menu.php','Menu');
        navitem($rootFolder . '/locations.php','Locations');
        navitem($rootFolder . '/reservations.php','Reservations')
        ?>
    </ol>
</nav>
