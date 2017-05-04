<?php
function navitem($linkFile, $linkText) {
    global $path_parts; // get global variable $path_parts
    $path_filename = $path_parts['filename'];
    $link_filename = pathinfo($linkFile)['filename']; // get filename part of passed link

    $activePage = ($path_filename == $link_filename) ? "activePage" : ""; // use ternary operator to set $activePage only if the page is the one being currently visited.
    print "<li>";
    print "<a class='navItem $activePage' href='$linkFile'>$linkText</a>";
    print "</li>";
}
?>
