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
$dateWritten = "12/05/2018";
$pageID = "login";
$title = "Log In Page";
$description = "Login page for the wedding website";
$dbName = "jpellweb_projectJP";
$authenticated = 0;
$siteFlag = 2;

function redirect($extra){
    /* Redirect to a different page in the current directory that was requested */
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: http://$host$uri/$extra");
    exit;
}// END REDIRECT

function displayForm($message){
$thisScript = htmlspecialchars($_SERVER['PHP_SELF']);
echo <<<FORMDOC
<form action="$thisScript" method="post" class="col-md-6 text-center mx-auto my-4">
  <div class="form-group">
    <label for="UserName">Username</label>
    <input type="text" name="username" id="UserName" size="25" minlength="5" maxlength="10" required/>
  </div>
  <div class="form-group">
    <label for="Password">Password</label>
    <input type="password" name="password" id="Password" size="25" minlength="8" maxlength="15" required/>
    <small id="error" class="form-text errRed">$message</small>
  </div>
  <div class="form-row justify-content-center">
    <input value="Submit" name="submit" class="btn btn-primary" type="submit" />
    <a href="reset.php" class="ml-2 my-auto">Forgot Username/Password?</a>
  </div>
</form>
FORMDOC;
}// END DISPLAYFORM

if(!isset($_POST['submit']))
{
require("connecti2db.inc.php");
require("weddingHead.inc");

echo "</header>\n";

$message = "";
echo <<<BODYDOC
<article class="my-4 py-4">
  <h2 class="col-md-4 text-center mx-auto mb-5">Thank you for logging in</h2>
  <p class="text-center col-md-8 mx-auto">I appreciate your desire to view more about our upcoming wedding! If you are an invited guest, please put in the username and password that was given to you on your invitation. After putting in this username and password, you will be redirected to a registration page where you can RSVP for the wedding, select the members of your family that will be attending, and register for a new username and password. This new username and password will be what you will use for any return visits to this website. If you do not know your username and password, click the link below where you can reset your password. If you use the username and password on the invitation, you will be sent to the registration page once again. I hope you enjoy the website and we look forward to seeing you at our wedding!</p>
</article>
BODYDOC;
displayForm($message);
}// IF !ISSET
else
{

  require("connecti2db.inc.php");

  $unamePosted = mysqli_real_escape_string($connection,stripslashes($_POST['username']));
  $pwordPosted = mysqli_real_escape_string($connection,stripslashes($_POST['password']));
  $genericUname = "guest";
  $genericPword = "Ariel1420";
  $authenticated = 0;

  if($unamePosted == $genericUname)
  {
    if($pwordPosted == $genericPword)
    {
      session_start();
      $_SESSION['uname'] = $unamePosted;
      $_SESSION['auth'] = $authenticated;
      redirect("rsvp.php");
      exit;
    }//IF GENERIC PASSWORD VALIDATES
    else
    {
      require("weddingHead.inc");
      echo "</header>\n";
      $message = "Password was incorrect. Please try again.";
      displayForm($message);
    }//ELSE GENERIC PASSWORD NOT VALIDATE
  }//IF GENERIC USERNAME USED
  else
  {
    //This code is reached if the user has inputted a username other
    //than the generic username. That tells me that they are a returning
    //user and will need to create a session and validate against the DB

    $query = "SELECT password,active,rID,email
	      FROM registration
	      WHERE username = '$unamePosted'";

    $result = mysqli_query($connection,$query)
    or die("<b>Query Failed.<b><br />" . mysqli_error($connection));

    $found = mysqli_num_rows($result);
    if(!$found){
      require("weddingHead.inc");
      echo "</header>\n";
      $message = "The username/password combination you entered is incorrect.";
      displayForm($message);
      echo "<p>Vars: username $unamePosted Not found in database</p>\n";
    }//END IF NOT FOUND

    $row = mysqli_fetch_row($result);
    $dbPW = $row[0];
    $active = $row[1];
    $salt = $row[2];
    $email = $row[3];
    $pepper = substr($email,0,3);

    if(!$active){
      require("weddingHead.inc");
      echo "</header>\n";
      echo "<h2>Activate Your Account</h2>\n";
      echo "<p>Please activate your account. Check your email at $email";
      echo " for the activation email to activate your account.</p>\n";
      require("weddingFoot.inc");
      die();
    }//IF NOT ACTIVE

    $processedPW = md5($salt . $pwordPosted . $pepper);

    if($processedPW != $dbPW){
      require("weddingHead.inc");
      echo "</header>\n";
      $message = "The username/password combination you entered is incorrect.";
      displayForm($message);
    }//IF NOT PW MATCH
    else{
      $authenticated = 1;
      session_start();
      $_SESSION['uname'] = $unamePosted;
      $_SESSION['auth'] = $authenticated;
      redirect("ourStory.php");
    }//END PW MATCH
  }//ELSE GENERIC USERNAME NOT USED
}//ELSE !ISSET

mysqli_close($connection);
require("weddingFoot.inc");
?>
