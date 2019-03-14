<?php
/* Author:      Jacob Pell
   Date:        12/14/2018
   Description: Pasword reset page for wedding site
*/
$author      = "Jacob Pell";
$dateWritten = "12/14/2018";
$description = "Password reset page for wedding site";
$title       = "Password Reset";
$dbName      = "jpellweb_projectJP";
$siteFlag = 2;
$authentication = 0;
$thisScript = htmlspecialchars($_SERVER['PHP_SELF']);

require("connecti2db.inc.php");
require("weddingHead.inc");
echo "</header>\n";

if (empty($_POST) && empty($_GET)) // stop the script if user arrives from anywehre
{				   // except the one-time URL
  echo "<article class=\"container text-center mx-auto\">\n";
  echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Oops!</h2>\n";
  echo "<p class=\"col-md-8 offset-md-2\">It looks like you tried to come to this page without following the reset link! Please check your email for the reset link. If you are unable to locate it, be sure to check your spam folder. If you feel as though you have reached this page in error, contact the site administrator for help.</p>\n";
  echo "</article>\n";
  require("weddingFoot.inc");
  die();
} // END IF POST AND GET ARE EMPTY
if(!isset($_POST['submit']))
{

  $uid	  = $_GET['ui'];
  $username = $_GET['parity'];

  $query = "SELECT rID,active
	  FROM registration
	  WHERE username = '$username'";

  $result = mysqli_query($connection,$query)
  or die("<b>Query Failed</b><br />$query<br />" . mysqli_error($connection));

  $row = mysqli_fetch_row($result);

  $expired = $row[1]; // This is the "active" column

  if ($expired)
  { // The one-time URL has already been used; account is already active.
    echo "<article class=\"container text-center mx-auto\">\n";
    echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Link Has Expired</h2>\n";
    echo "<p class=\"col-md-8 offset-md-2\">The link you are using has already been used or it has expired. Please contact the site administrator for assistance if you believe there has been an error.</p>\n";
    echo "</article>\n";
    die();
  } // END IF EXPIRED TRUE
  $salt   = $row[0];
  $pepper = "><,./_=2@`~";
  $verificationCode = md5($salt . $username . $pepper);

  if ($uid != $verificationCode)
  { 
    echo "<article class=\"container text-center mx-auto\">\n";
    echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Invalid Reset Code</h2>\n";
    echo "<p class=\"col-md-8 offset-md-2\">The link you are using is invalid. Please contact the site administrator for assistance if you believe there has been an error.</p>\n";
    echo "</article>\n";
    die();
  }//END UID NOT VERICODE
echo <<<FORMDOC
<form action="$thisScript" method="post" class="col-md-6 text-center mx-auto my-4">
  <div class="form-group">
    <label for="password1" class="mr-3">Password</label>
    <input type="password" name="password" id="password1" class="ml-4" size="25" minlength="8" maxlength="15" required/>
  </div>
  <div class="form-group">
    <label for="password2">Verify Password</label>
    <input type="password" name="Vpass" id="password2" size="25" minlength="8" maxlength="15" required/>
    <small id="error" class="form-text errRed"></small>
  </div>
  <div class="form-row justify-content-center">
    <input type="hidden" name="username" value="$username" />
    <input value="Submit" name="submit" class="btn btn-primary" type="submit" />
  </div>
</form>
FORMDOC;
}//END IF NOT ISSET
else
{
  $username = $_POST['username'];
  $pwPosted = mysqli_real_escape_string($connection,stripslashes($_POST['password']));
  $query = "SELECT email,rID
	    FROM registration
	    WHERE username = '$username'";
  $result = mysqli_query($connection,$query) or
  die("<b>Query Failed</b><br />$query<br />" . mysqli_error($connection));
  $row = mysqli_fetch_row($result);
  $salt = $row[1];
  $pepper = substr($row[0],0,3);
  $encPW = md5($salt.$pwPosted.$pepper);

  $query = "UPDATE registration
  	    SET password = '$encPW'
	    WHERE registration.username = '$username'";
  $result = mysqli_query($connection,$query) or
  die("<b>Query Failed</b><br />$query<br />" . mysqli_error($connection));

  $query = "UPDATE registration
	    SET active = 1
	    WHERE username = '$username'";
  $result = mysqli_query($connection,$query) or
  die("<b>Query Failed</b><br />$query<br />" . mysqli_error($connection));

  echo "<article class=\"container text-center mx-auto\">\n";
  echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Congratulations!</h2>\n";
  echo "<p class=\"col-md-8 offset-md-2\">Your password has been reset and your account has been activated! Please go to the <a href=\"login.php\">Login</a> page to sign in and start viewing the website!</p>\n";
  echo "</article>\n";
}//END ELSE NOT ISSET

require("weddingFoot.inc");
mysqli_close($connection);
?>
