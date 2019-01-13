<?php
/*
	Author: Jacob Pell
	Date: 12/14/2018
	Description: Our Story page for wedding website
		     No additional functionality on here
*/
session_start();
$uname = empty($_SESSION['uname']) ? "" : $_SESSION['uname'];
$authenticated = empty($_SESSION['auth']) ? "" : $_SESSION['auth'];

$author = "Jacob Pell";
$dateWritten = "12/14/2018";
$description = "Our Story page for wedding website, no additional functionality on this page";
$title = "Our Story";
$pageID = "ourStory";
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
<article class="container-fluid row">
  <div class="col-md-2">
    <img class="img round" src="img/linkedin_pic.jpg" width="200" height="200" alt="Profile image of Jacob Pell" />
  </div>
  <div class="col-md-4">
    <h2 class="text-center">His Story</h2>
    <p class="text-justify">For me, everything started when I first met Austyn. She was waiting in her car to meet me for the first time. I don't think she new I was there yet, but I thought she looked beautiful. She was shy, but I could tell she was something special from the beginning. We were just going to wonder around some shops looking for a collar for her new dog that shewas getting soon, Piper. We wondered for a bit and eventually made our way into Petsmart. When we got over to the collar section, and were looking around we were next to eachother and our hands occasionally grazed eachother. At one point I felt the need to just move my hand a little more and we held hands for the first time. The feeling was something I could never forget. A rush of intense emotion that I had never experienced before came over me. I may have had a good feeling that this girl was something special before, but now I was certain. I knew I didn't want to let this woman go, and almost exactly a year later, we were engaged. Here we are, after nearly 2 and a half years of being together, I love this woman more and more as the days go on. I loved her from the beginning, but this, this is just a new beginning for us and our lives together. Though I though this moment and the feelings I felt on that first day we met were intense, it was nothing compared to the next time we would see eachother on our first date. That was an amazing night and one I will never forget, but I'll let Austyn tell that one (even though she doesn't count it as our first date).</p>
  </div>
  <div class="col-md-4">
    <h2 class="text-center">Her Story</h2>
    <p class="text-justify">After our first successful meeting to get Piper a collar, I was excited when Jake asked me if we could see eachother again. This time was more like our first date (according to him at least), but it was a special night all the same. We drove over to silver beach and, like last time, we fell into conversation. We walked all around the beach and the pier talking and enjoying the evening air when Jake asked if I wanted to go get something to eat. I suggested we go and get some coffee instead, since I was a little nervous. So we walked around the beach, up the river walk to Bigby's. Once we got up there, it turned out it was closed. Still wanting to get something, Jake suggested we go to this mexican restaurant next door and get something to eat. I hesitently agreed and we went in to have dinner. When we got done with dinner, we walked back up to the beach to sit on the sand and watch the sunset. There was enough light to sit by and there were clouds rolling in over the water. It was still really pretty so we sat on the beach and talked, sitting close. The dark clouds that were rolling in started to flash, it was a thunderstorm coming in. It was still a ways off, so Jake and I sat there watching the storm. While we were sitting there with lulls in the conversation I was hoping he'd kiss me, the feeling we both had in the store the other day was just as intense now when we held hands. It seemed like it took forever for him to finally catch on. He kissed me and the feeling we felt when we held hands paled in comparison with this. It was at that moment that it started raining. We didn't want to end the evening so soon, so we took our time going to the car. When we got to the car, it was pouring, but we wanted one more kiss to end the nigh. I was nervous back then, but I think I knew, there was something different about this guy. Since we've been together, I haven't been happier and I'm excited to marry the love of my life.</p>
  </div>
  <div class="col-md-2">
    <img class="img round" src="img/austyn.jpg" width="950" height="950" alt="Profile image of Austyn Kiser" />
  </div>
</article>
ARTDOC;

mysqli_close($connection);
require("weddingFoot.inc");
?>
