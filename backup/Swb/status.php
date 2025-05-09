<?php include('main/config.php');

// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

include('main/header.php');
?>

<style>
body {

font-family: 'Open Sans', sans-serif;
}
p {
font-family: 'Open Sans', sans-serif;
}

</style>

  
<div class="container" style="font-family: 'Open Sans', sans-serif;">
<div class="row">

<?php include("main/side_bar.php"); ?>

<div class="col-md-6">
<style>
.sweeb_b {
color:#fff;
margin-bottom:25px;
height:100px;
  position: relative;
  //display:block;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 2px;
 
  text-transform: uppercase;
  outline: 0;
  overflow:hidden;
  background: none;
  z-index: 1;
  cursor: pointer;
  transition:         0.08s ease-in;
  -o-transition:      0.08s ease-in;
  -ms-transition:     0.08s ease-in;
  -moz-transition:    0.08s ease-in;
  -webkit-transition: 0.08s ease-in;
}
.sweeb_b a {
color:#fff;
}
.sweeb_g {
background:#a2de5a;
}

.sweeb_bl {
background:#5fb5f2;


}
.sweeb_r {
background:#f26986;

}


.sweeb_g:hover, .sweeb_bl:hover, .sweeb_r:hover {
  color: whitesmoke;
}

.sweeb_g:before, .sweeb_bl:before, .sweeb_r:before {
  content: "";
  position: absolute;
background:#3e4851;
  bottom: 0;
  left: 0;
  right: 0;
  top: 100%;
  z-index: -1;
  -webkit-transition: top 0.09s ease-in;
}

.sweeb_g:hover:before, .sweeb_bl:hover:before, .sweeb_r:hover:before {
  top: 0;
}




.sweeb {
background:#fff;
padding:20px;
}
</style>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<a href="sweeb.php" style="display:block;">
<div class="col-md-12 sweeb_b sweeb_g">

<p style="text-align:center;padding-top:12px;">
<img src="http://i.imgur.com/tMnVXCo.png"><br>
<a href="sweeb.php" style="font-size:14px;font-weight:Bold;">New Sweeb</a>
</p>
</div></div></a>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 sweeb_b sweeb_bl">
<p style="text-align:center;padding-top:12px;">
<img src="http://i.imgur.com/P2lDkM7.png"><br>
<a href="trending.php" style="font-size:14px;font-weight:Bold;">View Trending</a>
</p>
</div></div>

<div class="col-md-4 col-xs-4" style="padding:0px;">
<div class="col-md-12 sweeb_b sweeb_r">
<p style="text-align:center;padding-top:12px;">
<img src="http://i.imgur.com/ZPyvJAF.png"><br>
<a href="sweeb.php" style="font-size:14px;font-weight:Bold;">Find Friends</a>
</p>
</div>
</div>

<div class="col-md-12" style="margin-left:-1px;padding:0px;">

<div class="box" style="width:100%;padding:0px;margin-bottom:10px;margin-left:-1px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;margin-bottom:15px;width:100%;border:0px;">
Sweeba Network Status
</div>

<div style="padding:15px;">
<h3>Sweeba Status & Updates</h3>
<img src="images/sweeba-status.png" border="0">

<h3>Latest Sweeba Updates</h3>
<b><i>June updates</i></b>
<br>
- We are currently in the process of converting the site into https from http as we add a SSL certicate to the server. Some functions may not work until we are done updating!
<br>
<b><i>May updates</i></b>
<br>
- We added a new daily raffle in which members can win daily prizes.
<br><br>
- We added a new search function to help search tags/content within Sweeba.
<br><br>
- We added popular tags on the Sweeb page to help members with trending topics to Sweeb about.
<br><bR>
<b><i>January updates</i></b>
<br>
- We fixed an issue which was causing members to randomly get logged out.
<Br<bR>
- We <Br>added a new Random Sweeb feature to help members discover more on Sweeba.
<Br><bR>
<b><i>December updates</i></b>
<br>
- We fixed an issue causing sessions to be logged out.
<br><Br>
- We made many cosmetic changes within the members area.
<br><Br>
- We made the homepage showcase 2 popular Sweeb's. This will help those who create quality Sweeb's.
<br><Br>
- We added a views count on Sweeb pages so you can see how many views your Sweeb's get.
<br><Br>
- We added statistics to the "manage sweebs" page and also a button to view them from that page.
<br><Br>
- We added a search engine within Sweeba to search for hashtags or keywords. This will help members better connect with like minded people resulting in more earnings for members.
<br><Br>
- We added a referral function so members can earn money from referring other Sweebers. You can find this feature within the dash menu under "Refer Members". You can earn up to 10 cents a referral and earn even more from more exposure.
<br><br>
<b><i>November updates</i></b>
<br>
- Sweeba for Desktops is fully functional.
<br><br>
- Mobile compatibility is under way <b>(85% complete)</b>.
<br><br>
- Facebook and Twitter buttons added to Sweebs so they can easily be shared to earn more.
<br><Br>
- Fixed issue with words being cut off within Sweeb descriptions.
<bR><br>
- Gravatar/Name on dashboard links to your profile.
<br><br>
- Profile button was added to your dashboard and within the top drop down menu.
<br><br>
- Comment usernames now link to the commentors profile.
<br><br>
- You can now add friends and send them messages on the message page.
<br><br>
- Notifications were added.
<br><br>
- Sort Sweebs on the Trending page by Newest, Daily, Weekly and Monthly.
<br><br>
- You can add a profile picture and background profile image.


<h2> Feedback</h2>
If you are experiencing any issues or have feedback you can Email us @ info@sweeba.com
<br><Br>

</body>
</html>