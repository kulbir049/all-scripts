
<?php 
if($redirect_type=='mc' || $redirect_type=='cm'){
$main_category_ids=1;
}elseif($redirect_type=='sm'){
$main_category_ids=1321;
}elseif($redirect_type=='pa'){
$main_category_ids=12522;
}elseif($redirect_type=='cp'){
$main_category_ids=12619;
}elseif($redirect_type=='ms'){
$main_category_ids=13763;
}elseif($redirect_type=='sd'){
$main_category_ids=14155;
}else{
$main_category_ids=0;	
}




if(!isset($delete_html)){

foreach($objTree as $secondLevel){	
$parent_url = $this->Category_model->getCategory_name($secondLevel->parent_id);
$genrate_url=$parent_url[0]->parent_url.'/'.$secondLevel->parent_url;
	$genrate_url_array=array_unique(array_filter(explode('/',$genrate_url)));


						?>
<div class="accordion-header view_child_data" title="" id="<?php echo $secondLevel->id;?>">
  <input type="hidden" name="parent_url" id="parent_url_<?php echo $secondLevel->id;?>" value="<?php echo base64_encode( implode('/',$genrate_url_array));?>">                  
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

              <?php if($this->session->userdata('role_id')==1){ ?>
                <div><a id="<?php echo $secondLevel->id; ?>" href="<?php echo site_url('admin/category/delete_directory/'.base64_encode($secondLevel->id)); ?>" onclick="return confirm('Are you sure?')" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Permanent Delete</a></div>
               <?php } ?>
                
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
				<div><a href="<?php echo site_url('admin/category/addSubDir/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
                <div><a href="<?php echo site_url('admin/category/move_directory/'.base64_encode($secondLevel->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
                <div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
            <?php if($this->session->userdata('role_id')==1){ ?>
                <div><a id="<?php echo $secondLevel->id; ?>" class="delete" href="javascript:void(0)"  onclick="delete_category(this.id)"  title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
            <?php } ?>
                <div><a href="<?php echo site_url('admin/category/copy_directory/'.base64_encode($secondLevel->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)."/"."ManageCustomText"."/".$redirect_type); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
                <div><a href="<?php echo site_url('admin/category/add_composer/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Edit Composer"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
                <div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)."/"."AddKeywords"."/".$redirect_type); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
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
											<p style="border-bottom: 1px solid;"> <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($parent_id_tree)."_".base64_encode($main_category_ids)."_".base64_encode($varData->id); ?>" target="_blank">
												<img src="<?php if($ext=="pdf" || $ext=="PDF"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;">
											<?php  echo $varData->image;?></a>
											<div style="top: -35px;" class="naoTooltip-wrap naoTooltip_menu_tabs naoTooltip_menu_tabs_child " id="naoTooltip_<?php echo $varData->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)" >
											<p style="margin-right: 34px; font-size: 15px;">Option</p>
												<div class="naoTooltip nt-right nt-small dd-handle  naoTooltip_show_<?php echo $varData->id;?>">
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


<div><a id="<?php echo $secondLevel->id; ?>" href="javascript:void(0)" onclick="undo_delete_category(this.id)" title="Undo Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Undo Delete</a></div>

<?php if($this->session->userdata('role_id')==1){ ?>
<div><a id="permanent_<?php echo $secondLevel->id; ?>" href="javascript:void(0)"  onclick="permanent_delete_category(this.id)"  title="Permanent Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Permanent Delete</a></div>
<?php } ?>


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



										
											