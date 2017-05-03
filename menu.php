<?php include "_includes/top.php";?>
<?php include "_includes/nav.php";?>
<?php
	$debug = false;
	if (isset($_GET["debug"])) {
    	$debug = true;
	}
	include "_lib/print_menu.php";
	$boston_menu_arr = json_decode(file_get_contents("_data/boston_menu.json"), true);
	$vermont_menu_arr = json_decode(file_get_contents("_data/vermont_menu.json"), true);
	$chicago_menu_arr = json_decode(file_get_contents("_data/chicago_menu.json"), true);
	
?>

<article class="menu">
<h1>Menu</h1>
	<h2> Select your location </h2>
	<figure class="boston">
		<a href="menu_boston.php" </a>
		<img src="_media/boston.jpg" alt="boston photo">
		<h1> Boston </h1>
	</figure>
	<figure class="burlington">
		<a href="menu_burlingon.php" </a>
		<img src="_media/burlington.jpg" alt="burlington photo">
		<h1> Burlington </h1>
	</figure>
	<figure class="chicago">
		<a href="menu_chicago.php" </a>
		<img src="_media/chicago.jpg" alt="chicago photo">
		<h1> Chicago </h1>
	</figure>
	<p id="extra"> <br/> </p>
</article>


<?php include "_includes/footer.php";?>

