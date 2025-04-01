<?php include('main/config.php');
include('main/functions.php');
//include('main/message.php');
// if($logged_in == 'no'){
// header("Location: index.php");
// }

checkLogin();

$get_m_id = strip_tags($_GET["dlt"]);


$sql = "SELECT * FROM members WHERE avatar!='user.png' ORDER BY id desc";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  $name = filter_var($row['avatar']);
  $check = 'file/' . $name . '';
  if (file_exists($check)) {

    //exist image into foder

  } else {
    $sql = "UPDATE members SET avatar='user.png' WHERE id=" . $row['id'];
    $conn->query($sql);
  }
}
?>
<?php
include('main/header.php');
?>
<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<style>
  text {
    font-family: Helvetica, Arial, sans-serif;
    font-size: 11px;
    pointer-events: none;
  }

  #chart {
    position: relative;
    /*width:500px;
        height:500px;*/
    top: 0;
    /*        left:0;*/
    text-align: center;
  }

  #question {
    position: relative;
    /* width: 400px; */
    /* height: 500px; */
    top: 60px;
    left: 0;
  }

  #question h1 {
    font-size: 40px;
    font-weight: bold;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

    padding: 0;
    margin: 0;
    -webkit-transform: translate(0, -50%);
    transform: translate(0, -50%);
  }

  body {

    font-family: 'Open Sans', sans-serif;
  }

  p {
    font-family: 'Open Sans', sans-serif;
  }


  /* Tooltip container */
  .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
    /* If you want dots under the hoverable text */
  }

  /* Tooltip text */
  .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;

    /* Position the tooltip text */
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;

    /* Fade in tooltip */
    opacity: 0;
    transition: opacity 0.3s;
  }

  /* Tooltip arrow */
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

  /* Show the tooltip text when you mouse over the tooltip container */
  .tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
  }
</style>


<div class="container" style="font-family: 'Open Sans', sans-serif;">
  <div class="row">

    <div class="col-md-2 hidden-xs" style="padding:0px;">
    </div>

    <div class="col-md-12">
      <style>
        .sweeb_b {
          color: #fff;
          margin-bottom: 25px;
          height: 100px;
          position: relative;
          // display:block;
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
          background: #3e4851;
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

        .featureColor,
        .membershipColor,
        .freeColor,
        .tryColor,
        .yearlyColor,
        .upgradeColor {
          content: "";
          width: 13px;
          height: 13px;
          border-radius: 50%;
        }

        .featureColor {
          background: #aec7e8;
        }

        .membershipColor {
          background: #ff7f0e;
        }

        .freeColor {
          background: #1f77b4;
        }

        .tryColor {
          background: #98df8a;
        }

        .yearlyColor {
          background: #2ca02c;
        }

        .upgradeColor {
          background: #ffbb78;
        }

        .colorValue li {
          display: flex;
          margin-block: 5px;
        }

        .content {
          display: table;
          width: 100%;
          text-align: center;
          height: 500px;
        }

        .colorValue li div {
          margin-right: 10px
        }

        @media only screen and (max-width: 767px) {
          #question h1 {
            font-size: 28px;
          }
        }


        .cloud {
          width: 300px;
          height: 140px;

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
          margin: 45px auto 10px;
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
      </style>

      <?php
      $today = date("Y-m-d"); // Get the current date in the format "YYYY-MM-DD"
      $startOfDay = $today . " 00:00:00";
      $endOfDay = $today . " 23:59:59";

      $sql = "SELECT COUNT(*) AS count FROM spins WHERE user_id = '" . $_SESSION['user_id'] . "' AND created_at >= '" . $startOfDay . "' AND created_at <= '" . $endOfDay . "'";

      $result = $conn->query($sql);
      $cheking_spin = 0;
      if ($result && $result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count  >= 1) {
          $cheking_spin = 1;
        } else {
          $cheking_spin = 0;
        }
      }
      ?>

      <div class="col-md-6 col-xs-6" style="padding:0px;">




        <div class="colorValue">



          <div class="cloud">
            <ul style="list-style: none;padding-left: 60px;">
              <font size="2">
                <li>
                  <div class="featureColor"></div><span><strong>7 day Sweeba upgrade</strong></span>
                </li>
                <li>
                  <div class="tryColor"></div><span><strong>10 exposure credits</strong></span>
                </li>
                <li>
                  <div class="membershipColor"></div><span><strong>Featured member</strong></span>
                </li>
                <li>
                  <div class="freeColor"></div><span><strong>25% off yearly upgrade</strong></span>
                </li>
                <li>
                  <div class="yearlyColor"></div><span><strong>20% off yearly upgrade</strong></span>
                </li>
              </font>
            </ul>
          </div>


        </div>




      </div>



      <div class="col-md-4" style="margin-left: auto; margin-right: auto;">
        <div class="content">





          <?php
          $remainingSeconds = 0;
          $data_checking =  $cheking_spin;
          if ($data_checking == 0) { ?>


            <button class="btn btn-success" id="spinButton">SPIN DAILY NOW</button>

          <?php } else {
            $currentTime = time(); // Current timestamp
            $endOfDayTime = strtotime($endOfDay); // End of day timestamp
            $remainingSeconds = max(0, $endOfDayTime - $currentTime); // Ensure non-negative
          ?>
            <div id="timer" style="font-size: 20px; font-weight: bold;padding-bottom: 16px;"></div>
            <button class="btn btn-danger">Spin again tomorrow</button>
          <?php } ?>
          <h3 id="message" style="color:black;"></h3>
          <div id="question">
            <h1></h1><Br>
          </div>
          <div id="chart"></div>


        </div>
      </div>

    </div>

  </div>

