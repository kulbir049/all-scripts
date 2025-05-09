<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');
//dd($obj_data->cat_image[0]);
if(isset($obj_data->cat_image[0]))
{
	$incoded_id = base64_encode($obj_data->id);
	$action = "edit_composer/$incoded_id";
}

//dd($obj_data->cat_image[0]->description);
?>
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
            <div class="x_content">

                <?php
                get_flashdata();
                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_composer_detail', 'method' => 'post');
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

                <?php
                 if($sd === 'mc'){
                 $field_attr = array(
                    'name' => 'common',
                    'type' => 'hidden',
                    'value' => set_value('common', 'mc')
                );
                  echo form_input($field_attr);
                    }elseif($cd === 'cm'){
                       $field_attr = array(
                    'name' => 'common',
                    'type' => 'hidden',
                    'value' => set_value('common', 'cm')
                );
                  echo form_input($field_attr); 
                }
                elseif($smd === 'sm'){
                       $field_attr = array(
                    'name' => 'common',
                    'type' => 'hidden',
                    'value' => set_value('common', 'sm')
                );
                  echo form_input($field_attr); 
                }
                elseif($pub === 'pa'){
                       $field_attr = array(
                    'name' => 'common',
                    'type' => 'hidden',
                    'value' => set_value('common', 'pa')
                );
                  echo form_input($field_attr); 
                }
                elseif($cpm === 'cp'){
                       $field_attr = array(
                    'name' => 'common',
                    'type' => 'hidden',
                    'value' => set_value('common', 'cp')
                );
                  echo form_input($field_attr); 
                }
                elseif($mfs === 'ms'){
                       $field_attr = array(
                    'name' => 'common',
                    'type' => 'hidden',
                    'value' => set_value('common', 'ms')
                );
                  echo form_input($field_attr); 
                }
                else{
                $field_attr = array(
                    'name' => 'common',
                    'type' => 'hidden',
                    'value' => set_value('common', 'sd')
                );
                  echo form_input($field_attr);
                }
                ?>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <select name="parent_id"  class="select2_group form-control" disabled="">
                            <option>Select Directory</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select>

                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Directory Name <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'name',
                            'class' => 'form-control',
                            'placeholder' => 'Enter category name',
                            'id' => 'name',
							'readonly' => 'readonly',
                            'value' => set_value('name', (!empty($obj_data) && is_object($obj_data) ? $obj_data->name : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('name', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
				<div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        About Composer <!--<span class="required" style="color: red;">*</span>-->
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        /*$field_attr = array(
                            'name' => 'custom_text',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Custom text',
                            'id' => 'custom_text',
                            'value' => set_value('custom_text', (!empty($obj_data) && is_object($obj_data) ? $obj_data->custom_text : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('custom_text', '<div class="register-error" id="custom_text" style="color:red;">', '</div>');*/
                        ?>
						<textarea name="description" rows="6" cols="30" class="ckeditor" id="description"><?php if(!empty($obj_data)) { echo $obj_data->cat_image[0]->description;} ?></textarea>
                        <?php echo form_error('description', '<div class="register-error" id="register_name" style="color:red;">', '</div>'); ?>
                    </div>
                </div>
                <div class="item form-group" style="margin-top: 20px;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                        Upload Image for composer
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">

                            <div class="input-group">
                                <input type="text" class="form-control" disabled placeholder="Upload Image">
                                <span class="input-group-btn">
                                    <button class="browse btn btn-primary browse-button" type="button">Browse</button>
                                </span>
                                <h6 style="color: red;" class="error-custom"><?php echo form_error('images', '<div class="error">', '</div>'); ?></h6>
                            </div>

                            <span class="new_remove">
                                <?php
                                if (!empty($obj_data->cat_image)) {


                                    foreach ($obj_data->cat_image as $varImage) {

                                        $path = FCPATH . 'assets/uploads/ComposerProfileImages/' . (!empty($varImage) && is_object($varImage) ? $varImage->image : '');
                                        ?>

                                        <?php if (file_exists($path) && ($varImage->image)) {
                                            ?>
                                            <img id="previewing" height="75px"
                                                 src="<?php echo ROOT_IMAGE_PATH . '/ComposerProfileImages/' . (!empty($varImage) && is_object($varImage) ? $varImage->image : ''); ?>"
                                                 alt="your image" class="upload_img1 upload_img2"/>
                                            <span class="remove_icon"><i class="" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>


                                        <?php } else { ?> 

                                            <img id="previewing" height="75px" src="<?php echo IMAGE_PATH . 'no_image.jpg' ?>" alt="your image" class="upload_img1 upload_img2"/>
                                            <span class="remove_icon"><i class="" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>

                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </span>

                            <?php
                            $field_attr = array(
                                'name' => 'image',
                                'type' => 'file',
                                'accept'=>'image/*',
                                'class' => 'file maxfile',
                                //'multiple' => true,
                                'id' => 'images',
                                'onchange' => 'imageprv(event,this)'
                            );
                            echo form_input($field_attr);
                            //echo form_error('image[]', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                            ?>
                            
                        </div>
                        <div class="validation text-danger" style="display:none;"></div>
                        <div class="form-group">
                    <div class="col-md-6 col-md-offset-3" style="left: 368px;
    bottom: 145px;
"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Save">
                    </div>
                </div>
                    </div>
                    
                </div>
                <!--<div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Set Category On Home Page
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <?php
                        echo form_radio('priority', '1', set_radio('priority', '1', (!empty($obj_data) && is_object($obj_data) && $obj_data->priority === "1") ? TRUE : FALSE))."Up";
                        ?>
                        <?php
                        echo form_radio('priority', '2', set_radio('priority', '2', (!empty($obj_data) && is_object($obj_data) && $obj_data->priority === "2") ? TRUE : FALSE))."Down";
                        ?>
                        <?php
                        echo form_radio('priority', '0', set_radio('priority', '0', (!empty($obj_data) && is_object($obj_data) &&$obj_data->priority === "0" )? TRUE : FALSE))."None";

                        echo form_error('priority', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>-->
                <div class="ln_solid"></div>
                
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>

    jQuery(document).ready(function () {

        $(".delete-image").click(function (e) {
            var url_path = "<?php echo base_url('admin_categories/removeComposerProfileImage'); ?>";
            var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";
            e.preventDefault()
            var id = $(this).attr('img_id');
            var dataString = 'id=' + id;
			//alert(url_path);
			//alert(img_path);
			//alert(id);
			//alert(dataString);
			//return false;
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

