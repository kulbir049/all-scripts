

<?php 

$admin_role_id=$this->session->userdata('admin_role_id');

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

$main_parent_id=$main_category_ids;
if($redirect_type=='cm'){
$main_parent_id=132;
}






if(!isset($delete_html)){ 
///***********this condition will work when page will load first time/////OR//// without click on delete button



foreach($objTree as $secondLevel){	
                 if($secondLevel->rename_folder!=''){
                      $folder_name=$secondLevel->rename_folder;
                    }else{
                      $folder_name=$secondLevel->name;
                    }
                    
                  
$custom_text=$secondLevel->custom_text;
$keyword_text=$secondLevel->keyword;

$parent_id=$secondLevel->parent_id;
$parent_url = $this->Category_model->getDirNamesById($secondLevel->parent_id);
	$genrate_url_array=array_filter(explode('/',$parent_url));
  if($genrate_url_array[0]=='master-composers'){
    $main_root_id=1;
  }else{
    $main_root_id=$parent_id;
  }
  //print_r($genrate_url_array[0]);
 /* 
//***********************Parent url update file and folders start**********************
$folder_path['parent_url']=$parent_url;
$where1['id']=$secondLevel->parent_id;
$table_name='categories';
$this->Category_model->update_folder_data($table_name,$where1,$folder_path);
$file_path['file_path']=$parent_url;
$where2['cat_id']=$secondLevel->parent_id;
$table_name='category_image';
$this->Category_model->update_folder_data($table_name,$where2,$file_path);
//***********************Parent url update file and folders end**********************
if(count($genrate_url_array)<=3){
  $folder_option_class="folder_option_2";
}else{
  $folder_option_class="folder_option_3";
}   */
  
						?>


<div class="accordion-header view_child_data" id="header_row_<?php echo $secondLevel->id;?>">


  <input type="hidden" name="parent_url" id="parent_url_<?php echo $secondLevel->id;?>" value="<?php echo base64_encode( implode('/',$genrate_url_array));?>">                  

<?php 



 if($secondLevel->delete_status == 1) {?>

                <div class="child_folder_name" ><b style="color:red;" class="<?php if($main_root_id==1){ echo 'a-comp'; }?>" title="" id="<?php echo $secondLevel->id;?>" onclick="view_child_data_function(this)" data-parent_id="<?php echo $secondLevel->parent_id;?>" alt=""><?php echo $folder_name; ?></b>

         <a class="tooltip tooltip_a_<?php echo $secondLevel->id;?>" <?php if($secondLevel->keyword=="" ){ ?> style="visibility: hidden;" <?php } ?>>&nbsp;&nbsp;  <i class="fas fa-info-circle" style="font-size: 20px; margin-top: 3px;"></i>
                        <span class="tooltiptext tooltip_a_span_<?php echo $secondLevel->id;?>"><?php echo $secondLevel->keyword; ?></span>
                       </a> 

                

                        

                



				<div class="naoTooltip-wrap naoTooltip_menu_tabs option_align_folder option_tab_menu" id="naoTooltip_<?php echo $secondLevel->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)" >

				    <p>Option</p> 

                
<?php if($this->session->userdata('admin_role_id')==1){ ?>
                <div class="naoTooltip nt-left nt-small dd-handle naoTooltip_menu_tabs_child naoTooltip_option_child_folder naoTooltip_show_<?php echo $secondLevel->id;?>">
                <div><a id="<?php echo $secondLevel->id; ?>" href="javascript:void(0)" onclick='undo_delete_category(this.id,"<?php echo $folder_name; ?>")' title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Undo Delete</a></div>
               <div><a id="permanent_<?php echo $secondLevel->id; ?>" href="javascript:void(0)"  onclick='permanent_delete_category(this.id,"<?php echo $folder_name; ?>")'  title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Permanent Delete</a></div>
                </div>
<?php } ?>

                </div>

<?php if($secondLevel->custom_text!="" ){ ?>
                         <p class="custom_text_p" id="update_custom_text_<?php echo $secondLevel->id; ?>"><?php echo $secondLevel->custom_text; ?></p>
 <?php } ?>

                </div>



<!--****************************DELETED end  here**************************-->

            <?php }else {?>	



				<div class="child_folder_name"><b class="<?php if($main_root_id==1){ echo 'a-comp'; }?> new_name_<?php echo $secondLevel->id;?> <?php if($secondLevel->searchkeyword==1){ echo 'view_child_data_search'; } ?>" title="" id="<?php echo $secondLevel->id;?>" onclick="view_child_data_function(this)" data-parent_id="<?php echo $secondLevel->parent_id;?>" ><?php echo $folder_name; ?></b>
<?php if(isset($move_copy_approve)){ ?>
 <input name="rdbcomposer" value="<?php echo $secondLevel->id;?>" type="radio" class="select_radio1">
<?php } ?>


          
               <a class="tooltip tooltip_a_<?php echo $secondLevel->id;?>" <?php if($secondLevel->keyword=="" ){ ?> style="visibility: hidden;" <?php } ?>>&nbsp;&nbsp;  <i class="fas fa-info-circle" style="font-size: 20px; margin-top: 3px;"></i>
                        <span class="tooltiptext tooltip_a_span_<?php echo $secondLevel->id;?>"><?php echo $secondLevel->keyword; ?></span>
                       </a> 


				<div  class="naoTooltip-wrap naoTooltip_menu_tabs option_align_folder option_tab_menu" id="naoTooltip_<?php echo $secondLevel->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)" >

				<p class="<?php echo $folder_option_class;?>">Option</p>

                <div class="naoTooltip nt-left nt-small dd-handle naoTooltip_menu_tabs_folder naoTooltip_show_<?php echo $secondLevel->id;?>">
                  <?php if(regular_admin_permission('bookmark_individual_user', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo base_url('admin_categories/bookmark_individual_user/').base64_encode($secondLevel->id).'/'.$redirect_type; ?>" title="New Folder" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp;Bookmark to individual user</a></div>
                  <?php } ?>
                 
             <?php if(regular_admin_permission('edit_program_note', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo base_url('admin_banner/edit/'.base64_encode($secondLevel->folder_user_id).'/').$redirect_type.'/'.base64_encode($secondLevel->id); ?>" title="New Folder" style="text-align: left;"><i class="far fa-id-card masdel" aria-hidden="true"></i>&nbsp;&nbsp;Edit/Delete program notes</a></div>
                  <?php } ?>
                  <div><a href="<?php echo site_url('admin_categories/addSubDir/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>/searchkeyword" title="New Folder" style="text-align: left;"><i class="fa fa-search"></i>&nbsp;&nbsp;Add Search Folder</a></div>

                    <?php if(regular_admin_permission('Add_folder_content', $admin_role_id,$main_root_id)){ ?>
               <div><a href="<?php echo base_url('admin_categories/add_save_directory/').$redirect_type.'/'.base64_encode($secondLevel->id); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add folder content</a></div>
             <?php } ?>
                    <?php if(regular_admin_permission('create_folder', $admin_role_id,$main_root_id)){ ?>
				<div><a href="<?php echo site_url('admin_categories/addSubDir/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; New folder</a></div>
                      <?php } ?>
                    <?php if(regular_admin_permission('upload_folder', $admin_role_id,$main_root_id)){ ?>
                <div><a href="<?php echo site_url('admin_categories/add_edit_folder_content/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Upload Folder</a></div> 
              <?php } ?>
                    <?php if(regular_admin_permission('add_file', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo site_url('admin_categories/add_edit_file_content/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Upload File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Upload File</a></div>
            <?php } ?>
                    <?php 
                   /* if(regular_admin_permission('replace_file', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo site_url('admin_categories/add_edit_file_content/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Replace File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Replace File</a></div>
            <?php } */
             ?>

                    <?php if(regular_admin_permission('move_folder', $admin_role_id,$main_root_id)){ ?>
                <div><a href="<?php echo site_url('admin/category/move_directory/'.base64_encode($secondLevel->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
                   <?php } ?>
                    <?php if(regular_admin_permission('rename_folder', $admin_role_id,$main_root_id)){ ?>
                <div><a href="javascript:void(0)" title="folder" class="rename_folder" data-offerid="<?php echo $folder_name; ?>" data-folder_id="<?php echo $secondLevel->id;?>" data-parent_id="<?php echo $secondLevel->cat_id;?>"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div>
              <?php } ?>

<?php if($this->session->userdata('admin_role_id')==1){ ?>
                <div><a id="<?php echo $secondLevel->id; ?>" class="delete" href="javascript:void(0)"  onclick='delete_category(this.id,"<?php echo $folder_name; ?>")'  title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
            <?php } ?>
                    <?php if(regular_admin_permission('copy_folder', $admin_role_id,$main_root_id)){ ?>
                <div><a href="<?php echo site_url('admin/category/copy_directory/'.base64_encode($secondLevel->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
            <?php } ?>

                <div><a href="javascript:void(0)" class="custom_text custom_text_<?php echo $secondLevel->id; ?>" data-offerid="<?php echo $custom_text; ?>" data-folder_id="<?php echo $secondLevel->id; ?>" title="folder"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Update CustomText</a></div>
                    <?php /* if(in_array('edit', $this->session->userdata('userRole_data'))){ ?>
                <div><a href="<?php echo site_url('admin/category/add_composer/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Edit Composer"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
                <?php } */?>
                <div><a href="javascript:void(0)" class="keyword_text" data-offerid="<?php echo $keyword_text; ?>" data-folder_id="<?php echo $secondLevel->id; ?>" title="folder"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Edit Keyword</a></div>

                    <div><a href="<?php echo base_url();?>admin_seo_management/edit/<?php echo base64_encode($secondLevel->id).'/'.$redirect_type; ?>" ><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Edit Seo Meta</a></div>




                </div>

                </div>
                 <p class="custom_text_p" id="update_custom_text_<?php echo $secondLevel->id; ?>"><?php echo $secondLevel->custom_text; ?></p> 

                </div>

        <?php } ?>          

                </div>

                  



                  <div class="accordion-body">

                <div class="accordion-group child_data_<?php echo $secondLevel->id;?>" id="child_data_<?php echo $secondLevel->id;?>" data-behavior="accordion" data-multiple="true">

				                          <div class="progress_bar_start_box">Processing...</div>


					

                        

                </div>

                </div>




<?php if(in_array($secondLevel->id, $this->session->userdata('destination_ids'))){ 


  ?>

          <script type="text/javascript">
            auto_click_destination_ids('<?php echo $secondLevel->id;?>');
            auto_scroll_destination_ids('<?php echo $secondLevel->id;?>');
          </script>




   <?php 
 }
}//***********FOReach end here  ?>             

   <?php         			$CI = & get_instance();

											//$dpath = $this->Category_model->getRevArrayCatbyId($secondLevel->id,$secondLevel->parent_id);

											$arr_img_pdf_txt = $this->Category_model->getImagesById($parent_id_tree);
 $parent_url_file = $this->Category_model->getDirNamesById($parent_id_tree);

											//dd($arr_img_pdf_txt);

											//dd($dpath);




$parent_details = $this->Category_model->getCategory_name($parent_id_tree);

$parent_delete_status=$parent_details[0]->delete_status;



	if(!empty($arr_img_pdf_txt)  )

											{

												if($parent_delete_status==0){

	foreach ($arr_img_pdf_txt as $varData)  	{
// print_r($_SESSION['destination_last_id']);
// echo '='.$varData->cat_id;
// print_r($this->session->userdata('destination_ids'));



           if($varData->rename_file!=''){
                      $file_name=$varData->rename_file;
                    }else{
                      $file_name=$varData->image;
                    }
                    
                      $custom_text=$varData->custom_text;
               
$file_url_array=explode('/', $varData->file_path);



if(count($file_url_array)<=2){
  $file_delete_option_class="file_delete_option_2";
}else{
  $file_delete_option_class="file_delete_option_3";
}


												if($varData->delete_status==1){
													$color='color:red;';
												}else{
													$color='color:#555;';
												}

											$ext = pathinfo($varData->image, PATHINFO_EXTENSION);

											?>

<div style="border-bottom: 1px solid; display:none;" id="header_row_<?php echo $varData->id; ?>" class="file_delete_<?php echo $varData->id; ?> child_pdf_files" data-parent_id="<?php echo $varData->cat_id; ?>"> 

	<a style="<?php echo $color;?>" class="pdf_file_a" id="file_<?php echo $varData->id; ?>" <?php if($ext=="pdf" || $ext=="PDF"){ ?> href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($varData->id); ?>" <?php }else{ ?> href="<?php echo base_url().'/assets/uploads/Sheet-Music/'.$parent_url_file.'/'.$varData->image;?>" <?php } ?> target="_blank" data-parent_id="<?php echo $varData->cat_id; ?>">
	<img src="<?php if($ext=="pdf" || $ext=="PDF"){ echo IMAGE_PATH . "pdf.png"; }elseif($ext=="mp3" || $ext=="mp4"){ echo IMAGE_PATH . "music.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;">	<?php  echo $varData->image;?></a>




                            <a class="tooltip tooltip_a_<?php echo $varData->id;?>" <?php if($varData->keyword_text==''){ ?>style="visibility: hidden; " <?php } ?>>&nbsp;&nbsp; <i class="fas fa-info-circle" style="font-size: 20px; margin-top: 3px;"></i><span class="tooltiptext tooltip_a_span_<?php echo $varData->id;?>"><?php echo $varData->keyword_text; ?></span></a> 
                            




											<?php if($varData->delete_status==1){ ?>
        <div  class="naoTooltip-wrap naoTooltip_menu_tabs option_tab_menu naoTooltip_menu_tabs_child" id="naoTooltip_<?php echo $varData->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)" >
											    <p class="<?php if(trim($custom_text)==""){ echo "without_custom_text_on_file"; } echo $file_delete_option_class;?> file_delete_<?php echo $varData->id; ?>">Option</p> 
<?php if($this->session->userdata('admin_role_id')==1){ ?>
										 <div class="naoTooltip nt-left nt-small dd-handle naoTooltip_menu_tabs_child naoTooltip_show_<?php echo $varData->id;?>">
										                <div><a id="<?php echo $varData->id; ?>" href="javascript:void(0)" onclick="undo_delete_file(this.id,'<?php  echo $varData->image;?>')" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Undo Delete</a></div>
										               <div><a id="permanent_<?php echo $varData->id; ?>" href="javascript:void(0)"  onclick="permanent_delete_file(this.id,'<?php  echo $varData->image;?>')"  title="Permanent Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Permanent Delete</a></div>
										                </div>
<?php } ?>
							                </div>
                                  
							            <?php }else{?>
 <style type="text/css">
   .without_custom_text_file{margin-top: 7px!important;}
 </style>                           
			<div style="display:none;" class="naoTooltip-wrap naoTooltip_menu_tabs <?php if($custom_text=="" ){ ?> naoTooltip_menu_tabs_child <?php }else{ echo 'without_custom_text_file'; } ?> option_tab_menu" id="naoTooltip_<?php echo $varData->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)" >

											<p  class="<?php if(trim($custom_text)==""){ echo "without_custom_text_on_file"; } echo $file_delete_option_class;?> file_delete_<?php echo $varData->id; ?>">Option</p>

							<div class="naoTooltip nt-left nt-small dd-handle  naoTooltip_show_<?php echo $varData->id;?>">
												<?php /*
                        <div><a href="<?php echo site_url('admin/category/update/'.base64_encode($varData->id)."/"."UpdateDocument"); ?>" title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Update File</a></div> <?php */ ?>
                    <?php if(regular_admin_permission('rename_file', $admin_role_id,$main_root_id)){ ?>
												<div><a href="<?php echo site_url('admin/category/rename_file/'.base64_encode($varData->id)."/".$redirect_type."/file"); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename File</a></div>
                        <?php } ?> 
                        <div><a href="<?php echo site_url('admin_categories/replace_file_content/'.base64_encode($varData->id)."/".$redirect_type."/file"); ?>" title="Replace File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Replace File</a></div>
<?php if($this->session->userdata('admin_role_id')==1){ ?>
												<div><a id="<?php echo $varData->id; ?>" class="delete" href="javascript:void(0)"  onclick='delete_file(this.id,"<?php  echo $varData->image;?>")' title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Delete File</a></div> 
											<?php } ?>
                    <?php if(regular_admin_permission('move_file', $admin_role_id,$main_root_id)){ ?>
							                <div><a href="<?php echo site_url('admin_categories/move_file/'.base64_encode($varData->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Move File</a></div>
                            <?php } ?>
                    <?php if(regular_admin_permission('copy_file', $admin_role_id,$main_root_id)){ ?>
							                <div><a href="<?php echo site_url('admin_categories/copy_file/'.base64_encode($varData->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy File</a></div>
                            <?php } ?>
						 <div><a href="javascript:void(0)" class="custom_text" data-offerid="<?php echo $custom_text; ?>" data-folder_id="<?php echo $varData->id; ?>" title="file"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Update CustomText</a></div>
						 <div><a href="javascript:void(0)" class="keyword_text" data-offerid="<?php echo $keyword_text; ?>" data-folder_id="<?php echo $varData->id; ?>" title="file"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Edit Keyword</a></div>	            
             <?php /*
												<div><a href="#" title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage Custom Text</a></div> 
												<div><a href="#" title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Keyword</a></div> 
												<div><a href="#" title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Title Note</a></div> 
												<?php */ ?>

												

												</div>

							                </div>

                         <?php if($custom_text!="" ){ ?>
                          <br/>
                         <span class="custom_text_p file_cutomtxt" id="update_custom_text_<?php echo $varData->id; ?>" style="display: initial;"><?php echo $custom_text; ?></span>
                            <?php }else{ ?>
                            
                            <span class="custom_text_p file_cutomtxt" id="update_custom_text_<?php echo $varData->id; ?>" ></span>
                            <?php } ?>     

                     <?php }    ?>

							                </div>

							               

											

											<?php 


if($_SESSION['destination_last_id']==$varData->cat_id){
  $empty_array=0;
  $_SESSION['destination_last_id']=$empty_array;
     $this->session->set_userdata('destination_ids',$empty_array);

}

                       }

											}else{ echo '<p style="color: red;">Data temporary deteled.</p>';

											 }

											}

//*****************************Child tree end here**************************

//*****************************Child tree end here**************************

}elseif ($delete_html[0]==1) { 
///***********this condition will work when user click on 'Delete temprary'/////OR//// click on delete button

$secondLevel->id=$parent_id_tree;



	?>




<?php if($type=='folder'){ ?>
<div><a id="<?php echo $secondLevel->id; ?>" href="javascript:void(0)" onclick='undo_delete_category(this.id,"<?php echo $html_name->name; ?>")' title="Undo Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Undo Delete</a></div>
<?php if($this->session->userdata('admin_role_id')==1){ ?>
<div><a id="permanent_<?php echo $secondLevel->id; ?>" href="javascript:void(0)"  onclick='permanent_delete_category(this.id,"<?php echo $html_name->name; ?>")'  title="Permanent Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Permanent Delete</a></div>
<?php } ?>

<?php }else{ ?>
<div><a id="<?php echo $secondLevel->id; ?>" href="javascript:void(0)" onclick='undo_delete_file(this.id,"<?php echo $html_name->image; ?>")' title="Undo Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Undo Delete</a></div>
<?php if($this->session->userdata('admin_role_id')==1){ ?>
<div><a id="permanent_<?php echo $secondLevel->id; ?>" href="javascript:void(0)"  onclick='permanent_delete_file(this.id,"<?php echo $html_name->image; ?>")'  title="Permanent Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Permanent Delete</a></div>
<?php } ?>
<?php } ?>






<?php }elseif ($delete_html[0]==2) { 
///***********this condition will work when user click on 'undo delete file'/////OR//// click on undo delete button
$secondLevel=$this->Category_model->getRecordById($parent_id_tree);



	?>


                 <?php if($type=='file'){ ?>
                  <div><a href="<?php echo site_url('admin/category/update/'.base64_encode($secondLevel->id)."/"."UpdateDocument"); ?>" title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Update File</a></div>
												<div><a href="<?php echo site_url('admin/category/rename_file/'.base64_encode($secondLevel->id)."/".$redirect_type."/file"); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename File</a></div> 
                        <div><a href="<?php echo site_url('admin_categories/replace_file_content/'.base64_encode($secondLevel->id)."/".$redirect_type."/file"); ?>" title="Replace File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Replace File</a></div>
                    <?php if(in_array('delete', $this->session->userdata('userRole_data'))){ ?>
												<div><a id="<?php echo $secondLevel->id; ?>" class="delete" href="javascript:void(0)"  onclick='delete_file(this.id,"<?php echo $html_name->image; ?>")' title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Delete File</a></div> 
											<?php } ?>
							<?php /*if(in_array('copy', $this->session->userdata('userRole_data'))){ ?>
							                <div><a href="<?php echo site_url('admin_categories/move_file/'.base64_encode($secondLevel->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Move File</a></div>
							            <?php } ?>
							<?php if(in_array('copy', $this->session->userdata('userRole_data'))){ ?>
							                <div><a href="<?php echo site_url('admin_categories/copy_file/'.base64_encode($secondLevel->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy File</a></div>
							            <?php } */?> 
							 <div><a href="javascript:void(0)" class="custom_text" data-offerid="<?php echo $custom_text; ?>" data-folder_id="<?php echo $varData->id; ?>" title="file"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Update CustomText</a></div> 
							 <div><a href="javascript:void(0)" class="keyword_text" data-offerid="<?php echo $keyword_text; ?>" data-folder_id="<?php echo $varData->id; ?>" title="file"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Edit Keyword</a></div>          

												<?php /*
												<div><a href="#" title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage Custom Text</a></div> 
												<div><a href="#" title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Keyword</a></div> 
												<div><a href="#" title="Update File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Title Note</a></div> 
												<?php */ ?>
                  

                <?php }else{ ?>

                    <?php if(in_array('add', $this->session->userdata('userRole_data'))){ ?>
               <div><a href="<?php echo base_url('admin_categories/bookmark_individual_user/').base64_encode($secondLevel->id).'/'.$redirect_type; ?>" title="New Folder" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp;Bookmark to individual user</a></div>
               <!-- <div><a href="<?php echo base_url('admin_categories/add_search_keyword/').$redirect_type.'/'.base64_encode($secondLevel->id); ?>" title="New Folder" style="text-align: left;"><i class="fa fa-search"></i>&nbsp;&nbsp;Search Keyword</a></div> -->
               <div><a href="<?php echo base_url('admin_banner/edit/'.base64_encode($secondLevel->folder_user_id).'/').$redirect_type.'/'.base64_encode($secondLevel->id); ?>" title="New Folder" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp;Edit/Delete program notes</a></div>
               <div><a href="<?php echo base_url('admin_categories/add_save_directory/').$redirect_type.'/'.base64_encode($secondLevel->id); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add folder content</a></div>

				<div><a href="<?php echo site_url('admin_categories/addSubDir/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; New folder</a></div>

                <div><a href="<?php echo site_url('admin_categories/add_edit_folder_content/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Upload Folder</a></div>
                
                    <div><a href="<?php echo site_url('admin_categories/add_edit_file_content/'.base64_encode($secondLevel->id)."/".$redirect_type); ?>" title="Upload File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Upload File</a></div>

            <?php } ?>
                    

                    <?php if(in_array('move', $this->session->userdata('userRole_data'))){ ?>
                <div><a href="<?php echo site_url('admin/category/move_directory/'.base64_encode($secondLevel->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
                   <?php } ?>
                <div><a href="javascript:void(0)" title="folder" class="rename_folder" data-offerid="<?php echo $folder_name; ?>" data-folder_id="<?php echo $secondLevel->id;?>" data-parent_id="<?php echo $secondLevel->cat_id;?>"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 

<?php if($this->session->userdata('admin_role_id')==1){ ?>

                <div><a id="<?php echo $secondLevel->id; ?>" class="delete" href="javascript:void(0)"  onclick='delete_category(this.id,"<?php echo $html_name->name; ?>")'  title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>

            <?php } ?>
                    <?php if(in_array('copy', $this->session->userdata('userRole_data'))){ ?>
                <div><a href="<?php echo site_url('admin/category/copy_directory/'.base64_encode($secondLevel->id)."/"."AddDocument"."/".$redirect_type); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
            <?php } ?>

                <div><a href="javascript:void(0)" class="custom_text" data-offerid="<?php echo $custom_text; ?>" data-folder_id="<?php echo $secondLevel->id; ?>" title="folder"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Update CustomText</a></div>
                    
                <div><a href="javascript:void(0)" class="keyword_text" data-offerid="<?php echo $keyword_text; ?>" data-folder_id="<?php echo $secondLevel->id; ?>" title="folder"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Edit Keyword</a></div>
               <div><a href="<?php echo base_url();?>admin_seo_management/edit/<?php echo base64_encode($secondLevel->id).'/'.$redirect_type; ?>" ><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Edit Seo Meta</a></div>

            <?php } ?>




<?php } ?>											







										

											