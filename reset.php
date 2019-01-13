<?php
/*
  Author: Jacob Pell
  Date 12/05/2018
  Description: This is the login page for the wedding site.
	       It will validate the general credentials given
	       to guests and if they use that login information
	       then they will have to go to a registration page
	       and sign in where they will choose their new 
	       login credentials.
*/

$author = "Jacob Pell";
$dateWritten = "12/14/2018";
$title = "Reset Password";
$description = "Password reset for the wedding website";
$dbName = "projectJP";
$authenticated = 0;
$siteFlag = 2;
$thisScript = htmlspecialchars($_SERVER['PHP_SELF']);

require("connecti2db.inc.php");
require("weddingHead.inc");
echo "</header>\n";

if(!isset($_POST['submit']))
{
echo <<<BODYDOC
<article class="my-4 py-4">
  <h2 class="col-md-4 text-center mx-auto mb-5">Reset Your Password</h2>
  <p class="text-center col-md-8 mx-auto">Please enter your username and email address below. When you click submit, an email will be sent and you can use the link on that email to reset your password. Please note that due to security in some email providers, the email I send you may go to your spam folder.</p>
</article>
BODYDOC;
echo <<<FORMDOC
<form action="$thisScript" method="post" class="col-md-6 text-center mx-auto my-4">
  <div class="form-group">
    <label for="UserName">Username</label>
    <input type="text" name="username" id="UserName" size="25" minlength="5" maxlength="10" required/>
  </div>
  <div class="form-group">
    <label for="email" class="mr-1">Email</label>
    <input type="email" name="email" id="email" class="ml-4" size="25" required/>
  </div>
  <div class="form-row justify-content-center">
    <input value="Submit" name="submit" class="btn btn-primary" type="submit" />
  </div>
</form>
FORMDOC;
}//END IF NOT ISSET
else
{
  $email = mysqli_real_escape_string($connection,stripslashes($_POST['email']));
  $unamePosted = mysqli_real_escape_string($connection,stripslashes($_POST['username']));

  $query = "SELECT r.email,r.username,r.rID,u.firstName,u.lastName
	    FROM registration AS r JOIN users AS u
	    ON (r.userID = u.userID)
	    WHERE r.email = '$email' AND r.username = '$unamePosted'";
  $result = mysqli_query($connection,$query) or 
  die("<b>Query Failed</b><br />$query<br />" . mysqli_error($connection));
  $found = mysqli_num_rows($result);
  if(!$found)
  {
    echo "<article class=\"container text-center\">\n";
    echo "<h2 class=\"col-md-6 offset-md-3\">Oops!</h2>\n";
    echo "<p class=\"col-md-8 offset-md-2\">The username and/or email you entered is incorrect! Please <a href=\"$thisScript\">go back</a> and try again or contact the site administrator for assistance</p>\n";
    echo "</article>\n";
    die();
  }//END IF NOT FOUND
  else
  {
    $row   = mysqli_fetch_row($result);
    $email = $row[0];
    $uname = $row[1];
    $salt  = $row[2];
    $fname = $row[3];
    $lname = $row[4];

    //Build the confirmation email
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "To: $fname $lname <$email>\r\n";
    $headers .= "From: Password Reset <pelljacoba@gmail.com>\r\n";
    $headers .= "X-Priority: 1\r\n";
    $headers .= "X-MSMail-Priority: High\r\n";
    $headers .= "X-Mailer: PHP / ".phpversion() ."\r\n";
    $subject  = "A Password Reset Request Has Been Sent";

    // build codes for the one-time URL
    $verificationSalt   = $salt;
    $verificationPepper = "><,./_=2@`~";
    $verificationCode   = $verificationSalt . $uname . $verificationPepper;
    $verificationCode   = md5($verificationCode);
    $verificationScript = "http://sullens.net/~jpell/sdev253/project/pwReset.php";

    $body  = "<p>It looks like you requested a password reset.</p>\n";
    $body .= "Name: $fname $lname<br>\n";
    $body .= "Email: $email<br>\n";
    $body .= "If you requested this, follow the link below:<br />";
    $body .= "<a href=\"$verificationScript" . "?ui=$verificationCode";
    $body .= "&parity=$uname\">$verificationScript";
    $body .= "?ui=$verificationCode&parity=$uname</a>";
    $body .= "<p>If the link above does not work correctly, copy and paste it ";
    $body .= "into your browser's address bar. If you DID NOT request a password reset, ignore this email or contact the site administrator.</p>\n";
    $body  = stripslashes($body);

    // send the email
    $sent = mail("",$subject,$body,$headers);
    if($sent)
    {
      $query = "UPDATE registration
		SET active = 0
		WHERE username = '$uname'";
      $result = mysqli_query($connection,$query) or 
      die("<b>Query Failed</b><br />$query<br />" . mysqli_error($connection));
      
      echo "<article class=\"container text-center mx-auto\">\n";
      echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Success!</h2>\n";
      echo "<p class=\"col-md-8 offset-md-2\">A confirmation email has been sent to $email. Please check your email and click the link provided to reset your password. Please note, that due to modern email security filters, your email may have been sent to the spam folder. Please look in your spam folder and find the email from: \"Password Reset <pelljacoba@gmail.com>\" and with the subject: \"A Password Reset Request Has Been Sent\". If you are unable to follow the link, you can paste it in the URL bar of your browser. This reset code is valid for a one time use and will be expired after that use.</p>\n";
      echo "</article>\n";
    }// END IF SENT
    else
    {
      echo "<article class=\"container text-center mx-auto\">\n";
      echo "<h2 class=\"col-md-6 offset-md-3 mt-4\">Oops!</h2>\n";
      echo "<p class=\"col-md-8 offset-md-2\">Something went wrong while attempting to send you the reset code! Please contact the site administrator for assistance.</p>\n";
      echo "</article>\n";
    }// END ELSE SENT
  }//END ELSE NOT FOUND
}//END ELSE NOT ISSET
mysqli_close($connection);
require("weddingFoot.inc");
?>
