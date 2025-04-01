<?php include('main/config.php');
include('main/functions.php');

// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

?>
<?php
include('main/header.php');
?>

<style>
body {

font-family: 'Open Sans', sans-serif;
}
p {
font-family: 'Open Sans', sans-serif;
}

.clipboard {
    border: 0;
    padding: 25px;
    border-radius: 3px;
    
    cursor: pointer;
    color: #04048c;
    font-family: 'Karla', sans-serif;
    font-size: 18px;
    position: relative;
    top: 0;
    transition: all .2s ease;
    &:hover {
      top: 2px;
    }

.container {
  width: 500px;
}

.box {
    font-family: 'Open Sans', sans-serif;
    display: inline-block;
    background: #fff;
    border: 1px solid #eee;
    margin: 0 2px 15px;
  }  

</style>







<div  class="box" style="width:100%;padding:0px;margin-bottom:10px;">
<div style="width:100%;background:#5fb5f2;height:30px;color:#fff;text-align:center;font-weight:Bold;font-size:16px;padding-top:4px;font-family: 'Open Sans', sans-serif;">
Sweeba Offers
</div>
    
<div style="margin:20px;">


<iframe sandbox="allow-popups allow-same-origin allow-scripts allow-top-navigation-by-user-activation allow-popups-to-escape-sandbox" src="https://www.lnksforyou.com/list/28740" style="width:100%; height:690px; border:none;" frameborder="0"></iframe>



</div>


</div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="/dist/js/bootstrap.min.js"></script>
   
   
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47181279-4', 'auto');
  ga('send', 'pageview');

</script>


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
</script>
  </body>
</html>
<?php
 function getPremimumMember($id,$conn)
{
    //checking premium meber or not
    $date = date('Y-m-d');
    $ref_com = '0.00';
  $sql_premium ="SELECT * FROM subscription where user_id='".$id."' AND expire_date > '".$date."' AND status='Success'";
  $result_premium = $conn->query($sql_premium);
  if($result_premium->num_rows > 0)
  {
    $ref_com = '0.20';
  }else{
    $ref_com = '0.10';
  }
  return $ref_com;
}

?>