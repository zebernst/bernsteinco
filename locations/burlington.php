<?php include "../_includes/top.php";?>
<?php include "../_includes/nav.php";?>
<article class="actLocation">
    <div class="location">
        <h1>Burlington, Vermont</h1>
        <div class="locBox">
            <p>
                <i class="fa fa-home" aria-hidden="true"></i>
                <a target="_blank" class="address" href="//www.google.com/maps/place/7+Church+St,+Burlington,+VT+05401">
                    7 Church St.<br>
                    Burlington, VT 05401
                </a>
            </p>
            <p>
                <i class="fa fa-phone" aria-hidden="true"></i>
                <a class="phone" href="tel:802-576-8492">(802)-576-8492</a>
            </p>
            <div class="hours">
                <h2>Hours</h2>
                <p><strong><u>Monday-Friday:</u> 11am - 11pm</strong></p>
                <p><strong><u>Saturday-Sunday:</u> 10am - 11pm</strong></p>
            </div>
            <h2><a href="<?php print $rootFolder; ?>/menu_vermont.php" target="_blank"> Menu </a></h2>
        </div>
    </div>
    <div class="reserveNow">
        <p>
            <a href="<?php print $rootFolder; ?>/reservations.php">Reserve now!</a>
        </p>
    </div>
    <p id="extra">
        <br> 
    </p>
</article>
<?php include "../_includes/footer.php";?>
