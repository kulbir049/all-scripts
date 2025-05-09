<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');
//echo $action;
//dd($obj_data);
?>
<style type="text/css">
       .percent_admin{ display: inline-block;position: absolute;z-index:999;     font-size: 15px; }
       .bar_admin{height: 10px;background-color: green;width: 0px;margin-top: 10px;}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
               
                <div class="clearfix"></div>
                 <h1 style="text-align: center;"><?php echo $title; ?></h1>
            </div>
            <div class="x_content">

                <?php
                get_flashdata();
                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_directory-new', 'method' => 'post');
                echo form_open('admin_categories/add_directory_ajax', $form_attr);

                
                ?>
<input type="hidden" name="back_url" value="<?php echo $this->uri->segment(3);?>">

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                         <?php 
                         //echo $back_redirect;
                         /*<select name="parent_id" class="select2_group form-control">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select><?php */ ?>
                        <?php if($sd === 'mc') {  $gaurav_new='mc';$gaurav_old=1;?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="1" selected="selected">master-composers</option>

                        </select>
                        <?php } elseif($cd === 'cm') { $gaurav_new='cm';$gaurav_old=132; ?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="132" selected="selected">composers</option>

                        </select>
                        <?php } elseif($smd === 'sm') { $gaurav_new='sm';$gaurav_old=1321;?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="1321" selected="selected">School-Music</option>

                        </select>


                        <?php } elseif($pub === 'pa') {  $gaurav_new='pa';$gaurav_old=12522;?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="12522" selected="selected">Public Archive</option>

                        </select>
                    <?php } elseif($cpm === 'cp') { $gaurav_new='cp';$gaurav_old=12619;?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="12619" selected="selected">Captured Music</option>

                        </select>

                    <?php } elseif($mfs=== 'ms') {  $gaurav_new='ms';$gaurav_old=13763;?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="13763" selected="selected">Music For Sale</option>

                        </select>

                    <?php } elseif($tsd=== 'sd') {  $gaurav_new='sd';$gaurav_old=14155;?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="14155" selected="selected">S D</option>

                        </select>

                        <?php } else { $gaurav_new='';$gaurav_old='';?>

                        <select name="parent_id" class="select2_group form-control">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select>
                    <?php } ?>

                    </div>
                </div>
			<script>
		//	console.log("<?php echo implode(",",$this->session->userdata("destination_ids"));?>");
			    $gaurav_new="<?= $gaurav_new?>";
			    $gaurav_old="<?= $gaurav_old?>";
			</script>	
				<div class="item form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Directory <span style="color:red;">(Folders must be zipped)</span>
                    </label>
					<div class="col-md-6 col-sm-6 col-xs-12 ">
                        <input name="fileUpload" type="file" id="fileUpload-SMI" class="form-control" placeholder="Drag and drop music file here...or click to upload" required="true">
						<?php echo form_error('fileUpload', '<div class="register-error" id="fileUpload" style="color:red;">', '</div>'); ?>
						
						
                        <div class="progress">
                                <div class="bar_admin"></div >
                                <div class="percent_admin">0%</div >
                            </div>
                            <div id="status_admin" style="display: none;">Wait for upload to complete before leaving this page or closing browser.</div>

                    </div>
				</div>


                                        
                            
				
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" id="uploadsubmit" name="submits" value="Submit">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
$('#fileUpload-SMI').bind('change', function() {

  //this.files[0].size
  var max_size='2147483648';
 // var max_size='2097152';
  if(this.files[0].size>max_size){
      alert('Files must be under 2 geg in size.  To upload this file, break it into smaller files and re-upload.')
      document.getElementById('uploadsubmit').style.visibility='hidden';
      return false;
  }else{
      document.getElementById('uploadsubmit').style.visibility='visible';
      return true; 
  }
 // alert(this.files[0].size);

});

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

