<!-- <?php
//dd($categories);
//die;
?> -->
<script src="https://kit.fontawesome.com/ffec47c7a2.js"></script>
<style type="text/css">
.tooltip {
  position: relative;
  display: inline-block!important;
  opacity: 1!important;
}

.tooltip .tooltiptext {
visibility: hidden;
    width: 493px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 4px 8px;
    position: absolute;
    z-index: 1;
    left: 50%;
    margin-left: -60px;
    opacity: 1!important;
    transition: opacity 0.3s;
    margin-top: -36px;
    top: 0!important;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -186px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
.tabs a{
    padding: 10px 20px;
}
.abch a {
    background-color: #3bafda;
    color: #fff;
    padding: 5px;
    margin-left: 18px;
}
.loader_img{width: 50px;}

</style>

<?php 
//dd($objTree);
//$array_list_full = json_decode(json_encode($objTree), True);
//$array_list = $array_list_full['arrChilds']; 
$array_list = $objTree;
//dd($array_list); 
//die(); 
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
                <!--<ul class="nav  panel_toolbox">
                    <li><a  href="<?php echo base_url('admin/category/add'); ?>"><span class="glyphicon glyphicon-plus"></span></a>
                    </li>
                </ul>   
                <div class="clearfix"></div>-->
                <p style="text-align: center; color: red; margin-top: 30px;">Hint : type control F then composer name. Screen will jump to composer.</p>
                <div class="abch">

               <ul>

                    <li><a href="<?php echo site_url(); ?>admin_comp">ALL</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/A">A</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/B">B</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/C">C</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/D">D</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/E">E</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/F">F</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/G">G</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/H">H</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/I">I</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/J">J</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/K">K</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/L">L</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/M">M</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/N">N</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/O">O</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/P">P</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/Q">Q</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/R">R</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/S">S</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/T">T</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/U">U</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/V">V</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/W">W</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/X">X</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/Y">Y</a></li>

                    <li><a href="<?php echo base_url() ?>admin_comp/alphaSearch/Z">Z</a></li>

                </ul>
                <button class="btn btn-info" style="margin-left: 9px; margin-right: 46px; margin-top: 22px; float: right;"><a href="<?php echo base_url('admin/category/add_directory'); ?>"><span class="">Directory upload</span></a></button>
                <button class="btn btn-info" style="margin-left: 2px; margin-top: 22px; float: right;"><a href="<?php echo base_url('admin/category/add'); ?>"><span class="">New Root Folder</span></a></button>
            </div>
            <div class="clearfix"></div>
                <p class="tabs" style="margin: 17px 10px 0 10px;">
            <a href="<?php echo site_url(); ?>admin_categories">Master Composers</a>
            <a href="<?php echo site_url(); ?>admin_comp" style="background-color: #666666; color: #fff;">Composers</a>
            <a href="<?php echo site_url(); ?>admin_school_music">School Music</a>
            <a href="<?php echo site_url(); ?>admin_public_archive">© Public Archive</a>
            <a href="<?php echo site_url(); ?>admin_captured_music">© Captured Music</a>
            <a href="<?php echo site_url(); ?>admin_music_sale">Music for Sale</a>
            <a href="<?php echo site_url(); ?>admin_s_d">S.D</a>
            
        </p>
                   <div class="clearfix"></div>
            </div>
            
            <!------>
            <div id="demo_wrap">
            <div class="accordion-group" data-behavior="accordion">
                <?php get_flashdata(); ?>
                <?php
                if (isset($array_list) && !empty($array_list) && is_array($array_list)) {
                            foreach ($array_list as $category) {
                ?>
                <div class="accordion-header view_child_data" title="view data" id="<?php echo $category->id;?>">
                <p><?php echo (!empty($category) && is_object($category) ? $category->name : ''); ?>

                <?php if($category->custom_text!="" ){
                            ?>
                            <a class="tooltip">&nbsp;&nbsp; <i class="fas fa-info-circle" style="font-size: 20px;"></i>
                         <span class="tooltiptext"><?php echo $category->custom_text; ?></span>
                       </a>
                            <?php
                        } ?>
                        
                
                <div class="naoTooltip-wrap">
                <p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
                <!-- <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div> -->
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
                <div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($category->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
                <div><a href="<?php echo site_url('admin/category/delete_directory/'.base64_encode($category->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
                <!-- <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div> -->
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
                <div><a href="<?php echo site_url('admin/category/add_composer/'.base64_encode($category->id)); ?>" title="Add Composer"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
                
                 <div class="accordion-body">
                <div class="accordion-group child_data_<?php echo $category->id;?>" id="child_data_<?php echo $category->id;?>" data-behavior="accordion" data-multiple="true">
                <img  class="loader_img" src="<?php echo base_url();?>/images/ajax-loader.gif" >
                    
                        
                </div>
                </div>   
                <?php
                }
                }
                ?>
                
            </div>
            </div>
            <!------>
            
            
        </div>
    </div>
</div>                
<script type="text/javascript">


    $(".delete-record").click(function (e) {
        var url_path = "<?php echo base_url('admin_categories/deleteRecord'); ?>";
        var img_path = "<?php echo base_url();?>assets/admin/images/default.svg";
        e.preventDefault()
        var id = $(this).attr('id');
        var dataString = 'id=' + id;
        //alert(url_path);
        //alert(img_path);
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

    function confirm_status(sts, id, ip) {
        var url_path = "<?php echo base_url('admin_categories/changeStatus'); ?>";
        var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";
        var dataString = 'id=' + id + '&sts=' + sts;
        
        if (id) {
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
    }
$(document).ready(function(){
    //$('.view_child_data').click(function(){
$("div").delegate(".view_child_data", "click", function(){
        var parent_id=$(this).attr('id');
        var title=$(this).attr('title');
        if($(this).hasClass('open')){ var class_open=true;}else{var class_open=false;};


        $.ajax({
          type:'POST',  
          url: "<?php echo base_url();?>index.php/admin_categories/ajax_child_data",
          cache: false,
          data:{parent_id:parent_id},
          success: function(html){
            $('#child_data_'+parent_id).html(html);
            if(title!='view data'){
            child_data_visible(parent_id,class_open);
             }
            //left: 63px; top: -100px; visibility: visible; opacity: 1;
          }
        });
    });
 });
function naoTooltip_hide(naoTooltip_show_id){
    var id = naoTooltip_show_id.split("_");
         $('.naoTooltip_show_'+id[1]).css({"left": "63px", "top": "-100px", "visibility": "hidden"});

};

function naoTooltip_show(naoTooltip_show_id){
    var id = naoTooltip_show_id.split("_");
         $('.naoTooltip_show_'+id[1]).css({"left": "63px", "top": "-100px", "visibility": "visible", "opacity": 1});
         $('.naoTooltip_show_'+id[1]).show();

};
 function child_data_visible(parent_id,class_open){
    if(class_open){
            $('#'+parent_id).removeClass('open');
            $('#'+parent_id).next('.accordion-body').hide();
    }else{
           $('#'+parent_id).addClass('open');
            $('#'+parent_id).next('.accordion-body').show();
    }
            
 }
</script>