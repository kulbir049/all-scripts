<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');
// $res = '<div id="response"></div>';

?>

<style type="text/css">
  .checkbox,
  .radio,
  .select_radio1,
  label.option {
    cursor: pointer !important;
    position: relative;
    margin-right: 5px;
    display: inline-block;
    /*   border: 3px solid #DDD;
     height: 21px;
    width: 21px;*/
    -webkit-border-radius: 2px;
    border-radius: 2px;
  }

  .naoTooltip_menu_tabs {
    display: none !important;
  }

  .radio,
  .checkbox {
    margin-top: 0;
    margin-bottom: 0;
    padding-left: 0;
    top: 1px;
    vertical-align: bottom;
  }

  ul.section {
    display: inline-block !important;
  }

  ul.section li {
    padding-left: 10px !important;
    list-style-type: none;
    float: left !important;
  }

  .loader_img {
    width: 50px;
  }

  .processing_bg {
    background-color: green;
    width: 7%;
    text-align: center;
  }

  .progress_bar_start_box {
    height: 3px !important;
  }
</style>



<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <?php echo $breadcrumb; ?>
    <div class="x_title">
      <ul class="nav navbar-right panel_toolbox">
        <li><a href="<?php echo base_url('admin/category'); ?>">View</a>
      </ul>
      <div class="clearfix"></div>
      <h1 style="text-align: center;"><?php echo $title; ?></h1>
    </div>


    <form id="mainForm" name="mainForm" action="" method="post">
      <input name="move" value="true" type="hidden">
      <input name="ids" value="<?= $ids; ?>" type="hidden">

      <div class="row">
        <label class="col-lg-3 control-label" for="inputStandard" style="width: 23%; margin-left: 17px;">Select Library:</label>


        <div class="col-md-9" style="width: 72%;">
          <div id="demo_wrap">
            <div class="accordion-group" data-behavior="accordion">

              <?php if (regular_admin_permission('approve_masterC_music', $this->session->userdata('admin_role_id'), 1)) { ?>
                <div class="accordion-header  view_child_data" title="view data" id="header_row_1" alt="">
                  <div class="child_folder_name"><b class="new_name_1" onclick="view_child_data_function(this)" title="view data" id="1">Master Composers</b>
                    <?php if ($type != 'file') { ?>
                      <input name="rdbcomposer" value="1" type="radio" class="select_radio1">
                    <?php } ?>
                  </div>
                </div>

                <div class="accordion-body">
                  <div class="accordion-group child_data_1" id="child_data_1" data-behavior="accordion" data-multiple="true">
                    <div class="progress_bar_start_box">Processing...</div>
                  </div>
                </div>
              <?php } ?>
              <div class="accordion-header  view_child_data" title="view data" id="header_row_132" alt="composer">
                <div class="child_folder_name"><b class="new_name_132" onclick="view_child_data_function(this)" title="view data" id="132">Composers</b>
                  <?php if ($type != 'file') { ?>
                    <input name="rdbcomposer" value="132" type="radio" class="select_radio1">
                  <?php } ?>
                </div>
              </div>

              <div class="accordion-body">
                <div class="accordion-group child_data_132" id="child_data_132" data-behavior="accordion" data-multiple="true">
                  <div class="progress_bar_start_box">Processing...</div>
                </div>
              </div>

              <div class="accordion-header  view_child_data" title="view data" id="header_row_1321" alt="">
                <div class="child_folder_name"><b class="new_name_1321" onclick="view_child_data_function(this)" title="view data" id="1321">School Music</b>
                  <?php if ($type != 'file') { ?>
                    <input name="rdbcomposer" value="1321" type="radio" class="select_radio1">
                  <?php } ?>
                </div>
              </div>

              <div class="accordion-body">
                <div class="accordion-group child_data_1321" id="child_data_1321" data-behavior="accordion" data-multiple="true">
                  <div class="progress_bar_start_box">Processing...</div>
                </div>
              </div>

              <div class="accordion-header  view_child_data" title="view data" id="header_row_12522" alt="">
                <div class="child_folder_name"><b class="new_name_12522" onclick="view_child_data_function(this)" title="view data" id="12522">© Public Archive</b>
                  <?php if ($type != 'file') { ?>
                    <input name="rdbcomposer" value="12522" type="radio" class="select_radio1">
                  <?php } ?>
                </div>
              </div>

              <div class="accordion-body">
                <div class="accordion-group child_data_12522" id="child_data_12522" data-behavior="accordion" data-multiple="true">
                  <div class="progress_bar_start_box">Processing...</div>
                </div>
              </div>

              <div class="accordion-header  view_child_data" title="view data" id="header_row_12619" alt="">
                <div class="child_folder_name"><b class="new_name_12619" onclick="view_child_data_function(this)" title="view data" id="12619">© Captured Music</b>
                  <?php if ($type != 'file') { ?>
                    <input name="rdbcomposer" value="12619" type="radio" class="select_radio1">
                  <?php } ?>
                </div>
              </div>

              <div class="accordion-body">
                <div class="accordion-group child_data_12619" id="child_data_12619" data-behavior="accordion" data-multiple="true">
                  <div class="progress_bar_start_box">Processing...</div>
                </div>
              </div>

              <div class="accordion-header  view_child_data" title="view data" id="header_row_13763" alt="">
                <div class="child_folder_name"><b class="new_name_13763" onclick="view_child_data_function(this)" title="view data" id="13763">Music for Sale</b>
                  <?php if ($type != 'file') { ?>
                    <input name="rdbcomposer" value="13763" type="radio" class="select_radio1">
                  <?php } ?>
                </div>
              </div>

              <div class="accordion-body">
                <div class="accordion-group child_data_13763" id="child_data_13763" data-behavior="accordion" data-multiple="true">
                  <div class="progress_bar_start_box">Processing...</div>
                </div>
              </div>

              <div class="accordion-header  view_child_data" title="view data" id="header_row_14155" alt="">
                <div class="child_folder_name"><b class="new_name_14155" onclick="view_child_data_function(this)" title="view data" id="14155">Music for Approval</b>
                  <?php if ($type != 'file') { ?>
                    <input name="rdbcomposer" value="14155" type="radio" class="select_radio1">
                  <?php } ?>
                </div>
              </div>

              <div class="accordion-body">
                <div class="accordion-group child_data_14155" id="child_data_14155" data-behavior="accordion" data-multiple="true">
                  <div class="progress_bar_start_box">Processing...</div>
                </div>
              </div>

            </div>
          </div>

        </div>

        <span id="result"></span>

      </div>


      <style type="text/css">
        #submit_form {
          background-color: gray !important;
          pointer-events: none;
        }
      </style>

      <input type="hidden" name="folder_name" id="folder_name" value="<?php echo $folder_name; ?>" class="form-control">
      <input type="hidden" name="hidden_select_radio1" id="hidden_select_radio1" value="" class="form-control">


      <div id="child_multi_level_1" class="child_multi_level"></div>
      <div class="ln_solid"></div>
      <div class="ln_solid_msg" style="text-align: center; display: none;color: red;">This <?php echo $type; ?> name already exist that folder, which you have selected.</div>
      <div class="form-group">
        <div class="col-md-7 col-md-offset-3 pull-right">
          <?php

          if ($back_redirect_btn == 'mc') {
            $back_url = 'admin_categories';
          } elseif ($back_redirect_btn == 'cm') {
            $back_url = 'admin_categories/admin_comp';
          } elseif ($back_redirect_btn == 'sm') {
            $back_url = 'admin_categories/admin_school_music';
          } elseif ($back_redirect_btn == 'pa') {
            $back_url = 'admin_categories/admin_public_archive';
          } elseif ($back_redirect_btn == 'cp') {
            $back_url = 'admin_categories/admin_captured_music';
          } elseif ($back_redirect_btn == 'ms') {
            $back_url = 'admin_categories/admin_music_sale';
          } elseif ($back_redirect_btn == 'sd') {
            $back_url = 'admin_categories/admin_s_d';
          } else {
            $back_url = 'admin_categories';
          }


          ?>
          <a class="btn btn-success my_button_new" href="<?php echo base_url() . $back_url; ?>"> Back</a>
          <input type="submit" class="btn btn-success my_button_new submit_form_btn" id="submit_form" name="submits" value="<?php echo $submit_button_name; ?>">
        </div>
      </div>

    </form>
  </div>
