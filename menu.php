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
	<div id="menuBox">
<p><a href='menu_boston.php'>Boston, Massachusetts</a></p>
<p><a href='menu_vermont.php'>Burlington, Vermont</a></p>
<p><a href='menu_chicago.php'>Chicago, Illinois</a></p>
	</div>
	<p id="extra"> <br/> </p>
</article>


<?php include "_includes/footer.php";?>

