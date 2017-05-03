<?php
function print_menu_dl($menu_arr) {
	foreach ($menu_arr as $menuSection => $menuItems) {
		print "<p class='menu-section'>" . ucwords($menuSection) . "</p>";
		print "<dl>";
		foreach ($menuItems as $menuItem) {
			$itemName = $menuItem['dish'];
			$itemCost = $menuItem['price'];
			$itemDesc = $menuItem['description'];
			print "<dt><span>$itemName</span><span>$itemCost</span></dt>";
			print "<dd>$itemDesc</dd>";
		}
		print "</dl>";
	}
}
?>
