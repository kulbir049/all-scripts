<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');
// $res = '<div id="response"></div>';


function fetch_menu($objTree){
    foreach($objTree as $menu){
        echo "<li class='m_cmp'>".$menu->name."</li>";
        if(!empty($menu->arrChilds)){
            echo "<ul>";
            fetch_sub_menu($menu->arrChilds);
            echo "</ul>";
        }
    }
}
function fetch_sub_menu($sub_menu){
    foreach($sub_menu as $menu){
        echo "<li class='m_cmp'>".$menu->name."</li>";
        if(!empty($menu->arrChilds)){
            echo "<ul>";
            fetch_sub_menu($menu->arrChilds);
            echo "</ul>";
        }       
    }
}
echo "<ul style='display:none;' class='sds'>";
fetch_menu($objTree);
echo "</ul>";

////////

function fetch_menu_comp($objTreec){
    foreach($objTreec as $menucomp){
        echo "<li class='c_cmp'>".$menucomp->name."</li>";
        if(!empty($menucomp->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_comp($menucomp->arrChilds);
            echo "</ul>";
        }
    }
}
function fetch_sub_menu_comp($sub_menu_comp){
    foreach($sub_menu_comp as $menucomp){
        echo "<li class='c_cmp'>".$menucomp->name."</li>";
        if(!empty($menucomp->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_comp($menucomp->arrChilds);
            echo "</ul>";
        }       
    }
}
echo "<ul style='display:none;' class='sdsd'>";
$vals = fetch_menu_comp($objTreec);
echo "</ul>";

///////

////////

function fetch_menu_sm($objTreesm){
    foreach($objTreesm as $menusm){
        echo "<li class='schm'>".$menusm->name."</li>";
        if(!empty($menusm->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_sm($menusm->arrChilds);
            echo "</ul>";
        }
    }
}
function fetch_sub_menu_sm($sub_menu_sm){
    foreach($sub_menu_sm as $menusm){
        echo "<li class='schm'>".$menusm->name."</li>";
        if(!empty($menusm->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_sm($menusm->arrChilds);
            echo "</ul>";
        }       
    }
}
echo "<ul style='display:none;' class='sdsdsm'>";
$vals = fetch_menu_sm($objTreesm);
echo "</ul>";

///////

//////

function fetch_menu_ccm($objTreeccm){
    foreach($objTreeccm as $menuccm){
        echo "<li class='ccm'>".$menuccm->name."</li>";
        if(!empty($menuccm->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_ccm($menuccm->arrChilds);
            echo "</ul>";
        }
    }
}
function fetch_sub_menu_ccm($sub_menu_ccm){
    foreach($sub_menu_ccm as $menuccm){
        echo "<li class='ccm'>".$menuccm->name."</li>";
        if(!empty($menuccm->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_ccm($menuccm->arrChilds);
            echo "</ul>";
        }       
    }
}
echo "<ul style='display:none;' class='sdsdsm'>";
$vals = fetch_menu_ccm($objTreeccm);
echo "</ul>";
/////

//////

function fetch_menu_cpa($objTreecpa){
    foreach($objTreecpa as $menucpa){
        echo "<li class='cpa'>".$menucpa->name."</li>";
        if(!empty($menucpa->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_cpa($menucpa->arrChilds);
            echo "</ul>";
        }
    }
}
function fetch_sub_menu_cpa($sub_menu_cpa){
    foreach($sub_menu_cpa as $menucpa){
        echo "<li class='cpa'>".$menucpa->name."</li>";
        if(!empty($menucpa->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_ccm($menucpa->arrChilds);
            echo "</ul>";
        }       
    }
}
echo "<ul style='display:none;' class='sdsdsm'>";
$vals = fetch_menu_cpa($objTreecpa);
echo "</ul>";
/////


//////

function fetch_menu_mfs($objTreemfs){
    foreach($objTreemfs as $menumfs){
        echo "<li class='mfs'>".$menumfs->name."</li>";
        if(!empty($menumfs->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_mfs($menumfs->arrChilds);
            echo "</ul>";
        }
    }
}
function fetch_sub_menu_mfs($sub_menu_mfs){
    foreach($sub_menu_mfs as $menumfs){
        echo "<li class='mfs'>".$menumfs->name."</li>";
        if(!empty($menumfs->arrChilds)){
            echo "<ul>";
            fetch_sub_menu_mfs($menumfs->arrChilds);
            echo "</ul>";
        }       
    }
}
echo "<ul style='display:none;' class='sdsmfs'>";
$vals = fetch_menu_mfs($objTreemfs);
echo "</ul>";
/////

?>

<style type="text/css">
    .checkbox, .radio {
    cursor: pointer; 
    position: relative; 
    margin-right: 5px;
    background: #fff; 
    display: inline-block; 
 /*   border: 3px solid #DDD;
     height: 21px;
    width: 21px;*/
    -webkit-border-radius: 2px;
    border-radius: 2px;
}

 .radio, .checkbox {
    margin-top: 0;
    margin-bottom: 0;
    padding-left: 0;
    top: 1px;
    vertical-align: bottom;
}


</style>



<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="<?php echo base_url('admin/category'); ?>">View</a>
                </ul>
                <div class="clearfix"></div>
                <h1 style="text-align: center;"><?php echo $title; ?></h1>
            </div>

    

            <div class="row" style="margin-bottom: 10px;">
                    <label class="col-lg-3 control-label" for="inputStandard" style="width: 23%; margin-left: 16px;">From File/Folder Path:</label>
                    <div class="col-md-9" style="width: 72%;">
                        <div class="section">
                            <span id="ctl00_ContentPlaceHolder1_lable_filename" class="field select" style="width: 100%; margin-left: 15px; font-weight:bold;"><?php echo $src_path; ?></span>
                            <br>
                        </div>
                    </div>
                </div>

           <div class="row">
                    <label class="col-lg-3 control-label" for="inputStandard" style="width: 23%; margin-left: 17px;">Select Library:</label>
                    <form id="mainForm" name="mainForm" action="" method="post">
                    <div class="col-md-9" style="width: 72%;">
                        <div class="section" id="rdoptions" style="margin-left: 15px; margin-bottom: 10px;">

                            
                                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                                        <input name="rdbcomposer" value="Captured Copyrighted Music" type="radio" id="radio1">
                                        <span class="radio" style="padding-top: 0px;"></span>Captured Copyrighted Music</label>
                                
                                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                                        <input name="rdbcomposer" value="composers" type="radio" id="radio2">
                                        <span class="radio" style="padding-top: 0px;"></span>composers</label>
                                
                                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                                        <input name="rdbcomposer" value="Copyrighted-public-Archive-additions" type="radio" id="radio3">
                                        <span class="radio" style="padding-top: 0px;"></span>Copyrighted-public-Archive-additions</label>
                                
                                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                                        <input name="rdbcomposer" value="master-composers" type="radio" id="radio4">
                                        <span class="radio" style="padding-top: 0px;"></span>master-composers</label>
                                
                                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                                        <input name="rdbcomposer" value="Music for Sale" type="radio" id="radio5">
                                        <span class="radio" style="padding-top: 0px;"></span>Music for Sale</label>
                                
                                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                                        <input name="rdbcomposer" value="School-Music" type="radio" id="radio6">
                                        <span class="radio" style="padding-top: 0px;"></span>School-Music</label>
                            
                        </div>
                    </div>
                    </form> 
                    
                    <span id="result"></span>
                    <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" style="margin-left: 15px;">
                        Search for Destination Folder: <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="name"  id= "tags" onchange="myFunction()" class="form-control" placeholder="Search for Destination Folder" style=" width: 97%; margin-left: -7px; margin-bottom: 5px;">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="col-md-5 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Add Composer" style="    margin-left: 38px;">
                    </div>
                </div> -->
                </div>


            <div class="x_content">

                <?php
                get_flashdata();
                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_category', 'method' => 'post');
                echo form_open('admin_categories/' . $action, $form_attr);

                $field_attr = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'id' => 'id',
                    'value' => set_value('id', (!empty($obj_data) && is_object($obj_data) ? $obj_data->id : ''))
                );

                echo form_input($field_attr);
                ?>

                <!-- <div class="item form-group" style="display: none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Composer Lists
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <select name="parent_id" class="select2_group form-control">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select>

                    </div>
                </div> -->

               <!--  <div class="item form-group" style="display: none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Composer Name <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'name',
                            'class' => 'form-control',
                            'placeholder' => 'Enter composer name',
                            'id' => 'name',
                            'value' => set_value('name', (!empty($obj_data) && is_object($obj_data) ? $obj_data->name : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('name', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div> -->
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Where to move
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <!-- <select name="dest_id" class="select2_group form-control">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select> -->
                        <input type="text" name="dest_id" id="destination" class="form-control"><br>

                    </div>
                </div>
<?php 
  $dynamic_url= $this->uri->segment(5); 

                       if($dynamic_url == 'mc'){
                        $back_url=site_url('admin_categories');
                        }elseif($dynamic_url == 'cm'){
                        $back_url=site_url('admin_categories/admin_comp');  
                        }elseif($dynamic_url == 'sm'){
                        $back_url=site_url('admin_categories/admin_school_music');  
                        }elseif($dynamic_url == 'pa'){
                        $back_url=site_url('admin_categories/admin_public_archive');  
                        }elseif($dynamic_url == 'cp'){
                        $back_url=site_url('admin_categories/admin_captured_music');  
                        }elseif($dynamic_url == 'ms'){
                        $back_url=site_url('admin_categories/admin_music_sale');  
                        }elseif($dynamic_url == 'sd'){
                        $back_url=site_url('admin_categories/admin_s_d');
                        }else{
                        $back_url=site_url('admin_categories');
                        }
                        ?> 
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-7 col-md-offset-3 pull-right">
                        <a href="<?php echo $back_url;?>" class="btn btn-success my_button_new">Back</a>

                        <input type="submit" class="btn btn-success my_button_new" name="submits" value="Move Folder">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>


    jQuery(document).ready(function () {

        $(".delete-image").click(function (e) {
            var url_path = "<?php echo base_url('admin_categories/removeCatImage'); ?>";
            var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";
            e.preventDefault()
            var id = $(this).attr('img_id');
            var dataString = 'id=' + id;
            //alert(url_path);die;
            $.confirm({
                title: 'Deleting Confirmation',
                content: 'Are you sure you want to Delete?',
                animation: 'scale',
                closeAnimation: 'scale',
                opacity: 0.5,
                buttons: {
                    confirm: {
                        text: 'Yes, sure!',
                        btnClass: 'btn-primary',
                        action: function () {
                            e.preventDefault();

                            $.ajax({
                                type: "POST",
                                url: url_path,
                                data: dataString,
                                cache: false,

                                beforeSend: function () {
                                    $.loader("on", img_path);
                                },
                                success: function (data) {
                                    if (data) {
                                        setTimeout(function () {
                                         location.reload();
                                         }, 1000);

                                    }

                                },
                                complete: function () {
                                    $.loader("off", img_path);
                                }
                            });
                        }
                    },
                    cancel: function () {
                        //$.alert('you clicked on <strong>cancel</strong>');
                    },
                }
            });
        });
    });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
     //var availableTags = '<?php echo $val ?>';
     //alert(availableTags);
     //alert($('input[name=rdbcomposer]:checked').val());
  $( function() { 
   
    $("#radio1").click(function(){
        $('.c_cmp').removeClass('tsd');
        $('.m_cmp').removeClass('tsd');
        $('.schm').removeClass('tsd');
        $('.cpa').removeClass('tsd');
        $('.mfs').removeClass('tsd');
        $('.ccm').addClass('tsd');
        var phrases = []; 
          $( "li.tsd" ).each(function( index ) {
          // console.log( index + ": " + $( this ).text() );
          var items = $( this ).text();
          phrases.push(items);
          console.log(items);
            });
            var availableTags = phrases;
            //alert(availableTags);
            $( "#tags" ).autocomplete({
              source: availableTags
            });
            $('#tags').change(function() {
            $('#destination').val($(this).val());
            });  
    });

    $("#radio2").click(function(){
        $('.m_cmp').removeClass('tsd');
        $('.schm').removeClass('tsd');
        $('.cpa').removeClass('tsd');
        $('.mfs').removeClass('tsd');
        $('.ccm').removeClass('tsd');
        $('.c_cmp').addClass('tsd');
        var phrases = [];
 
          $( "li.tsd" ).each(function( index ) {
          var items = $( this ).text();
          phrases.push(items);
          console.log(items);
            });
            var availableTags = phrases;
            //alert(availableTags);
            $( "#tags" ).autocomplete({
              source: availableTags
            });
            $('#tags').change(function() {
            $('#destination').val($(this).val());
            });
    });

    $("#radio3").click(function(){
        $('.c_cmp').removeClass('tsd');
        $('.m_cmp').removeClass('tsd');
        $('.schm').removeClass('tsd');
        $('.ccm').removeClass('tsd');
        $('.mfs').removeClass('tsd');
        $('.cpa').addClass('tsd');
        var phrases = []; 
          $( "li.tsd" ).each(function( index ) {
          // console.log( index + ": " + $( this ).text() );
          var items = $( this ).text();
          phrases.push(items);
          console.log(items);
            });
            var availableTags = phrases;
            //alert(availableTags);
            $( "#tags" ).autocomplete({
              source: availableTags
            });
            $('#tags').change(function() {
            $('#destination').val($(this).val());
            });  
    });

    $("#radio4").click(function(){
          
        $('.c_cmp').removeClass('tsd');
        $('.mfs').removeClass('tsd');
        $('.schm').removeClass('tsd');
        $('.ccm').removeClass('tsd');
        $('.cpa').removeClass('tsd');
        $('.m_cmp').addClass('tsd');
        var phrases = [];
  
          $( "li.tsd" ).each(function( index ) {
          // console.log( index + ": " + $( this ).text() );
          var items = $( this ).text();
          phrases.push(items);
          console.log(items);
            });
            var availableTags = phrases;
            //alert(availableTags);
            $( "#tags" ).autocomplete({
              source: availableTags
            });
            $('#tags').change(function() {
            $('#destination').val($(this).val());
            });
    });

    $("#radio5").click(function(){
        $('.c_cmp').removeClass('tsd');
        $('.m_cmp').removeClass('tsd');
        $('.schm').removeClass('tsd');
        $('.cpa').removeClass('tsd');
        $('.ccm').removeClass('tsd');
        $('.mfs').addClass('tsd');
        var phrases = []; 
          $( "li.tsd" ).each(function( index ) {
          // console.log( index + ": " + $( this ).text() );
          var items = $( this ).text();
          phrases.push(items);
          console.log(items);
            });
            var availableTags = phrases;
            //alert(availableTags);
            $( "#tags" ).autocomplete({
              source: availableTags
            });
            $('#tags').change(function() {
            $('#destination').val($(this).val());
            });
    });

    $("#radio6").click(function(){
        $('.c_cmp').removeClass('tsd');
        $('.m_cmp').removeClass('tsd');
        $('.schm').removeClass('tsd');
        $('.cpa').removeClass('tsd');
        $('.ccm').removeClass('tsd');
        $('.schm').addClass('tsd');

        var phrases = [];
  
          $( "li.tsd" ).each(function( index ) {
          // console.log( index + ": " + $( this ).text() );
          var items = $( this ).text();
          phrases.push(items);
          console.log(items);
            });
            var availableTags = phrases;
           //aler t(availableTags);
            $( "#tags" ).autocomplete({
              source: availableTags
            });
            $('#tags').keyup(function() {
            $('#destination').val($(this).val());
            });
            $('#tags').keydown(function() {
            $('#destination').val($(this).val());
            });
    });


 //  var phrases = [];
 //  // $("#radio2").click(function(){

 //  	//$('li.msd').addClass('tsd');
 //    //$('.tsdc').addClass('tsd');
 //  $( "li.tsd" ).each(function( index ) {
 //  // console.log( index + ": " + $( this ).text() );
 //  var items = $( this ).text();
 //  phrases.push(items);
 //  console.log(items);
	// });
 //    var availableTags = phrases;
 //    alert(availableTags);
 //    $( "#tags" ).autocomplete({
 //      source: availableTags
 //    });
 //    $('#tags').change(function() {
 //    $('#destination').val($(this).val());
	// });
    // });
 //  var phrases1 = [];
 //  $("#radio2").click(function(){
 //  	//$("li.tsd").removeClass('tsd');
 
 //  	//alert(22);
 //  $( "li.tsdc" ).each(function( index ) {
 //  // console.log( index + ": " + $( this ).text() );
 //  var items = $( this ).text();
 //  phrases1.push(items);
 //  //console.log(items);
	// });
 //    var availableTags1 = phrases1;
 //    //alert(availableTags1);
 //    $( "#tags" ).autocomplete({
 //      source: availableTags1
 //    });
 //    $('#tags').change(function() {
 //    $('#destination').val($(this).val());
	// });
 //    });


// var phrases2 = [];
//   $("#radio6").click(function(){
//   	//$("li.tsd").removeClass('tsd');
 
//   	//alert(22);
//   $( "li.tsdcsm" ).each(function( index ) {
//   // console.log( index + ": " + $( this ).text() );
//   var items = $( this ).text();
//   phrases2.push(items);
//   console.log(items);
// 	});
//     var availableTags2 = phrases2;
//     //alert(availableTags1);
//     $( "#tags" ).autocomplete({
//       source: availableTags2
//     });
//     $('#tags').change(function() {
//     $('#destination').val($(this).val());
// 	});
//     });

  } );
  </script>

  <script type="text/javascript">
var jvalue = 'this is javascript value';

<?php $abc = "<script>document.write(jvalue)</script>"?>   
</script>

<script>
    $('input[type=radio]').click(function(e) {//jQuery works on clicking radio box
        var value = $(this).val(); //Get the clicked checkbox value
        $('.r-text').html(value);
    });

// $('#tags').blur(function(){
//     var destination=$(this).val();
//       $('#destination').val(destination);
// });


$(document).ready(function(){
  $("#tags").keydown(function(){
    var destination=$(this).val();
    $("#destination").val(destination);
  });
  $("#tags").keyup(function(){
    var destination=$(this).val();
    $("#destination").val(destination);
  });
  $("#tags").blur(function(){
    var destination=$(this).val();
    $("#destination").val(destination);
  });
});
function myFunction(){
    var destination=$(this).val();
    $("#destination").val(destination);
  }
</script>
  
</head>
<body>
 
<!-- <div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags">
</div> -->

