

<?php 
require_once('watermark/library/SetaPDF/Autoload.php');

function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}



foreach($objTree as $secondLevel){

$permision_logs_explode=explode('_', $permision_logs);


//********************insert data in personal library******************************

// if($secondLevel->p_id<1 && $secondLevel->created_status!=1){
//   if($secondLevel->temporary_lib>0){
//    $temporary_lib=$secondLevel->temporary_lib;
//   }else{
//   $temporary_lib=0; 
//   }
//   $save_data['cat_id']=$secondLevel->id;
//   $save_data['parent_id']=$secondLevel->parent_id;
//   $save_data['user_id']=$permision_logs_explode[2];
//   $save_data['rename_folder']=$secondLevel->name;
//   $save_data['temporary_lib']=$temporary_lib;
//   $save_data['personal_upload']=$secondLevel->public_personal;
//   $save_data['folder_path']=$this->Category_model->getDirNamesById($secondLevel->id);
//   if($secondLevel->name!=''){
//   $this->Personal_library_model->save_data_insert('personal_library',$save_data);
//   }
// }

//********************insert data in personal library end******************************

if($permision_logs_array[0]=='temporary'){
                  if($secondLevel->temp_rename_folder!='')
                        {
                          $folder_name=$secondLevel->temp_rename_folder;
                        }else{
                          $folder_name=$secondLevel->name;
                        }
}else{
               if($secondLevel->rename_folder!=''){
                     $folder_name=$secondLevel->rename_folder;
                    }else{
                      $folder_name=$secondLevel->name;
                    }
}


                    if($secondLevel->p_custom_text!=''){
                     $custom_text=$secondLevel->p_custom_text;
                    }else{
                      $custom_text=$secondLevel->custom_text;
                    }



$share_folder_url=base_url()."shared_documents/doc/".base64_encode($secondLevel->id);
	?>

<div class="accordion-header view_child_data option_folder_i" id="header_row_<?php echo $secondLevel->id;?>" >
<?php if($secondLevel->searchkeyword==1){ ?>
              <b  title="view data"  class="<?php if($secondLevel->searchkeyword==1){ echo 'view_child_data_search'; } ?>" id="<?php echo $secondLevel->id; ?>"><a href="<?php echo site_url('home/profile_details/'.$secondLevel->folder_user_id); ?>"> <?php echo $secondLevel->name; ?></a></b>
            <?php }else{ ?>
	<b  title="" onclick="view_child_data_function(this)" id="<?php echo $secondLevel->id;?>"><?php echo $folder_name; ?></b>
<?php } ?>

    &nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $secondLevel->name; ?>" target="_blank"><img src="<?php echo base_url();?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $secondLevel->name."+".$secondLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url();?>assets/img/wikipedia.png" style="width: 2%;"></a>
<?php if($secondLevel->keyword!="" ){ ?>
     <a class="tooltip">&nbsp;&nbsp; <i class="fas fa-info-circle" style="font-size: 20px; margin-top: 3px;"></i>
                        <span class="tooltiptext"><?php echo $secondLevel->keyword; ?></span></a> 
<?php } ?>
<?php if($custom_text!="" ){ ?>
 <br/> <b class="front_custom_text_b" ><?php echo $custom_text; ?></b>
              <?php }  ?>
  <div class="mail_share_book_icon">
	<a href="mailto:?subject=Sheet Music&subject=Sheet Music&body=To download <?php  echo $secondLevel->name;?> (composer, title, instrument)   click link below <?php echo $share_folder_url; ?>"><i class="fas fa-envelope masenv"></i></a>

	<a href="#" onclick="share_with_friends(this)" data-offerid="<?php echo $share_folder_url; ?>" data-toggle="modal" class="share_with_friends"><i class="fas fa-share-alt masshar resetInput"></i></a>

  <?php if($secondLevel->folder_user_id>0 && $secondLevel->searchkeyword==0){ ?>
    <a href="<?php echo site_url('home/profile_details/'.$secondLevel->folder_user_id); ?>"><i class="far fa-id-card masdel"></i></a>
  <?php } ?>
	<?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?><a href="javascript:void(0);" onclick="bookmark_footer_func('<?php echo $secondLevel->id;?>')"><i class="far fa-bookmark pdfdel"></i></a>

	<?php } else { ?>

	<a href="<?php echo base_url(); ?>login"><i class="far fa-bookmark pdfdel"></i></a>

	<?php } ?>
   </div>
</div>

                  


<div class="accordion-body">

                <div class="accordion-group child_data_<?php echo $secondLevel->id;?>" id="child_data_<?php echo $secondLevel->id;?>" data-behavior="accordion" data-multiple="true">

				                                          <div class="progress_bar_start_box">Processing...</div>


  </div>

