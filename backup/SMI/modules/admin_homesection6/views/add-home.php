<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
               <!--  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="<?php echo base_url('admin/homesection6'); ?>">Back</a>
                </ul> -->
                <h1 style="text-align: center;"><?php echo $title; ?></h1>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                get_flashdata();
                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_homesection6', 'method' => 'post');
                echo form_open('admin_homesection6/' . $action, $form_attr);
                $field_attr = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'id' => 'id',
                    'value' => set_value('id', (!empty($obj_data) && is_object($obj_data) ? $obj_data->id : ''))
                );
                echo form_input($field_attr);
                $field_attr = array(
                    'name' => 'type',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'value' => set_value('type','Section6')
                );
                echo form_input($field_attr);
                ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php $field_attr = array(
                            'name' => 'title',
                            'type' => 'text',
                            'class' => 'form-control',
                            'id' => 'title',
                            'placeholder' => 'Title',
                            'value' => set_value('title', (!empty($obj_data) && is_object($obj_data) ? $obj_data->title : ''))
                        );
                        echo form_input($field_attr);
                        echo form_error('title', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>

                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description <span style="color: red;">* (Do not copy and paste into this input box.)</span>
                    </label>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <textarea name="description" rows="6" cols="50" class="ckeditor"  placeholder="Text" id="description"><?php if(!empty($obj_data)) { echo $obj_data->description;} ?></textarea>
                        <?php echo form_error('description', '<div class="register-error" id="register_name" style="color:red;">', '</div>'); ?>
                    </div>
                </div>
                    <div class="clearfix"></div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3 pull-right">
                            <input type="submit" class="btn btn-success my_button_new" name="submits" value="Submit">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

                    