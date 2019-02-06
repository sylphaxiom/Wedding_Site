<?php
/*
  Author: Jacob Pell
  Landing page for wedding website. Constructed wth PHP using Bootstrap framework
  There is no navigation on this page. The only thing that people can do is view the 
  engagement photos and read a little about us, then log into the website to view the
  rest of the site. 
  Constructed 01/13/2019
  Git version controlled.	
*/

$author = "Jacob Pell";
$dateWritten = "11/08/2018";
$description = "Landing page of personal wedding website";
$title = "The Pell Wedding";
$pageID = "landing";
$dbName = "projectJP";
$authenticated = 0;
$siteFlag = 0;

require("connecti2db.inc.php");
require("metaQueries.inc");
require("weddingHead.inc");

#Top portion of the page with names, photo, and colorful filigre
echo <<<ARTDOC
<article class="pt-5">
	<div class="row">
		<h2 class="col-md-2 text-right my-auto">Jacob Pell</h2>
    	<img class="watermark col-md-2 img" src="svg/filigreeLR.svg" width="229" height="276" alt="decorative filigree" />
    	<img class="col-md-4 img-fluid" src="img/Austyn_and_I.jpg" width="960" height="641" alt="Image of couple" />
    	<img class="watermark col-md-2 img" src="svg/filigreeLL.svg" width="229" height="276" alt="decorative filigree" />
    	<h2 class="col-md-2 my-auto">Austyn Kiser</h2>
  	</div>
</article>
ARTDOC;

#Text explaining page and button to log in to the main site.
echo <<<ARTDOC
<article>
  	<div class="row mt-4">
    	<p class="text-center col-md-10 mx-auto">Thank you for visiting our wedding website! We are pleased to have you as a part of our wedding. If you are a guest and would like some information on the site, please log in using the button below. If you are not a guest and just wanted to view our website and our story, you can find all of that on this home page along with a few of our engagement photos.</p>
  	</div>
  	<a class="btn btn-primary col-md-4 offset-md-4" id="login" href="login.php" role="button">Log In</a>
</article>
ARTDOC;

#Brief "our story" modeled off of the our story page on the site, but with brief information about us.
echo <<<ARTDOC
<article class="container-fluid row">
  <div class="col-md-2">
    <img class="img round" src="img/linkedin_pic.jpg" width="200" height="200" alt="Profile image of Jacob Pell" />
  </div>
  <div class="col-md-8">
    <h2 class="text-center">The Happy Couple</h2>
    <p class="text-justify">Jake and Austyn met back in July of 2016. They took things slow but it was electrifying from the very beginning. They both shared a love of animals and the country where they, one day, hope to live with their family. Jake had 2 kids, Bently and Calliope, Austyn has taken to and loves those kids as if they were her very own, and those kids love her like crazy as well. Jake proposed in October of 2017 and the process of planning and getting ready for the wedding began! Our love has never waivered through our relationship and we are very excited for our wedding in October of 2019. It has been quite the jouney getting here and neither of us would trade it for the world! For those of you who are invited to the wedding, we hope to see you there. For those that we were, unfortunately, not able to invite please feel free to contact either Austyn or Jake and send your congratulations! We would love to hear from you.</p>
  </div>
  <div class="col-md-2">
    <img class="img round" src="img/austyn.jpg" width="950" height="950" alt="Profile image of Austyn Kiser" />
  </div>
</article>
ARTDOC;

#Custom made slide show for our wedding photos using bootstrap.
echo <<<ARTDOC
<div id="carouselIndicators" class="carousel slide w-50 h-50 mx-auto" data-ride="carousel">
  	<ol class="carousel-indicators">
    	<li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
    	<li data-target="#carouselIndicators" data-slide-to="1"></li>
    	<li data-target="#carouselIndicators" data-slide-to="2"></li>
  	</ol>
  	<div class="carousel-inner">
    	<div class="carousel-item active">
      		<img class="d-block w-auto h-100 mx-auto" src="img/Austyn_and_I.jpg" alt="Happy couple looking at camera">
    	</div>
    	<div class="carousel-item">
      		<img class="d-block w-auto h-100 mx-auto" src="img/Austyn_and_I_blanket.jpg" alt="happy couple kissing with blanket on shoulders">
    	</div>
    	<div class="carousel-item">
      		<img class="d-block w-auto h-100 mx-auto" src="img/ring_on_leaf.jpg" alt="Ring on a leaf">
    	</div>
    	<div class="carousel-item">
      		<img class="d-block w-auto h-100 mx-auto" src="img/bw_kiss.jpg" alt="happy couple kissing in black and white">
    	</div>
    	<div class="carousel-item">
      		<img class="d-block w-auto h-100 mx-auto" src="img/grossed_kiss.jpg" alt="Couple kissing with kids in front lookng grossed out">
    	</div>
    	<div class="carousel-item">
      		<img class="d-block w-auto h-100 mx-auto" src="img/ring_hand.jpg" alt="Holding hands and showing off the ring">
    	</div>
    	<div class="carousel-item">
      		<img class="d-block w-auto h-100 mx-auto" src="img/wrestle_kids_ring.jpg" alt="Showing off ring with man wrestling with kids in background">
    	</div>
  	</div>
  	<a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    	<span class="sr-only">Previous</span>
  	</a>
  	<a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
    	<span class="sr-only">Next</span>
  	</a>
</div>
ARTDOC;

require("weddingFoot.inc");
mysqli_close($connection);
?>
