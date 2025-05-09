<?php

//echo $ip_address;
//die;

$ip = $this->input->ip_address();
//$ipen=base64_encode($ip);
if($this->session->userdata('language_code')){
    $ipen=base64_encode($this->session->userdata('language_code'));

}else{
    $ipen=base64_encode($ip);
}
//print_r($ipen);die('gg');
if(isset($open_rep_file) && $open_rep_file=='yes'){
  $file_name=base64_encode($arr_img_pdf_txt->image);

  $file_path=base64_encode($dpath.'/'.base64_decode($file_name));
  $parent_name=base64_encode($dpath);

}else{

$parent_details = $this->Category_model->getDirNamesById($arr_img_pdf_txt->cat_id);

 //echo $parent_details.'/'.base64_decode($file_name);die;
  $file_path=base64_encode($parent_details.'/'.base64_decode($file_name));


}
//echo $this->session->userdata('language');die('aa');


//$parent_name= base64_encode(translatetext(base64_decode($parent_name),$targetLanguage)) ;
//echo $parent_name_array=explode('/', base64_decode($parent_name));
//echo getTranslation("welcome to india",'tr');
//die;
?>
<style type="text/css">
.tooltip {
  position: relative;
  display: inline-block;
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


.download{
  width: 58%;
  display: block; 
  margin-left: auto; 
  margin-right: auto;
}
</style>
<div class="row" style="margin: 0 0 0 0;">
  <?php if($this->session->userdata('user_type')){ ?>
  <input type="hidden" name="plan_type" id="plan_type" value="<?php echo $this->session->userdata('user_type');?>">
<?php }else{ ?>
  <input type="hidden" name="plan_type" id="plan_type" value="">
<?php } ?>
<?php
      $ext = pathinfo(base64_decode($file_name), PATHINFO_EXTENSION);

  $path = FCPATH . "assets/uploads/Sheet-Music/".base64_decode($file_path); 
     if (file_exists($path)  && ($ext!='pdf' || $ext!='PDF')) {
    
        echo "<p style='text-align:center; color: #000;     padding-top: 100px; font-size: 25px;margin: auto;  width: 50%;'>File Downloading...!</p>";

      }
?>
     
<script type="text/javascript">

var plan_type=$('#plan_type').val();
var file_name='<?php echo $file_name;?>';
var ext='<?php echo $ext;?>';
//alert(plan_type);
<?php
  $expire_date=$this->session->userdata('expiry_date');

if(strtotime('now')>strtotime($expire_date) && $expire_date!='' && $this->session->userdata('user_type')==3){ 
 
    ?>
  var timeleft = 10;
var downloadTimer = setInterval(function(){
  document.getElementById("countdown").innerHTML = timeleft;
  timeleft -= 1;
  if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.getElementById("countdown").innerHTML = "1"
  }
}, 1000);
 setTimeout(function(){ 
      //window.location.href = "<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo $file_id."_1_".$id_internal; ?>";
      if(ext=='pdf' || ext=='PDF'){
    window.location.href = "<?php echo base_url('watermark/simple_pdf.php?file_path=').$file_path; ?>&parent_name=<?php echo $parent_name;?>&file_name=<?php echo $file_name;?>&ip=<?php echo $ipen; ?>";
     }else{ 
        window.location.href = "<?php echo base_url()."downloadfile/showpdffile/"; ?><?php echo $file_id; ?>";
      }
 }, 10000);
    <?php }else{?>
if(plan_type==2){
  var timeleft = 10;
var downloadTimer = setInterval(function(){
  document.getElementById("countdown").innerHTML = timeleft;
  timeleft -= 1;
  if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.getElementById("countdown").innerHTML = "1"
  }
}, 1000);
 setTimeout(function(){
     //const savedLanguage = sessionStorage.getItem('selectedLanguage');
    // alert(savedLanguage)
      //window.location.href = "<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo $file_id."_1_".$id_internal; ?>";
      if(ext=='pdf' || ext=='PDF'){
    window.location.href = "<?php echo base_url('watermark/simple_pdf.php?file_path=').$file_path; ?>&parent_name=<?php echo $parent_name;?>&file_name=<?php echo $file_name;?>&ip=<?php echo $ipen; ?>";
     }else{ 
        window.location.href = "<?php echo base_url()."downloadfile/showpdffile/"; ?><?php echo $file_id; ?>";
      }
 }, 10000);
}else if(plan_type=='' && file_name!=''){  //************if not login show watermark*************
      if(ext=='pdf' || ext=='PDF'){
    window.location.href = "<?php echo base_url('watermark/StampTextStyle.php?file_path=').$file_path; ?>&parent_name=<?php echo $parent_name;?>&file_name=<?php echo $file_name;?>&ip=<?php echo $ipen; ?>";
    }else{ 
        window.location.href = "<?php echo base_url()."downloadfile/showpdffile/"; ?><?php echo $file_id; ?>";
      }

}else if(file_name!=''){
        if(ext=='pdf' || ext=='PDF'){
    window.location.href = "<?php echo base_url('watermark/simple_pdf.php?file_path=').$file_path; ?>&parent_name=<?php echo $parent_name;?>&file_name=<?php echo $file_name;?>&ip=<?php echo $ipen; ?>";
    }else{ 
        window.location.href = "<?php echo base_url()."downloadfile/showpdffile/"; ?><?php echo $file_id; ?>";
      }

}
<?php }?>
</script>




	<div class="container">
		<div class="download">
      <?php if(count($arr_img_pdf_txt)==0){ ?>
    <p style="text-align:center; color: #000; margin-top: 40px; font-size: 25px;"><b>File not found</b></p>
    <?php }else{ ?>
		<p style="text-align:center; color: #000; margin-top: 40px; font-size: 25px;"><b>Your Download will Begin in <span id="countdown" style="color:red;font-weight:bold">10</span> seconds.</b></p>
		<p style="text-align:center; color: #000; font-size: 16px; ">Upgrade to Premium membership for immediate download and to remove this message.<br/> 
Please Join us in promoting this great music. Click here to upgrade</p>
		<p style="text-align:left; color: #000; font-size: 16px;">
		<b>Your Premium memberships goes toward:</b><br/>

      music scholarships to under privileged children.<br/>
      supports non profit performance organizations (like the Scottsdale Philharmonic)<br/>
      improving this library<br/>
      providing free classical sheet music world wide.<br/>
		</p>
  <?php } ?>
    </div>
	</div>
</div>
      

<script>
function myFunction() {
  //window.location.href="https://www.youtube.com/results?search_query=++Collections-Bassoon";
  window.open(
  'https://www.youtube.com/results?search_query=++Collections-Bassoon',
  '_blank' // <- This is what makes it open in a new window.
);
}





</script>

