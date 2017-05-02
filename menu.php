<?php include "_includes/top.php";?>
<?php include "_includes/nav.php";?>
<?php
	$debug = false;
	if (isset($_GET["debug"])) {
    	$debug = true;
	}

	$boston_menu_arr = json_decode(file_get_contents("_data/boston_menu.json"), true);
	$vermont_menu_arr = json_decode(file_get_contents("_data/vermont_menu.json"), true);
	$chicago_menu_arr = json_decode(file_get_contents("_data/chicago_menu.json"), true);

	function print_menu_dl($menu_arr) {
		foreach ($menu_arr as $menuSection => $menuItems) {
			print "<p class='menu-section'>" . ucwords($menuSection) . "</p>";
			print "<dl>";
			foreach ($menuItems as $menuItem) {
				$itemName = $menuItem['dish'];
				$itemCost = $menuItem['price'];
				$menuDesc = $menuItem['description'];
				print "<dt><span>$itemName</span><span>$itemCost</span></dt>";
				print "<dd>$itemDesc</dd>";
			}
			print "</dl>";
		}
	}
	
?>

<article class="menu">
<h1>Menu</h1>
<p>Boston</p>
<div><?php if ($boston_menu_arr) print_menu_dl($boston_menu_arr); ?></div>
<p>Burlington</p>
<div><?php if ($vermont_menu_arr) print_menu_dl($vermont_menu_arr); ?></div>
<p>Chicago</p>
<div><?php if ($chicago_menu_arr) print_menu_dl($chicago_menu_arr); ?></div>

</article>


<?php include "_includes/footer.php";?>

