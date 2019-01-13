<?php
/*
	Author: Jacob Pell
	Date: 12/13/2018
	Description: build Nav bar for site
*/

//connection to db is in another file

$query = "SELECT pageID,linkText,siteFlag
	  FROM navigation
	  WHERE siteFlag = '$siteFlag'";

$result = mysqli_query($connection,$query) or
die("<b>Query Failed</b><br />" . mysqli_error($connection));

echo <<<NAVDOC
  <nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler nav-btn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon float-right"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">\n
NAVDOC;

while($row = mysqli_fetch_row($result))
{
  $href = $row[0];
  $linkText = $row[1];
  $flag = $row[2];
  $regEx = "/$pageID/";
  if(preg_match($regEx,$href) && ($flag == 0)) 
  { continue; }//skip iteration if active page
  echo "\t\t<li class=\"nav-item col-md-3 text-center\"><a href=\"$href\" class=\"nav-link\">$linkText</a></li>\n";
}// END WHILE LOOP

echo <<<NAVDOC
      </ul>
    </div>
  </nav>
  <hr class="my-1" />
  <hr class="my-1" />
</header>
NAVDOC;
?>
