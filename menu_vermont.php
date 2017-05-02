<?php include "_includes/top.php";?>
<?php include "_includes/nav.php";?>
<?php
	include "_lib/print_menu.php";
	$vermont_menu_arr = json_decode(file_get_contents("_data/vermont_menu.json"), true);
?>
<div>
	<?php if ($vermont_menu_arr) print_menu_dl($vermont_menu_arr); ?>
</div>
<?php include "_includes/footer.php";?>
