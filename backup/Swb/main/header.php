<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
</script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="Sweeba the Social Network that Rewards you!">
<meta name="author" content="Sweeba.com">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="apple-touch-icon" href="https://www.sweeba.com/dist/img/app2.png">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="robots" content="index, follow" />
<meta name="mobile-web-app-capable" content="yes">
<link rel="apple-touch-startup-image" href="https://www.sweeba.com/dist/img/app2.png">
<link rel="icon" href="https://sweeba.com/favicon.ico">
<title>Sweeba</title>
<link rel="shortcut icon" type="image/x-icon" href="https://sweeba.com/favicon.ico">

<link href="<?php echo SITE_URL;?>dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo SITE_URL;?>style.css" rel="stylesheet" type="text/css">
<link href="<?php echo SITE_URL;?>css/responsive.css" rel="stylesheet" type="text/css">
<style type="text/css">

.wrap1 {
   max-width: 1028px;
    margin: 0 auto;
    margin-top:60px;
}



.yo { 
color:#000;
padding-right:10px;
}
.yo:hover {
background:#00adee;
padding:5px;
color:#fff;
text-decoration:none;
}

.logo {
display: block;
width: auto;
max-width: 100%;
margin-top:-10px;
margin-left:-10px;

}

.avatar {
display:block;
height:auto;
max-width:120%;
margin-top:10px;
}

.nav-marg {
margin-left:5%;
margin-right:5%;
}

</style>

