<?php include "_includes/top.php";?>
<?php include "_includes/nav.php"; ?>
<h1>Reservations</h1>
<?php
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// Print out _POST array for debugging purposes
$debug = false;
if (isset($_GET["debug"])) $debug = true;

if($debug) {
	print '<p>_POST Array:</p><pre>';
	print_r($_POST);
	print '</pre>';
}

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// %%%% Initialize Variables %%%%
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

// Form Variables
//
// text boxes
$firstName = '';
$lastName = '';
$email = '';
$phoneNumber = '';
$partySize = '';

// datetime picker
$resDateTime = '';

// dropdown
$location = 'Select a location...';

// radio buttons
$specOccasion = 'None';

// check boxes
$ageAdult = false;
$ageChild = false;
$ageInfant = false;
$totalChecked = 0;

// text area
$comments = '';

// %%%%%%%%%%%%%%%%%%%%%
// %%%% Error Flags %%%%
// %%%%%%%%%%%%%%%%%%%%%

// text boxes
$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;
$phoneNumberERROR = false;
$partySizeERROR = false;

// datetime
$resDateTimeERROR = false;

// dropdown
$locationERROR = false;

// radio buttons
$specOccasionERROR = false;

// check boxes
$ageERROR = false;


// %%%%%%%%%%%%%%%%%%%%%%%%
// %%%% Misc Variables %%%%
// %%%%%%%%%%%%%%%%%%%%%%%%

// array to hold error messages
$errorMsg = array();
// data array to write to CSV
$dataRecord = array();
// have we mailed the user?
$mailed = false;


// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// %%%% Process Form Submission %%%%
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if (isset($_POST["btnSubmit"])) {

	// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	// Security
	$thisURL = $domain . $phpSelf;

	if (!securityCheck($thisURL)) {
        $msg = "<p>Sorry, you cannot access this page. ";
        $msg .= "A security breach has been detected and reported.</p>";
        die($msg);
    }

    

    
/*
- Drop down for which location √
- Name of person (first and last) √
- Date/Time of Reservation √
- Phone number √
- Email √
- Number of people √
- Anything we should know (comments box)
- radio buttons (special occasion): graduation, anniversary, wedding, etc. √
- who's coming: adult, child, infant (for menu types and baby chairs)
- Submit Button
*/

?>
<?php include "_includes/footer.php ";?>
