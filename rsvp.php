<?php
/*
	Author: Jacob Pell
	Date: 12/11/2018
	Description: RSVP page and profile sign-up
*/

$title = "RSVP and Registration";
$dateWritten = "12/11/2018";
$author = "Jacob Pell";
$pageID = "rsvp";
$description = "RSVP page and profile sign-up";
$dbName = "jpellweb_projectJP";
$authenticated = 0;
$siteFlag = 2;

require("connecti2db.inc.php");

function buildState($connection){
  $query = "SELECT stateID
	    FROM state";
  $result = mysqli_query($connection,$query) or
  die("<b>Query Failed.</b><br />" . mysqli_error($connection));
  echo "<select id=\"state\" name=\"state\" class=\"col-md-11\" required>\n";
  echo "\t<option value=\"\">--</option>\n";
  while($row = mysqli_fetch_row($result)){
    $stateID = $row[0];
    echo "\t<option value=\"$stateID\">$stateID</option>\n";
  }//END WHILE
  echo "</select>\n";
}//END BUILDSTATE

function buildGuest($connection){
  $query = "SELECT firstName,lastName,minor,rsvp
	    FROM guestList";
  $result = mysqli_query($connection,$query) or
  die("<b>Query Failed.</b><br />" . mysqli_error($connection));
  echo "<select id=\"guest\" name=\"guest[]\" class=\"col-md-11\" multiple>\n";
  while($row = mysqli_fetch_row($result)){
    $fname = $row[0];
    $lname = $row[1];
    $minor = $row[2];
    $rsvp = $row[3];
    if($rsvp){
      echo "\t<option value=\"$fname $lname\" disabled>$fname $lname</option>\n";
    } else {
      echo "\t<option value=\"$fname $lname,$minor\">$fname $lname</option>\n";
    }//END IF
  }//END WHILE
  echo "</select>\n";
}//END BUILDGUEST

session_start();
$logUser = (empty($_SESSION['uname'])) ? "" : $_SESSION['uname'];

if($logUser != "guest") {
  $title = "Oops! Please Login First";
  require("weddingHead.inc");
  echo "</header>\n";
  echo "<p class=\"col-md-6 mx-auto my-4 text-center\">In order to view the remainder of the site, you must be a guest and log in. There was a username and password provided to you on your invitation. Please use that username and password to access the RSVP page and register for an account. After your account has been verified, you will be able to access the rest of the site with your new username and password. Please visit the <a href=\"https://www.sullens.net/~jpell/sdev253/project/login.php\">Login Page</a> if you would like to view this website and RSVP for our wedding.</p>\n";
  require("weddingFoot.inc");
  die();
}
require("weddingHead.inc");
echo "</header>\n";
echo "<article class=\"py-4 container-fluid\">\n";
echo "<h2 class=\"col-md-3 mx-auto mb-4 text-center\">Welcome Friends and Family!</h2>\n";
echo "<h4 class=\"col-md-4 mx-auto text-center\">We are so glad you are able to join us in this exciting time!</h4>\n";
echo "<p class=\"col-md-8 mx-auto my-5 text-center\">Below, you will find a form in which you can RSVP for the wedding and sign up for an account to view the rest of the website. The rest of the website contains information about our wedding venue, travel, wedding registry (or donations), and our story that lead us to this point. Please fill out all fields of this form below, your data security has been taken into account and will remain private and secure. Please select if you will be attending in the section marked RSVP, and if you would like to be provided alcohol at the wedding select the appropriate option in that section. Non-alcoholic drinks will be provided to everyone regardless of your alcohol choice. If you need to RSVP for another guest as well (children, spouse, non-web-using family, etc.) there is a drop down box where you can select the guest(s) you are RSVPing for. Please select each guest and they will be marked as coming. Once the additional guest has been added, you can select if they would like alcohol or not. Please note that all guests under 21 will, naturally, not be eligible for alcohol and the option will not appear for them. Thanks for joining us and we hope you enjoy the site and are as excited about the wedding as we are!</p>\n";
echo "</article>\n";

echo <<<FORMDOC
<form action="thankYou.php" method="post" class="container text-left mx-auto">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="username">Username</label>
      <input type="text" name="uname" id="username" class="col-md-11" size="30" minlength="5" maxlength="10" required />
      <small id="unameHelp" class="form-text text-muted">Username must be 5-10 characters long.</small>
    </div>
    <div class="form-group col-md-4">
      <label for="password1">Password</label>
      <input type="password" name="pword" id="password1" class="col-md-11" size="30" minlength="8" maxlength="15" required />
      <small id="pwHelp" class="form-text text-muted">Password must be 8-15 characters long and contain at least 1 capital letter and 1 number</small>
    </div>
    <div class="form-group col-md-4">
      <label for="password2">Verify Password</label>
      <input type="password" name="Vpword" id="password2" class="col-md-11" size="30" minlength="8" maxlength="15" required />
      <small id="pwErr" class="form-text text-muted">Re-type password</small>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="first">First Name</label>
      <input type="text" name="fname" id="first" class="col-md-11" size="30" minlength="2" maxlength="15" required />
    </div>
    <div class="form-group col-md-4">
      <label for="last">Last Name</label>
      <input type="text" name="lname" id="last" class="col-md-11" size="30" minlength="2" maxlength="15" required />
    </div>
    <div class="form-group col-md-4">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="col-md-11" size="30" minlength="5" required />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="phone">Phone Number</label>
      <input type="text" name="phone" id="phone" class="col-md-11" size="15" minlength="10" maxlength="15" required />
    </div>
    <div class="form-group col-md-4">
      <label for="street">Street</label>
      <input type="text" name="street" id="street" class="col-md-11" size="30" maxlength="60" required />
    </div>
    <div class="form-group col-md-3">
      <label for="city">City</label>
      <input type="text" name="city" id="city" class="col-md-11" size="30" maxlength="25" required />
    </div>
    <div class="form-group col-md-1">
      <label for="state">State</label>
FORMDOC;
buildState($connection);
echo <<<FORMDOC
    </div>
    <div class="form-group col-md-1">
      <label for="zip">Zip</label>
      <input type="text" name="zip" id="zip" class="col-md-11" size="5" minlength="5" maxlength="5" required />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-2">
      <p class="form-label mb-2">RSVP?</p>
      <label for="rsvpY"><input type="radio" id="rsvpY" name="rsvp" value="1" class="mr-2" />Yes</label>
      <label for="rsvpN"><input type="radio" id="rsvpN" name="rsvp" value="0" class="mr-2" checked />No</label>
    </div>
    <div class="form-group col-md-2">
      <p class="form-label mb-2">Alcohol?</p>
      <label for="alcoholY"><input type="radio" id="alcoholY" name="alcohol" value="1" class="mr-2" />Yes</label>
      <label for="alcoholN"><input type="radio" id="alcoholN" name="alcohol" value="0" class="mr-2" checked />No</label>
    </div>
    <div class="form-group col-md-4">
      <label for="guest">Additional guests?</label>
FORMDOC;
buildGuest($connection);
echo <<<FORMDOC
      <small id="selHelp" class="form-text text-muted">Hold 'Ctrl' or 'Cmd' on your keyboard and click each name to select multiple people.</small>
    </div>
    <div id="guestList" class="col-md-4">
    </div>
  </div>
  <div class="form-row">
    <button type="reset" name="reset" id="reset" class="btn btn-primary btn-lg col-md-2 mx-auto">Reset Form</button>
    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg col-md-2 mx-auto">Submit Form</button>
  </div>
</form>
FORMDOC;

require("weddingFoot.inc");
mysqli_close($connection);
?>
