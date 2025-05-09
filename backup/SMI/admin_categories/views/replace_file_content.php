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
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
               
                <div class="clearfix"></div>
                 <h1 style="text-align: center;"><?php echo $title; ?></h1>
            </div>
            <div class="x_content">

                <?php
                get_flashdata();

                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_file_directory', 'method' => 'post');
                echo form_open('admin_categories/add_single_file', $form_attr);

                
                ?>
<input type="hidden" name="back_url" value="<?php echo $this->uri->segment(4);?>">
<input type="hidden" name="replace_file_id" value="<?php echo $replace_file_id;?>">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <?php /* <select name="parent_id" class="select2_group form-control">
                            <option>Select Composer</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select> <?php */ 

                        ?>
                       <strong> Path </strong>:  <?php  
                       if($replace_file_id==''){
                        $add_dir_path = $this->Category_model->getDirNamesById($obj_data->id);
                       }else{
                        $add_file_path = $this->Category_model->get_file_detail($replace_file_id);
                        $add_dir_path = $this->Category_model->getDirNamesById($add_file_path->cat_id);
                       }


echo $add_dir_path;
                                                if($replace_file_id==''){
?>
                        <select name="parent_id" class="select2_group form-control" required="true">
                            <option value="<?php echo $obj_data->id;?>" selected="selected"><?php echo $obj_data->name;?></option>
                        </select>
                        <?php    
                                            }else{
                                                
                                                $ar=explode(".",$add_file_path->image);
                                                $ext=end($ar);
                                                
 ?>
                        <select name="parent_id" class="select2_group form-control" required="true">
                            <option value="<?php echo $add_file_path->cat_id;?>" selected="selected"><?php echo $add_file_path->image;?></option>
                        </select>
                    <?php } ?>

                    </div>
                </div>
				<div class="item form-group">
                    <?php 
                                            if($replace_file_id==''){?>

					<label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Single File  </label>
                <?php }else{ ?>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Replace Single File  </label>

<?php                 } ?>
					<div class="col-md-6 col-sm-6 col-xs-12 ">
                        <input name="fileUpload" id="file" type="file" class="form-control" onchange="return fileValidation()" placeholder="Drag and drop music file here...or click to upload">
						<?php echo form_error('fileUpload', '<div class="register-error" id="fileUpload" style="color:red;">', '</div>'); ?>

                    </div>
				</div>


                                        
                            
				
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Submit">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    
    function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.<?= $ext?>)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .<?= $ext?> only.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                //document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
</script>
