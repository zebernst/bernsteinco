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

	    // setup path prefixing
	    $host  = parse_url($domain, PHP_URL_HOST); // get url hostname (i.e. zebernst.w3.uvm.edu)
		$netid = explode('.', $host)[0]; // extract netid from hostname
		$root  = $_SERVER['DOCUMENT_ROOT']; // contains filesystem folder (e.g. /users/z/e/zebernst)

		if ($netid == "makissel") {
			$rootFolder = "/final";
		} elseif ($netid == "ohurd") {
			$rootFolder = "/cs008/bernsteinco-master";
		} else {
			$rootFolder = "/bernsteinco";
		}
		$root .= $rootFolder; // adds root subdirectory to filesystem path (i.e. it's not in the server root, but in a subfolder.)
		// $root is used when including php resources or files, as it's a file path.
		// $rootFolder is used to prefix on links in html, primarily for the purpose of making links 
		// relative to root (but root differs from person to person, as seen in the $rootFolder variable.)
    ?>
	<head>
		<title>Bernstein &amp; Co. | <?php print ucfirst($path_parts['filename']); ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php print $rootFolder; ?>/favicon.ico">
		<meta charset="utf-8">
		<meta name="author" content="Zach Bernstein, Maria Kissel, Liv Hurd">
		<meta name="description" content="Bernstein &amp; Co. Steakhouse">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- include css stylesheets -->
		<link rel="stylesheet" href="<?php print $rootFolder; ?>/_css/site.css" type="text/css" media="screen">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|Pacifico|Raleway" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
        <?php
		// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		// %%    include libraries    %%
		// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%

        print "\n" . "<!-- include libraries -->" . "\n";
        require_once($root . '/_lib/security.php'); // force require security functions
		?>
	</head>
	<!-- begin body -->
	<body id="<?php print $path_parts['filename']; ?>">
		<header>
			<p> Bernstein &amp; Co. </p>
		</header>
