<?php
//echo $error_msg;
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
                <ul class="nav navbar-right panel_toolbox">
                    <?php //echo $this->uri->segment(5);
                    if(base64_decode($this->uri->segment(3))>0){ ?>
                    <li><a href="javascript:void(0)" data-note_id="<?php echo base64_decode($this->uri->segment(3));?>" data-back_url="<?php echo $this->uri->segment(4);?>" data-music_id="<?php echo base64_decode($this->uri->segment(5));?>" onclick="delete_note(this)" style="background: #fd0000;">Delete Program Note</a>
                    <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url();?>home/profile_details/<?php echo (!empty($obj_data) && is_object($obj_data) ? $obj_data->id : '') ?> " target="_blank">View </a>
                      <!--  <a href="<?php /*echo base_url('admin/banner'); */?>">View</a>-->
                    <li><a href="javascript:void(0)" data-note_id="<?php echo base64_decode($this->uri->segment(3));?>" data-back_url="<?php echo $this->uri->segment(4);?>" data-music_id="<?php echo base64_decode($this->uri->segment(5));?>" onclick="delete_note(this)" style="background: #fd0000;">Delete Program Note</a>
                    <?php } ?>
                </ul>
                <h1 style="text-align: center;">Manage Program Notes</h1>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                get_flashdata();
                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_banner', 'method' => 'post');
                echo form_open('admin_banner/' . $action, $form_attr);
                $field_attr = array(
                    'name' => 'id',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'id' => 'id',
                    'value' => set_value('id', (!empty($obj_data) && is_object($obj_data) ? $obj_data->id : ''))
                );

                echo form_input($field_attr);
				
				$field_attr = array(
                    'name' => 'b_type',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'id' => 'b_type',
                    'value' => set_value('b_type', (!empty($obj_data) && is_object($obj_data) ? $obj_data->b_type : '2'))
                );

                echo form_input($field_attr);
				
                $field_attr = array(
                    'name' => 'old_image',
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'id' => 'image_old',
                    'value' => set_value('id', (!empty($obj_data) && is_object($obj_data) ? $obj_data->image : ''))
                );

                echo form_input($field_attr);
                ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Name<span class="required" style="color: red;">*</span>
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                        $attr = array(
                            'name' => 'name',
                            'id' => 'name',
                            'class' => 'form-control col-md-7 col-xs-12',
                            'placeholder' => 'Name',
                            'value' => set_value( 'name',(!empty($obj_data) && is_object($obj_data) ? $obj_data->name : ''))
                        );
                        echo form_input($attr);
                        //echo form_input('name', null, $attr);
                        echo form_error('title', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Title (H1 title)<span class="required" style="color: red;">*</span>
                    </label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                        $attr = array(
                            'name' => 'title',
                            'id' => 'title',
                            'class' => 'form-control col-md-7 col-xs-12',
                            'placeholder' => 'Title',
                            'value' => set_value( 'title',(!empty($obj_data) && is_object($obj_data) ? $obj_data->title : ''))
                        );
                        echo form_input($attr);
                        //echo form_input('name', null, $attr);
                        echo form_error('title', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                        ?>
                    </div>
                </div>
                <?php $position_index_next=$getlastBanner_position[0]['position_index'];

                if($obj_data->position_index>0){
                 $position_index=$obj_data->position_index;
                }else{
                 $position_index=$position_index_next+1;
                }

                 ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Position <span class="required" style="color: red;"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" name="position_index" value="<?php echo $position_index;?>" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Show on Home Page <span class="required" style="color: red;"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="radio" name="b_type" value="2" <?php if($obj_data->b_type==2){ echo "checked"; }?> >Yes
                        <input type="radio" name="b_type" value="0"  <?php if($obj_data->b_type==0){ echo "checked"; }?>  >No
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Add Search Folder 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="search_keyword" value="<?php echo $obj_data->search_keyword;?>" class="form-control col-md-7 col-xs-12">
                        <span> add ',' to add more  Search Folder</span>
                    </div>
                </div>
                
                <div class="item form-group" style="margin-top: 20px;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                        <?php echo form_label('Image:'); ?><span class="required" style="color: red;"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" disabled
                                       placeholder="Upload Image">
                                <span class="input-group-btn">
                                            <button class="browse btn btn-primary browse-button"
                                                    type="button">Browse</button>
                                            </span>
                            </div>
                            <?php
                            $path = site_url() . 'assets/uploads/composers_image/' . $obj_data->image;

                               if($obj_data->image!=''){ ?>
                                <span class="new_remove">
                                            <img id="previewing" height="75px"
                                                 src="<?php echo $path; ?>"
                                                 alt="your image" class="upload_img1 upload_img2"/>
                                            <!--<span class="remove_icon"><i class="fa fa-times-circle"></i></span>
                                            </span>-->
                                    </span>
                            <?php } ?>
                            <?php
                            $attr = array(
                                'name' => 'image',
                                'type' => 'file',
                                'class' => 'file',
                                'id' => 'images'
                                /*'onchange' => 'return imageprv(event,this);'*/
                            );
                            echo form_input($attr);
                            echo form_error('image', '<div class="register-error" id="register_name" style="color:red;">', '</div>');
                            ?>
                        </div>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                       Meta Title  
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="meta_title" value="<?php echo $obj_data->meta_title;?>" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                       Meta Keyword  
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="meta_keyword" value="<?php echo $obj_data->meta_keyword;?>" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                       Meta description  
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="meta_desc" value="<?php echo $obj_data->meta_desc;?>" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                       Image Title  
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="image_title" value="<?php echo $obj_data->image_title;?>" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>


                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        Image ALT tags 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="image_alt" value="<?php echo $obj_data->image_alt;?>" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descrition <span style="color: red;">( Do not copy and paste into this input box.)</span>
                    </label>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <textarea name="description" rows="6" cols="50" class="ckeditor"  placeholder="Text" id="description"><?php if(!empty($obj_data)) { echo $obj_data->description;} ?></textarea>
                        <?php echo form_error('description', '<div class="register-error" id="register_name" style="color:red;">', '</div>'); ?>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 pull-right">
                        <input type="submit" name="submits" class="btn btn-success my_button_new" value="Submit">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('change', '.file', function () {
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
</script>
 <script type="text/javascript">
function delete_note(data){
    var note_id=$(data).attr('data-note_id');
    var music_id=$(data).attr('data-music_id');
    var back_url=$(data).attr('data-back_url');
    var url_path = "<?php echo base_url('admin_banner/delete_note'); ?>";
    var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";
//alert(back_url);
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
                                   // e.preventDefault();

                                    $.ajax({
                                        type: "POST",
                                        url: url_path,
                                        data: {note_id:note_id,music_id:music_id,back_url:back_url},
                                        cache: false,
                                        beforeSend: function () {
                                            $.loader('on', img_path);
                                        },
                                        success: function (data) {
                                           // alert(data);
                                            // setTimeout(function () {
                                            //     location.reload();
                                            // }, 1000);
                                            window.location.href = "<?php echo site_url();?>"+data;

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

}

                $(".delete-record").click(function (e) {
                    var url_path = "<?php echo base_url('admin_banner/deleteRecord'); ?>";
                    var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";
                    e.preventDefault()
                    var id = $(this).attr('id');
                    var dataString = 'id=' + id;
                    // alert(id);
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
                                            $.loader('on', img_path);
                                        },
                                        success: function (data) {
                                            setTimeout(function () {
                                                location.reload();
                                            }, 1000);

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

             

            </script>