</div>



   <?php } ?>             

   <?php         			
//$parent_details = $this->Category_model->getDirNamesById($parent_id_tree);
//echo $permision_logs;
					$permision_logs_array=explode('_', $permision_logs);

          										//$CI = & get_instance();
                        if($permision_logs!=''){
  $sharing_true=1;;
                            $arr_img_pdf_txt = $this->Shared_documents_model->getImagesById_share($parent_id_tree,$permision_logs,$sharing_true);
                         }else{
                              $arr_img_pdf_txt = $this->Category_model->getImagesById($parent_id_tree);
                            }

															//dd($arr_img_pdf_txt);

															//dd($dpath);
//echo count($arr_img_pdf_txt);die;
foreach ($arr_img_pdf_txt as $varData){
$share_file_url=base_url()."downloadfile/find/".base64_encode($varData->id);
$parent_details = $this->Category_model->getDirNamesById($varData->cat_id);


$file_path_size=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/Sheet-Music/'.$parent_details.'/'.$varData->image;
 

if(file_exists($file_path_size)){

//$version = pdfVersion($file_path_size);
//print_r($file_path_size);
	$ext = pathinfo($varData->image, PATHINFO_EXTENSION);

if(file_exists($file_path_size) && ($ext=="pdf" || $ext=="PDF")){

try {
      $document = SetaPDF_Core_Document::loadByFilename($file_path_size);
      $pages = $document->getCatalog()->getPages();
      $pageCount = floatval(trim($pages->count()));
} catch (Exception $e) {
    //echo 'This file is not repairable!';
}

}else{
	
$pageCount = 0;
}


//print_r($varData);

if($permision_logs_array[0]=='temporary'){
                if($varData->temp_rename_file!=''){
                      $file_name=$varData->temp_rename_file;
                  }elseif($varData->rename_file!=''){
                      $file_name=$varData->rename_file;
                    }else{
                      $file_name=$varData->image;
                    }
}else{
                  if($varData->p_rename_file!=''){
                      $file_name=$varData->p_rename_file;
                  }elseif($varData->rename_file!=''){
                      $file_name=$varData->rename_file;
                    }else{
                      $file_name=$varData->image;
                    }
     }               
                    if($varData->p_custom_text!=''){
                      $custom_text=$varData->p_custom_text;
                    }else{
                      $custom_text=$varData->custom_text;
                    }


	?>

	<div class="option_file_i" style="border-bottom: 1px solid #000;"> 

	<?php /*if ($this->session->userdata('user_id')) { ?>



	<a target="blank" href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($parent_id_tree)."_".base64_encode('1')."_".base64_encode($varData->id); ?>"><img src="<?php if($ext=="pdf" || $ext=="PDF"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" width="24" height="24"><?php  echo $varData->image;?> (<?php  echo formatSizeUnits(filesize($file_path_size));?>, <?php echo $pageCount . ' pages' ?>)</a>

	<?php } else { */ ?>

	<a target="blank" href="<?php echo $share_file_url; ?>"><img src="<?php if($ext=="pdf" || $ext=="PDF"){ echo IMAGE_PATH . "pdf.png"; }elseif($ext=="mp3" || $ext=="mp4"){ echo IMAGE_PATH . "music.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" width="24" height="24"><?php  echo $file_name;?> (<?php  echo formatSizeUnits(filesize($file_path_size));?>, <?php echo $pageCount . ' pages' ?>)</a>

	<?php // } ?>

	<a href="mailto:?subject=Sheet Music&body=To download <?php  echo $varData->image;?> (composer, title, instrument)   click link below <?php echo $share_file_url; ?>" target="_top"><i class="fas fa-envelope pdfenv"></i></a>
<?php if($ext!="pdf" && $ext!="PDF"){ ?>
  <a href="<?php echo base_url().'assets/uploads/Sheet-Music/'.$parent_details.'/'.$varData->image;?>" download><i class="fas fa-download download_icon"></i></a>
<?php } ?>
	<a href="#myModal" data-offerid="<?php echo $share_file_url; ?>" data-toggle="modal" class="share_with_friends"><i class="fas fa-share-alt  pdfshar resetInput"></i></a>
   
	<?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?><a href="javascript:void(0);"  onclick="bookmark_file_fun(this.id)" id="<?php echo $varData->id; ?>"><i class="far fa-bookmark pdfdel_file"></i></a>

		<?php } else { ?>

		<a href="<?php echo base_url(); ?>login"><i class="far fa-bookmark pdfdel_file"></i></a>

		<?php } ?>

	</div>

	<?php 

	}
	}

	?>

