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
$dbName = "jpellweb_projectJP";
$siteFlag = 1;

/*
if(!$authenticated) {
  $title = "Oops! Please Login First";
  require("weddingHead.inc");
  echo "</header>\n";
  echo "<p class=\"col-md-6 mx-auto my-4 text-center\">In order to view the remainder of the site, you must be a guest and log in. There was a username and password provided to you on your invitation. Please use that username and password to access the RSVP page and register for an account. After your account has been verified, you will be able to access the rest of the site with your new username and password. Please visit the <a href=\"https://www.pellwedding.com/login.php\">Login Page</a> if you would like to view this website and RSVP for our wedding.</p>\n";
  require("weddingFoot.inc");
  die();
}
*/

require("connecti2db.inc.php");
require("weddingHead.inc");

if ($authenticated) {
	require("nav.inc");
}

# Contrucion notification. Put this up if the site is under construction
# and should not be publically viewable.

/*
echo <<<CONSTRUCTION
<article class="container text-center">
  <h2 class="col-md-6 offset-md-3 mx-auto">Oops!</h2>
  <p class="col-md-8 offset-md-2">Please excuse our mess! This site is currently under construction and we will hopefully have things ready for you soon! Please enjoy the rest of the site and this page will be ready before you know it!</p>
  <img src="img/200px-Commons-emblem-Under_construction-green.svg.png" width="200" height="200" class="img-fluid col-md-3 mx-auto" alt="under construction img" />
</article>
CONSTRUCTION;
*/

# Main body of page.

echo <<<BODYDOC
<article class="container text-center">
	<h2 class="col-md-6 offset-md-3 mx-auto">Wedding Registry and Donation</h2>
	<p class="col-md-8 offset-md-2">For our wedding registry, we decided to give people 2 options. We have both a wedding registry and a donation option. We know not everyone likes to get people physical gifts for weddings these days. Sometimes the gifts are expensive, sometimes they just don't seem fully "in the spirit", and sometimes you just don't feel like getting something the happy couple will hardly use. In these cases, simply donating money might be a better option. Below I have given links to both our registry on Amazon and our PayPal where you can donate money. The money that is donated will go to covering the cost of the wedding, our honeymoon, and it will help getting us a head start on our life together.</p>
	<p class="col-md-8 offset-md-2">No matter what you guys choose, we hope that you will come to the wedding and enjoy yourself! We look forward to seeing you all there are excited for our big day! See you soon!</p>
</article>

<article class="container text-center">
	<div class="col">
		<div class="row">
			<div class="col">
				<a class="mx-auto" href="https://www.amazon.com/wedding/austyn-kiser-jacob-pell-south-bend-october-2019/registry/1ZG3ZP89O0Q6I" target="_blank">
					<img class="img-fluid text-center" src="img/registry_photo_us.png" width="730" height="367" alt="Image of couple with text beside it stating all you, one registry wedding registry" />
				</a>
			</div>
			<div class="col">
				<div class="row">
					<a class="mx-auto" href="https://paypal.me/pellwedding?locale.x=en_US" target="_blank">
						<img class="img-fluid text-center" src="img/paypal_me_ss.png" width="225" height="227" alt="Image of couple with text below showing it is a link to paypal.me/pellwedding" />
					</a>
				</div>
				<div class="row">
					<form class="mx-auto" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_donations" />
						<input type="hidden" name="business" value="UZESAMGB56PCN" />
						<input type="hidden" name="item_name" value="Donate money for the wedding of Austyn Kiser and Jacob Pell" />
						<input type="hidden" name="currency_code" value="USD" />
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
						<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
					</form>
				</div>
			</div>
		</div>
	</div>
</article>
BODYDOC;

if(!$authenticated){
	echo "<div class=\"row mx-auto my-4\">\n";
    echo "\t<a class=\"btn btn-primary btn-lg ml-auto mr-2 col-md-3\" href=\"login.php\">Log In</a>\n";
    echo "\t<a class=\"btn btn-primary btn-lg mr-auto ml-2 col-md-3\" href=\"landing.php\">Home</a>\n";
    echo "</div>\n";
}

mysqli_close($connection);
require("weddingFoot.inc");
