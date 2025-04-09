<?php 
	 $path = FCPATH . "assets/uploads/Sheet-Music/$dpath/" . $arr_img_pdf_txt->image; 
	 $path_new = base_url() . "assets/uploads/Sheet-Music/$dpath/" . $arr_img_pdf_txt->image;
	$dppath =  base_url() . "assets/uploads/Sheet-Music/$dpath/" . $arr_img_pdf_txt->image;
	$dloc = FCPATH . "assets/uploads/Sheet-Music/$dpath/";
         $download_file_file = '/assets/uploads/Sheet-Music/'.$dpath.'/';
   
			$ext = pathinfo($arr_img_pdf_txt->image, PATHINFO_EXTENSION);


if($ext=='XML' || $ext=='xml'){
				    header("Content-type: text/".$ext);
				 //   die("gaurav");
				    @readfile($path);
				}