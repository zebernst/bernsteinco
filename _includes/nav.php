<!-- main navigation -->
<nav>
    <ol>
        <?php
        print '<li class="';
        if ($path_parts['filename'] == "index") {
            print 'activePage';
        }
        print '">';
        print '<a href="index.php">Home</a>';
        print '</li>';

		print '<li class="';
        if ($path_parts['filename'] == "about") {
            print 'activePage';
        }
        print '">';
        print '<a href="about.php">About</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "menu") {
            print 'activePage';
        }
        print '">';
        print '<a href="menu.php">Menu</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "locations") {
            print 'activePage';
        }
        print '">';
        print '<a href="locations.php">Locations</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "reservations") {
            print 'activePage';
        }
        print '">';
        print '<a href="reservations.php">Reservations</a>';
        print '</li>';
        ?>
    </ol>
</nav>