</head>

    <nav class="navbar navbar-default navbar-fixed-top" style="font-family: 'Open Sans', sans-serif;">
     <div class="nav-marg">
        <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <a class="navbar-brand" href="<?php echo SITE_URL;?>dash.php"><img src="dist/img/sweeba.png" class="logo hidden-xs"><img src="images/IVynm2a.png" class="logo visible-xs"></a>
        </div>
  
            
        <div id="navbar" class="collapse navbar-collapse">
              <?php if($logged_in == 'yes'){ ?>
         
        <form method="post" action="tags.php" class="navbar-form navbar-left" role="search">
            <input type="text" class="form-control form_in" style="width:160px;" placeholder="Search Sweeba" name="tag"> <button type="submit" class="btn btn-search">Go</button>
            </form> 
            <?php } ?>
            
            
             <ul class="nav navbar-nav navbar-right">
        
                <?php if($logged_in == 'no'){ ?>
            <ul class="nav navbar-nav navbar-right" style="font-family: 'Open Sans', sans-serif;">
        
<li class="random_2"><a href="random.php"><img src="dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"> Surf</a></li>
<li><a href="raffle.php"> <img src="dist/img/ticketssmall.png" style="height:16px;width:16px;margin-top:-4px;"> Winners</a></li>  
 <li><a href="spin.php"> <img src="dist/img/wheel-icon.png" style="height:18px;width:18px;margin-top:-4px;"> Spin</a></li>  
<li><a href="match.php"> <img src="images/sweeba-match.png" style="height:16px;width:16px;margin-top:-4px;"> Match</a></li>
<li><a href="sweeb.php"> <img src="dist/img/light.png" style="height:16px;width:16px;margin-top:-4px;"> Sweeb</a></li>
            <li><a href="login.php"><img src="https://sweeba.com/dist/img/login.png" style="margin-top:-4px;"> Login</a></li>
            <li><a href="register.php"><img src="https://sweeba.com/dist/img/users81.png" style="margin-top:-4px;"> Register</a></li>
            </ul>
    <?php }else{ ?>
            
            
              <li class="dropdown hidden-xs" style="height:50px;background:#eef0f2;">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <img src="grab_image.php?img=<?php echo $avatar; ?>" style="height:32px;width:32px;border-radius:3px;border-radius:100%;margin-top:-5px; "></a>
          
          <ul class="dropdown-menu">
            <li><a href="dash.php"><img src="images/TQDIGBX.png" style="margin-top:-4px;"> Dash</a></li> 
            <li class="random_1"><a href="random.php"><img src="dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"> Start Surfing</a></li>
<li><a href="/<?php echo $username; ?>" style="text-decoration:none;"><img src="grab_image.php?img=<?php echo $avatar; ?>" style="height:16px;width:16px;margin-top:-4px;"> Your Profile</a></li>
            <li><a href="sweeb.php"><img src="dist/img/light.png" style="height:16px;width:16px;margin-top:-4px;"> New Sweeb</a></li>
              <li><a href="sweebs.php"><font color="#5fb5f2">🔨</font> Manage Sweebs</a></li>
<li><a href="stats_view.php"><font color="#5fb5f2">📊</font> Sweeb Stats</a></li>
            <li><a href="reset.php"><font color="#5fb5f2">🔧</font> Update Account</a></li>
             <li><a href="spin.php"><img src="dist/img/wheel-icon.png" style="height:18px;width:18px;margin-top:-4px;"> Spin</a></li>
              <li><a href="leaderboard.php"><img src="https://sweeba.com/images/matches.png" width="16" height="16"> Leaderboard</a></li>
    <li><a href="upgrade.php"><img src="https://sweeba.com/images/upgrade-now.png" width="16" height="16"> Upgrade</a></li> 
     <li><a href="purchase.php"><font color="#5fb5f2">🛒</font> Buy Credits</a></li> 
      <li><a href="/my_followers.php"><img src="https://sweeba.com/dist/img/users6.png" width="16" height="16"> Followers</a></li>
           <li><a href="match.php"><img src="images/sweeba-match.png" style="height:16px;width:16px;margin-top:-4px;"> Find Matches</a></li>	
           <li><a href="matches.php"><font color="#5fb5f2">🕯</font> Your Matches</a></li> 
            <li><a href="views.php"><img src="https://sweeba.com/images/views.png" width="16" height="16"> Profile Views</a></li>
        <li><a href="ring_history.php"><img src="https://sweeba.com/images/ring-diamond.png" width="16" height="16"> Ring History</a></li> 
        <li><a href="notifications.php"><img src="dist/img/notify.png" style="height:16px;width:16px;margin-top:0px;"> Notifications</a></li> 
            <li><a href="message.php"><img src="dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> Messages</a></li>
            <li><a href="refs.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Refer Members</a></li>
           <li><a href="support.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Support</a></li>
            <?php if($msg == 'yes'){ ?>
            <li> <a href="message.php"> <img src="dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> New</a></li>
            <li role="separator" class="divider"></li>
            
            <?php } ?>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
          </ul>
        </li>
      </ul>
           
          </ul>  
            
            <ul class="nav navbar-nav navbar-right visible-xs" style="font-family: 'Open Sans', sans-serif;">
            <li><a href="dash.php"><img src="images/TQDIGBX.png" style="margin-top:-4px;"> Dash</a></li> 
            <li class="random_1"><a href="random.php"><img src="dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"> Start Surfing</a></li>
            <li><a href="/<?php echo $username; ?>"><img src="grab_image.php?img=<?php echo $avatar; ?>"  width="16" height="16" style="height:16px;width:16px;margin-top:-4px;"> Your Profile</a></li>
            <li><a href="sweeb.php"><img src="dist/img/light.png" style="height:16px;width:16px;margin-top:-4px;"> New Sweeb</a></li> 
             <li><a href="sweebs.php"><font color="#5fb5f2">🔨</font> Manage Sweebs</a></li>
             <li><a href="stats_view.php"><font color="#5fb5f2">📊</font> Sweeb Stats</a></li>
            <li><a href="reset.php"><font color="#5fb5f2">🔧</font> Update Account</a></li> 
             <li><a href="spin.php"><img src="dist/img/wheel-icon.png" style="height:16px;width:16px;margin-top:-4px;"> Spin</a></li>                 
               <li><a href="leaderboard.php"><img src="https://sweeba.com/images/matches.png" width="16" height="16"> Leaderboard</a></li>  
            <li><a href="raffle.php"><img src="dist/img/ticketssmall.png" style="height:16px;width:16px;margin-top:-4px;"> Winners</a></li>     
            <li><a href="upgrade.php"><img src="https://sweeba.com/images/upgrade-now.png" width="16" height="16"> Upgrade</a></li>
            <li><a href="purchase.php"><font color="#5fb5f2">🛒</font> Buy Credits</a></li> 
           <li><a href="match.php"><img src="images/sweeba-match.png" style="height:16px;width:16px;margin-top:-4px;"> Find Matches</a></li>	
            <li><a href="matches.php"><font color="#5fb5f2">🕯</font> Your Matches</a></li>
            <li><a href="views.php"><img src="https://sweeba.com/images/views.png" width="16" height="16"> Profile Views</a></li>
            <li><a href="ring_history.php"><img src="https://sweeba.com/images/ring-diamond.png" width="16" height="16"> Ring History</a></li> 
            <li><a href="notifications.php"><img src="dist/img/notify.png" style="height:16px;width:16px;margin-top:0px;"> Notifications</a></li>    
            <li><a href="my_followers.php"><img src="https://sweeba.com/dist/img/users6.png" width="16" height="16"> Followers</a></li>
            <li><a href="check_in.php"><img src="https://sweeba.com/dist/img/friends.png" width="16" height="16"> Check-in</a></li>
            <li><a href="message.php"><img src="dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> Messages</a></li>
            <li><a href="trending.php"><font color="#5fb5f2">⦾</font> View Trending</a></li>
            <li><a href="friends.php"><font color="#5fb5f2">🫂</font> Find Friends</a></li>
           <li><a href="refs.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Refer Members</a></li>
           <li><a href="support.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Support</a></li>
             <li><a href="logout.php"> <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
            <?php if($msg == 'yes'){ ?>
            <li><a href="message.php"><img src="dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> New</a></li>
            <li role="separator" class="divider"></li>
            <?php } ?>
            </ul>
            
            
              <ul class="nav navbar-nav navbar-right hidden-xs" style="font-family: 'Open Sans', sans-serif;">
                  <?php if($notifications >= 1){ ?>
            <li><a href="notifications.php"> <img src="dist/img/notify.png" style="height:16px;width:16px;margin-top:0px;"> <span style="color:#f44336;font-family: 'Open Sans', sans-serif;font-weight:bold;"><?php echo $notifications; ?></span></a></li>
            <?php } ?>
             <li class="random_2"><a href="random.php"><img src="dist/img/random5.png" style="height:16px;width:16px;margin-top:-4px;"> Surf</a></li>
           <li><a href="raffle.php"> <img src="dist/img/ticketssmall.png" style="height:16px;width:16px;margin-top:-4px;"> Winners</a></li>    
           <li><a href="spin.php"> <img src="dist/img/wheel-icon.png" style="height:18px;width:18px;margin-top:-4px;"> Spin</a></li>  
           <li><a href="match.php"> <img src="images/sweeba-match.png" style="height:16px;width:16px;margin-top:-4px;"> Match</a></li>
           <li><a href="dash.php"><img src="images/TQDIGBX.png" style="margin-top:-4px;">Dash</a></li>
           <li><a href="sweeb.php"> <img src="dist/img/light.png" style="height:16px;width:16px;margin-top:-4px;"> Sweeb</a></li>
                
            <?php if($msg == 'yes'){ ?>
            <li><a href="message.php"> <img src="dist/img/email5.png" style="height:16px;width:16px;margin-top:-4px;"> New</a></li>
            <?php } ?>
            </ul>
            <?php } ?>

        </div>
     </div>

    </nav>

 <div class="wrap" style="margin-top:80px;">
