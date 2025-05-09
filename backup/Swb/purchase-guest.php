<?php include('main/config.php');
include('main/functions.php');
//include('main/message.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }


$get_m_id = strip_tags($_GET["dlt"]);


$sql = "SELECT * FROM members WHERE avatar!='user.png' ORDER BY id desc";
        $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
             $name= filter_var($row['avatar']);
            $check = 'file/'.$name.'';
            if (file_exists($check)) {
                
                //exist image into foder
                
            }else{
              $sql = "UPDATE members SET avatar='user.png' WHERE id=".$row['id'];
               $conn->query($sql);
            }

          }
?>
<?php
include('main/header.php');
?>
   <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
   <style>
* {
  box-sizing: border-box;
}

.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}

.price {
  list-style-type: none;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}


.price .header {
  background-color: #111;
  color: white;
  font-size: 25px;
}

.price li {

  padding: 15px;
  text-align: center;
}

.price .grey {
  background-color: #eee;
  font-size: 20px;
}

.button {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}

@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}

.btn-success2 {
    color: #FFF;
    font-size: 17px;
    background-color: #000;
    border-color
}

.btn-success {
    color: #FFF;
    font-size: 17px;
    background-color: #5fb5f2;
    border-color: #4cae4c;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
   } 

   .btn-search {
    border: 1px solid #b6c0c9;
    color: #b6c0c9;
    background: none;
    font-size: 14px;
    font-weight: Bold;
    border-radius: 0px;
}


.cloud {
	width: 335px; height: 200px;
	
	background: #f2f9fe;
	background: linear-gradient(top, #fff 5%, #d0deec 100%);
	background: -webkit-linear-gradient(top, #fff 5%, #d0deec 100%);
	background: -moz-linear-gradient(top, #fff 5%, #d0deec 100%);
	background: -ms-linear-gradient(top, #fff 5%, #d0deec 100%);
	background: -o-linear-gradient(top, #fff 5%, #d0deec 100%);
	
	border-radius: 100px;
	-webkit-border-radius: 100px;
	-moz-border-radius: 100px;
	
	position: relative;
	margin: 45px auto 20px;
}

.cloud:after, .cloud:before {
	content: '';
	position: absolute;
	background: #FFF;
	z-index: -1
}

.cloud:after {
	width: 100px; height: 100px;
	top: -30px; left: 50px;
	
	border-radius: 100px;
	-webkit-border-radius: 100px;
	-moz-border-radius: 100px;
}

.cloud:before {
	width: 180px; height: 180px;
	top: -50px; right: 50px;
	border-radius: 200px;
	-webkit-border-radius: 200px;
	-moz-border-radius: 200px;
}

#rocket {
  position: relative;
  size: large;
  top: 0;
  transition: top ease 0.5s;
}
#rocket:hover {
  top: -300px;
}

a:hover {
 text-decoration: none;
}

.glyphicon.glyphicon-check {
    font-size: 20px;
}





@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Source Sans Pro", sans-serif;
}
body {
  background-color: #d9e4ed;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
h1 {
  text-align: center;
  margin-top: 2rem;
}
p {
  text-align: center;
  margin-bottom: 4rem;
}
.pricing {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;

  .plan {
    background-color: #fff;
    padding: 2.5rem;
    margin: 12px;
    border-radius: 5px;
    text-align: center;
    transition: 0.3s;
    cursor: pointer;

    h2 {
      font-size: 22px;
      margin-bottom: 12px;
    }

    .price {
      margin-bottom: 1rem;
      font-size: 30px;
    }

    ul.features {
      list-style-type: none;
      text-align: left;
      li {
        margin: 8px;
        .fas {
          margin-right: 4px;
        }
        .fa-check-circle {
          color: #6ab04c;
        }
        .fa-times-circle {
          color: #eb4d4b;
        }
      }
    }

    button {
      border: none;
      width: 100%;
      padding: 12px 35px;
      margin-top: 1rem;
      background-color: #5fb5f2;
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    &.popular {
      border: 2px solid #6ab04c;
      position: relative;
      transform: scale(1.08);

      span2 {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #6ab04c;
        color: #fff;
        padding: 4px 20px;
        font-size: 18px;
        border-radius: 5px;
      }
    }

    &:hover {
      box-shadow: 5px 7px 67px -28px rgba(0, 0, 0, 0.37);
    }
  }
}


</style>



            <?php if($user_id_sess==14508){ ?>



              <?php } ?>

<center>


<h3> Get Double the credits </h3>

<h4>Receive exposure by purchasing credits for your campaigns. <br>
<span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Receive Bonus un-assigned referrals.</h4>
</center>
<BR><br>
<div class="pricing">
      <div class="plan">
    <h2>500 credits</h2>
    <h5>+ 500 bonus credits</h5>
        <div class="price">$7.99</div>
        <ul class="features">
        <center>
       
        <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 0.008 per view
         <br>
         <font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> <b>BONUS</b></font> <b>2</b> unassigned referrals
         </center>
       
        </ul>
<a href="https://buy.stripe.com/4gw9DTgFE22S0pO4gn" data-testid="hosted-buy-button-text"><button>Credit Card</button></a>
<br>    
<a href="https://www.paypal.com/ncp/payment/4WFJ6WDYW9MAG" data-testid="hosted-buy-button-text"><button>Paypal</button></a>


      </div>
      

 <div class="plan popular">
        <span2>Most Popular</span2>
          <h2>2500 credits</h2>
    <h5>+ 2500 bonus credits</h5>

        <div class="price">$25.99</div>
        <ul class="features">
    <center>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 0.005 per view
           <br>
  <font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> <b>BONUS</b></font> <b>10</b> unassigned referrals
         </center>
        </ul>

        <a href="https://buy.stripe.com/28oaHXblkfTI8WkbIN" data-testid="hosted-buy-button-text"><button>Credit Card</button></a>
        <br>
     
     <a href="https://www.paypal.com/ncp/payment/T8DUFL69YC5PC" data-testid="hosted-buy-button-text"><button>Paypal </button></a>
     <br>
<a href="https://nowpayments.io/payment/?iid=5023183997" data-testid="hosted-buy-button-text"><button>Bitcoin</button></a>


      </div>



 <div class="plan">
    <h2>1000 credits</h2>
    <h5>+ 1000 bonus credits</h5>

        <div class="price">$12.99</div>
        <ul class="features">
        <center>
          <font color="#6ab04c"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></font> 0.006 per view
           <br>
          <font color="#6ab04c"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> <b>BONUS</b></font> <b>4</b> unassigned referrals
         </center>
       
        </ul>
<a href="https://buy.stripe.com/bIY2brahgdLA8Wk006" data-testid="hosted-buy-button-text"><button>Credit Card</button></a>
<br>    
<a href="https://www.paypal.com/ncp/payment/B4YVDSBTCZKV4" data-testid="hosted-buy-button-text"><button>Paypal</button></a>

</div>
</div>


<div class="col-md-12" style="margin-left: auto; margin-right: auto;">
                    <div class="content">

                    <h3 id="message" style="color:black;"></h3>
                            <div id="question"><h1></h1><Br>
                            </div>
                    <div id="chart">

                    </div>
                    <Br>
                        
                   </div>
                </div>
            

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>  



   
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