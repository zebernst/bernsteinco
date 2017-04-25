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
        if ($path_parts['filename'] == "locations") {
            print 'activePage';
        }
        print '">';
        print '<a href="locations.php">Locations</a>';
        print '</li>';

        // TODO: make "About" a dropdown menu and choose between "about the restaurant" and "about the founders"
        print '<li class="';
        if ($path_parts['filename'] == "about" or $path_parts['filename'] == "owners") {
            print 'activePage';
        }
        print '">';
        print '<a href="about.php">About</a>';
        print '</li>';
        ?>
    </ol>
</nav>
