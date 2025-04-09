<?php 


if(isset($open_rep_file) && $open_rep_file=='yes'){
  $file_name_heeram=$arr_img_pdf_txt->image;
  $file_name=base64_encode($arr_img_pdf_txt->image);
  $file_path=base64_encode($dpath.'/'.base64_decode($file_name));
  $parent_name=base64_encode($dpath);
}else{

$parent_details = $this->Category_model->getDirNamesById($arr_img_pdf_txt->cat_id);

 //echo $parent_details.'/'.base64_decode($file_name);die;
 $file_name_heeram=base64_decode($file_name);
  $file_path=base64_encode($parent_details.'/'.base64_decode($file_name));

 //echo $parent_name;die;
}
?>

<?php
      $ext = pathinfo(base64_decode($file_name), PATHINFO_EXTENSION);

  $path = base_url() . "assets/uploads/Sheet-Music/".base64_decode($file_path); 
   
?>
<div class="text-center" style="margin:40px;">
    
  
    <h4><?= $file_name_heeram?></h4>
<audio controls>

  <source src="<?= $path?>" type="audio/mpeg">
  Your browser does not support the audio tag.
</audio>

</div>