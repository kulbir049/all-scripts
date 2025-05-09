<!-- <script src="https://kit.fontawesome.com/ffec47c7a2.js"></script>-->
<?php //echo $this->uri->segment(5);?>
<style type="text/css">
  .custom_text_p{margin-left:50px;font-size: 13px!important;margin-bottom: 0px!important;}
.new_file_add_update{background-color: greenyellow;}
.masdel{font-size: 22px!important;}
.nt-left{left: -260px!important;}
.naoTooltip-wrap{left: -50px!important;}

 .without_custom_text_file{margin-top: 7px!important;}
.without_custom_text_on_filefile_delete_option_3 { margin-right: 0; margin-top: 12px;}
.tooltip_hide{visibility: hidden;}
.deleted_color{color: red!important;}
.accordion-header.m-comp.open b {
    background: url(https://sheetmusicinternational.com/assets/img/minus-brown.png) no-repeat 15px center;
    color: #000;
    font-weight: bold;
}

.accordion-header.m-comp b {
    background: url(https://sheetmusicinternational.com/assets/img/plus-brown.png) no-repeat 15px center;
    color: #000;
    font-weight: bold;
}
.d-none-gaurav{
    display:none;
}

a[title^="file"].keyword_text {
  display:none;
}
</style>

<?php  
//echo "<pre>";print_r($_SESSION);print_r($this->session);die;
$array_list = $objTree;
if(isset($_SESSION['destination_last_id']) && $_SESSION['destination_last_id']>0){
 $destination_ids = $this->Category_model->get_destination_ids($_SESSION['destination_last_id']);
 $destination_ids[]=$_SESSION['destination_last_id'];
$last_key=array_search($_SESSION['destination_last_id'],$destination_ids);
 $_SESSION['destination_ids']= $destination_ids;
}
//print_r($_SESSION);//die;
//echo "</pre>";
if (!in_array($parent_id, $_SESSION['destination_ids']))
  {
 unset($_SESSION['destination_ids']);
 $destination_ids_json=json_encode(array(0));               
  }else{
    $destination_ids_json=json_encode($_SESSION['destination_ids']);
  }
  //echo "<pre>";print_r($_SESSION['destination_last_id']);die;
 /* if($_SESSION['destination_last_id']!=""){
?>
        <script>
        //  alert("hi");
     <?php   if(isset($_SESSION['tyoe_smi_operation'])):
         unset($_SESSION['tyoe_smi_operation']);
        elseif(isset($_SESSION['file_uploding'])):
         unset($_SESSION['file_uploding']);
        else:
        
            if(isset($_SESSION['gaurav_replace'])):
                 unset($_SESSION['gaurav_replace']);
                else:
        ?>
             setTimeout(function(){view_child_data_function('<?= $_SESSION['destination_last_id']?>'); },5000);
             <?php 
             
             endif;endif; ?>
              </script>
<?php } */?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
                <p style="text-align: center; color: red;">Hint : type control F then composer name. Screen will jump to composer.</p>
        <div class="col-md-12 abch">
         <ul>

            <li><a href="<?php echo site_url(); ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/ALL/<?php echo $redirect_type;?>">ALL</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/A/<?php echo $redirect_type;?>">A</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/B/<?php echo $redirect_type;?>">B</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/C/<?php echo $redirect_type;?>">C</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/D/<?php echo $redirect_type;?>">D</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/E/<?php echo $redirect_type;?>">E</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/F/<?php echo $redirect_type;?>">F</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/G/<?php echo $redirect_type;?>">G</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/H/<?php echo $redirect_type;?>">H</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/I/<?php echo $redirect_type;?>">I</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/J/<?php echo $redirect_type;?>">J</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/K/<?php echo $redirect_type;?>">K</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/L/<?php echo $redirect_type;?>">L</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/M/<?php echo $redirect_type;?>">M</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/N/<?php echo $redirect_type;?>">N</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/O/<?php echo $redirect_type;?>">O</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/P/<?php echo $redirect_type;?>">P</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/Q/<?php echo $redirect_type;?>">Q</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/R/<?php echo $redirect_type;?>">R</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/S/<?php echo $redirect_type;?>">S</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/T/<?php echo $redirect_type;?>">T</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/U/<?php echo $redirect_type;?>">U</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/V/<?php echo $redirect_type;?>">V</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/W/<?php echo $redirect_type;?>">W</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/X/<?php echo $redirect_type;?>">X</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/Y/<?php echo $redirect_type;?>">Y</a></li>
              <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/<?php echo $parent_id;?>/Z/<?php echo $redirect_type;?>">Z</a></li>

          </ul>
                 
      </div>
        <div class="container">
            <div class="alert"></div>
                          <form method="post" id="feedInput" name="searchon" action="<?php echo base_url();?>admin_categories/keywordsearch" autocomplete="off">
                <div class="main">
                
                        <div class="row">
                        <div class="col-md-9 ">
                            
                    
                       
                        <input type="text" name="home_search_file" class="form-control size col-md-6" id="ajax_search_file" placeholder="Compositions Search" value="<?php echo trim(strip_tags($home_search_file));?>">
                        
                        
                        
                        </div>
                        <div class="col-md-3"><button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                       
                      </div>
                     
                        </div>
                    </div>
                   

                </form>
                </div>
      <div class="col-md-12">
                    <?php if(regular_admin_permission('top_3_button',$this->session->userdata('admin_role_id'),$redirect_type)){ ?>
              <button class="btn btn-info" style="margin-left: 5px; margin-right: 46px; margin-top: 22px; float: right;"><a href="<?php echo base_url('admin_categories/add_save_directory/').$redirect_type; ?>" style="margin-left:0!important;"><span class="">Upload Folder Content</span></a></button>

              <button class="btn btn-info" style="margin-left: 9px; margin-right: 9px; margin-top: 22px; float: right;"><a href="<?php echo base_url('admin_categories/add_directory/').$redirect_type; ?>" style="margin-left:0!important;"><span class="">Upload Music Folder</span></a></button>

              <button class="btn btn-info" style="margin-left: 2px; margin-top: 22px; float: right;"><a href="<?php echo base_url('admin_categories/addSubDir/').base64_encode($parent_id).'/'.$redirect_type; ?>" style="margin-left:0!important;"><span class="">Add Root Folder</span></a></button>
              <button class="btn btn-info" style="margin-left: 2px; margin-top: 22px; float: right;"><a href="<?php echo base_url('admin_categories/addSubDir/').base64_encode($parent_id).'/'.$redirect_type; ?>/searchkeyword" style="margin-left:0!important;"><span class="">Add Search Folder</span></a></button>
            <?php } ?>
      </div>  
<?php if($this->session->flashdata('flash_msg_type')){ ?>
<div class="col-md-12">
<?php if($this->session->flashdata('flash_msg_type')=='success'){ ?>
<div class="alert alert-success">
  <strong>Success!</strong> <?php echo $this->session->flashdata('flash_msg_text');?>.
</div>
<?php } ?>
<?php if($this->session->flashdata('flash_msg_type')=='error'){ ?>
<div class="alert alert-danger">
  <strong>Danger!</strong> <?php echo $this->session->flashdata('flash_msg_text');?>.
</div>
<?php } ?>


</div>
<?php } ?>



<div class="clearfix"></div>

        <p class="tabs" style="margin: 17px 10px 0 10px;">
            <a href="<?php echo site_url(); ?>admin_categories" <?php if($parent_id==1 && $cate_type!='comp'){ ?>style="background-color: #666666; color: #fff;" <?php } ?>>Master Composers</a>
            <a href="<?php echo site_url(); ?>admin_categories/admin_comp"  <?php if($parent_id==132 && $cate_type=='comp'){ ?>style="background-color: #666666; color: #fff;" <?php } ?>>All Composers</a>

            <a href="<?php echo site_url(); ?>admin_categories/admin_school_music" <?php if($parent_id==1321){ ?>style="background-color: #666666; color: #fff;" <?php } ?>>School Music</a>

            <a href="<?php echo site_url(); ?>admin_categories/admin_public_archive" <?php if($parent_id==12522){ ?>style="background-color: #666666; color: #fff;" <?php } ?>>© Public Archive</a>

            <a href="<?php echo site_url(); ?>admin_categories/admin_captured_music" <?php if($parent_id==12619){ ?>style="background-color: #666666; color: #fff;" <?php } ?>>© Captured Music</a>

            <a href="<?php echo site_url(); ?>admin_categories/admin_music_sale" <?php if($parent_id==13763){ ?>style="background-color: #666666; color: #fff;" <?php } ?>>Music for Sale</a>

            <a href="<?php echo site_url(); ?>admin_categories/admin_s_d" <?php if($parent_id==14155){ ?>style="background-color: #666666; color: #fff;" <?php } ?>>Music for Approval</a>
            <!--<a href="<?php echo site_url(); ?>admin/approve_music" >Music for Approval</a>-->
            
            
            
        </p>
        <br>
        <div class="row">
            <div class="col-md-6">
                <form method="post" id="dhs-form-search1" action="<?= base_url('admin_categories/move_files')?>" style="display: inline-block;">
                    
                    <button type="submit" id="gaurav-data-multiple-button" class="btn btn-info" name="move_files" value="true" style="display:none;">Move Files</button>
                    <input type="hidden" name="ids" value="" id="gaurav_data_multiple_field" />
                    
                </form>
            </div>
            <div class="col-md-6 <?= (!isset($alphaSearch_keyword))?'d-none-gaurav':'';  ?> d-none-gaurav">
                <form method="post" id="dhs-form-search" style="display: inline-block;">
                    <div class="row">
                        <div class="col-md-9">
                            <input type="search" name="search_dhs" id="search_dhs" class="form-control" required placeholder="Enter Root Folder Name" />
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6  <?= (!isset($alphaSearch_keyword))?'':'d-none-gaurav';  ?> d-none-gaurav">
                <form method="post" id="dhs-form-search123" style="display: inline-block;">
                    <div class="row">
                        <div class="col-md-9">
                            <input type="search" name="search_dhs123" id="search_dhs_sub" class="form-control" required placeholder="Enter Sub Folder Name" />
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </div>
                </form>
            </div>
          
        </div>
           <div class="clearfix"></div>
            </div>
      
      <!------>
<div id="demo_wrap">
            
             <div class="progress_bar_start_box" style="color: black;">Processing...</div>
                
</div>
      <!------>
      
            
        </div>
    </div>
</div>          





<!--*********************************Rename model start here***************************-->
<p style="display: none;">
<button type="button" id="rename_folder" class="btn btn-info btn-lg" data-toggle="modal" data-target="#rename_btn_model">Update rename_folder</button>
</p>
  <!-- Modal -->
  <div class="modal fade" id="rename_btn_model" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header" style="background-color: #666; height: 48px;">
         <h4 class="modal-title" style="color: #fff;">Update Libraray Data</h4>
          <button type="button" class="close" data-dismiss="modal" style="padding: 6px 16px;">&times;</button>
         
        </div>
        <div class="modal-body" style="padding: 2rem; background-color: #666;">
            <label class="L_folder_name" style="color: #fff;">Folder Name:</label>
            <input type="hidden" class="form-control" name="folder_id" id="rename_folder_id" placeholder="folder_id" style="height: 30px; border: none;">
            <input type="text" class="form-control" name="new_folder_name" id="new_folder_name"  value="" >
            <input type="hidden" class="form-control" name="old_folder_name" id="old_folder_name"  value="" >
            <input type="hidden" class="form-control" name="rename_type" id="rename_type"  value="" >
            <p class="update_data_error" style="max-height: 150px;
    overflow-y: scroll;display: none;color:red;">Please enter name.</p>
            <button class="btn btn-default" style="background-color: #fff; margin-top: 10px;" id="submit_rename">UPDATE</button>&nbsp;&nbsp;<button class="btn btn-default" data-dismiss="modal" style="background-color: #fff; margin-top: 10px;">CLOSE</button>
         
              </div>
        <div class="modal-footer" style="background-color: #666; height: 30px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!--*********************************custome text model start here***************************-->
<p style="display: none;">
<button type="button" id="custom_text" class="btn btn-info btn-lg" data-toggle="modal" data-target="#custom_text_model">Update custom_text</button>
</p>
  <!-- Modal -->
  <div class="modal fade" id="custom_text_model" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header" style="background-color: #666; height: 48px;">
         <h4 class="modal-title" style="color: #fff;">Update Custom Text Data</h4>
          <button type="button" class="close" data-dismiss="modal" style="padding: 6px 16px;">&times;</button>
         
        </div>
        <div class="modal-body" style="padding: 2rem; background-color: #666;">
            <label class="L_custom_text" style="color: #fff;">Custom Text:</label>
            <input type="hidden" class="form-control" name="custom_text_id" id="custom_text_id" placeholder="folder_id">
            <input type="hidden" class="form-control" name="custom_text_title" id="custom_text_title" placeholder="folder_id">
            <input type="text" class="form-control" name="new_custom_text" id="new_custom_text" value="" placeholder="Please Enter Folder Name" style="height: 30px; border: none;">
            <!-- <p class="update_data_error" style="display: none;color:red;">Please enter Custom Text.</p> -->
            <button class="btn btn-default" style="background-color: #fff; margin-top: 10px;" id="submit_custom_text">UPDATE</button>&nbsp;&nbsp;<button class="btn btn-default" data-dismiss="modal" style="background-color: #fff; margin-top: 10px;">CLOSE</button>
         
              </div>
        <div class="modal-footer" style="background-color: #666; height: 30px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!--*********************************keyword_text model start here***************************-->
<p style="display: none;">
<button type="button" id="keyword_text" class="btn btn-info btn-lg" data-toggle="modal" data-target="#keyword_text_model">Update keyword text</button>
</p>
  <!-- Modal -->
  <div class="modal fade" id="keyword_text_model" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header" style="background-color: #666; height: 48px;">
         <h4 class="modal-title" style="color: #fff;">Update keyword text Data</h4>
          <button type="button" class="close" data-dismiss="modal" style="padding: 6px 16px;">&times;</button>
         
        </div>
        <div class="modal-body" style="padding: 2rem; background-color: #666;">
            <label class="L_custom_text" style="color: #fff;">keyword text:</label>
            <input type="hidden" class="form-control" name="keyword_text_id" id="keyword_text_id" placeholder="folder_id">
            <input type="hidden" class="form-control" name="keyword_text_title" id="keyword_text_title" placeholder="folder_id">
            <input type="text" class="form-control" name="new_keyword_text" id="new_keyword_text" value="" placeholder="Please Enter keyword text" style="height: 30px; border: none;">
            <!-- <p class="update_data_error" style="display: none;color:red;">Please enter keyword text.</p> -->
            <button class="btn btn-default" style="background-color: #fff; margin-top: 10px;" id="submit_keyword_text">UPDATE</button>&nbsp;&nbsp;<button class="btn btn-default" data-dismiss="modal" style="background-color: #fff; margin-top: 10px;">CLOSE</button>
         
              </div>
        <div class="modal-footer" style="background-color: #666; height: 30px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<!--********************Jquery alert message start here*******-->
<style type="text/css">
/* Popup box BEGIN */
.hover_bkgr_fricc{    background:rgba(0,0,0,.4);    cursor:pointer;    display:none;    height:100%;    position:fixed;    text-align:center;    top:0;    width:100%;    z-index:10000;}
.hover_bkgr_fricc .helper{    display:inline-block;    height:100%;    vertical-align:middle;}
.hover_bkgr_fricc > div {    background-color: #fff;    box-shadow: 10px 10px 60px #555;    display: inline-block;    height: auto;    max-width: 551px;    min-height: 100px;    vertical-align: middle;    width: 60%;    position: relative;    border-radius: 8px;    padding: 40px 5%;}
.popupCloseButton {    background-color: #fff;    border: 3px solid #999;    border-radius: 50px;    cursor: pointer;    display: inline-block;    font-family: arial;    font-weight: bold;    position: absolute;    top: -20px;    right: -20px;    font-size: 25px;    line-height: 30px;    width: 30px;    height: 30px;    text-align: center;}
.popupCloseButton:hover {    background-color: #ccc;}
.trigger_popup_fricc {    cursor: pointer;    font-size: 20px;    margin: 20px;    display: inline-block;    font-weight: bold;}
/* Popup box BEGIN */
</style>

<div class="hover_bkgr_fricc">
    <span class="helper"></span>
    <div>
        <div class="popupCloseButton">&times;</div>
        <p class="popup_message">loading...</p>
    </div>
</div>
<!--********************Jquery alert message end here*******-->



<script type="text/javascript">

$(window).load(function () {
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
});








  //$(".rename_folder").click(function(){
$("div").delegate(".rename_folder", "click", function(){
      var folder_name=$(this).attr('data-offerid');
      var folder_id=$(this).attr('data-folder_id');
      var rename_type=$(this).attr('title');
      $('#new_folder_name').val(folder_name);
      $('#old_folder_name').val(folder_name);
      $('#rename_folder_id').val(folder_id);
      $('#rename_type').val(rename_type);
      $('#rename_btn_model').modal('show');
setTimeout(function(){ $("#new_folder_name").focus(); }, 500);
});
//$(".custom_text").click(function(){
$("div").delegate(".custom_text", "click", function(){
      var id=$(this).attr('data-folder_id');
      var title=$(this).attr('title');
      var custom_text=$('#update_custom_text_'+id).text();
      $('#new_custom_text').val(custom_text);
      $('#custom_text_id').val(id);
      $('#custom_text_title').val(title);
      $('#custom_text_model').modal('show');
setTimeout(function(){ $("#new_custom_text").focus(); }, 500);
});
//$(".custom_text").click(function(){
$("div").delegate(".keyword_text", "click", function(){
      var id=$(this).attr('data-folder_id');
      var title=$(this).attr('title');
      var custom_text=$('.tooltip_a_span_'+id).text();
      $('#new_keyword_text').val(custom_text);
      $('#keyword_text_id').val(id);
      $('#keyword_text_title').val(title);
      $('#keyword_text_model').modal('show');
setTimeout(function(){ $("#new_keyword_text").focus(); }, 500);
});

$("#submit_rename").click(function(){
      var new_folder_name=$('#new_folder_name').val();
      var old_folder_name=$('#old_folder_name').val();
      var id=$('#rename_folder_id').val();
      var parent_id=$('#<?php echo $varData->id; ?>'+id).attr('data-parent_id');
      var rename_type=$('#rename_type').val();
      //alert(new_folder_name);
      if(new_folder_name!=''){
                      $('.update_data_error').hide();

                //if (confirm("Are you sure to Rename "+old_folder_name+"  to "+new_folder_name+"?")) {

            $.ajax({
                  type:'POST',  
                  url: "<?php echo base_url('admin_categories/rename_folder/'); ?>",
                  cache: false,
                  data:{id:id,type:rename_type,new_name:new_folder_name,old_folder_name:old_folder_name,parent_id:parent_id},
                  success: function(html){
                    //alert(html);
                    if(html==0){
                      $('.update_data_error').show();
                    $('.update_data_error').html("'"+new_folder_name+"' folder is already exist.");
                    return false;
                    }
                    
                    $('.new_name_'+id).text(new_folder_name);
                    $('#new_folder_name').val(new_folder_name);
                    $('#rename_btn_model').modal('hide');
                    // $("p.popup_message").text(rename_type+' name update Successfully');
                    // $('.hover_bkgr_fricc').show();
                    if(parent_id==1 || parent_id==132 || parent_id==1321 || parent_id==12522 || parent_id==12619 || parent_id==13763){ 
                    setTimeout(function(){ $('#'+id).click(); }, 500);
                    setTimeout(function(){ $('#'+id).click(); }, 1000); 
                    }else{
                        parent_id=$("#header_row_"+id).data("parent_id");
                    setTimeout(function(){ $('#'+parent_id).click(); }, 500);
                   
                    setTimeout(function(){ $('#'+parent_id).click(); }, 1000); 
                    }


                  }
                });
           // }
      }else{
        $('.update_data_error').show();
      }
});
$("#submit_custom_text").click(function(){
      var new_custom_text=$('#new_custom_text').val();
      var id=$('#custom_text_id').val();
      var parent_id=$('#'+id).attr('data-parent_id');
      var type=$('#custom_text_title').val();
      //if(new_custom_text!=''){
                //if (confirm("Are you sure to Update custom text?")) {
            $.ajax({
                  type:'POST',  
                  url: "<?php echo base_url('admin_categories/custom_text/'); ?>",
                  cache: false,
                  data:{id:id,type:type,new_custom_text:new_custom_text},
                  success: function(html){
                    $('#update_custom_text_'+id).text(new_custom_text);
                    $('.custom_text_'+id).attr('data-offerid',new_custom_text);
                   $('#custom_text_model').modal('hide');
                   //$("p.popup_message").text('Custom text update Successfully');
                    //$('.hover_bkgr_fricc').show();
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 500);
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 1000);
                    return false;
                }
                });
           // }
      // }else{
      //   $('.update_data_error').show();
      // }
});
$("#submit_keyword_text").click(function(){
      var new_keyword_text=$('#new_keyword_text').val();
      var id=$('#keyword_text_id').val();
      var parent_id=$('#'+id).attr('data-parent_id');
      var type=$('#keyword_text_title').val();
      //if(new_custom_text!=''){
       
                //if (confirm("Are you sure to Update keyword text?")) {
            $.ajax({
                  type:'POST',  
                  url: "<?php echo base_url('admin_categories/keyword_text/'); ?>",
                  cache: false,
                  data:{id:id,type:type,new_keyword_text:new_keyword_text},
                  success: function(html){
                    //$('.updated_custom_text_'+id).text(new_keyword_text);
                    $('#new_custom_text').val(new_keyword_text);
                    if(new_keyword_text!=''){
                    $('.tooltip_a_'+id).removeAttr('style');
                    $('.tooltip_a_'+id).removeClass("tooltip_hide");
                    }else{
                    $('.tooltip_a_'+id).addClass("tooltip_hide");
                    }
                    $('.tooltip_a_span_'+id).text(new_keyword_text);
                   $('#keyword_text_model').modal('hide');
                  //  $("p.popup_message").text('Keyword text update Successfully');
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 500);
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 1000);
                    //$('.hover_bkgr_fricc').show();
                    // var parent_id=$('#header_row_'+id).attr('data-parent_id');
                    // console.log(parent_id);
                    //  view_child_data_function(parent_id);
                    // if(parent_id==14155 || parent_id=="13763" || parent_id=="12619" || parent_id=="12522" || parent_id=="1321" || parent_id=="132" || parent_id=="1"){
                    //     gaurav_suraj=0;
                    // }
                    // if(parent_id==1 || parent_id==132 || parent_id==1321 || parent_id==12522 || parent_id==12619 || parent_id==13763){ 
                    // setTimeout(function(){ $('#'+id).click(); }, 500);
                    // setTimeout(function(){ $('#'+id).click(); }, 1000); 
                    // }else{
                    //     parent_id=$("#header_row_"+id).data("parent_id");
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 500);
                   
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 1000); 
                    // }
                    }
                });
            //}
      // }else{
      //   $('.update_data_error').show();
      // }
});


