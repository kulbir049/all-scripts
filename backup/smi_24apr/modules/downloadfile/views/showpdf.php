<?php
require('rotation.php');
class PDF extends PDF_Rotate
{
function Header()
{
    //Put the watermark
    $this->SetFont('helvetica','B',50);
    $this->SetTextColor(82,86,89);
    $this->RotatedText(35,190,"lorem ipsum",45);
}

function RotatedText($x, $y, $txt, $angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}
}


//foreach ($arr_img_pdf_txt as $varImage) 
//{
	//dd($arr_img_pdf_txt);
	//die;

	 $path = FCPATH . "assets/uploads/Sheet-Music/$dpath/" . $arr_img_pdf_txt->image; 
	 $path_new = FCPATH . "assets/uploads/Sheet-Music/$dpath/" . $arr_img_pdf_txt->image;
	$dppath =  base_url() . "assets/uploads/Sheet-Music/$dpath/" . $arr_img_pdf_txt->image;
	$dloc = FCPATH . "assets/uploads/Sheet-Music/$dpath/";
         $download_file_file = '/assets/uploads/Sheet-Music/'.$dpath.'/';
   
			$ext = pathinfo($arr_img_pdf_txt->image, PATHINFO_EXTENSION);
			$ext=strtolower($ext);
			
// 			echo var_dump(file_exists($path));
// 			echo $path;
// 			echo "<pre>";print_r($arr_img_pdf_txt);die;
    ?>

	<?php if (file_exists($path) && ($arr_img_pdf_txt->image)) {

		if($ext=='mp3' || $ext=='mp4' || $ext=='wav'){ ?>
        <iframe 
  src = "<?php echo $path_new;?>?autoplay=1&loop=1&autopause=0" width="100%" height="100%" frameborder=“0” allowfullscreen allow=autoplay/>
        	<!--<video  id="automusicPlay_id" autoplay="true" width="100%" height="100%" controls><source src="<?php echo $path_new;?>" ></video>-->
         	
		<?php }else{
		//@readfile($path);
			if($ext=='txt'){
			show_source($path);
				}elseif($ext=='doc'){
					?>
				    <a   href="<?php echo base_url().$download_file_file.$arr_img_pdf_txt->image;?>" download><button id="autodownload" type="button"><span style="display:none;">Download</span></button></a>
				    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				    <script type="text/javascript">
						  $('#autodownload').trigger('click');
						  setTimeout(function(){ window.top.close(); }, 1000);

						  

				    </script>
					<?php
				    }elseif($ext=='PDF' || $ext=='pdf'){
				        
				        //echo $path;die;
				    header("Content-type: application/".$ext);
		            header("Content-Disposition: inline; filename=".$arr_img_pdf_txt->image);	
				   @readfile($path);
					}
				else if($ext=='XML' || $ext=='xml'){
				    header("Content-type: application/".$ext);
				    @readfile($path);
				}
				else if($ext=="png" || $ext=="jpg" || $ext=="jpeg" || $ext=="gif" ||$ext=="bmp" || $ext=="webp"){
				    $path = $path_new;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
				    echo "<img src='".$base64."' style='max-width: 100%;'>";
				    
				}
					else{
					  //  echo $ext;die;
					 // echo $path;die;  
				   @readfile($path);
					}
			//$file_rad = fopen($path,"r");
				// echo fgets($file_rad);
				// fclose($file_rad);

				// $handle = fopen($path, "r") or die("Couldn't get handle");
				// 		if ($handle) {
				// 		    while (!feof($handle)) {
				// 		        echo $buffer = fgets($handle, 4096);
				// 		        // Process buffer here..
				// 		    }
				// 		    fclose($handle);
				// 		}
				 	
		}
	}else{
		echo "<p style='text-align:center;padding: 34px;'>File does not exist!</p>";
	} 
//}

?>