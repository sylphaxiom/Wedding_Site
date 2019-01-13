<?php
/*	Author:		Jacob Pell
	Program:	htmlHead.inc
	Date Written:	11/08/2018
	Description:	Special version of htmlHead.inc that
			automatically populates with meta
			tags from database table
*/

$metaStr = "";

if($siteFlag == 0)
{
  $metaStr  = "\t<meta name=\"keywords\" content=\"$keywordList\" />\n";
  $metaStr .= "\t<meta name=\"description\" content=\"$metaDescription\" />\n";
}// END IF NOT SITEFLAG
echo "<!doctype html> <!-- Author:	$author -->\n";
echo "<html lang=\"en\"><!-- Date Written: $dateWritten -->\n";
echo "<head>		<!-- Description: $description -->\n";
echo "\t<title>$title</title>\n";
echo "\t<meta charset=\"utf-8\" />\n";
echo $metaStr;
echo "\t<link rel=\"stylesheet\" href=\"weddingStyles.css\" />\n";
echo "\t<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\"/>\n";
echo "<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>\n";
echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>\n";
echo "<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js\" integrity=\"sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy\" crossorigin=\"anonymous\"></script>\n";
echo "<link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.5.0/css/all.css\" integrity=\"sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU\" crossorigin=\"anonymous\">\n";
echo "</head>\n";
echo "<body>\n";

echo <<<HEADDOC
<header>
  <div class="row text-center">
    <img class="col-2 ml-auto" src="svg/leaf_filigree_L.svg" width="200" height="100" alt="decorative filigree" />
    <h1 class="col-4 my-auto">$title</h1>
    <img class="col-2 mr-auto" src="svg/leaf_filigree_R.svg" width="200" height="100" alt="decorative filigree" />
  </div>
  <hr class="my-1" />
  <hr class="my-1" />
</header>
HEADDOC;
?>
