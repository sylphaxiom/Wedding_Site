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
/*
echo <<<ARTDOC
<article class="container text-center">
  <h2 class="col-md-6 offset-md-3 mx-auto">Oops!</h2>
  <p class="col-md-8 offset-md-2">Please excuse our mess! This site is currently under construction and we will hopefully have things ready for you soon! Please enjoy the rest of the site and this page will be ready before you know it!</p>
  <img src="img/200px-Commons-emblem-Under_construction-green.svg.png" width="200" height="200" class="img-fluid col-md-3 mx-auto" alt="under construction img" />
</article>
ARTDOC;
*/

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

echo <<<ARTDOC
<h2 class="text-center my-5">Travel</h2>
<div class="row">
	<div class="col-md-6 embed-responsive embed-responsive-1by1" id="map">
		<script>
      		function initMap() {
				var map = new google.maps.Map(document.getElementById('map'), {
          		center: {lat: 41.7562869, lng: -86.2705357},
          		zoom: 15
				});
				var request = {
					location: map.getCenter(),
					radius: '500',
					query: 'St. Patrick\'s County Park'
			  	};

				var service = new google.maps.places.PlacesService(map);
				service.textSearch(request, callback);
			}
				
			// Checks that the PlacesServiceStatus is OK, and adds a marker
			// using the place ID and location from the PlacesService.

			function callback(results, status) {
				if (status == google.maps.places.PlacesServiceStatus.OK) {
					var marker = new google.maps.Marker({
						map: map,
						place: {
							placeId: results[0].place_id,
							location: results[0].geometry.location
						}
					});
				}
			}
      	</script>
	</div>
	<div class="col-md-6">
		<p class="text-center">We know there are many of our family members who are coming from out of town. If you are planning on staying in town</p>
	</div>
</div>
ARTDOC;

echo "<script async defer src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyDX0uVUPKuqBLPO_Q_mmhrKD-9saPEaVoc&callback=initMap\"></script>\n";

mysqli_close($connection);
require("weddingFoot.inc");