</script>









<script type="text/javascript">
//*******************Directory delete  function start here***************** 
function permanent_delete_category(permanent_id,delete_name){
        var id = permanent_id.split("_");
        var redirect_type = '<?php echo $redirect_type;?>';
      var parent_id=$('#'+permanent_id).attr('data-parent_id');
    if (confirm("Are you sure to delete '"+delete_name+"' permanently?")) {
        // your deletion code
    
    $.ajax({
          type:'POST',  
          url: "<?php echo site_url('admin_categories/permanent_delete_category/'); ?>",
          data:{delete_id:id[1],redirect_type:redirect_type},
          success: function(html){
            //alert(id[1]);
            $('#header_row_'+id[1]).remove();
            $('#child_data_'+id[1]).parent('.accordion-body').remove();
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 500);
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 1000);
           //$("p.popup_message").text('Data permanent deleted');
                  //  $('.hover_bkgr_fricc').show();
            //left: 63px; top: -100px; visibility: visible; opacity: 1;
          }
        });
    }
    return false;
}
function delete_category(id,delete_name){
        var redirect_type = '<?php echo $redirect_type;?>';
      var parent_id=$('#header_row_'+id).attr('data-parent_id');
    if (confirm("Are you sure to '"+delete_name+"' temporary delete?")) {
    $.ajax({
          type:'POST',  
          url: "<?php echo site_url('admin_categories/delete_initiate/'); ?>",
          cache: false,
          data:{delete_id:id,redirect_type:redirect_type},
          success: function(html){
            $('.new_name_'+id).css({"color":"red"});
            $('#child_data_'+id).parent().hide();
            $('#child_data_'+id).html('<p style="color: red;">Data temporary deteled.</p>');
            //$('.new_name_'+parent_id).click();
            view_child_data_function(parent_id);
            if(parent_id==14155 || parent_id=="13763" || parent_id=="12619" || parent_id=="12522" || parent_id=="1321" || parent_id=="132" || parent_id=="1"){
                gaurav_suraj=0;
               // ajax_root_folder_index_gaurav(parent_id,'<?php echo $cate_type;?>','<?php echo $alphaSearch_keyword;?>','<?php echo $redirect_type;?>',0); 
            }else{
                setTimeout(function(){ view_child_data_function(parent_id); }, 1000);
            }
            
          // setTimeout(function(){ view_child_data_function(parent_id); }, 1000);
            // $('.naoTooltip_show_'+id).html(html);
            // $('.naoTooltip_show_'+id).addClass('naoTooltip_menu_tabs_child');
            // $('.naoTooltip_show_'+id).removeClass('naoTooltip_menu_tabs_folder');
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 500);
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 1000);
           // $("p.popup_message").text('Data temporary deleted');
                 //   $('.hover_bkgr_fricc').show();
                                //left: 63px; top: -100px; visibility: visible; opacity: 1;
          }
        });
    }
    return false;
}
 function undo_delete_category(id,delete_name){
 //alert(id+'===='+delete_name);return false;
        var redirect_type = '<?php echo $redirect_type;?>';
      var parent_id=$('#header_row_'+id).attr('data-parent_id');
    if (confirm("Are you sure to '"+delete_name+"' Undo delete?")) {
    $.ajax({
          type:'POST',  
          url: "<?php echo site_url('admin_categories/delete_undothis/'); ?>",
          cache: false,
          data:{delete_id:id,redirect_type:redirect_type},
          success: function(html){
            $('.new_name_'+id).css({"color":"#555"});
            $('#child_data_'+id).parent().hide();
              view_child_data_function(parent_id); 
             if(parent_id==14155 || parent_id=="13763" || parent_id=="12619" || parent_id=="12522" || parent_id=="1321" || parent_id=="132" || parent_id=="1"){
                gaurav_suraj=0;
                //ajax_root_folder_index_gaurav(parent_id,'<?php echo $cate_type;?>','<?php echo $alphaSearch_keyword;?>','<?php echo $redirect_type;?>',0); 
            }else{
                
                setTimeout(function(){ view_child_data_function(parent_id); }, 1000);
            }

            // $('.naoTooltip_show_'+id).html(html);
            
            // $('.naoTooltip_show_'+id).removeClass('naoTooltip_menu_tabs_child');
            // $('.naoTooltip_show_'+id).addClass('naoTooltip_menu_tabs_folder');
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 500);
                    // setTimeout(function(){ $('#'+parent_id).click(); }, 1000);
            //$("p.popup_message").text('Data Undo deleted Successfully');
                   // $('.hover_bkgr_fricc').show();
            //left: 63px; top: -100px; visibility: visible; opacity: 1;
          }
        });
    }
    return false;
}
//*******************Directory delete  function end here***************** 
//*******************file delete  function start here***************** 
function permanent_delete_file(permanent_id,delete_name){
        var id = permanent_id.split("_");
        var redirect_type = '<?php echo $redirect_type;?>';
    if (confirm("Are you sure to delete '"+delete_name+"' permanently?")) {
        // your deletion code
    
    $.ajax({
          type:'POST',  
          url: "<?php echo site_url('admin_categories/permanent_delete_file/'); ?>",
          data:{delete_id:id[1],redirect_type:redirect_type},
          success: function(html){
             $('.file_delete_'+id[1]).hide();
            // $('#child_data_'+id[1]).parent('.accordion-body').hide();
          //$("p.popup_message").text('Data permanent deleted');

            //left: 63px; top: -100px; visibility: visible; opacity: 1;
          }
        });
    }
    return false;
}
function delete_file(id,delete_name){
        var redirect_type = '<?php echo $redirect_type;?>';
       var file_parent=$('.file_parent_'+id).attr('data-parent_id');
    if (confirm("Are you sure to delete '"+delete_name+"'?")) {
    $.ajax({
          type:'POST',  
          url: "<?php echo site_url('admin_categories/delete_initiate_file/'); ?>",
          cache: false,
          data:{delete_id:id,redirect_type:redirect_type},
          success: function(html){
             // alert("hi")
             $('#file_'+id).css({"color":"red"});
             view_child_data_function(file_parent); 
           setTimeout(function(){ view_child_data_function(file_parent); }, 500);
          // window.location.reload();
            // $('#child_data_'+id).parent().hide();
            // $('#child_data_'+id).html('<p style="color: red;">Data temporary deteled.</p>');
           // $('.naoTooltip_show_'+id).html(html);
           //  $('.naoTooltip_show_'+id).addClass('naoTooltip_menu_tabs_child');
           //  $('.naoTooltip_show_'+id).removeClass('naoTooltip_menu_tabs_folder');
            //$("p.popup_message").text('Data temporary deleted');
                   // $('.hover_bkgr_fricc').show();
            //left: 63px; top: -100px; visibility: visible; opacity: 1;
          }
        });
    }
    return false;
}
 function undo_delete_file(id,delete_name){
        var redirect_type = '<?php echo $redirect_type;?>';
       var file_parent=$('.file_parent_'+id).attr('data-parent_id');
    if (confirm("Are you sure to '"+delete_name+"' Undo delete?")) {
    $.ajax({
          type:'POST',  
          url: "<?php echo site_url('admin_categories/delete_undothis_file/'); ?>",
          cache: false,
          data:{delete_id:id,redirect_type:redirect_type},
          success: function(html){
             $('#file_'+id).css({"color":"#555"});
               view_child_data_function(file_parent); 
           setTimeout(function(){ view_child_data_function(file_parent); }, 1000);
            // $('#'+id).addClass('view_child_data');
            // $('#'+id).click();
            // $('#child_data_'+id).parent().show();
            // $('.naoTooltip_show_'+id).html(html);
            
            // $('.naoTooltip_show_'+id).removeClass('naoTooltip_menu_tabs_child');
            // $('.naoTooltip_show_'+id).addClass('naoTooltip_menu_tabs_folder');
            //$("p.popup_message").text('Data Undo deleted');
                  //  $('.hover_bkgr_fricc').show();
          }
        });
    }
    return false;
}
//*******************file delete  function end here***************** 

    /*$(".delete-record").click(function (e) {
        var url_path = "<?php echo base_url('admin_categories/deleteRecord'); ?>";
        var img_path = "<?php echo base_url();?>assets/admin/images/default.svg";
        e.preventDefault()
        var id = $(this).attr('id');
        var dataString = 'id=' + id;
    //alert(url_path);
    //alert(img_path);
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
                                $.loader('on', img_path);
                            },
                            success: function (data) {
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);

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
    });*/

    function confirm_status(sts, id, ip) {
        var url_path = "<?php echo base_url('admin_categories/changeStatus'); ?>";
        var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";
        var dataString = 'id=' + id + '&sts=' + sts;
        
        if (id) {
            $.ajax({
                type: "POST",
                url: url_path,
                data: dataString,
                cache: false,
                beforeSend: function () {
                    $.loader('on', img_path);
                },
                success: function (data) {

                    setTimeout(function () {
                        location.reload();
                    }, 1000);

                },
                complete: function () {
                    $.loader("off", img_path);
                }
            });
        }
    }