</div>



<script>
  $('input[type=radio]').click(function(e) { //jQuery works on clicking radio box
    var value = $(this).val(); //Get the clicked checkbox value
    $('.r-text').html(value);
  });
  $(document).ready(function() {
    $("#tags").keydown(function() {
      var destination = $(this).val();
      $("#destination").val(destination);
    });
    $("#tags").keyup(function() {
      var destination = $(this).val();
      $("#destination").val(destination);
    });
    $("#tags").blur(function() {
      var destination = $(this).val();
      $("#destination").val(destination);
    });
  });

  function myFunction() {
    var destination = $(this).val();
    $("#destination").val(destination);
  }


  //$('.select_radio1').change(function(){
  $("div").delegate(".select_radio1", "change", function() {
    var select_radio1 = $(this).val();
    $('#hidden_select_radio1').val(select_radio1);
    var moving_folder_name = '<?php echo $moving_folder_name; ?>';
    var type = '<?php echo $type; ?>';
    $('#submit_form').removeAttr('id');
    $.ajax({
      type: 'POST',
      url: "<?php echo site_url('admin_categories/verify_folder_existing'); ?>",
      cache: false,
      data: {
        category_id: select_radio1,
        moving_folder_name: moving_folder_name,
        type: type
      },
      success: function(html) {
        // $('.ln_solid_msg').show();
        // $('.ln_solid_msg').html(html);
        if (html > 0) {
          $('.ln_solid_msg').show();
          $('.submit_form_btn').attr('id', 'submit_form');
        } else {
          $('.ln_solid_msg').hide();
          $('#submit_form').removeAttr('id');
        }

      }
    });
  });

  function view_child_data_function(data) {
    var parent_id = $(data).attr('id');
    var category_title = $(data).attr('alt');
    var title = $(data).attr('title');
    if ($("#header_row_" + parent_id).hasClass('open')) {
      var class_open = true;
    } else {
      var class_open = false;
    };
    progress_bar_start_root_folders(parent_id);
    $('#header_row_' + parent_id).next('.accordion-body').show();
    if (class_open == true) {
      child_data_visible(parent_id, class_open);
      return false;
    }
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url(); ?>index.php/admin_categories/child_data_tree1",
      cache: false,
      data: {
        parent_id: parent_id,
        category_title: category_title
      },
      success: function(html) {
        // $('#child_data_'+parent_id).html(html);
        progress_bar_start(parent_id, html);
        // if(title!='view data'){
        child_data_visible(parent_id, class_open);
        // }

        //left: 63px; top: -100px; visibility: visible; opacity: 1;
      }
    });

  }

  function child_data_visible(parent_id, class_open) {
    if (class_open) {
      $('#header_row_' + parent_id).removeClass('open');
      $('#header_row_' + parent_id).next('.accordion-body').hide();
    } else {
      $('#header_row_' + parent_id).addClass('open');
      $('#header_row_' + parent_id).next('.accordion-body').show();
    }

  }

  function progress_bar_start(parent_id, html) {
    var duration = 3000; // it should finish in 5 seconds !
    $('#child_data_' + parent_id + ' .progress_bar_start_box').stop().addClass("processing_bg").animate({
      //$('#child_data_'+parent_id+' .progress_bar_start_box').stop().({"background-color": "green", "width": "0%"}).animate({
      width: '100%'
    }, {
      duration: duration,
      progress: function(promise, progress, ms) {
        $(this).text('Processing... ' + Math.round(progress * 100) + '%');
      }
    });

    setTimeout(function() {
      $('#child_data_' + parent_id).html(html);
      $('.progress_bar_start_box').removeClass('processing_bg');
    }, 3500);



  }

  function progress_bar_start_root_folders(id) {
    var duration = 5000; // it should finish in 5 seconds !
    $('.child_data_' + id + ' .progress_bar_start_box').stop().addClass("processing_bg").animate({
      //$('#child_data_'+parent_id+' .progress_bar_start_box').stop().({"background-color": "green", "width": "0%"}).animate({
      width: '100%'
    }, {
      duration: duration,
      progress: function(promise, progress, ms) {
        $(this).text('Processing... ' + Math.round(progress * 100) + '%');
      }
    });


  }
</script>

<script src="<?php echo base_url() . 'assets/admin/js/jquery.simpleaccordion.js' ?>"></script>