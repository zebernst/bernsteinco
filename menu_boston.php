<?php include "_includes/top.php";?>
<?php include "_includes/nav.php";?>
<article class="actMenu">
<?php
	include "_lib/print_menu.php";
	$boston_menu_arr = json_decode(file_get_contents("_data/boston_menu.json"), true);
?>
<div>
	<?php if ($boston_menu_arr) print_menu_dl($boston_menu_arr); ?>
</div>
	   <p id="extra"> <br/> </p>
</article>
<?php include "_includes/footer.php";?>