//$(document).ready(function(){
    //$('.view_child_data').click(function(){
//$("div").delegate(".view_child_data", "click", function(){
function view_child_data_function (id){
    //if($("#header_row_"+id).hasClass("open")){
        
   // }else{
        var redirect_type = '<?php echo $redirect_type;?>';
        var parent_id=id;
        //alert(parent_id);
        var parent_url=$('#parent_url_'+parent_id).val();
        if($('#header_row_'+parent_id).hasClass('open')){ var class_open=true;}else{var class_open=false;};
             $('#header_row_'+parent_id).next('.accordion-body').show();
             //alert(class_open);
             if(class_open==true){
             child_data_visible(parent_id,class_open);
             return false;
             } 
             keywords123='';
             url="<?php echo base_url();?>index.php/admin_categories/ajax_child_data";
             
             if($("#search_dhs_sub").length>0){
                 keywords123=$("#search_dhs_sub").val();
                 if(keywords123!=""){
                     //url="<?php echo base_url();?>index.php/admin_categories/ajax_root_folder_index_gaurav123";
                 }
             }
             
            //progress_bar_start_root_folders(parent_id);
        $.ajax({
          type:'POST',  
          url: url,
          cache: false,
          data:{parent_id:parent_id,redirect_type:redirect_type,parent_url:parent_url,keywords123:keywords123},
          success: function(html){
                      child_data_visible(parent_id,class_open);
                      json_to_html(html,parent_id);
          }
        });
    //}
    }
