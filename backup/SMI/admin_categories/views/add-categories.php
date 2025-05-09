<style type="text/css">
    #loader{
    width:81%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("/assets/admin/images/progress-loader.gif") rgba(0,0,0,0.25);
    background-repeat: no-repeat;
    background-position: center;
}
</style>
<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');
//dd($obj_data);
//$sd
// dd($sd); die;
//dd($sd); die;
?>
<div id="loader" class="preload"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
                <!-- <ul class="nav navbar-right panel_toolbox">
                    <li><a href="<?php echo base_url('admin/category'); ?>">View</a>
                </ul> -->
                <h1 style="text-align: center;"><?php echo $title; ?></h1>
                <div class="clearfix"></div>
                
            </div>
<!-- manage custom text -->
            <?php 
            if($title==="Manage CustomText"){
            ?>

            <div class="x_content contents">

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
                <?php
                 $field_attr = array(
                    'name' => 'action_taken',
                    'type' => 'hidden',
                    'value' => set_value('action_taken', $title)
                );
                  echo form_input($field_attr);
                 ?>
                 <?php
                 $field_attr = array(
                    'name' => 'url_taken',
                    'type' => 'hidden',
                    'value' => set_value('url_taken', $last_url)
                );
                  echo form_input($field_attr);
                 ?>

                <div class="item form-group" id="sel_comp" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <select name="parent_id" class="select2_group form-control">
                            <option>Select Directory</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select>

                    </div>
                </div>

                <div class="item form-group" id="comp_name" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Directory Name <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'name',
                            'class' => 'form-control',
                            'placeholder' => 'Enter composer name',
                            'id' => 'name',
                            'readonly' => true,
                            'value' => set_value('name', (!empty($obj_data) && is_object($obj_data) ? $obj_data->name : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('name', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Custom Text <!--<span class="required" style="color: red;">*</span>-->
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'custom_text',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Custom text',
                            'id' => 'custom_text',
                            'value' => set_value('custom_text', (!empty($obj_data) && is_object($obj_data) ? $obj_data->custom_text : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('custom_text', '<div class="register-error" id="custom_text" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" id="add_key" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Keyword <!--<span class="required" style="color: red;">*</span>-->
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'keyword',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Keyword',
                            'id' => 'keyword',
                            'value' => set_value('keyword', (!empty($obj_data) && is_object($obj_data) ? $obj_data->keyword : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('keyword', '<div class="register-error" id="keyword" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" style="margin-top: 20px; display:none;" id="pdf_text">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                        Single File (PDF,Doc,Txt,Mp3,Mp4,Wav)
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">

                            <!--<div class="input-group">
                                <input type="text" class="form-control" disabled placeholder="Upload Image">
                                <span class="input-group-btn">
                                    <button class="browse btn btn-primary browse-button" type="button">Browse</button>
                                </span>
                                <h6 style="color: red;" class="error-custom"><?php echo form_error('images', '<div class="error">', '</div>'); ?></h6>
                            </div>-->

                            <span class="new_remove">
                                <?php
                                if (!empty($obj_data->cat_image)) {
                                    //dd($obj_data);
                                    $CI = & get_instance();
                                    $dpath = $this->Category_model->getRevArrayCatbyId($obj_data->id,$obj_data->parent_id);
                                    //echo $path;
                                    


                                    foreach ($obj_data->cat_image as $varImage) {

                                        $path = FCPATH . "assets/uploads/Sheet-Music/$dpath/" . (!empty($varImage) && is_object($varImage) ? $varImage->image : '');
                                        ?>

                                        <?php if (file_exists($path) && ($varImage->image)) {
                                            $ext = "";
                                            ?>
                                            <?php $ext = pathinfo($varImage->image, PATHINFO_EXTENSION); ?>
                                            <!--<figure>-->
                                            <img id="previewing" height="75px"
                                                 src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }elseif($ext=="txt"){ echo IMAGE_PATH . "txt.png"; }else{ echo ROOT_IMAGE_PATH . "Sheet-Music/$dpath/" . (!empty($varImage) && is_object($varImage) ? $varImage->image : ''); }  ?>"
                                                 alt="<?php echo $varImage->image; ?>" title="<?php echo $varImage->image; ?>" class="upload_img1 upload_img2"/>
                                            
                                            <!--</figure>-->
                                            <span class="remove_icon"><i class="fa fa-times-circle delete-image" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>
                                            <?php if($ext=="pdf" || $ext=="txt"){ ?>
                                            <p><?php echo $varImage->image; ?></p>
                                            <?php } ?>


                                        <?php } else { ?> 

                                            <img id="previewing" height="75px" src="<?php echo IMAGE_PATH . 'no_image.jpg' ?>" alt="your image" class="upload_img1 upload_img2"/>
                                            <span class="remove_icon"><i class="fa fa-times-circle delete-image" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>

                                            <?php
                                        }
                                        
                                    }
                                }
                                ?>
                            </span>

                            <?php
                            $field_attr = array(
                                'name' => 'image[]',
                                'type' => 'file',
                                //'accept'=>'all/*',
                                //'class' => 'file maxfile',
                                'multiple' => true,
                                'id' => 'images'
                                //'onchange' => 'imageprv(event,this)'
                            );
                            echo form_input($field_attr);
                            //echo form_error('image[]', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                            ?>
                            
                        </div>
                        <div class="validation text-danger" style="display:none;"></div>
                    </div>
                    
                </div>
                <div class="item form-group" style="display:none;">
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
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Submit">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        <?php }?>
<!-- manage custom text end -->    

<!-- add keyword -->
            <?php 
            if($title==="Add Keywords"){
            ?>

            <div class="x_content contents">

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
                <?php
                 $field_attr = array(
                    'name' => 'action_taken',
                    'type' => 'hidden',
                    'value' => set_value('action_taken', $title)
                );
                  echo form_input($field_attr);
                 ?>

                <?php
                 $field_attr = array(
                    'name' => 'url_taken',
                    'type' => 'hidden',
                    'value' => set_value('url_taken', $last_url)
                );
                  echo form_input($field_attr);
                 ?>

                <div class="item form-group" id="sel_comp" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <select name="parent_id" class="select2_group form-control">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select>

                    </div>
                </div>

                <div class="item form-group" id="comp_name" style="display:none;">
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
                </div>
                <div class="item form-group" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Custom Text <!--<span class="required" style="color: red;">*</span>-->
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'custom_text',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Custom text',
                            'id' => 'custom_text',
                            'value' => set_value('custom_text', (!empty($obj_data) && is_object($obj_data) ? $obj_data->custom_text : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('custom_text', '<div class="register-error" id="custom_text" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" id="add_key">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Keyword <!--<span class="required" style="color: red;">*</span>-->
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'keyword',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Keyword',
                            'id' => 'keyword',
                            'value' => set_value('keyword', (!empty($obj_data) && is_object($obj_data) ? $obj_data->keyword : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('keyword', '<div class="register-error" id="keyword" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" style="margin-top: 20px; display:none;" id="pdf_text">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                        Single File (PDF,Doc,Txt,Mp3,Mp4,Wav)
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">

                            <!--<div class="input-group">
                                <input type="text" class="form-control" disabled placeholder="Upload Image">
                                <span class="input-group-btn">
                                    <button class="browse btn btn-primary browse-button" type="button">Browse</button>
                                </span>
                                <h6 style="color: red;" class="error-custom"><?php echo form_error('images', '<div class="error">', '</div>'); ?></h6>
                            </div>-->

                            <span class="new_remove">
                                <?php
                                if (!empty($obj_data->cat_image)) {
                                    //dd($obj_data);
                                    $CI = & get_instance();
                                    $dpath = $this->Category_model->getRevArrayCatbyId($obj_data->id,$obj_data->parent_id);
                                    //echo $path;
                                    


                                    foreach ($obj_data->cat_image as $varImage) {

                                        $path = FCPATH . "assets/uploads/Sheet-Music/$dpath/" . (!empty($varImage) && is_object($varImage) ? $varImage->image : '');
                                        ?>

                                        <?php if (file_exists($path) && ($varImage->image)) {
                                            $ext = "";
                                            ?>
                                            <?php $ext = pathinfo($varImage->image, PATHINFO_EXTENSION); ?>
                                            <!--<figure>-->
                                            <img id="previewing" height="75px"
                                                 src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }elseif($ext=="txt"){ echo IMAGE_PATH . "txt.png"; }else{ echo ROOT_IMAGE_PATH . "Sheet-Music/$dpath/" . (!empty($varImage) && is_object($varImage) ? $varImage->image : ''); }  ?>"
                                                 alt="<?php echo $varImage->image; ?>" title="<?php echo $varImage->image; ?>" class="upload_img1 upload_img2"/>
                                            
                                            <!--</figure>-->
                                            <span class="remove_icon"><i class="fa fa-times-circle delete-image" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>
                                            <?php if($ext=="pdf" || $ext=="txt"){ ?>
                                            <p><?php echo $varImage->image; ?></p>
                                            <?php } ?>


                                        <?php } else { ?> 

                                            <img id="previewing" height="75px" src="<?php echo IMAGE_PATH . 'no_image.jpg' ?>" alt="your image" class="upload_img1 upload_img2"/>
                                            <span class="remove_icon"><i class="fa fa-times-circle delete-image" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>

                                            <?php
                                        }
                                        
                                    }
                                }
                                ?>
                            </span>

                            <?php
                            $field_attr = array(
                                'name' => 'image[]',
                                'type' => 'file',
                                //'accept'=>'all/*',
                                //'class' => 'file maxfile',
                                'multiple' => true,
                                'id' => 'images'
                                //'onchange' => 'imageprv(event,this)'
                            );
                            echo form_input($field_attr);
                            //echo form_error('image[]', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                            ?>
                            
                        </div>
                        <div class="validation text-danger" style="display:none;"></div>
                    </div>
                    
                </div>
                <div class="item form-group" style="display:none;">
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
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Submit">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        <?php }?> 
        <!-- add keyword end  -->   

        <!-- Add Composers -->
            <?php 
            if($title==="Add Directory"){
            ?>

            <div class="x_content contents">

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
                <?php
                 $field_attr = array(
                    'name' => 'action_taken',
                    'type' => 'hidden',
                    'value' => set_value('action_taken', $title)
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
              }elseif($smd === 'sm'){
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
              
                
              

                <div class="item form-group" id="sel_comp">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <?php if($sd === 'mc') {?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="1" selected="selected">master-composers</option>

                        </select>
                        <?php } elseif($sd === 'cm') { ?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="132" selected="selected">composers</option>

                        </select>
                    <?php } elseif($sd === 'sm') { ?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="1321" selected="selected">School-Music</option>

                        </select>

                         <?php } elseif($sd === 'pa') { ?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="12522" selected="selected">Public Archive</option>

                        </select>

                        <?php } elseif($sd === 'cp') { ?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="12619" selected="selected">Captured Music</option>

                        </select>

                        <?php } elseif($sd === 'ms') { ?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="13763" selected="selected">Music For Sale</option>

                        </select>

                         <?php } elseif($sd === 'sd') { ?>
                        <select name="parent_id" class="select2_group form-control">
                            <option value="14155" selected="selected">S D</option>

                        </select>

                        <?php } else { ?>

                        <select name="parent_id" class="select2_group form-control">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select>
                    <?php } ?>

                    </div>
                </div>

                <div class="item form-group" id="comp_name">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Create Root Directory: <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'name',
                            'class' => 'form-control',
                            'placeholder' => 'Type Here...',
                            'id' => 'name',
                            'value' => set_value('name', (!empty($obj_data) && is_object($obj_data) ? $obj_data->name : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('name', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Custom Text <!--<span class="required" style="color: red;">*</span>-->
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'custom_text',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Custom text',
                            'id' => 'custom_text',
                            'value' => set_value('custom_text', (!empty($obj_data) && is_object($obj_data) ? $obj_data->custom_text : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('custom_text', '<div class="register-error" id="custom_text" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" id="add_key" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Keyword <!--<span class="required" style="color: red;">*</span>-->
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'keyword',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Keyword',
                            'id' => 'keyword',
                            'value' => set_value('keyword', (!empty($obj_data) && is_object($obj_data) ? $obj_data->keyword : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('keyword', '<div class="register-error" id="keyword" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" style="margin-top: 20px; display:none;" id="pdf_text">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                        Single File (PDF,Doc,Txt,Mp3,Mp4,Wav)
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">

                            <!--<div class="input-group">
                                <input type="text" class="form-control" disabled placeholder="Upload Image">
                                <span class="input-group-btn">
                                    <button class="browse btn btn-primary browse-button" type="button">Browse</button>
                                </span>
                                <h6 style="color: red;" class="error-custom"><?php echo form_error('images', '<div class="error">', '</div>'); ?></h6>
                            </div>-->

                            <span class="new_remove">
                                <?php
                                if (!empty($obj_data->cat_image)) {
                                    //dd($obj_data);
                                    $CI = & get_instance();
                                    $dpath = $this->Category_model->getRevArrayCatbyId($obj_data->id,$obj_data->parent_id);
                                    //echo $path;
                                    


                                    foreach ($obj_data->cat_image as $varImage) {

                                        $path = FCPATH . "assets/uploads/Sheet-Music/$dpath/" . (!empty($varImage) && is_object($varImage) ? $varImage->image : '');
                                        ?>

                                        <?php if (file_exists($path) && ($varImage->image)) {
                                            $ext = "";
                                            ?>
                                            <?php $ext = pathinfo($varImage->image, PATHINFO_EXTENSION); ?>
                                            <!--<figure>-->
                                            <img id="previewing" height="75px"
                                                 src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }elseif($ext=="txt"){ echo IMAGE_PATH . "txt.png"; }else{ echo ROOT_IMAGE_PATH . "Sheet-Music/$dpath/" . (!empty($varImage) && is_object($varImage) ? $varImage->image : ''); }  ?>"
                                                 alt="<?php echo $varImage->image; ?>" title="<?php echo $varImage->image; ?>" class="upload_img1 upload_img2"/>
                                            
                                            <!--</figure>-->
                                            <span class="remove_icon"><i class="fa fa-times-circle delete-image" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>
                                            <?php if($ext=="pdf" || $ext=="txt"){ ?>
                                            <p><?php echo $varImage->image; ?></p>
                                            <?php } ?>


                                        <?php } else { ?> 

                                            <img id="previewing" height="75px" src="<?php echo IMAGE_PATH . 'no_image.jpg' ?>" alt="your image" class="upload_img1 upload_img2"/>
                                            <span class="remove_icon"><i class="fa fa-times-circle delete-image" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>

                                            <?php
                                        }
                                        
                                    }
                                }
                                ?>
                            </span>

                            <?php
                            $field_attr = array(
                                'name' => 'image[]',
                                'type' => 'file',
                                //'accept'=>'all/*',
                                //'class' => 'file maxfile',
                                'multiple' => true,
                                'id' => 'images'
                                //'onchange' => 'imageprv(event,this)'
                            );
                            echo form_input($field_attr);
                            //echo form_error('image[]', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                            ?>
                            
                        </div>
                        <div class="validation text-danger" style="display:none;"></div>
                    </div>
                    
                </div>
                <div class="item form-group" style="display:none;">
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
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Submit">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        <?php }?> 
        <!-- add composer end  -->   


        <!-- add document -->
            <?php 
            if($title==="Add Document"){
            ?>

            <div class="x_content contents">

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
                <?php
                 $field_attr = array(
                    'name' => 'action_taken',
                    'type' => 'hidden',
                    'value' => set_value('action_taken', $title)
                );
                  echo form_input($field_attr);
                 ?>
                 <?php
                 $field_attr = array(
                    'name' => 'url_taken',
                    'type' => 'hidden',
                    'value' => set_value('url_taken', $last_url)
                );
                  echo form_input($field_attr);
                 ?>

                <div class="item form-group" id="sel_comp">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <select name="parent_id" class="select2_group form-control">
                            <option>Select Directory</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select>

                    </div>
                </div>

                <div class="item form-group" id="comp_name">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Directory Name <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'name',
                            'class' => 'form-control',
                            'placeholder' => 'Enter composer name',
                            'id' => 'name',
                            'readonly' => true,
                            'value' => set_value('name', (!empty($obj_data) && is_object($obj_data) ? $obj_data->name : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('name', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Custom Text <!--<span class="required" style="color: red;">*</span>-->
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'custom_text',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Custom text',
                            'id' => 'custom_text',
                            'value' => set_value('custom_text', (!empty($obj_data) && is_object($obj_data) ? $obj_data->custom_text : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('custom_text', '<div class="register-error" id="custom_text" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" id="add_key" style="display:none;"> 
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Keyword <!--<span class="required" style="color: red;">*</span>-->
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'keyword',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Keyword',
                            'id' => 'keyword',
                            'value' => set_value('keyword', (!empty($obj_data) && is_object($obj_data) ? $obj_data->keyword : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('keyword', '<div class="register-error" id="keyword" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <div class="item form-group" style="margin-top: 20px;" id="pdf_text">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                        Single File (PDF,Doc,Txt,Mp3,Mp4,Wav)
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">

                            <!--<div class="input-group">
                                <input type="text" class="form-control" disabled placeholder="Upload Image">
                                <span class="input-group-btn">
                                    <button class="browse btn btn-primary browse-button" type="button">Browse</button>
                                </span>
                                <h6 style="color: red;" class="error-custom"><?php echo form_error('images', '<div class="error">', '</div>'); ?></h6>
                            </div>-->

                            <span class="new_remove">
                                <?php
                                if (!empty($obj_data->cat_image)) {
                                    //dd($obj_data);
                                    $CI = & get_instance();
                                    $dpath = $this->Category_model->getRevArrayCatbyId($obj_data->id,$obj_data->parent_id);
                                    //echo $path;
                                    


                                    foreach ($obj_data->cat_image as $varImage) {

                                        $path = FCPATH . "assets/uploads/Sheet-Music/$dpath/" . (!empty($varImage) && is_object($varImage) ? $varImage->image : '');
                                        ?>

                                        <?php if (file_exists($path) && ($varImage->image)) {
                                            $ext = "";
                                            ?>
                                            <?php $ext = pathinfo($varImage->image, PATHINFO_EXTENSION); ?>
                                            <!--<figure>-->
                                            <img id="previewing" height="75px"
                                                 src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }elseif($ext=="txt"){ echo IMAGE_PATH . "txt.png"; }else{ echo ROOT_IMAGE_PATH . "Sheet-Music/$dpath/" . (!empty($varImage) && is_object($varImage) ? $varImage->image : ''); }  ?>"
                                                 alt="<?php echo $varImage->image; ?>" title="<?php echo $varImage->image; ?>" class="upload_img1 upload_img2"/>
                                            
                                            <!--</figure>-->
                                            <span class="remove_icon"><i class="fa fa-times-circle delete-image" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>
                                            <?php if($ext=="pdf" || $ext=="txt"){ ?>
                                            <p><?php echo $varImage->image; ?></p>
                                            <?php } ?>


                                        <?php } else { ?> 

                                            <img id="previewing" height="75px" src="<?php echo IMAGE_PATH . 'no_image.jpg' ?>" alt="your image" class="upload_img1 upload_img2"/>
                                            <span class="remove_icon"><i class="fa fa-times-circle delete-image" img_id="<?php echo (!empty($varImage) && is_object($varImage) ? $varImage->id : ''); ?>"></i></span>

                                            <?php
                                        }
                                        
                                    }
                                }
                                ?>
                            </span>

                            <?php
                            $field_attr = array(
                                'name' => 'image[]',
                                'type' => 'file',
                                //'accept'=>'all/*',
                                //'class' => 'file maxfile',
                                'multiple' => true,
                                'id' => 'images'
                                //'onchange' => 'imageprv(event,this)'
                            );
                            echo form_input($field_attr);
                            //echo form_error('image[]', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                            ?>
                            
                        </div>
                        <div class="validation text-danger" style="display:none;"></div>
                    </div>
                    
                </div>
                <div class="item form-group" style="display:none;">
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
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Submit">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        <?php }?> 
        <!-- add document end  --> 

        
        </div>
    </div>
</div>
<script  type="text/javascript">

    $(document).ready(function(){
        // var dynamicText = $('.random-text').text();
        // if(dynamicText === "Manage CustomText"){
        //  $('#sel_comp').hide();
        //  $('#comp_name').hide();
        //  $('#add_key').hide();
        //  $('#pdf_text').hide();

        // }
        

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
<script>
$(function() {
    $(".preload").fadeOut(1000, function() {
        $(".contents").fadeIn(1000);        
    });
});
</script> 

