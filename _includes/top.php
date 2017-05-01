<!DOCTYPE html>
<html lang="en">
    <?php
        // %%%%%%%%%%%%%%%%%%%%%%
        // %%    path setup    %%
        // %%%%%%%%%%%%%%%%%%%%%%

        $domain  = "//";
        $server  = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");
        $domain .= $server;

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
        $path_parts = pathinfo($phpSelf);
    ?>
	<head>
		<title>Bernstein &amp; Co. | <?php print ucfirst($path_parts['filename']); ?></title>

		<meta charset="utf-8">
		<meta name="author" content="Zach Bernstein, Maria Kissel, Liv Hurd">
		<meta name="description" content="Bernstein & Co. Steakhouse">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- include css stylesheets -->
		<link rel="stylesheet" href="_css/site.css" type="text/css" media="screen">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|Pacifico|Raleway" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php
		// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		// %%    include libraries    %%
		// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%

        print "\n" . "<!-- include libraries -->" . "\n";
        require_once('_lib/security.php');

        if ($path_parts['filename'] == "reservations") {
            include "lib/validation-functions.php";
            include "lib/mail-message.php";
        }
		?>
	</head>
	<!-- begin body -->
    <?php print '    <body id="' . $path_parts['filename'] . '">'; ?>
		<header>
			<p> Bernstein &amp; Co. </p>
		</header>
														 
														 
