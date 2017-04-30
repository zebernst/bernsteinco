<?php include "_includes/top.php";?>
<?php include "_includes/nav.php"; ?>
<article class="locations">
<h1>Our Locations</h1>
<figure id="map">
    <img src="_media/map.png" alt="Clickable map of restaurant locations" usemap="#map">
    <map name="map">
        <area shape="rectangle" 
              alt="Burlington" 
              coords="845,124,885,165" 
              href="burlington.php">

        <area shape="rectangle" 
              alt="Boston " 
              coords="885,170,931,213" 
              href="boston.php ">
              
       <area shape="rectangle " 
              alt="Chicago" 
              coords="603,216,657,267" 
              href="chicago.php ">       
    </map>
    <figcaption>Click one of our three locations for more information!</figcaption>
</figure>
                                 </article>
<?php include "_includes/footer.php ";?>
