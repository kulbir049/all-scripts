<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');
//echo $action;
//dd($obj_data);
//echo $back_redirect;die;
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
                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_directory', 'method' => 'post');
                echo form_open('admin_categories/' . $action, $form_attr);

                
                ?>
<input type="hidden" name="back_url" value="<?php echo $this->uri->segment(3);?>">

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        
                        <!-- <select name="parent_id" class="select2_group form-control">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select> -->
                        <?php if($sub_directory_id>0){
                        $sub_directory_name=$this->Category_model->getCategory_name($sub_directory_id);
                        ?>
                        <select name="parent_id" id="parentidvalue" class="select2_group form-control">
                            <option value="<?php echo $sub_directory_id;?>" selected="selected"><?php echo $sub_directory_name[0]->name;?></option>

                        </select>
                        <?php }elseif($sd === 'mc') {?>
                        <select name="parent_id" class="select2_group form-control" id="parentidvalue">
                            <option value="1" selected="selected">master-composers</option>

                        </select>
                        <?php } elseif($cd === 'cm') { ?>
                        <select name="parent_id" class="select2_group form-control" id="parentidvalue">
                            <option value="132" selected="selected">composers</option>

                        </select>
                        <?php } elseif($smd === 'sm') { ?>
                        <select name="parent_id" class="select2_group form-control" id="parentidvalue">
                            <option value="1321" selected="selected">School-Music</option>

                        </select>


                        <?php } elseif($pub === 'pa') { ?>
                        <select name="parent_id" class="select2_group form-control" id="parentidvalue">
                            <option value="12522" selected="selected">Public Archive</option>

                        </select>
                    <?php } elseif($cpm === 'cp') { ?>
                        <select name="parent_id" class="select2_group form-control" id="parentidvalue">
                            <option value="12619" selected="selected">Captured Music</option>

                        </select>

                    <?php } elseif($mfs=== 'ms') { ?>
                        <select name="parent_id" class="select2_group form-control" id="parentidvalue">
                            <option value="13763" selected="selected">Music For Sale</option>

                        </select>

                    <?php } elseif($tsd=== 'sd') { ?>
                        <select name="parent_id" class="select2_group form-control" id="parentidvalue">
                            <option value="14155" selected="selected">S D</option>

                        </select>

                        <?php } else { ?>

                        <select name="parent_id" class="select2_group form-control" id="parentidvalue">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select>
                    <?php } ?>

                    </div>
                </div>
				
				<div class="item form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Directory <span style="color:red;">(Folders must be zipped)</span>
                    </label>
					<div class="col-md-6 col-sm-6 col-xs-12 ">
                        <input name="fileUpload" type="file" class="form-control" multiple="multiple" placeholder="Drag and drop music file here...or click to upload" required>
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
                    <div class="col-md-6 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" id="contentupload" value="Submit">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $( window ).on( "load", function() {
        var parentid = $('#parentidvalue').find(":selected").val();
        if (parentid==132 || parentid==1 || parentid==1321 || parentid==12522 || parentid==12619 || parentid==13763 || parentid==14155 ) {
            var status = $('#status_admin');
            status.show();
            $('.percent_admin').html('<span style="color:red;">Individual files cannot be loaded to the root directory of a library</span>');
        }
    } );
/*	$(document).ready(function() {
  $('#contentupload').click(function(e) {
   var value=  document.getElementById("parentidvalue").value;
      if(value==1){
          alert("Only folders may be added to root of a library.  Individual .pdfs must be in a folder. ")
      }else{
          document.getElementById('add_directory').submit();
      }
  });
	});*/
</script>
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