// });
function naoTooltip_hide(naoTooltip_show_id){
    var id = naoTooltip_show_id.split("_");
       $('.naoTooltip_show_'+id[1]).css({"left": "63px", "top": "-100px", "visibility": "hidden"});
};

function naoTooltip_show(naoTooltip_show_id){
    var id = naoTooltip_show_id.split("_");
         $('.naoTooltip_show_'+id[1]).css({"left": "63px", "top": "-100px", "visibility": "visible", "opacity": 1});
         $('.naoTooltip_show_'+id[1]).show();

};
 function child_data_visible(parent_id,class_open){
    if(class_open){
            $('#header_row_'+parent_id).removeClass('open');
            //$('#header_row_'+parent_id).next('.accordion-body').hide();
            $('#child_data_'+parent_id).parent().hide();

    }else{
           $('#header_row_'+parent_id).addClass('open');
            //$('#header_row_'+parent_id).next('.accordion-body').show();
            $('#child_data_'+parent_id).parent().show();
    }
            
 }

//  function progress_bar_start(parent_id,html) {
//   var duration = 500; // it should finish in 5 seconds !
//   $('#child_data_'+parent_id+' .progress_bar_start_box').stop().addClass("processing_bg").animate({
//   //$('#child_data_'+parent_id+' .progress_bar_start_box').stop().({"background-color": "green", "width": "0%"}).animate({
//     width: '100%'
//   }, {
//     duration: duration,
//     progress: function(promise, progress, ms) {
//       $(this).text('Processing... '+Math.round(progress * 100) + '%');
//     }
//   });

