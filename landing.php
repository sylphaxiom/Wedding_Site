<?php
/*
  Author: Jacob Pell
  Script: landing.php
  LastUpdate: 11/08/2018
  Description: Landing page for wedding website and SDEV 253 project.
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
echo <<<ARTDOC
<article>
  <div class="row mt-4">
    <p class="text-center col-md-10 mx-auto">Thank you for visiting our wedding website! We are pleased to have you as a part of our wedding. If you are a guest and would like some information on the site, please log in using the button below. If you are not a guest and just wanted to view our website and our story, you can find all of that on this home page along with a few of our engagement photos.</p>
  </div>
  <a class="btn btn-primary col-md-4 offset-md-4" id="login" href="login.php" role="button">Log In</a>
</article>
ARTDOC;

require("weddingFoot.inc");
mysqli_close($connection);
?>
