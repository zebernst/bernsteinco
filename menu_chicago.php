<?php include "_includes/top.php";?>
<?php include "_includes/nav.php";?>
<article class="actMenu">
    <div>
        <?php
		include "_lib/print_menu.php";
		$chicago_menu_arr = json_decode(file_get_contents("_data/chicago_menu.json"), true);
		if ($chicago_menu_arr) print_menu_dl($chicago_menu_arr);
		?>
    </div>
    <p id="extra">
        <br>
    </p>
</article>
<?php include "_includes/footer.php";?>
