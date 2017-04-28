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

// datetime 
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

    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // Sanitize Data

    // text boxes
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;
    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;
    $phoneNumber = htmlentities($_POST["txtPhoneNumber"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $phoneNumber;
    $partySize = htmlentities($_POST["txtPartySize"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $partySize;

    // date/time stamp (dts)
    $resDateTime = htmlentities($_POST["dtsReservation"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $resDateTime;

    // dropdown
    $location = htmlentities($_POST["lstLocation"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $location;

    // radio buttons
    $specOccasion = htmlentities($_POST["radOccasion"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $specOccasion;

    // check boxes
    if(isset($_POST["chkAdult"])) {
        $ageAdult = true;
        $totalChecked++;
    } else {
        $ageAdult = false;
    }
    $dataRecord[] = $ageAdult;
    if(isset($_POST["chkChild"])) {
        $ageChild = true;
        $totalChecked++;
    } else {
        $ageChild = false;
    }
    $dataRecord[] = $ageChild;
    if(isset($_POST["chkInfant"])) {
        $ageInfant = true;
        $totalChecked++;
    } else {
        $ageInfant = false;
    }
    $dataRecord[] = $ageInfant;

    // text area
    $comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $comments;

    // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // Validate Data


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
