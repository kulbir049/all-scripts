
<?php 
if(!isset($delete_html)){

foreach($objTree as $secondLevel){							?>
<div class="accordion-header view_child_data" title="" id="<?php echo $secondLevel->id;?>">
<?php 
 if($secondLevel->delete_status == 1) {?>
                <p style="color:red;"><?php echo (!empty($secondLevel) && is_object($secondLevel) ? $secondLevel->name : ''); ?>

                <?php if($secondLevel->custom_text!="" ){
                            ?>
                            <!-- <a class="tooltip">&nbsp;&nbsp; <i class="fas fa-info-circle" style="font-size: 20px;"></i> -->
                         <p class="custom_text" style="margin-left:100px;"><?php echo $secondLevel->custom_text; ?></p>
                       <!-- </a> -->
                            <?php
                        } ?>
                        
                

				<div class="naoTooltip-wrap naoTooltip_menu_tabs" id="naoTooltip_<?php echo $secondLevel->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)" >
				    <p>Option</p> 
                
                <div class="naoTooltip nt-right nt-small dd-handle naoTooltip_menu_tabs_child naoTooltip_show_<?php echo $secondLevel->id;?>">
                <div><a id="<?php echo $secondLevel->id; ?>" href="javascript:void(0)" onclick="undo_delete_category(this.id)" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Undo Delete</a></div>


                <div><a id="<?php echo $secondLevel->id; ?>" href="<?php echo site_url('admin/category/delete_directory/'.base64_encode($secondLevel->id)); ?>" onclick="return confirm('Are you sure?')" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Permanent Delete</a></div>

                
                </div>
                </div>
                <!-- <p class="custom_text" style="margin-left:25px;"><?php echo $category->custom_text; ?></p> -->
                </p>

<!--****************************DELETED end  here**************************-->
            <?php }else {?>	

				<p><?php echo $secondLevel->name; ?>
				<div class="naoTooltip-wrap naoTooltip_menu_tabs" id="naoTooltip_<?php echo $secondLevel->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)" >
				<p style="margin-right: -20px;">Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle naoTooltip_menu_tabs_folder naoTooltip_show_<?php echo $secondLevel->id;?>">
				<div><a href="<?php echo site_url('admin/category/addSubDir/'.base64_encode($secondLevel->id)."/"."mc"); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)."/"."AddDocument"."/"."mc"); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
                <div><a href="<?php echo site_url('admin/category/move_directory/'.base64_encode($secondLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
                <div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($secondLevel->id)."/"."mc"); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
                <div><a id="<?php echo $category->id; ?>" class="delete" href="<?php echo site_url('admin/category/delete_initiate/'.base64_encode($secondLevel->id)); ?>"  title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
                <div><a href="<?php echo site_url('admin/category/copy_directory/'.base64_encode($secondLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)."/"."ManageCustomText"."/"."mc"); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
                <div><a href="<?php echo site_url('admin/category/add_composer/'.base64_encode($secondLevel->id)."/"."mc"); ?>" title="Edit Composer"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)."/"."AddKeywords"."/"."mc"); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
        <?php } ?>          
                </div>
                  

                  <div class="accordion-body">
                <div class="accordion-group child_data_<?php echo $secondLevel->id;?>" id="child_data_<?php echo $secondLevel->id;?>" data-behavior="accordion" data-multiple="true">
				Loading... 
					
                        
                </div>
                </div>




   <?php } ?>             
   <?php         			$CI = & get_instance();
											//$dpath = $this->Category_model->getRevArrayCatbyId($secondLevel->id,$secondLevel->parent_id);
											$arr_img_pdf_txt = $this->Category_model->getImagesById($parent_id_tree);
											//dd($arr_img_pdf_txt);
											//dd($dpath);
											if(!empty($arr_img_pdf_txt))
											{
											foreach ($arr_img_pdf_txt as $varData) 
											{
											$ext = pathinfo($varData->image, PATHINFO_EXTENSION);
											?>
											<p style="border-bottom: 1px solid;"><a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($parent_id_tree)."_".base64_encode("1")."_".base64_encode($varData->id); ?>" target="_blank">
												<img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;">
											<?php  echo $varData->image;?></a>
											<div style="top: -35px;" class="naoTooltip-wrap naoTooltip_menu_tabs " id="naoTooltip_<?php echo $varData->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)" >
											<p style="margin-right: 34px; font-size: 15px;">Option</p>
												<div class="naoTooltip nt-right nt-small dd-handle naoTooltip_menu_tabs_child naoTooltip_show_<?php echo $varData->id;?>">
												<!-- <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($varData->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div> -->
												<div><a href="<?php echo site_url('admin/category/update/'.base64_encode($varData->id)."/"."UpdateDocument"); ?>" title="Update Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Update Document</a></div> 
												
												</div>
							                </div>
							                </p>
							                
											
											<?php 
											}
											}
//*****************************Child tree end here**************************
//*****************************Child tree end here**************************
}elseif ($delete_html[0]==1) { 
$secondLevel->id=$parent_id_tree;

	?>


<div><a id="<?php echo $secondLevel->id; ?>" href="javascript:void(0)" onclick="undo_delete_category(this.id)" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Undo Delete</a></div>


<div><a id="permanent_<?php echo $secondLevel->id; ?>" href="javascript:void(0)"  onclick="permanent_delete_category(this.id)"  title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Permanent Delete</a></div>



<?php }elseif ($delete_html[0]==2) { 
$secondLevel->id=$parent_id_tree;

	?>
<!-- <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div> -->
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($secondLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 

				<div><a href="javascript:void(0)"  onclick="delete_category(this.id)" id="<?php echo $secondLevel->id; ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<!-- <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div> -->
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>


<?php } ?>											



										
											