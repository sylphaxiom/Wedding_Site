<?php
/*
	Author: Jacob Pell
	Date: 12/14/2018
	Description: Logout page for wedding site
*/

session_start();

$author = "Jacob Pell";
$dateWritten = "12/14/2018";
$description = "Logout page for the wedding site";
$title = "Log Out";
$pageID = "logOut";
$dbName = "projectJP";
$siteFlag = 1;
$thisScript = htmlspecialchars($_SERVER['PHP_SELF']);

require("connecti2db.inc.php");
require("weddingHead.inc");

if(!isset($_POST['submit']))
{
require("nav.inc");
$uname = $_SESSION['uname'];
$authenticated = $_SESSION['auth'];
echo <<<BODYDOC
<article class="container text-center">
  <h2 class="col-md-6 offest-md-3 mx-auto">Are You Sure?</h2>
  <p class="col-md-8 offset-md-2">Are you sure you want to log out? If you're done for now, go ahead and click the button below and you will be logged out. If you didn't want to, you can navigate back to the rest of the site!</p>
  <form action="$thisScript" method="post">
    <button type="submit" name="submit" class="btn btn-primary btn-lg">Log Out</button>
  </form>
</article>
BODYDOC;
}
else
{
$authenticated = 0;
session_destroy();

echo "</header>\n";

echo <<<BODYDOC
<article class="container text-center">
  <h2 class="col-md-6 offest-md-3 mx-auto">Thank You for Visiting</h2>
  <p class="col-md-8 offset-md-2">Thanks for visiting our wedding website. I hope you enjoyed and will come back again soon! Whenever you come back, just log back in and view whatever you'd like! We look forward to seeing you at the wedding!</p>
  <div class="row mx-auto">
    <a class="btn btn-primary btn-lg ml-auto mr-2 col-md-2" href="login.php">Log In</a>
    <a class="btn btn-primary btn-lg mr-auto ml-2 col-md-2" href="index.php">Home</a>
  </div>
</article>
BODYDOC;
}

mysqli_close($connection);
require("weddingFoot.inc");
?>