// setTimeout(function(){
//  $('#child_data_'+parent_id).html(html); 
//  $('.progress_bar_start_box').removeClass('processing_bg'); 
// }, 3500);

              

// }


// function progress_bar_start(parent_id,html) {
//   var duration = 500; // it should finish in 5 seconds !
//   $('#child_data_'+parent_id+' .progress_bar_start_box').stop().addClass("processing_bg").animate({
//   //$('#child_data_'+parent_id+' .progress_bar_start_box').stop().({"background-color": "green", "width": "0%"}).animate({
//     width: '100%'
//   }, {
//     duration: duration,
//     progress: function(promise, progress, ms) {
//       $(this).text('Processing... '+Math.round(progress * 100) + '%');
//     }
//   });

// setTimeout(function(){
//  $('#child_data_'+parent_id).html(html);
//  $('.progress_bar_start_box').removeClass('processing_bg'); 
// }, 600);

              

// }
// function progress_bar_start_root() {
//   var duration = 500; // it should finish in 5 seconds !
//   $('#demo_wrap .progress_bar_start_box').stop().addClass("processing_bg").animate({
//   //$('#child_data_'+parent_id+' .progress_bar_start_box').stop().({"background-color": "green", "width": "0%"}).animate({
//     width: '100%'
//   }, {
//     duration: duration,
//     progress: function(promise, progress, ms) {
//       $(this).text('Processing... '+Math.round(progress * 100) + '%');
//     }
//   });


// }
// function progress_bar_start_root_folders(id) {
//   if(id==25527 || id==40568){
//   var duration = 20000; // it should finish in 20 seconds !
//       }else{
//     var duration = 500; // it should finish in 5 seconds !
//   }
//   $('.child_data_'+id+' .progress_bar_start_box').stop().addClass("processing_bg").animate({
//   //$('#child_data_'+parent_id+' .progress_bar_start_box').stop().({"background-color": "green", "width": "0%"}).animate({
//     width: '100%'
//   }, {
//     duration: duration,
//     progress: function(promise, progress, ms) {
//       $(this).text('Processing... '+Math.round(progress * 100) + '%');
//     }
//   });


// }

function ajax_root_folder_index(parent_id,cate_type,alphaSearch_keyword,redirect_type,parent_url){
    
        var parent_url=$('#parent_url_'+parent_id).val();
       // alert(alphaSearch_keyword);
  //progress_bar_start_root();
        $.ajax({
          type:'POST',  
          url: "<?php echo base_url();?>index.php/admin_categories/ajax_root_folder_index",
          cache: false,
          data:{parent_id:parent_id,redirect_type:redirect_type,parent_url:parent_url,alphaSearch_keyword:alphaSearch_keyword},
          success: function(html){
           //  }
          
          json_to_html(html);


            //left: 63px; top: -100px; visibility: visible; opacity: 1;
          }
        });
    }
    var gaurav_suraj=0;
