<?php
/*
	Author: Jacob Pell
	Date: 12/14/2018
	Description: Date Info page, under construction
*/
session_start();
$uname = empty($_SESSION['uname']) ? "" : $_SESSION['uname'];
$authenticated = empty($_SESSION['auth']) ? "" : $_SESSION['auth'];

$author = "Jacob Pell";
$dateWritten = "12/14/2018";
$description = "Date info page, under construction";
$title = "Wedding Location and Information";
$pageID = "dateInfo";
$dbName = "jpellweb_projectJP";
$siteFlag = 1;

if(!$authenticated) {
  $title = "Oops! Please Login First";
  require("weddingHead.inc");
  echo "</header>\n";
  echo "<p class=\"col-md-6 mx-auto my-4 text-center\">In order to view the remainder of the site, you must be a guest and log in. There was a username and password provided to you on your invitation. Please use that username and password to access the RSVP page and register for an account. After your account has been verified, you will be able to access the rest of the site with your new username and password. Please visit the <a href=\"https://www.pellwedding.com/login.php\">Login Page</a> if you would like to view this website and RSVP for our wedding.</p>\n";
  require("weddingFoot.inc");
  die();
}


require("connecti2db.inc.php");
require("weddingHead.inc");
require("nav.inc");

# Under construction notification for un-finished pages.

echo <<<ARTDOC
<article class="container text-center">
  <h2 class="col-md-6 offset-md-3 mx-auto">Oops!</h2>
  <p class="col-md-8 offset-md-2">Please excuse our mess! This site is currently under construction and we will hopefully have things ready for you soon! Please enjoy the rest of the site and this page will be ready before you know it!</p>
  <img src="img/200px-Commons-emblem-Under_construction-green.svg.png" width="200" height="200" class="img-fluid col-md-3 mx-auto" alt="under construction img" />
</article>
ARTDOC;

/*
echo <<<ARTDOC
<h2 class="text-center my-5">The Place</h2>
<div class="row">
	<div class="col-md-4">
		<img class="img  m-auto" src="img/barn_overview.jpg" width="467" height="350" alt="Ariel image of red barn at St. Patrick's park" />
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="col-md-3">
				<h5 class="text-center m-auto"><strong>Location:</strong></h5>
			</div>
			<div class="col-md-9">
				<h6 class="text-center">St. Patrick's Park<br/>50651 Laurel Road<br/>South Bend, IN 46637</h6>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<h5 class="text-center m-auto"><strong>Date:</strong></h5>
			</div>
			<div class="col-md-9">
				<h6 class="text-center">October 12, 2019<br/>4:15 PM</h6>
			</div>
		</div>
		<div class="row">
			<p class="text-center">We will have at our disposal the barn, gazebo, and Pfiel Pavilion. Ceremony will be held at the gazebo with the reception to follow at the red barn and pavilion. Drinks and food will be provided, but alcohol is BYOB. The rules for alcohol are: no glass bottles (except for wine), beer and wine ONLY, and you must bring your own coolers if you wish to keep your alcohol cold. We will be providing enough wine for a toast as well as soda and water. Catering will be provided by Dreaded Chef Hospitality from Indianapolis, IN and will consist of soup, salad, and sandwiches.</p>
		</div>
	</div>
	<div class="col-md-4">
		<img class="img  m-auto" src="img/gazebo.jpg" width="467" height="350" alt="Image of gazebo with flowers arranged around it" />
	</div>
</div>
ARTDOC;

$query = "SELECT firstName,lastName
	  	  FROM users
	  	  WHERE firstName = '$fname' AND lastName = '$lname'";
$result = mysqli_query($connection,$query) or
die("<b>Query Failed</b><br />$query<br />".mysqli_error($connection));

$count = mysqli_num_rows($result);
if($count != 0)
{
	
}

echo <<<ARTDOC
<h2 class="text-center mt-5">Travel</h2>
<div class="row">
	<div class="col-md-5 m-5 embed-responsive embed-responsive-1by1" id="map">
		<script>
      		function initMap() {
				var map = new google.maps.Map(document.getElementById('map'), {
          		center: {lat: 41.758096, lng: -86.267656},
          		zoom: 15
				});
				
				var marker = new google.maps.Marker({
					position: {lat: 41.758096, lng: -86.267656},
					map: map,
					title: 'St. Patrick\'s Park'
				});
			}
      	</script>
	</div>
	<div class="col-md-6 my-5">
		<p class="text-center">We know there are many of our family members who are coming from out of town. If you are planning on staying in town, we would suggest looking up and booking a hotel as soon as you possibly can. St. Patrick's park is just north of Notre Dame and the weekend of our wedding is a Notre Dame/USC game played at Notre Dame. While traffic will not be bad once you are off the highway, the hotels in the area will be full or have severely increased prices for that weekend. I would suggest looking for hotel locations in Niles, LaPorte, Plymouth, Elkhart, and Saint Saint Joseph. All of those locations are within an hour drive of the wedding location and should not be majorly impacted by the Notre Dame game.</p>
		<p class="text-center">The following button will provide you with driving directions from the address you listed when you registered for this site to St. Patrick's Park.</p>
		<a class="btn btn-primary col-md-6 offset-md-3 my-2" id="login" href="https://www.google.com/maps/dir/$addr,+$city,+$state+$zip,+USA/St.+Patrick's+County+Park,+50651+Laurel+Rd,+South+Bend,+IN+46637/@40.6757848,-87.5584774,8z/data=!3m1!4b1!4m13!4m12!1m5!1m1!1s0x886b5d95fce445cd:0xbdc9a99ac026ad58!2m2!1d-86.1499172!2d39.6083159!1m5!1m1!1s0x88112cc8b9dd73d9:0xf1f9e22772d7ac84!2m2!1d-86.2655692!2d41.7551906" role="button">Direction</a>
	</div>
</div>
ARTDOC;

echo "<script async defer src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyDX0uVUPKuqBLPO_Q_mmhrKD-9saPEaVoc&callback=initMap\"></script>\n";
*/

mysqli_close($connection);
require("weddingFoot.inc");
