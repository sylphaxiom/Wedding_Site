<?php
/*
	Author: Jacob Pell
	Date: 12/14/2018
	Description: Registry page, under construction
*/
session_start();
$uname = empty($_SESSION['uname']) ? "" : $_SESSION['uname'];
$authenticated = empty($_SESSION['auth']) ? "" : $_SESSION['auth'];

$author = "Jacob Pell";
$dateWritten = "12/14/2018";
$description = "Registry Page, under construction";
$title = "Registry and Donations";
$pageID = "registry";
$dbName = "projectJP";
$siteFlag = 1;

if(!$authenticated) {
  $title = "Oops! Please Login First";
  require("weddingHead.inc");
  echo "</header>\n";
  echo "<p class=\"col-md-6 mx-auto my-4 text-center\">In order to view the remainder of the site, you must be a guest and log in. There was a username and password provided to you on your invitation. Please use that username and password to access the RSVP page and register for an account. After your account has been verified, you will be able to access the rest of the site with your new username and password. Please visit the <a href=\"https://www.sullens.net/~jpell/sdev253/project/login.php\">Login Page</a> if you would like to view this website and RSVP for our wedding.</p>\n";
  require("weddingFoot.inc");
  die();
}


require("connecti2db.inc.php");
require("weddingHead.inc");
require("nav.inc");

echo <<<ARTDOC
<article class="container text-center">
  <h2 class="col-md-6 offset-md-3 mx-auto">Oops!</h2>
  <p class="col-md-8 offset-md-2">Please excuse our mess! This site is currently under construction and we will hopefully have things ready for you soon! Please enjoy the rest of the site and this page will be ready before you know it!</p>
  <img src="img/200px-Commons-emblem-Under_construction-green.svg.png" width="200" height="200" class="img-fluid col-md-3 mx-auto" alt="under construction img" />
</article>
ARTDOC;

mysqli_close($connection);
require("weddingFoot.inc");
