<?php include "_includes/top.php"; ?>
<?php include "_includes/nav.php"; ?>
<article class="reservations">

    <?php
    //%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    //
    // Print out _POST array for debugging purposes
    $debug = isset($_GET["debug"]);

    if ($debug) {
        print '<p>_POST Array:</p><pre>';
        print_r($_POST);
        print '</pre>';
    }

    // Includes
    include $root . "/_lib/validation-functions.php";
    include $root . "/_lib/mail-message.php";

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

    // drop-down
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
    if (isset($_POST["btnReserve"])) {

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
        $specOccasion = htmlentities($_POST["radSpecOccasion"], ENT_QUOTES, "UTF-8");
        $dataRecord[] = $specOccasion;

        // check boxes
        if (isset($_POST["chkAdult"])) {
            $ageAdult = true;
            $totalChecked++;
        } else {
            $ageAdult = false;
        }
        $dataRecord[] = $ageAdult;
        if (isset($_POST["chkChild"])) {
            $ageChild = true;
            $totalChecked++;
        } else {
            $ageChild = false;
        }
        $dataRecord[] = $ageChild;
        if (isset($_POST["chkInfant"])) {
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

        // text boxes
        if ($firstName == "") {
            $errorMsg[] = "Please enter your first name.";
            $firstNameERROR = true;
        } elseif (!verifyAlphaNum($firstName)) {
            $errorMsg[] = "Your first name contains an invalid character.";
            $firstNameERROR = true;
        }
        if ($lastName == "") {
            $errorMsg[] = "Please enter your last name.";
            $lastNameERROR = true;
        } elseif (!verifyAlphaNum($lastName)) {
            $errorMsg[] = "Your last name contains an invalid character.";
            $lastNameERROR = true;
        }
        if ($email == "") {
            $errorMsg[] = "Email address cannot be blank.";
            $emailERROR = true;
        } elseif (!verifyEmail($email)) {
            $errorMsg[] = "The email address you entered is not a valid email address.";
            $emailERROR = true;
        }
        if ($phoneNumber == "") {
            $errorMsg[] = "Phone number cannot be blank.";
            $phoneNumberERROR = true;
        } elseif (!verifyPhone($phoneNumber)) {
            $errorMsg[] = "Your phone number appears to be invalid.";
            $phoneNumberERROR = true;
        }

        // datetime
        if ($resDateTime == "") {
            $errorMsg[] = "Please enter a date and time for your reservation.";
            $resDateTimeERROR = true;
        } elseif (!verifyTimeStamp($resDateTime)) {
            $errorMsg[] = "The date and time you entered are not in the correct format.";
            $resDateTimeERROR = true;
        }

        // dropdown
        if ($location == "") {
            $errorMsg[] = "Please select a restaurant location.";
            $locationERROR = true;
        } elseif ($location != "Chicago" AND $location != "Burlington" AND $location != "Boston") {
            $errorMsg[] = "Please select a valid restaurant location.";
            $locationERROR = true;
        }

        // radio buttons
        if ($specOccasion != "None" AND $specOccasion != "Birthday" AND $specOccasion != "Graduation" AND $specOccasion != "Anniversary" AND $specOccasion != "Wedding" AND $specOccasion != "Other") {
            $errorMsg[] = "Please indicate whether your party is celebrating a special occasion or not.";
            $specOccasionERROR = true;
        }

        // check boxes
        if ($totalChecked < 1) {
            $errorMsg[] = "Please choose at least one age group.";
            $ageERROR = true;
        }

        // not validating the comments textarea because a) it's optional, not required and b) I don't need to censor out
        // certain characters in it because htmlentities() will take care of any malicious code.

        // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // Process Form if Validation Successful
        if (!$errorMsg) {
            if ($debug) print '<p>Form is valid</p>';

            // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            // Save data to CSV
            $filename = "_data/reservations.csv";
            if ($debug) print "\n\n<p>filename is $filename";

            // open file for appending
            $file = fopen($filename, 'a');

            // write data
            fputcsv($file, $dataRecord);

            // close file
            fclose($file);

            // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            // Create message

            $message = '<h2>Your Reservation:</h2>';

            foreach ($_POST as $htmlName => $value) {
                $message .= "<p>";

                // breaks up the form names into words. for example
                // txtFirstName becomes First Name
                $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));

                foreach ($camelCase as $oneWord) {
                    $message .= "$oneWord ";
                }

                $sanitizedValue = htmlentities($value, ENT_QUOTES, "UTF-8");
                $message .= ": $sanitizedValue</p>";
            }

            // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            // Mail to user
            $to = $email;
            $cc = "";
            $bcc = "";

            $from = "Bernstein & Co. <reservations@bernsteinco.com>";

            // $todaysDate = strftime("%x");
            $subject = "Reservation Confirmation for $resDateTime";

            $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
        } // end if form is valid
    } // end if form is submitted

    // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // Display Form
    ?>

    <article class='form'>
        <?php
        // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // If first time on page OR errors exist, display form

        if (isset($_POST["btnReserve"]) and empty($errorMsg)) { // closing if brace marked with "end body submit"
            print '<h2>Thank you for reserving a table with us.</h2>';

            if ($mailed) {
                print "<p>For your records, a copy of this reservation has been emailed to <pre>$email</pre></p>";
            } elseif (!$mailed) {
                print "<p>A copy of this reservation was sent to you at <pre>$email</pre>, but it was unable to be delivered.";
            }

            print $message;

        } else {

            print '<h2 id="reserve">Reserve a table</h2>';
            print '<p class="form-heading">We\'d be delighted to have you!</p>';

            // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            // Error messages

            if ($errorMsg) {
                print "<div id='errors'>\n";
                print "<p><strong>There was a problem with your reservation. The form has the following mistakes that need to be fixed:</strong></p>\n";
                print "<ol>\n";

                foreach ($errorMsg as $err) {
                    print "<li>$err</li>\n";
                }

                print "</ol>\n";
                print "</div>\n";
            }

            // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
            // Form HTML

            ?>
            <form action="<?php print $phpSelf; ?>" id="frmReserve" method="post">

                <fieldset
                        class="reserveInfo <?php if ($resDateTimeERROR or $locationERROR or $partySizeERROR) print 'mistake'; ?>">
                    <legend>Reservation Information</legend>
                    <p>
                        <label class="required" for="lstLocation">Location</label>
                        <select
                                id="lstLocation"
                                name="lstLocation"
                                tabindex="100">
                            <option <?php if ($location == "Boston") print "selected"; ?>
                                    value="Boston">Boston
                            </option>
                            <option <?php if ($location == "Burlington") print "selected"; ?>
                                    value="Burlington">Burlington
                            </option>
                            <option <?php if ($location == "Chicago") print "selected"; ?>
                                    value="Chicago">Chicago
                            </option>
                        </select>
                    </p>
                    <p>
                        <label class="required" for="dtsReservation">Date &amp; Time</label>
                        <input
                                type="datetime-local"
                                id="dtsReservation"
                                name="dtsReservation"
                                onfocus="this.select()"
                                tabindex="120"
                                value=""
                        >
                    </p>
                    <p>
                        <label class="required text-field" for="txtPartySize">Party Size</label>
                        <input
                                id="txtPartySize"
                                name="txtPartySize"
                                onfocus="this.select()"
                                tabindex="140"
                                type="text"
                                value="<?php print $partySize; ?>">
                    </p>
                </fieldset>
                <section class="section">
                    <h2>Contact Information</h2>
                    <p>
                        <label class="required text-field" for="txtFirstName">First name</label>
                        <input <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                                id="txtFirstName"
                                maxlength="45"
                                name="txtFirstName"
                                onfocus="this.select()"
                                placeholder="Enter your first name"
                                tabindex="200"
                                type="text"
                                value="<?php print $firstName; ?>">

                        <label class="required text-field" for="txtLastName">Last name</label>
                        <input <?php if ($lastNameERROR) print 'class="mistake"'; ?>
                                id="txtLastName"
                                maxlength="45"
                                name="txtLastName"
                                onfocus="this.select()"
                                placeholder="Enter your last name"
                                tabindex="200"
                                type="text"
                                value="<?php print $lastName; ?>">
                    </p>
                    <p>
                        <label class="required" for="txtEmail">Email</label>
                        <input <?php if ($emailERROR) print 'class="mistake"'; ?>
                                id="txtEmail"
                                maxlength="55"
                                name="txtEmail"
                                onfocus="this.select()"
                                placeholder="Enter a valid email address"
                                tabindex="300"
                                type="text"
                                value="<?php print $email; ?>">
                    </p>
                    <p>
                        <label class="required" for="txtPhoneNumber">Phone Number</label>
                        <input <?php if ($phoneNumberERROR) print 'class="mistake"'; ?>
                                id="txtPhoneNumber"
                                maxlength="55"
                                name="txtPhoneNumber"
                                onfocus="this.select()"
                                placeholder="Enter a valid phone number"
                                tabindex="300"
                                type="tel"
                                value="<?php print $phoneNumber; ?>">
                    </p>
                </section>
                <section class="section">
                    <h2>Additional Information</h2>
                    <fieldset class="radio <?php if ($specOccasionERROR) print 'mistake'; ?>">
                        <legend>Are you celebrating a special occasion with us?</legend>
                        <p>
                            <label class="radio-field">
                                <input type="radio"
                                       id="radSpecOccasionAnniversary"
                                       name="radSpecOccasion"
                                       value="Anniversary"
                                       tabindex="750"
                                    <?php if ($specOccasion == "Anniversary") echo 'checked="checked" '; ?>>
                                Anniversary</label>
                        </p>
                        <p>
                            <label class="radio-field">
                                <input type="radio"
                                       id="radSpecOccasionBirthday"
                                       name="radSpecOccasion"
                                       value="Birthday"
                                       tabindex="770"
                                    <?php if ($specOccasion == "Birthday") echo 'Checked="checked" '; ?>>
                                Birthday</label>
                        </p>
                        <p>
                            <label class="radio-field">
                                <input type="radio"
                                       id="radSpecOccasionGraduation"
                                       name="radSpecOccasion"
                                       value="Graduation"
                                       tabindex="790"
                                    <?php if ($specOccasion == "Graduation") echo 'checked="checked" '; ?>>
                                Graduation</label>
                        </p>
                        <p>
                            <label class="radio-field">
                                <input type="radio"
                                       id="radSpecOccasionNone"
                                       name="radSpecOccasion"
                                       value="None"
                                       tabindex="810"
                                    <?php if ($specOccasion == "None") echo 'checked="checked" '; ?>>
                                None</label>
                        </p>
                    </fieldset>
                    <fieldset class="checkbox <?php if ($ageERROR) print ' mistake'; ?>">
                        <legend>Please indicate the age groups in your party (choose at least one and check all that may
                            apply):
                        </legend>
                        <p>
                            <label class="check-field">
                                <input <?php if ($ageAdult) print " checked "; ?>
                                        id="chkAdult"
                                        name="chkAdult"
                                        tabindex="830"
                                        type="checkbox"
                                        value="Adult"> Adult</label>
                        </p>
                        <p>
                            <label class="check-field">
                                <input <?php if ($ageChild) print " checked "; ?>
                                        id="chkChild"
                                        name="chkChild"
                                        tabindex="850"
                                        type="checkbox"
                                        value="Child"> Child</label>
                        </p>
                        <p>
                            <label class="check-field">
                                <input <?php if ($ageInfant) print " checked "; ?>
                                        id="chkInfant"
                                        name="chkInfant"
                                        tabindex="870"
                                        type="checkbox"
                                        value="Infant"> Infant</label>
                        </p>
                    </fieldset>
                    <p>
                        <label id="comments" class="required" for="txtComments">Comments </label>
                        <textarea
                                id="txtComments"
                                name="txtComments"
                                onfocus="this.select()"
                                tabindex="900"><?php print $comments; ?></textarea>
                    </p>
                </section>
                <fieldset class="buttons">
                    <legend></legend>
                    <input
                            class="button"
                            id="btnReserve"
                            name="btnReserve"
                            tabindex="950"
                            type="submit"
                            value="Reserve now">
                </fieldset>
            </form>
        <?php } // end body submit ?>

    </article>
    <p id="extra"><br/></p>
</article>
<?php include "_includes/footer.php"; ?>
