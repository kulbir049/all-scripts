<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');
//echo $action;
//dd($obj_data);
?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
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
                echo form_open('admin_categories/add_directory_ajax', $form_attr);

                
                ?>
<input type="hidden" name="back_url" value="<?php echo $this->uri->segment(4);?>">

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <!-- <select name="parent_id" class="select2_group form-control">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select> -->
                       <strong> Path </strong>:  <?php  echo $add_dir_path = $this->Category_model->getDirNamesById($obj_data->id); ?>

                        <select name="parent_id" class="select2_group form-control" required="true">
                            <option value="<?php echo $obj_data->id;?>" selected="selected"><?php echo $obj_data->name;?></option>

                        </select>

                    </div>
                </div>
				
				<div class="item form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Directory <span style="color:red;">(Folders must be zipped)</span>
                    </label>
					<div class="col-md-6 col-sm-6 col-xs-12 ">
                        <input name="fileUpload" type="file" class="form-control" placeholder="Drag and drop music file here...or click to upload" required="true">
						<?php echo form_error('fileUpload', '<div class="register-error" id="fileUpload" style="color:red;">', '</div>'); ?>
						<div class="progress">
                                <div class="bar_admin"></div >
                                <div class="percent_admin">0%</div >
                            </div><br/>
                            <div id="status_admin" style="display: none;">Wait for upload to complete before leaving this page or closing browser.</div>

                    </div>
				</div>


                                        
                            
				
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Submit">
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

