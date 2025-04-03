<?php
error_reporting(0);



?>
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

        <?php echo $breadcrumb; ?>

        <div class="x_panel">

            <div class="x_title">

                <ul class="nav navbar-right " style="display: flex;">
                    <?php /*
                    if (isset($obj_data->id)) {

                    ?>
                        <li><a title="Edit" href="<?php echo site_url('admin_specialcode/show/' . base64_encode($obj_data->id)); ?>"><span class="glyphicon glyphicon-eye-open castumicon" style="color:#008000"></span></a>
                        </li>


                    <?php }*/ ?>

                </ul>

                <div class="clearfix"></div>

            </div>
            <h1 style="text-align: center;"><?php echo $title; ?></h1>

            <div class="x_content">

                <?php

                get_flashdata();

                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_specialcode', 'method' => 'post');

                echo form_open('admin_specialcode/' . $action, $form_attr);

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
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        Membership Plan <span style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                        $selected_plan = set_value('membership_plan', (!empty($obj_data) && is_object($obj_data) ? $obj_data->membership_plan : ''));

                        echo '<label>';
                        echo form_radio('membership_plan', '3', ($selected_plan == 3), ['class' => 'flat','required' => 'required']);
                        echo ' Standard';
                        echo '</label>&nbsp;&nbsp;';

                        echo '<label>';
                        echo form_radio('membership_plan', '4', ($selected_plan == 4), ['class' => 'flat','required' => 'required']);
                        echo ' Premium';
                        echo '</label>';

                        echo form_error('membership_plan', '<div class="register-error" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>


                <div class="item form-group">

                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">

                        Title<span style="color: red;">*</span>

                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php

                        $attr = array(

                            'name' => 'title',

                            'id' => 'title',
                            'required' => 'required',
                            'class' => 'form-control col-md-7 col-xs-12',

                            'placeholder' => 'Special code',

                            'value' => set_value('title', (!empty($obj_data) && is_object($obj_data) ? $obj_data->title : ''))

                        );

                        echo form_input($attr);

                        echo form_error('title', '<div class="register-error" id="register_name" style="color:red;">', '</div>');

                        ?>

                    </div>

                </div>


                <div class="item form-group">

                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">

                        Discount<span style="color: red;">*</span>

                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php

                        $attr = array(

                            'name' => 'price',

                            'id' => 'price',
                            'required' => 'required',

                            'class' => 'form-control col-md-7 col-xs-12',

                            'placeholder' => 'Discount',

                            'value' => set_value('price', (!empty($obj_data) && is_object($obj_data) ? $obj_data->price : ''))

                        );

                        echo form_input($attr);

                        echo form_error('price', '<div class="register-error" id="register_name" style="color:red;">', '</div>');

                        ?>

                    </div>

                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        Status <span style="color: red;">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                        $status_options = [
                            '' => 'Select Status',  // Default empty option
                            'Active' => 'Active',
                            'Inactive' => 'Inactive'
                        ];

                        $selected_status = set_value('status', (!empty($obj_data) && is_object($obj_data) ? $obj_data->status : ''));

                        echo form_dropdown('status', $status_options, $selected_status, [
                            'id' => 'status',
                            'class' => 'form-control col-md-7 col-xs-12',
                            'required' => 'required'
                        ]);

                        echo form_error('status', '<div class="register-error" style="color:red;">', '</div>');
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



<script type="text/javascript">
    CKEDITOR.editorConfig = function(config) {
        config.toolbar = [{
                name: 'document',
                items: ['Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates']
            },
            {
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
            },
            {
                name: 'forms',
                items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']
            },
            '/',
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
            },
            {
                name: 'links',
                items: ['Link', 'Unlink', 'Anchor']
            },
            {
                name: 'insert',
                items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
            },
            '/',
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'tools',
                items: ['Maximize', 'ShowBlocks']
            },
            {
                name: 'about',
                items: ['About']
            }
        ];
    };
    CKEDITOR.replace('body', {
        height: 5000
    });
</script>