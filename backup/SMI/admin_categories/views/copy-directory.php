<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');

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
                            <span id="ctl00_ContentPlaceHolder1_lable_filename" class="field select" style="width: 100%; margin-left: 15px; font-weight:bold;">Sheet-Music/master-composers/+Collections</span>
                            <br>
                        </div>
                    </div>
                </div>

           <div class="row">
                    <label class="col-lg-3 control-label" for="inputStandard" style="width: 23%; margin-left: 17px;">Select Library:</label>
                    <form id="mainForm" name="mainForm" action="" method="post" autocomplete="off">
                    <div class="col-md-9" style="width: 72%;">
                        <div class="section" id="rdoptions" style="margin-left: 15px; margin-bottom: 10px;">

                            
                 <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                        <input name="rdbcomposer" value="1" title="Master Composers" type="radio" class="select_radio1">
                        <span class="radio" style="padding-top: 0px;"></span>Master Composers</label>
                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                        <input name="rdbcomposer" value="1" title="composer" type="radio" class="select_radio1">
                        <span class="radio" style="padding-top: 0px;"></span>Composers</label>
                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                        <input name="rdbcomposer" value="1321" title="School Music" type="radio" class="select_radio1">
                        <span class="radio" style="padding-top: 0px;"></span>School Music</label>
                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                        <input name="rdbcomposer" value="12522" title="© Public Archive" type="radio" class="select_radio1">
                        <span class="radio" style="padding-top: 0px;"></span>© Public Archive</label>
                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                        <input name="rdbcomposer" value="12619" title="© Captured Music" type="radio" class="select_radio1">
                        <span class="radio" style="padding-top: 0px;"></span>© Captured Music</label>
                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                        <input name="rdbcomposer" value="13763" title="Music for Sale" type="radio" class="select_radio1">
                        <span class="radio" style="padding-top: 0px;"></span>Music for Sale</label>
                    <label class="option" style="width: 45%; padding: 0px; margin-bottom: 0px!important;">
                        <input name="rdbcomposer" value="14155" title="Music for Approval" type="radio" class="select_radio1">
                        <span class="radio" style="padding-top: 0px;"></span>Music for Approval</label>
                            
                        </div>
                    </div>
                    </form> 
                    
                    <span id="result"></span>
                    <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" style="margin-left: 15px;">
                        Search for Destination Folder: <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="name"  id= "tags" onchange="myFunction()" class="form-control" placeholder="Search for Destination Folder" style=" width: 97%; margin-left: -7px; margin-bottom: 5px;" list="browsers" autocomplete="off">
                    </div>
<datalist id="browsers">
  <option value="Loading...">
</datalist> 

                </div>
                <!-- <div class="form-group">
                    <div class="col-md-5 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Add Composer" style="    margin-left: 38px;">
                    </div>
                </div> -->
                </div>


            <div class="x_content">
<form action="<?php echo site_url('admin_categories/' . $action);?>" method="post" class="form-horizontal" enctype="multipart/form-data" id="add_category">
                <?php
                // get_flashdata();
                // $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_category', 'method' => 'post');
                // echo form_open('admin_categories/' . $action, $form_attr);

                $field_attr = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'id' => 'id',
                    'value' => set_value('id', (!empty($obj_data) && is_object($obj_data) ? $obj_data->id : ''))
                );

                echo form_input($field_attr);
                ?>

                <input type="hidden" name="main_category_id" value="" id="main_category_id">
                <input type="hidden" name="redirection_type" value="<?php echo $this->uri->segment(5);?>" id="redirection_type">
                
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
                        <a  href="<?php echo $back_url;?>" class="btn btn-success my_button_new">Back</a>
                        <input type="submit" class="btn btn-success my_button_new" name="submits" value="Copy Folder" style="pointer-events: none;">
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


  <script type="text/javascript">
var jvalue = 'this is javascript value';

<?php $abc = "<script>document.write(jvalue)</script>"?>   
</script>

<script>
    $('input[type=radio]').click(function(e) {//jQuery works on clicking radio box
        var value = $(this).val(); //Get the clicked checkbox value
        $('.r-text').html(value);
    });
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


$('.select_radio1').change(function(){
                 $('#browsers').html('');
                 $('#tags').val('');
                 $('#destination').val('');
$('.my_button_new').css('pointer-events','auto');

       var category_id = $(this).val();
       var category_title = $(this).attr('title');
       $('#main_category_id').val(category_id);
    $.ajax({
          type:'POST',  
          url: "<?php echo site_url('admin_categories/tree_html_name'); ?>",
          cache: false,
          data:{category_id:category_id,category_title:category_title},
          success: function(html){
             $('#browsers').html(html);
            
          }
        });
});
</script>
  
</head>
<body>
 
<!-- <div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags">
</div> -->

