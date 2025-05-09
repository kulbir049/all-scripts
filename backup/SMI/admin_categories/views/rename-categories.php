<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');
//dd($obj_data);die;
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
<?php if($rename_type=='rename_folder'){ ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Directory
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <select name="parent_id" class="select2_group form-control">
                            <option>Select Directory</option>
                            <?php cat_list('', '', $cat_id); ?>

                        </select>

                    </div>
                </div>
<?php }else{ 

?>
<input type="hidden" name="old_file_name" value="<?php echo $obj_data->image;?>">
<input type="hidden" name="old_file_path" value="<?php echo $obj_data->file_path;?>">
    <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Old File Name
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <select name="parent_id" class="select2_group form-control">
                            <option value="<?php echo $obj_data->cat_id;?>"><?php echo $obj_data->image;?></option>
                            

                        </select>

                    </div>
                </div>
            <?php } ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
<?php if($rename_type=='rename_folder'){ ?>
                        Directory Name 
                    
                        <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'name',
                            'class' => 'form-control',
                            'placeholder' => 'Enter category name',
                            'id' => 'name',
                            'required' => 'true',
                            'value' => set_value('name', (!empty($obj_data) && is_object($obj_data) ? $obj_data->name : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('name', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                    <?php }else{ ?>
                        New File Name
                           <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php
                        $field_attr = array(
                            'name' => 'name',
                            'class' => 'form-control',
                            'placeholder' => 'Enter category name',
                            'id' => 'name',
                            'required' => 'true',
                            'value' => set_value('name', (!empty($obj_data) && is_object($obj_data) ? $obj_data->image : ''))
                        );

                        echo form_input($field_attr);
                        echo form_error('name', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                    <?php } ?>
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