</div>


<div class="col-md-12" style="padding:0px;text-align:center;padding-bottom:2px;">


</div>


</div>

</div>
</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<?php
function getUserDetail($userId, $conn)
{
  $data = array();
  $sql = "SELECT * FROM  members WHERE id =" . $userId . "";
  $result = $conn->query($sql);
  $check = false;
  if ($result->num_rows > 0) {

    $check = true;
  }
  if ($check == true) {
    while ($row = $result->fetch_assoc()) {
      $data['name'] = $row['name'];
      $data['avatar'] =  $row['avatar'];
      $data['user_id'] = $row['id'];
      $data['username'] =  $row['username'];
    }
  }
  return $data;
}

?>

<script>
  function create_mssage_button() {
    jQuery("#collapseExample").show();

  }
</script>


<script>
  var w_height = $(window).height();
  var w_width = $(window).width();
  var spin_w = 250;
  var spin_h = 250;
  if (w_width < 250) {
    var spin_w = 325;
    var spin_h = 325;
  }
  var padding = {
      top: 20,
      right: 40,
      bottom: 0,
      left: 0
    },
    w = spin_w - padding.left - padding.right,
    h = spin_h - padding.top - padding.bottom,
    r = Math.min(w, h) / 2,
    rotation = 0,
    oldrotation = 0,
    picked = 100000,
    oldpick = [],
    color = d3.scale.category20(); //category20c()
  //randomNumbers = getRandomNumbers();
  //http://osric.com/bingo-card-generator/?title=HTML+and+CSS+BINGO!&words=padding%2Cfont-family%2Ccolor%2Cfont-weight%2Cfont-size%2Cbackground-color%2Cnesting%2Cbottom%2Csans-serif%2Cperiod%2Cpound+sign%2C%EF%B9%A4body%EF%B9%A5%2C%EF%B9%A4ul%EF%B9%A5%2C%EF%B9%A4h1%EF%B9%A5%2Cmargin%2C%3C++%3E%2C{+}%2C%EF%B9%A4p%EF%B9%A5%2C%EF%B9%A4!DOCTYPE+html%EF%B9%A5%2C%EF%B9%A4head%EF%B9%A5%2Ccolon%2C%EF%B9%A4style%EF%B9%A5%2C.html%2CHTML%2CCSS%2CJavaScript%2Cborder&freespace=true&freespaceValue=Web+Design+Master&freespaceRandom=false&width=5&height=5&number=35#results
  var data = [{
      "label": " ",
      "value": 1,
      "question": "25% membership discount",
    }, // padding
    {
      "label": " ",
      "value": 2,
      "question": "Free 7 day membership"
    }, //font-family
    {
      "label": " ",
      "value": 3,
      "question": "Featured member"
    }, //color
    {
      "label": " ",
      "value": 4,
      "question": "Try again tomorrow"
    }, //font-weight
    {
      "label": " ",
      "value": 5,
      "question": "20% membership discount "
    }, //font-size
    {
      "label": " ",
      "value": 6,
      "question": "10 free exposure credits"
    } //background-color
  ];
  var svg = d3.select('#chart')
    .append("svg")
    .data([data])
    .attr("width", w + padding.left + padding.right)
    .attr("height", h + padding.top + padding.bottom);
  var container = svg.append("g")
    .attr("class", "chartholder")
    .attr("transform", "translate(" + (w / 2 + padding.left) + "," + (h / 2 + padding.top) + ")");
  var vis = container
    .append("g");

  var pie = d3.layout.pie().sort(null).value(function(d) {
    return 1;
  });
  // declare an arc generator function
  var arc = d3.svg.arc().outerRadius(r);
  // select paths, use arc generator to draw
  var arcs = vis.selectAll("g.slice")
    .data(pie)
    .enter()
    .append("g")
    .attr("class", "slice");

  arcs.append("path")
    .attr("fill", function(d, i) {
      return color(i);
    })
    .attr("d", function(d) {
      return arc(d);
    });
  // add the text
  arcs.append("text").attr("transform", function(d) {
      d.innerRadius = 0;
      d.outerRadius = r;
      d.angle = (d.startAngle + d.endAngle) / 2;
      return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius - 10) + ")";
    })
    .attr("text-anchor", "end")
    .text(function(d, i) {
      return data[i].label;
    });
  var check_spin = '<?php echo $cheking_spin; ?>';

  if (check_spin == 0) {
    container.on("click", spin);
  } else {
    $('#message').html('Try Again Tomorrow');
  }
  //container.on("click", spin);
  function spin(d) {

    container.on("click", null);
    //all slices have been seen, all done
    console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
    if (oldpick.length == data.length) {
      console.log("done");
      container.on("click", null);
      return;
    }

    if (oldpick.length > 0) {
      $('#message').html('Try Again Tomorrow');
      return;
    }

    var ps = 360 / data.length,
      pieslice = Math.round(1440 / data.length),
      rng = Math.floor((Math.random() * 1440) + 360);

    rotation = (Math.round(rng / ps) * ps);

    picked = Math.round(data.length - (rotation % 360) / ps);
    picked = picked >= data.length ? (picked % data.length) : picked;
    if (oldpick.indexOf(picked) !== -1) {
      d3.select(this).call(spin);
      return;
    } else {
      oldpick.push(picked);
    }
    rotation += 90 - Math.round(ps / 2);
    vis.transition()
      .duration(3000)
      .attrTween("transform", rotTween)
      .each("end", function() {
        //mark question as seen
        d3.select(".slice:nth-child(" + (picked + 1) + ") path");
        //populate question
        d3.select("#question h1")
          .text(data[picked].question);
        oldrotation = rotation;
        var user_id = '<?php echo $_SESSION['user_id']; ?>';
        $.ajax({
          type: "POST",
          url: "spin_insert.php",
          data: {
            value: data[picked].value,
            user_id: user_id
          },
          success: function(response) {
            // $("#result").html(response);
          }
        });
        /* Get the result value from object "data" */
        console.log(data[picked].value)

        /* Comment the below line for restrict spin to sngle time */
        // container.on("click", spin);
      });
  }
  //make arrow
  svg.append("g")
    .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h / 2) + padding.top) + ")")
    .append("path")
    .attr("d", "M-" + (r * .15) + ",0L0," + (r * .05) + "L0,-" + (r * .05) + "Z");
  //.style({"fill":"black"});
  //draw spin circle
  container.append("circle")
    .attr("cx", 0)
    .attr("cy", 0)
    .attr("r", 60)
    .style({
      "fill": "white",
      "cursor": "pointer"
    });
  //spin text
  // container.append("text")
  //     .attr("x", 0)
  //     .attr("y", 15)
  //     .attr("text-anchor", "middle")
  //     .text("SPIN")
  //     .style({"font-weight":"bold", "font-size":"30px"});
  container.append("image")
    .attr("xlink:href", "https://sweeba.com/images/Spin.png") // Replace with the URL of your logo image
    .attr("x", -30) // Adjust the x-coordinate to position the logo as needed
    .attr("y", -30) // Adjust the y-coordinate to position the logo as needed
    .attr("width", 60) // Adjust the width of the logo as needed
    .attr("height", 60); // Adjust the height of the logo as needed

  function rotTween(to) {
    var i = d3.interpolate(oldrotation % 360, rotation);
    return function(t) {
      return "rotate(" + i(t) + ")";
    };
  }


  function getRandomNumbers() {
    var array = new Uint16Array(1000);
    var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);
    if (window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function") {
      window.crypto.getRandomValues(array);
      console.log("works");
    } else {
      //no support for crypto, get crappy random numbers
      for (var i = 0; i < 1000; i++) {
        array[i] = Math.floor(Math.random() * 100000) + 1;
      }
    }
    return array;
  }
  document.getElementById('spinButton').addEventListener('click', function() {
    // Call the spin function when the button is clicked
    spin();
  });
</script>



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

<script>
  // Pass PHP data to JavaScript
  const remainingSeconds = <?= $remainingSeconds ?>;

  let remainingTime = remainingSeconds;

  function updateTimer() {
    if (remainingTime > 0) {
      const hours = Math.floor(remainingTime / 3600);
      const minutes = Math.floor((remainingTime % 3600) / 60);
      const seconds = remainingTime % 60;

      // Update the timer display
      // document.getElementById("timer").textContent =
      //   `Time left: ${hours} hour(s), ${minutes} minute(s), and ${seconds} second(s)`;

      document.getElementById("timer").textContent =
        `Time left: ${hours} hour(s), ${minutes} minute(s)`;

      remainingTime--;
    } else {
      document.getElementById("timer").textContent = "Time is up!";
    }
  }

  // Initialize and update the timer every second
  document.addEventListener("DOMContentLoaded", () => {
    updateTimer();
    setInterval(updateTimer, 1000);
  });
</script>

</body>

</html>