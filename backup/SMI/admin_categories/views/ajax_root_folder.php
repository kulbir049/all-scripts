 <div class="accordion-group" data-behavior="accordion">
        <?php get_flashdata(); ?>

        <?php 


$admin_role_id=$this->session->userdata('admin_role_id');


        $array_list=$objTree;
        if (isset($array_list) && !empty($array_list) && is_array($array_list)) {
                 foreach ($array_list as $category) {

                  if($category->rename_folder!=''){
                      $folder_name=$category->rename_folder;
                    }else{
                      $folder_name=$category->name;
                    }
                    
                  

$custom_text=$category->custom_text;



                    if($category->parent_id == 1)
                        {
                            $class_comp='a-comp';
                            $main_root_id=1;
                         }else{
                            $class_comp='';
                              $main_root_id=$category->parent_id;
                         } 
$parent_url = $this->Category_model->getCategory_name($category->parent_id);
$genrate_url=$parent_url[0]->parent_url.'/'.$category->parent_url;
  $genrate_url_array=array_unique(array_filter(explode('/',$genrate_url)));

          ?>
             
<div class="accordion-header  view_child_data" id="header_row_<?php echo $category->id;?>">
  <input type="hidden" name="parent_url" id="parent_url_<?php echo $category->id;?>" value="<?php echo base64_encode( implode('/',$genrate_url_array));?>">                  

<!--****************************DELETED start here**************************-->
                <?php if($category->delete_status == 1) {?>
                <div class="child_folder_name" ><b class="<?php echo $class_comp;?> new_name_<?php echo $category->id;?>" onclick="view_child_data_function(this)" title="view data" id="<?php echo $category->id;?>" style="color:red;"><?php echo $folder_name; ?></b>

               
                          
                            <a class="tooltip tooltip_a_<?php echo $category->id;?>" <?php if($category->keyword=="" ){ ?> style="visibility: hidden;" <?php } ?>>&nbsp;&nbsp;  <i class="fas fa-info-circle" style="font-size: 20px; margin-top: 3px;"></i>
                        <span class="tooltiptext tooltip_a_span_<?php echo $category->id;?>"><?php echo $category->keyword; ?></span>
                       </a> 
                           

                                        
                
                <div class="naoTooltip-wrap" style="top:0px;" id="naoTooltip_<?php echo $category->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)">
                    <p class="folder_option_2">Option</p> 
                    
                    <div class="naoTooltip nt-left nt-small dd-handle naoTooltip_menu_tabs_child naoTooltip_show_<?php echo $category->id;?>" >
                    <?php if(in_array('delete', $this->session->userdata('userRole_data'))){ ?>
                    <div><a id="<?php echo $category->id; ?>" href="javascript:void(0)" onclick='undo_delete_category(this.id,"<?php echo $folder_name; ?>")' title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Undo Delete</a></div>
<?php if($this->session->userdata('admin_role_id')==1){ ?>
                     <div><a id="permanent_<?php echo $category->id; ?>" href="javascript:void(0)"  onclick='permanent_delete_category(this.id,"<?php echo $folder_name; ?>")'  title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Permanent Delete</a></div>
<?php } ?>                     
                    <?php } ?>
                    
                    </div>
                </div>
                <!-- <p class="custom_text" style="margin-left:25px;"><?php echo $category->custom_text; ?></p> -->
                </div>

<!--****************************DELETED end  here**************************-->
            <?php }else {?>
                    
             <div class="child_folder_name"><b class="<?php echo $class_comp;?> new_name_<?php echo $category->id;?> <?php if($category->searchkeyword==1){ echo 'view_child_data_search'; } ?>" onclick="view_child_data_function(this)" title="view data" id="<?php echo $category->id;?>"><?php echo $folder_name; ?></b>


                      <a class="tooltip tooltip_a_<?php echo $category->id;?>" <?php if($category->keyword=="" ){ ?> style="visibility: hidden;" <?php } ?>>&nbsp;&nbsp;  <i class="fas fa-info-circle" style="font-size: 20px; margin-top: 3px;"></i>
                        <span class="tooltiptext tooltip_a_span_<?php echo $category->id;?>"><?php echo $category->keyword; ?></span>
                       </a> 

            
                <div class="naoTooltip-wrap" style="top:0px;" id="naoTooltip_<?php echo $category->id;?>"  onmouseout="naoTooltip_hide(this.id)" onmouseover="naoTooltip_show(this.id)">
                  <p class="folder_option_2">Option</p>
                  <div class="naoTooltip nt-left nt-small dd-handle naoTooltip_show_<?php echo $category->id;?>">
                    
                    <?php if(regular_admin_permission('bookmark_individual_user', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo base_url('admin_categories/bookmark_individual_user/').base64_encode($category->id).'/'.$redirect_type; ?>" title="New Folder" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp;Bookmark to individual user</a></div>
                  <?php } ?>
                  
                    <?php if(regular_admin_permission('edit_program_note', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo base_url('admin_banner/edit/'.base64_encode($category->folder_user_id).'/').$redirect_type.'/'.base64_encode($category->id); ?>" title="New Folder" style="text-align: left;"><i class="far fa-id-card masdel"></i>&nbsp;&nbsp;Edit/Delete program notes</a></div>
                  <?php } ?>
                   <div><a href="<?php echo site_url('admin_categories/addSubDir/'.base64_encode($category->id)."/".$redirect_type); ?>/searchkeyword" title="New Folder" style="text-align: left;"><i class="fa fa-search"></i>&nbsp;&nbsp;Add Search folder</a></div> 

                    <?php if(regular_admin_permission('Add_folder_content', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo base_url('admin_categories/add_save_directory/').$redirect_type.'/'.base64_encode($category->id); ?>" title="New Folder" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add folder content</a></div>
                  <?php } ?>
                    <?php if(regular_admin_permission('create_folder', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo site_url('admin_categories/addSubDir/'.base64_encode($category->id)."/".$redirect_type); ?>" title="New Folder" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; New Folder</a></div>
                  <?php } ?>
                    <?php if(regular_admin_permission('upload_folder', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo site_url('admin_categories/add_edit_folder_content/'.base64_encode($category->id)."/".$redirect_type); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Upload Folder</a></div>
                  <?php } ?>
                    <?php if(regular_admin_permission('add_file', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo site_url('admin_categories/add_edit_file_content/'.base64_encode($category->id)."/".$redirect_type); ?>" title="Upload File"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Upload File</a></div>
                  <?php } ?>
                    


                    <?php if(regular_admin_permission('move_folder', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo site_url('admin/category/move_directory/'.base64_encode($category->id)."/".$redirect_type); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
                  <?php } ?>
                    <?php if(regular_admin_permission('rename_folder', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="javascript:void(0)" title="folder" class="rename_folder" data-offerid="<?php echo $folder_name; ?>" data-folder_id="<?php echo $category->id;?>"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div>
                    <?php } ?> 
                   
<?php if($this->session->userdata('admin_role_id')==1){ ?>
                    <div><a id="<?php echo $category->id; ?>" class="delete" href="javascript:void(0)"  onclick='delete_category(this.id,"<?php echo $folder_name; ?>")'  title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
 <?php } ?>

                    <?php if(regular_admin_permission('copy_folder', $admin_role_id,$main_root_id)){ ?>
                    <div><a href="<?php echo site_url('admin/category/copy_directory/'.base64_encode($category->id)."/".$redirect_type); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
                  <?php } ?>

                    <div><a href="javascript:void(0)" class="custom_text custom_text_<?php echo $category->id; ?>" data-offerid="<?php echo $custom_text; ?>" data-folder_id="<?php echo $category->id; ?>" title="folder"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Update CustomText</a></div>
                   
                    <?php /*if(in_array('edit', $this->session->userdata('userRole_data'))){ ?>
                    <div><a href="<?php echo site_url('admin/category/add_composer/'.base64_encode($category->id)."/".$redirect_type); ?>" title="Edit Composer"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
                      <?php } */?>
                      
                    <div><a href="javascript:void(0)" class="keyword_text" data-offerid="<?php echo $category->keyword; ?>" data-folder_id="<?php echo $category->id; ?>" title="folder"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Edit Keyword</a></div>
                      
                    <div><a href="<?php echo base_url();?>admin_seo_management/edit/<?php echo base64_encode($category->id).'/'.$redirect_type; ?>" ><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add/Edit Seo Meta</a></div>


                  </div>
                </div>
                            <p class="custom_text_p custom_text_font updated_custom_text_<?php echo $category->id;?>" id="update_custom_text_<?php echo $category->id; ?>"  <?php if($category->id==40567){ ?> style="color:red"<?php }?> ><?php echo $category->custom_text; ?></p>
                </div>
            <?php } ?>
</div>
              <div class="accordion-body">
                        <div class="accordion-group child_data_<?php echo $category->id;?>" id="child_data_<?php echo $category->id;?>" data-behavior="accordion" data-multiple="true">
                          <!--<img  class="loader_img" src="<?php echo base_url();?>/images/ajax-loader.gif" >-->
                          <div class="progress_bar_start_box">Processing...</div>
                                
                        </div>
                </div> 
        <?php if(in_array($category->id, $this->session->userdata('destination_ids'))){

if (($key_remove = array_search($category->id, $this->session->userdata('destination_ids'))) !== false) {
  $destination_ids_array=$this->session->userdata('destination_ids');
    unset($destination_ids_array[$key_remove]);
    $this->session->set_userdata('destination_ids',$destination_ids_array);
}

        ?>

          <script type="text/javascript">
            auto_click_destination_ids('<?php echo $category->id;?>');
            auto_scroll_destination_ids('<?php echo $category->id;?>');
          </script>
        
     <?php   }
      }//**********************FOReach end here
        }else{
          echo "No record found!";
        }
        ?>

</div>