function ajax_root_folder_index(parent_id,cate_type,alphaSearch_keyword,redirect_type,start){
    //alert(parent_id);
        var parent_url=$('#parent_url_'+parent_id).val();
        $("#gaurav-button-data").html('<hr><p>Loading Please wait .....</p>');
       // alert(alphaSearch_keyword);
  //progress_bar_start_root();
 // $("#gaurav-button-data").remove();
 keywords=$("#search_dhs").val();
 if($("#search_dhs_sub").length>0){
    keywords123=$("#search_dhs_sub").val();
 }else{
     keywords123='';
 }
 
 if(keywords123==''){
     url="<?php echo base_url();?>index.php/admin_categories/ajax_root_folder_deleted_data";
 }else{
      url="<?php echo base_url();?>index.php/admin_categories/ajax_root_folder_index_gaurav123";
 }
  console.log({parent_id:parent_id,redirect_type:redirect_type,start:start,keywords:keywords,parent_url:parent_url,alphaSearch_keyword:alphaSearch_keyword,keywords123:keywords123});
        $.ajax({
          type:'POST',  
          url: url,
          cache: false,
          data:{parent_id:parent_id,redirect_type:redirect_type,start:start,keywords:keywords,parent_url:parent_url,alphaSearch_keyword:alphaSearch_keyword,keywords123:keywords123},
          success: function(html){
           //  }
          
          json_to_html(html);

gaurav_suraj=0;
            //left: 63px; top: -100px; visibility: visible; opacity: 1;
          }
        });
    }
    
  $(document).on("submit","#dhs-form-search",function(e){
      e.preventDefault();
      gaurav_suraj=0;
       $('#demo_wrap').html( `<div class="progress_bar_start_box" style="color: black;">Processing...</div>`); 
       //ajax_root_folder_index_gaurav('<?php echo $parent_id;?>','<?php echo $cate_type;?>','<?php echo $alphaSearch_keyword;?>','<?php echo $redirect_type;?>',0); 
  }); 
  $(document).on("submit","#dhs-form-search123",function(e){
      e.preventDefault();
      if($("#search_dhs_sub").length!=""){
          if($("#search_dhs_sub").val().length>2){
               e.preventDefault();
              gaurav_suraj=0;
               $('#demo_wrap').html( `<div class="progress_bar_start_box" style="color: black;">Processing...</div>`); 
              // ajax_root_folder_index_gaurav('<?php echo $parent_id;?>','<?php echo $cate_type;?>','<?php echo $alphaSearch_keyword;?>','<?php echo $redirect_type;?>',0); 
          }else{
              alert("Minimum three characters then we will search12 gaurav");
              $("#search_dhs_sub").val(null);
              $("#search_dhs_sub").focus();
          }
      }else{
          alert("Minimum three characters then we will search");
              $("#search_dhs_sub").val(null);
              $("#search_dhs_sub").focus();
      }
     
  });  
    
    function json_to_html(json_data,parent_id=''){
        
        var show_data_gaurav_12=0;
      var html_data='';
      var folder_name='';
      var tooltip_hide_class='';
      var custom_text='';
      var delete_status_class='';
      var searchkeyword_class='';
      var auto_open_folder_id=0;
      var site_url='<?php echo base_url();?>';
        var redirect_type = '<?php echo $redirect_type;?>';
//****************folder HTML end here*****************************
var json_data_array=JSON.parse(json_data);
var folder_array=json_data_array.folders;
var next_data=json_data_array.next_data;

var files_array=json_data_array.files;
//alert(folder_array.length);
if(folder_array.length>0){ 
   $.each(folder_array, function (i) {
    
                   if(folder_array[i].rename_folder!=''){
                      folder_name=folder_array[i].rename_folder;
                    }else{
                      folder_name=folder_array[i].name;
                    }
                   if(folder_array[i].keyword=='' || folder_array[i].keyword==null){
                      tooltip_hide_class='tooltip_hide';
                    }else{
                      tooltip_hide_class='';
                    }
                   if(folder_array[i].custom_text=='' || folder_array[i].custom_text==null){
                      custom_text='';
                    }else{
                      custom_text=folder_array[i].custom_text;
                    }
                   if(folder_array[i].delete_status==1){
                      delete_status_class='deleted_color';
                    }else{
                      delete_status_class='';
                    }
                   if(folder_array[i].searchkeyword==1){
                      searchkeyword_class='view_child_data_search';
                    }else{
                      searchkeyword_class='';
                    }
                    cate_class='';
if(folder_array[i].parent_id == 132){
                          cate_class="m-comp";
                        }
                        else{
                        
                          cate_class=$('#header_row_'+parent_id).attr('data-folder_brown');
                        }
                        
                      if(folder_array[i].keyword!=null){
                          keyword_dhs=folder_array[i].keyword;
                      }  else{
                          keyword_dhs='';
                      }

      html_data+=`<div class="accordion-header `+cate_class+`  view_child_data" id="header_row_`+folder_array[i].id+`" data-parent_id='`+folder_array[i].parent_id+`' data-folder_brown='`+cate_class+`' >
                     
   <div class="child_folder_name">
      <b class=" new_name_`+folder_array[i].id+` `+delete_status_class+` `+searchkeyword_class+`" onclick="view_child_data_function(`+ folder_array[i].id +`)" title="view data" id="`+ folder_array[i].id +`">`+folder_name+`</b>
      <a class="tooltip tooltip_a_`+folder_array[i].id+` `+tooltip_hide_class+`" >&nbsp;&nbsp;  <i class="fas fa-info-circle" style="font-size: 20px; margin-top: 3px;" aria-hidden="true"></i>
      <span class="tooltiptext tooltip_a_span_`+folder_array[i].id+`">`+keyword_dhs+`</span>
      <br/>
      </a><span>`+folder_array[i].parent_url+`</span> `
      if(folder_array[i].folder_user_id>0){
         html_data+=`<a href="`+site_url+`/admin_banner/edit/MA==/`+redirect_type+`/`+btoa(folder_array[i].id)+`"><i class="far fa-id-card masdel"></i></a>`;
         }
          html_data+=`<div class="naoTooltip-wrap" style="top:0px;" id="naoTooltip_`+folder_array[i].id+`" onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)">
      	
         <p class="folder_option_2">Option</p>`;

if(folder_array[i].delete_status==0){
         html_data+=`<div class="naoTooltip nt-left nt-small dd-handle naoTooltip_show_`+folder_array[i].id+`" style="z-index:999999;opacity: 1; left: 63px; top: -100px; visibility: hidden;">
            <div><a href="`+site_url+`/admin_categories/bookmark_individual_user/`+btoa(folder_array[i].id)+`/`+redirect_type+`" title="New Folder" style="text-align: left;"><img src="`+site_url+`/assets/admin/images/adddirectory.png" style="height: 24px;">&nbsp;&nbsp;Bookmark to individual user</a></div>
            <div><a href="`+site_url+`/admin_banner/edit/MA==/`+redirect_type+`/`+btoa(folder_array[i].id)+`" title="New Folder" style="text-align: left;"><i class="far fa-id-card masdel" aria-hidden="true"></i>&nbsp;&nbsp;Edit/Delete program notes</a></div>
            <div><a href="`+site_url+`/admin_categories/addSubDir/`+btoa(folder_array[i].id)+`/`+redirect_type+`/searchkeyword" title="New Folder" style="text-align: left;"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Add Search folder</a></div>
            <div><a href="`+site_url+`/admin_categories/add_save_directory/`+redirect_type+`/`+btoa(folder_array[i].id)+`" title="New Folder" style="text-align: left;"><img src="`+site_url+`/assets/admin/images/adddirectory.png" style="height: 24px;">&nbsp;&nbsp; Add folder content</a></div>
            <div><a href="`+site_url+`/admin_categories/addSubDir/`+btoa(folder_array[i].id)+`/`+redirect_type+`" title="New Folder" style="text-align: left;"><img src="`+site_url+`/assets/admin/images/adddirectory.png" style="height: 24px;">&nbsp;&nbsp; New Folder</a></div>
            <div><a href="`+site_url+`/admin_categories/add_edit_folder_content/`+btoa(folder_array[i].id)+`/`+redirect_type+`" title="Add Document"><img src="`+site_url+`/assets/admin/images/addfile.png" style="height: 24px;">&nbsp;&nbsp; Upload Folder</a></div>
            <div><a href="`+site_url+`/admin_categories/add_edit_file_content/`+btoa(folder_array[i].id)+`/`+redirect_type+`" title="Upload File"><img src="`+site_url+`/assets/admin/images/addfile.png" style="height: 24px;">&nbsp;&nbsp; Upload File</a></div>
            <div><a href="`+site_url+`/admin/category/move_directory/`+btoa(folder_array[i].id)+`/`+redirect_type+`" title="Move Directory"><img src="`+site_url+`/assets/admin/images/move.png" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div>
            <div><a href="javascript:void(0)" title="folder" class="rename_folder" data-offerid="`+folder_name+`" data-folder_id="`+folder_array[i].id+`"><img src="`+site_url+`/assets/admin/images/notepad.gif">&nbsp;&nbsp; Rename folder</a></div>
            <div><a id="`+folder_array[i].id+`" class="delete" href="javascript:void(0)" onclick="delete_category(this.id,'`+folder_name+`')" title="Delete Directory"><img src="`+site_url+`/assets/admin/images/trashcan.gif">&nbsp;&nbsp; Delete Directory</a></div>
            <div><a href="`+site_url+`/admin/category/copy_directory/`+btoa(folder_array[i].id)+`/`+redirect_type+`" title="Copy Directory"><img src="`+site_url+`/assets/admin/images/copy.png" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
            <div><a href="javascript:void(0)" class="custom_text custom_text_`+folder_array[i].id+`" data-offerid="" data-folder_id="`+folder_array[i].id+`" title="folder"><img src="`+site_url+`/assets/admin/images/ctDir.png" style="height: 24px;">&nbsp;&nbsp; Add/Update CustomText</a></div>
            <div><a href="javascript:void(0)" class="keyword_text" data-offerid="" data-folder_id="`+folder_array[i].id+`" title="folder"><img src="`+site_url+`/assets/admin/images/ctDir.png" style="height: 24px;">&nbsp;&nbsp; Add/Edit Keyword</a></div>
            <div><a href="`+site_url+`/admin_seo_management/edit/`+btoa(folder_array[i].id)+`/`+redirect_type+`"><img src="`+site_url+`/assets/admin/images/ctDir.png" style="height: 24px;">&nbsp;&nbsp; Add/Edit Seo Meta</a></div>
         </div>`;
       }else{
  html_data+=`<div class="naoTooltip nt-left nt-small dd-handle naoTooltip_menu_tabs_child naoTooltip_option_child_folder naoTooltip_show_`+folder_array[i].id+`" style="z-index:999999;opacity: 1; left: 63px; top: -100px; visibility: hidden;">
             <div><a id="`+folder_array[i].id+`" href="javascript:void(0)" onclick="undo_delete_category(this.id,'`+folder_name+`')" title="Delete Directory"><img src="`+site_url+`/assets/admin/images/trashcan.gif">&nbsp;&nbsp; Undo Delete</a></div>
             <div><a id="permanent_`+folder_array[i].id+`" href="javascript:void(0)" onclick="permanent_delete_category(this.id,'`+folder_name+`')" title="Delete Directory"><img src="`+site_url+`/assets/admin/images/trashcan.gif">&nbsp;&nbsp; Permanent Delete</a></div>
          </div>`;
       }


 html_data+=`</div>
      <p class="custom_text_p custom_text_font updated_custom_text_`+folder_array[i].id+`" id="update_custom_text_`+folder_array[i].id+`"> `+custom_text+`</p>
   </div>
</div>`;
if(folder_array[i].delete_status==0){

        html_data+=`<div class="accordion-body">
         <div class="accordion-group child_data_`+folder_array[i].id+`" id="child_data_`+folder_array[i].id+`" data-behavior="accordion" data-multiple="true">
            <div class="progress_bar_start_box">Processing...</div>
         </div>
      </div>`;
    }else{
      html_data+=`<div class="accordion-body">
         <div class="accordion-group "  data-behavior="accordion" data-multiple="true">
            <p style="color: red;">Data temporary deteled.</p>
         </div>
      </div>`;
    }
var destination_ids_json='<?php echo $destination_ids_json;?>';


var destination_ids_array=JSON.parse(destination_ids_json);
var open_folder_id=folder_array[i].id;

if(destination_ids_array.includes(folder_array[i].id)){
   auto_open_folder_id=folder_array[i].id;
  
}

 });
}
//****************folder HTML end here*****************************
         
//****************files HTML start here*****************************
if(files_array.length>0 ){
  var file_name='';
$.each(files_array, function (j) {
                   if(files_array[j].rename_file!=''){
                      file_name=files_array[j].rename_file;
                    }else{
                      file_name=files_array[j].image;
                    }
                    if(files_array[j].delete_status==1){
                      delete_status_class='deleted_color';
                    }else{
                      delete_status_class='';
                    }
                    
                     if(files_array[j].custom_text=='' || files_array[j].custom_text==null){
                      tooltip_hide_class='tooltip_hide';
                    }else{
                      tooltip_hide_class='';
                    }
var ext=file_name.split('.').pop();
//alert(ext);
if(ext=="pdf" || ext=="PDF"){
 var ext_icon='<?php echo IMAGE_PATH;?>pdf.png'; 
   }else if(ext=="mp3" || ext=="mp4"){
     //echo IMAGE_PATH . "music.png";
 var ext_icon='<?php echo IMAGE_PATH;?>music.png'; 
     }else {
   //echo IMAGE_PATH . "txt.png";
 var ext_icon='<?php echo IMAGE_PATH;?>txt.png'; 
    }
  
        html_data+=`<div style="border-bottom: 1px solid;" data-id="gaurav-raj" id="header_row_`+files_array[j].id+`" class="file_delete_`+files_array[j].id+` child_pdf_files" data-parent_id="`+files_array[j].parent_id+`"> `;
        if(delete_status_class==''){
            html_data+=`
            <input  type="checkbox" name="files_multiple_gaurav[]" class="gaurav-data-multiple" value="`+files_array[j].id+`" />
            `;
        }
        html_data+=`
   <a style="color:#555;" class="pdf_file_a `+delete_status_class+`" id="file_`+files_array[j].id+`" href="`+site_url+`/downloadfile/showpdf/`+btoa(files_array[j].id)+`" target="_blank" data-parent_id="`+files_array[j].parent_id+`">
   <img src="`+ext_icon+`" style="height: 24px;"> `+file_name+` (<span id="file_detail_span`+files_array[j].id+`">`+get_filedetail(files_array[j].id)+`</span>)</a>
   <a class="tooltip tooltip_a_`+files_array[j].id+`    `+tooltip_hide_class+`">&nbsp;&nbsp; <i class="fas fa-info-circle" style="font-size: 20px; margin-top: 3px;" aria-hidden="true"></i><span class="tooltiptext tooltip_a_span_`+files_array[j].id+`">`+files_array[j].custom_text+`</span></a>

   <div class="naoTooltip-wrap naoTooltip_menu_tabs  naoTooltip_menu_tabs_child  option_tab_menu" id="naoTooltip_`+files_array[j].id+`" onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)">
      <p class="without_custom_text_on_filefile_delete_option_3 file_delete_`+files_array[j].id+`">Option</p>`;
if(files_array[j].delete_status==0){


      html_data+=`<div class="naoTooltip nt-left nt-small dd-handle  naoTooltip_show_`+files_array[j].id+`">
         <div><a href="`+site_url+`/admin/category/rename_file/`+btoa(files_array[j].id)+`/`+redirect_type+`/file" title="Rename folder"><img src="`+site_url+`/assets/admin/images/notepad.gif">&nbsp;&nbsp; Rename File</a></div>
         <div><a href="`+site_url+`/admin_categories/replace_file_content/`+btoa(files_array[j].id)+`/`+redirect_type+`/file" title="Replace File"><img src="`+site_url+`/assets/admin/images/addfile.png" style="height: 24px;">&nbsp;&nbsp; Replace File</a></div>
         <div><a id="`+files_array[j].id+`" class="delete file_parent_`+files_array[j].id+`" href="javascript:void(0)" onclick="delete_file(this.id,'`+file_name+`')" data-parent_id='`+files_array[j].cat_id+`' title="Update File"><img src="`+site_url+`/assets/admin/images/addfile.png" style="height: 24px;">&nbsp;&nbsp; Delete File</a></div>
         <div><a href="`+site_url+`/admin_categories/move_file/`+btoa(files_array[j].id)+`/AddDocument/`+redirect_type+`" title="Copy Directory"><img src="`+site_url+`/assets/admin/images/copy.png" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Move File</a></div>
         <div><a href="`+site_url+`/admin_categories/copy_file/`+btoa(files_array[j].id)+`/AddDocument/`+redirect_type+`" title="Copy Directory"><img src="`+site_url+`/assets/admin/images/copy.png" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy File</a></div>
         <div><a href="javascript:void(0)" class="custom_text" data-offerid="" data-folder_id="`+files_array[j].id+`" title="file"><img src="`+site_url+`/assets/admin/images/ctDir.png" style="height: 24px;">&nbsp;&nbsp; Add/Update CustomText</a></div>
         <div><a href="javascript:void(0)" class="keyword_text" data-offerid="" data-folder_id="`+files_array[j].id+`" title="file"><img src="`+site_url+`/assets/admin/images/ctDir.png" style="height: 24px;">&nbsp;&nbsp; Add/Edit Keyword</a></div>
      </div>`;
    }else{

html_data+=`<div class="naoTooltip nt-left nt-small dd-handle  naoTooltip_show_`+files_array[j].id+` naoTooltip_menu_tabs_child" style="z-index:999999;opacity: 1; left: 63px; top: -100px; visibility: hidden;">
   <div><a id="`+files_array[j].id+`" href="javascript:void(0)" onclick="undo_delete_file(this.id,'`+file_name+`')" class="file_parent_`+files_array[j].id+`" title="Undo Directory" data-parent_id='`+files_array[j].cat_id+`'><img src="`+site_url+`/assets/admin/images/trashcan.gif">&nbsp;&nbsp; Undo Delete</a></div>
   <div><a id="permanent_`+files_array[j].id+`" href="javascript:void(0)" onclick="permanent_delete_file(this.id,'`+file_name+`')" title="Permanent Directory"><img src="`+site_url+`/assets/admin/images/trashcan.gif">&nbsp;&nbsp; Permanent Delete</a></div>
</div>`;
    }
if(files_array[j].custom_text!= null) {
    var custtext=files_array[j].custom_text;
}else{
    var custtext='';
}
    html_data += `</div>
   <span class="custom_text_p file_cutomtxt" id="update_custom_text_` + files_array[j].id + `">` + custtext + `</span>
</div>`;


});
}
//****************files HTML end here*****************************
//alert(parent_id);
if(parent_id==''){
    
        if(next_data!=""){
            
            html_data+=`<div class="text-center"  id="gaurav-button-data"> <hr><button type="button" 
            class='btn btn-success' id="show_pagination_data"
            onclick="ajax_root_folder_index_gaurav('<?php echo $parent_id;?>','<?php echo $cate_type;?>','<?php echo $alphaSearch_keyword;?>','<?php echo $redirect_type;?>',`+next_data+`)">(Remains `+json_data_array.count+`) Load More</button></div>`;
        }
        if(gaurav_suraj==0){
            $('#demo_wrap').html(html_data); 
        }else{
             $("#gaurav-button-data").remove();
            $('#demo_wrap').append(html_data);
        }
}else{
            $('#child_data_'+parent_id).html(html_data);
}
//console.log(auto_open_folder_id);
if(auto_open_folder_id>0){
    console.log(auto_open_folder_id);
   // alert("hi")
   //console.log($('.new_name_'+auto_open_folder_id).html())
$('.new_name_'+auto_open_folder_id).click();
$('html, body').animate({ scrollTop: $("#"+auto_open_folder_id).offset().top    }, 2000);
console.log("gaurav")
 show_data_gaurav_12=11;
    }else{
       if(show_data_gaurav_12==0){
           $("#show_pagination_data").click();
       } 
    }
  }
