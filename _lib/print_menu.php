<?php
function print_menu_dl($menu_arr) {
	foreach ($menu_arr as $menuSection => $menuItems) {
		print "<p class='menu-section'>" . ucwords($menuSection) . "</p>\n";
		print "<dl>\n";
		foreach ($menuItems as $menuItem) {
			$itemName = $menuItem['dish'];
			$itemCost = $menuItem['price'];
			$itemDesc = $menuItem['description'];
			
			print "<dt><span>$itemName</span><span>$itemCost</span></dt>\n";
			print "<dd>$itemDesc</dd>\n";
		}
		print "</dl>\n";
	}
}
?>
