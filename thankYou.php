<?php
/*
	Author: Jacob Pell
	Date: 12/12/2018
	Description: Thank you page and page that sends activation email
		     to the user so they will be activated and can access
		     the rest of the website.
*/

session_start();

$author = "Jacob Pell";
$dateWritten = "12/12/2018";
$description = "Thank you page that sends activation email";
$title = "Thank you for Registering";
$dbName = "jpellweb_projectJP";
$authentication = 0;
$siteFlag = 2;

require("connecti2db.inc.php");
require("weddingHead.inc");

echo "</header>\n";

if(!isset($_POST['submit']))
{
  echo "<article class=\"container text-center mx-auto\">\n";
  echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Oops!</h2>\n";
  echo "<p class=\"col-md-8 offset-md-2\">It looks like you tried to come to this page without submitting the RSVP form! Please go back to the <a href=\"login.php\">login page</a> and try again!</p>\n";
  echo "</article>\n";
  require("weddingFoot.inc");
  die();
}// END IF NOT ISSET
else
{
// Take the form data, strip, and prep for insert
$uname = mysqli_real_escape_string($connection,stripslashes($_POST['uname']));
$pword = mysqli_real_escape_string($connection,stripslashes($_POST['pword']));
$fname = mysqli_real_escape_string($connection,stripslashes($_POST['fname']));
$lname = mysqli_real_escape_string($connection,stripslashes($_POST['lname']));
$email = mysqli_real_escape_string($connection,stripslashes($_POST['email']));
$phone = mysqli_real_escape_string($connection,stripslashes($_POST['phone']));
$street = mysqli_real_escape_string($connection,stripslashes($_POST['street']));
$city = mysqli_real_escape_string($connection,stripslashes($_POST['city']));
$state = mysqli_real_escape_string($connection,stripslashes($_POST['state']));
$zip = mysqli_real_escape_string($connection,stripslashes($_POST['zip']));
$rsvp = mysqli_real_escape_string($connection,stripslashes($_POST['rsvp']));
$name = (empty($_POST['guest']) ? array() : $_POST['guest']);//array cannot be escaped or stripped
$salt = (int) date('s');
$pepper = substr($email,0,3);
$encPword = md5($salt . $pword . $pepper);

//process guest into id and age arrays
$gFname = array();
$gLname = array();

for($i=0;$i<count($name);$i++)
{
  $arrayName = explode(" ",$name[$i]);
  array_push($gFname,$arrayName[0]);
  array_push($gLname,$arrayName[1]);
#  rtrim($gLname[$i]);
#  rtrim($gFname[$i]);
}//END FOR NAME

if($rsvp == '1'){
	array_push($gFname,$fname);
	array_push($gLname,$lname);
}

$query = "SELECT firstName,lastName
	  FROM users
	  WHERE firstName = '$fname' AND lastName = '$lname'";
$result = mysqli_query($connection,$query) or
die("<b>Query Failed</b><br />$query<br />".mysqli_error($connection));

$count = mysqli_num_rows($result);
if($count != 0)
{
  echo "<article class=\"container text-center mx-auto\">\n";
  echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Oops!</h2>\n";
  echo "<p class=\"col-md-8 offset-md-2\">It looks like you've already created an account! If you have forgotten your password you can go to the <a href=\"reset.php\">forgot/reset password</a> page and reset your password!</p>\n";
  echo "<div class=\"row mx-auto\">\n";
  echo "\t<a class=\"btn btn-primary btn-lg ml-auto mr-2 col-md-2\" href=\"login.php\">Log In</a>\n";
  echo "\t<a class=\"btn btn-primary btn-lg mr-auto ml-2 col-md-2\" href=\"landing.php\">Home</a>\n";
  echo "</div>\n";
  echo "</article>\n";
  require("weddingFoot.inc");
  die();
}// END IF COUNT

$query = "SELECT username
	  FROM registration
	  WHERE username = '$uname'";
$result = mysqli_query($connection,$query) or
die("<b>Query Failed</b><br />$query<br />".mysqli_error($connection));

$count = mysqli_num_rows($result);
if($count != 0)
{
  echo "<article class=\"container text-center mx-auto\">\n";
  echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Oops!</h2>\n";
  echo "<p class=\"col-md-8 offset-md-2\">I'm sorry, that username has already been chose. Please go back and re-submit the form with a unique username.</p>\n";
  echo "<div class=\"row mx-auto\">\n";
  echo "\t<a class=\"btn btn-primary btn-lg ml-auto mr-2 col-md-2\" href=\"login.php\">Log In</a>\n";
  echo "\t<a class=\"btn btn-primary btn-lg mr-auto ml-2 col-md-2\" href=\"landing.php\">Home</a>\n";
  echo "</div>\n";
  echo "</article>\n";
  require("weddingFoot.inc");
  die();
}// END IF COUNT

$query = "INSERT INTO users
	  (firstName,lastName,phone,street,city,state,zip)
	  VALUES
	  ('$fname','$lname','$phone','$street','$city','$state','$zip')";

$result = mysqli_query($connection,$query) or
die("<b>Query Failed</b><br />$query<br />".mysqli_error($connection));

for($i=0;$i<count($gFname);$i++)
{
  $query = "UPDATE guestList
	    SET rsvp = 1
	    WHERE guestList.firstName = '$gFname[$i]' AND guestList.lastName = '$gLname[$i]'";
  
  $result = mysqli_query($connection,$query) or
  die("<b>Query Failed<b/><br />$query<br />".mysqli_error($connection));
}//END FOR GFNAME

$query = "INSERT INTO registration
	  (email,username,password,userID,rID)
	  VALUES
	  ('$email','$uname','$encPword',(SELECT (users.userID) FROM users WHERE users.firstName = '$fname' AND users.lastName = '$lname'),'$salt')";

$result = mysqli_query($connection,$query) or
die("<b>Query Failed<b/><br />$query<br />".mysqli_error($connection));

//Build the confirmation email
  $headers  = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "To: $fname $lname <$email>\r\n";
  $headers .= "From: Account Verification <groom@pellwedding.com>\r\n";
  $headers .= "X-Priority: 1\r\n";
  $headers .= "X-MSMail-Priority: High\r\n";
  $headers .= "X-Mailer: PHP / ".phpversion() ."\r\n";
  $subject  = "Please verify your account";

  // build codes for the one-time URL
  $verificationSalt   = $salt;
  $verificationPepper = "><,./_=2@`~";
  $verificationCode   = $verificationSalt . $uname . $verificationPepper;
  $verificationCode   = md5($verificationCode);
  $verificationScript = "https://www.pellwedding.com/activate.php";

  $body  = "<h2>One more step and you're done.</h2>\n";
  $body .= "<p>Name: $fname $lname<br>\n";
  $body .= "Email: $email<br>\n";
  $body .= "Follow this link to activate your account:<br />";
  $body .= "<a href=\"$verificationScript" . "?ui=$verificationCode";
  $body .= "&parity=$uname\">$verificationScript";
  $body .= "?ui=$verificationCode&parity=$uname</a></p>";
  $body .= "<p>If the link above does not work correctly, copy and paste it ";
  $body .= "into your browser's address bar.</p>\n";
  $body  = stripslashes($body);

  // send the email
$sent = mail("",$subject,$body,$headers);
if($sent)
{
  echo "<article class=\"container text-center mx-auto\">\n";
  echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Success!</h2>\n";
  echo "<p class=\"col-md-8 offset-md-2\">A confirmation email has been sent to $email. Please check your email and click the link provided to activate your account and view the rest of the website! Please note, that due to modern email security filters, your email may have been sent to the spam folder. Please look in your spam folder and find the email from: \"Account Verification <groom@pellwedding.com>\" and with the subject: \"Please verify your account\". If you are unable to follow the link, you can paste it in the URL bar of your browser. This activation code is valid for a one time use and will be expired after that use.</p>\n";
  echo "<div class=\"row mx-auto\">\n";
  echo "\t<a class=\"btn btn-primary btn-lg ml-auto mr-2 col-md-2\" href=\"login.php\">Log In</a>\n";
  echo "\t<a class=\"btn btn-primary btn-lg mr-auto ml-2 col-md-2\" href=\"landing.php\">Home</a>\n";
  echo "</div>\n";
  echo "</article>\n";
}// END IF SENT
else
{
  echo "<article class=\"container text-center mx-auto\">\n";
  echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Oops!</h2>\n";
  echo "<p class=\"col-md-8 offset-md-2\">Something went wrong while attempting to send you the email verification! Please contact the site administrator for assistance.</p>\n";
  echo "<div class=\"row mx-auto\">\n";
  echo "\t<a class=\"btn btn-primary btn-lg ml-auto mr-2 col-md-2\" href=\"login.php\">Log In</a>\n";
  echo "\t<a class=\"btn btn-primary btn-lg mr-auto ml-2 col-md-2\" href=\"landing.php\">Home</a>\n";
  echo "</div>\n";
  echo "</article>\n";
}// END ELSE SENT
}//END ELSE ISSET
mysqli_close($connection);
require("weddingFoot.inc");
?>
