<?php include "_includes/top.php";?>
<?php include "_includes/nav.php";?>
<?php
	include "_lib/print_menu.php";
	$chicago_menu_arr = json_decode(file_get_contents("_data/chicago_menu.json"), true);
?>
<div>
	<?php if ($chicago_menu_arr) print_menu_dl($chicago_menu_arr); ?>
</div>
<?php include "_includes/footer.php";?>