setTimeout(function(){ 
      ajax_root_folder_index('<?php echo $parent_id;?>','<?php echo $cate_type;?>','<?php echo $alphaSearch_keyword;?>','<?php echo $redirect_type;?>',0); 
    }, 500);

</script>


<script src="<?php echo base_url() . 'assets/admin/js/jquery.simpleaccordion.js' ?>"></script>
        <script>
        
        
        
         function get_filedetail(id) {
    $.ajax({
          type:'POST',  
          url: "https://sheetmusicinternational.com/comp/get_filedetail",
          cache: false,
          data:{id:id},
          success: function(html){
             $('#file_detail_span'+id).html(html);
          }
        });
}
            $(document).ready(function() {
                $('[data-behavior=accordion]').simpleAccordion({cbOpen:accOpen, cbClose:accClose});
            });


            function accClose(e, $this) {
                $this.find('span').fadeIn(200);
            }

            function accOpen(e, $this) {
                $this.find('span').fadeOut(200)
            }

        </script>
<script src="<?php echo base_url() . 'assets/admin/js/naoTooltips.js' ?>"></script>
        <script>
            (function() {
                $('.naoTooltip-wrap').naoTooltip();
            })();


function auto_click_destination_ids(id) {
setTimeout(function(){ $('#'+id).click(); }, 1000);
}
function auto_scroll_destination_ids(id) {
$('html, body').animate({
        scrollTop: $("#"+id).offset().top
    }, 2000);
}


$(document).on("change",".gaurav-data-multiple",function(){
    $("#gaurav-data-multiple-button").hide();
    flag=0;
    ids=new Array();
   $(".gaurav-data-multiple").each(function(){
        if($(this).prop("checked")==true){
            flag=flag+1;
            ids.push($(this).val());
        }     
   });
   if(flag>0){
       if(flag==1){
           alert("Check box to move multiple files then select move button on top.");
       }
       $("#gaurav-data-multiple-button").show();
       $("#gaurav-data-multiple-button").html("Move "+flag+" Files");
       $("#gaurav_data_multiple_field").val(ids.join());
   }
});

        </script>