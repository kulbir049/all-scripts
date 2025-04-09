<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="<?php echo base_url('admin/dbbackup'); ?>">View</a>
                </ul>
                <div class="clearfix"></div>
				<h1 style="text-align: center;"><?php echo $title; ?></h1>
            </div>
            <div class="x_content">
                <?php
                get_flashdata();
                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_country', 'method' => 'post');
                echo form_open('admin_dbbackup/' . $action, $form_attr);
                $field_attr = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'id' => 'id',
                    'value' => set_value('id', (!empty($obj_data) && is_object($obj_data) ? $obj_data->id : ''))
                );
                echo form_input($field_attr);
                ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Name <span class="required" style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                        $attr = array(
                            'name' => 'name',
                            'id' => 'name',
                            'class' => 'form-control col-md-7 col-xs-12',
                            'placeholder' => 'Database Name',
                            'value' => set_value('name', (!empty($obj_data) && is_object($obj_data) ? $obj_data->name : ''))
                        );
                        echo form_input($attr);
                        echo form_error('name', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
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
                 