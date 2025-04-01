<?php include('main/config.php');

include('main/functions.php');
checkLogin();
include('main/follow_premium_featured.php');
  // if($logged_in == 'no'){
  // header("Location: index.php");
  // }

;
function isMobile()
{
  return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

//$sql_last_login = "SELECT * FROM login_history WHERE user_id='$user_id_sess'";



?>
<?php
include('main/header.php');
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<style>
  ::afterbody {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
  }

  .container {
    width: 80%;
    margin: 50px auto;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }







  h1 {

    text-align: center;
    color: #333;
  }

  .chart-container {
    position: relative;
    height: 380px;
    width: 100%;

  }

  canvas {
    width: 100%;
    height: 100%;
  }
</style>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7LHWPPZECB"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'G-7LHWPPZECB');
</script>

<style>
  body {

    font-family: 'Open Sans', sans-serif;
  }

  p {
    font-family: 'Open Sans', sans-serif;
  }

  .sweeb_b {
    color: #000;
    margin-bottom: 25px;
    height: 100px;
    position: relative;
    //display:block;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 2px;

    text-transform: uppercase;
    outline: 0;
    overflow: hidden;
    background: none;
    z-index: 1;
    cursor: pointer;
    transition: 0.08s ease-in;
    -o-transition: 0.08s ease-in;
    -ms-transition: 0.08s ease-in;
    -moz-transition: 0.08s ease-in;
    -webkit-transition: 0.08s ease-in;
  }

  .sweeb_b a {
    color: #fff;
  }

  .sweeb_g {
    background: #a2de5a;
  }

  .sweeb_bl {
    background: #5fb5f2;


  }

  .sweeb_r {
    background: #f26986;

  }

  .sweeb_g:hover,
  .sweeb_bl:hover,
  .sweeb_r:hover {
    color: whitesmoke;
  }

  .sweeb_g:before,
  .sweeb_bl:before,
  .sweeb_r:before {
    content: "";
    position: absolute;
    background: #5cb85c;
    bottom: 0;
    left: 0;
    right: 0;
    top: 100%;
    z-index: -1;
    -webkit-transition: top 0.09s ease-in;
  }

  .sweeb_g:hover:before,
  .sweeb_bl:hover:before,
  .sweeb_r:hover:before {
    top: 0;
  }

  .sweeb {
    background: #fff;
    padding: 20px;
  }


  .clipboard {
    border: 0;
    padding: 10px;
    border-radius: 0px;
    background-image: linear-gradient(135deg, #d9e4ed 44%, #ffc300 100%);
    cursor: pointer;
    color: #04048c;
    font-family: 'Karla', sans-serif;
    font-size: 13px;
    position: relative;
    top: 0;
    transition: all .2s ease;

    &:hover {
      top: 0px;
    }
  }

  p {
    font-weight: 300;
  }
  }


  .tooltip {
    position: relative;
    display: inline-block;
  }

  .tooltip .tooltiptext {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 150%;
    left: 50%;
    margin-left: -75px;
    opacity: 0;
    transition: opacity 0.3s;
  }

  .tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
  }

  .btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
    border: none;
  }

  .preview {
    border-radius: 3px;
    padding: 5px;
    margin-top: 7px;
    margin-bottom: 10px;
    -webkit-box-shadow: 1px 0px 8px 1px rgba(95, 181, 242, 1);
    -moz-box-shadow: 1px 0px 8px 1px rgba(95, 181, 242, 1);
    box-shadow: 1px 0px 8px 1px rgba(95, 181, 242, 1);
  }


  /* The alert message box */
  .alert {
    padding: 10px;
    background-color: #2196F3;
    /* Red */
    color: white;
    margin-bottom: 15px;
  }

  /* The close button */
  .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }

  /* When moving the mouse over the close button */
  .closebtn:hover {
    color: black;
  }

  .cloud {
    width: 320px;
    height: 215px;

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

  .cloud:after,
  .cloud:before {
    content: '';
    position: absolute;
    background: #FFF;
    z-index: -1
  }

  .cloud:after {
    width: 100px;
    height: 100px;
    top: -30px;
    left: 50px;

    border-radius: 100px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
  }

  .cloud:before {
    width: 180px;
    height: 180px;
    top: -50px;
    right: 50px;
    border-radius: 200px;
    -webkit-border-radius: 200px;
    -moz-border-radius: 200px;
  }


  .btn-main8 {
    border: 2px solid #F88379;
    width: 100%;
    color: #Fff;
    background: #F88379;
    font-size: 14px;
    font-color: #fff;
    font-weight: Bold;
    border-radius: 3px;
  }

  .btn-main8:hover {
    border: 4px solid #fff;
    color: #fff;
    font-size: 14px;
    background: #5cb85c;
    font-weight: Bold;
    border-radius: 3px;
  }
</style>

<body>
  <br>
  <center>
    <h2>Sweeba Statistics</h2>
    <center>
      <p>
      <div class="btn btn-success">
        <a id="smallLinkButton" href="purchase.php">
          <font size="2" face="verdana" color="white"> Buy credits </font>
        </a>
      </div>

      <div class="btn btn-success">
        <a id="smallLinkButton" href="upgrade.php">
          <font size="2" face="verdana" color="white"> Upgrade </font>
        </a>
      </div>
      </p>
    </center>
    <div class="row">
      <div class="col-md-12">

        <div class="chart-container">

          <canvas id="statsChart"></canvas>

        </div>

      </div>
    </div>
  </center>


  <footer>

    <center>
      <Br>

      <p>&copy; Sweeba.com 2024</p>
    </center>
  </footer>


  <?php include('footer.php'); ?>


  <script>
    window.onload = function() {
      // Fetch data from the PHP backend
      fetch('https://sweeba.com/stats_view_ajax.php')
        .then(response => response.json())
        .then(data => {
          // Prepare data for the chart
          const labels = data.days.map(item => item.date);
          const sweebsVisitedData = data.days.map(item => item.sweebs_visited);
          const sweebViewsData = data.days.map(item => item.sweeb_views);

          // Create the chart
          const ctx = document.getElementById('statsChart').getContext('2d');
          new Chart(ctx, {
            type: 'line',
            data: {
              labels: labels,
              datasets: [{
                  label: 'Credits Earned',
                  data: sweebsVisitedData,
                  borderColor: '#4caf50',
                  backgroundColor: 'rgba(76, 175, 80, 0.2)',
                  fill: true,
                },
                {
                  label: 'Sweeb Views',
                  data: sweebViewsData,
                  borderColor: '#f44336',
                  backgroundColor: 'rgba(244, 67, 54, 0.2)',
                  fill: true,
                },
              ],
            },
            options: {
              responsive: true,
              scales: {
                x: {
                  title: {
                    display: true,
                    text: 'Date',
                  },
                },
                y: {
                  title: {
                    display: true,
                    text: 'Count',
                  },
                },
              },
            },
          });
        })
        .catch(error => console.error('Error fetching data:', error));
    };
  </script>
</body>

</html>