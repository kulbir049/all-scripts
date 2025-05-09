
    <!--========================== Start Composer profile =======================-->



     <div class="row" style="margin: 0 0 0 0;">



         <div class="container">

            <h2 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 30px;">Sheet Music of  <?php echo $detail['name']; ?></h2>

            <div class="row">

                 <div class="col-md-4 col-xs-12">

                     <div class="detail2">
<?php if($detail['image']!=''){ ?>
                         <img src="<?php echo base_url(); ?>assets/uploads/ComposerProfileImages/<?php echo $detail['image']; ?>" class="img-responsive">
                       <?php }else{ ?>
                         <img src="<?php echo base_url(); ?>images/demo_profile.jpg" class="img-responsive">
                       <?php } ?>
                         <!-- <img src="<?php echo $detail['image']; ?>"> -->

                     </div>

                 </div>

                 <div class="col-md-8 col-xs-12">

                     <div class="detail">

                         <div class="borde">

                             
                             <?php echo $detail['description']; ?>

                             
                           <!--   <a href="#">Read more...</a> -->

                         </div>

                     </div>

                 </div>

             </div>

         </div>

     </div>

<!--========================== Start personal liberary =======================-->
<?php 
//dd($objTree);
//$array_list_full = json_decode(json_encode($objTree), True);
//$array_list = $array_list_full['arrChilds']; 
$array_list = $objTree;
// dd($array_list); 
// die(); 
?>



<div class="row" style="margin: 0 0 0 0;">
  <div class="container">
   <!--  <h2 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 30px;">Shared Documents</h2> -->
    <div id="MyNewTabs" class="tabs-container">
        <br><br>
        <ul class="tabs-content">
            <!---------------------------->
<!--========================== master tabs =======================-->      
      <div id="demo_wrap">
        <div class="accordion-group" data-behavior="accordion">
          <?php
          if (isset($array_list) && !empty($array_list)) 
          {
            //dd($array_list);
            //die;
          ?>
            <p class="accordion-header"><?php echo $array_list->name; ?>&nbsp;&nbsp; 

              <a href="https://www.youtube.com/results?search_query=<?php echo $array_list->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $array_list->name."+".$array_list->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
            <?php if($array_list->custom_text!="" )
            {
            ?>
            <a class="tooltip">&nbsp;&nbsp; <i class="fas fa-info-circle" style="font-size: 20px;"></i>
                        <span class="tooltiptext"><?php echo $array_list->custom_text; ?></span>
            </a>
            <?php
            } 
            ?>
            
              
              <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($array_list->id); ?>"><i class="fas fa-envelope masenv"></i></a>
              <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($array_list->id); ?>" style="z-index: 999999;"><i class="fas fa-share-alt masshar resetInput"></i></a>
              <!-- <a href="<?php echo site_url(); ?>composerprofile"><i class="far fa-id-card masdel"></i></a> -->
              <a href="<?php echo site_url('composerprofile/cid/'.base64_encode($array_list->id)); ?>"><i class="<?php if($array_list->parent_id=="1") {echo "far fa-id-card masdel";}else{ echo "far fa-bookmark masdel";} ?>"></i></a>
              <!-- onclick="window.location='<?php //echo site_url("sales/viewlead/".base64_encode($fetch_ld->id));?>'" -->

            </p>
            <?php
            $CI = & get_instance();
            $CI->load->model('admin_categories/Category_model');
            $arr_data = $CI->Category_model->getCategorybycomposerid($array_list->id);
            //dd($arr_data);
            //die;
            ?>
            <!---start secondLevel loop-->
            <?php if(isset($arr_data) && !empty($arr_data)) 
            {
            ?>
            <div class="accordion-body">
              <div class="accordion-group" data-behavior="accordion" data-multiple="true">
            <?php
            foreach($arr_data as $secondLevel) 
              {
              ?>
              
              <p class="accordion-header" style="margin-right: -19px;"><?php echo $secondLevel->name; ?>&nbsp;&nbsp; 
              <a href="https://www.youtube.com/results?search_query=<?php echo $secondLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $secondLevel->name."+".$secondLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
              <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($secondLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
              <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($secondLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
              <a href="#"><i class="far fa-bookmark masdel"></i></a>
              </p>    
              <?php
              $CI = & get_instance();
              $CI->load->model('admin_categories/Category_model');
              $arr_data = $CI->Category_model->getCategorybycomposerid($secondLevel->id);
              //dd($arr_data);
              //die;
              ?>
              <!---start thirdLevel loop-->
              <?php if(isset($arr_data) && !empty($arr_data)) 
              {
              ?>  
              <div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">  
              <?php 
                foreach($arr_data as $thirdLevel) 
                {
              ?>
                <p class="accordion-header" style="margin-right: -40px;"><?php echo $thirdLevel->name; ?>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $thirdLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $thirdLevel->name."+".$thirdLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
                <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($thirdLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
                <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($thirdLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
                <a href="#"><i class="far fa-bookmark masdel"></i></a>
                </p>
                <?php
                $CI = & get_instance();
                $CI->load->model('admin_categories/Category_model');
                $arr_data = $CI->Category_model->getCategorybycomposerid($thirdLevel->id);
                ?>
                <!---start fourthLevel loop--->
                <?php if(isset($arr_data) && !empty($arr_data)) 
                {
                ?>  
                <div class="accordion-body">
                  <div class="accordion-group" data-behavior="accordion" data-multiple="true">  
                <?php 
                  foreach($arr_data as $fourthLevel) 
                  {
                ?>
                  <p class="accordion-header" style="margin-right: -40px;"><?php echo $fourthLevel->name; ?>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $fourthLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $fourthLevel->name."+".$fourthLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
                  <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($fourthLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
                  <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($fourthLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
                  <a href="#"><i class="far fa-bookmark masdel"></i></a>
                  </p>
                  <?php
                  $CI = & get_instance();
                  $CI->load->model('admin_categories/Category_model');
                  $arr_data = $CI->Category_model->getCategorybycomposerid($fourthLevel->id);
                  ?>
                  <!---start fifthLevel loop--->
                  <?php if (isset($arr_data) && !empty($arr_data)) 
                  {
                  ?>  
                  <div class="accordion-body">
                    <div class="accordion-group" data-behavior="accordion" data-multiple="true">  
                  <?php 
                    foreach($arr_data as $fifthLevel) 
                    {
                  ?>
                    <p class="accordion-header" style="margin-right: -40px;"><?php echo $fifthLevel->name; ?>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $fifthLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $fifthLevel->name."+".$fifthLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
                    <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($fifthLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
                    <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($fifthLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
                    <a href="#"><i class="far fa-bookmark masdel"></i></a>
                    </p>
                    <?php
                    $CI = & get_instance();
                    $CI->load->model('admin_categories/Category_model');
                    $arr_data = $CI->Category_model->getCategorybycomposerid($fifthLevel->id);
                    ?>
                    <!---start sixthLevel loop--->
                    <?php if (isset($arr_data) && !empty($arr_data)) 
                    {
                    ?>  
                    <div class="accordion-body">
                      <div class="accordion-group" data-behavior="accordion" data-multiple="true">  
                    <?php 
                      foreach($arr_data as $sixthLevel) 
                      {
                    ?>
                      <p class="accordion-header" style="margin-right: -40px;"><?php echo $sixthLevel->name; ?>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $sixthLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $sixthLevel->name."+".$sixthLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
                      <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($sixthLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
                      <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($sixthLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
                      <a href="#"><i class="far fa-bookmark masdel"></i></a>
                      </p>
                      <?php
                      $CI = & get_instance();
                      $CI->load->model('admin_categories/Category_model');
                      $arr_data = $CI->Category_model->getCategorybycomposerid($sixthLevel->id);
                      ?>
                      <!---start seventhLevel loop--->
                      <?php if (isset($arr_data) && !empty($arr_data)) 
                      {
                      ?>  
                      <div class="accordion-body">
                        <div class="accordion-group" data-behavior="accordion" data-multiple="true">  
                      <?php 
                        foreach($arr_data as $seventhLevel) 
                        {
                      ?>
                        <p class="accordion-header" style="margin-right: -40px;"><?php echo $seventhLevel->name; ?>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $seventhLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $seventhLevel->name."+".$seventhLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
                        <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($seventhLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
                        <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($seventhLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
                        <a href="#"><i class="far fa-bookmark masdel"></i></a>
                        </p>
                        <?php
                        $CI = & get_instance();
                        $CI->load->model('admin_categories/Category_model');
                        $arr_data = $CI->Category_model->getCategorybycomposerid($seventhLevel->id);
                        ?>
                        <!---start eighthLevel loop--->
                        <?php if(isset($arr_data) && !empty($arr_data)) 
                        {
                        ?>  
                        <div class="accordion-body">
                          <div class="accordion-group" data-behavior="accordion" data-multiple="true">  
                        <?php 
                          foreach($arr_data as $eighthLevel) 
                          {
                        ?>
                          <p class="accordion-header" style="margin-right: -40px;"><?php echo $eighthLevel->name; ?>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $eighthLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $eighthLevel->name."+".$eighthLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
                          <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($eighthLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
                          <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($eighthLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
                          <a href="#"><i class="far fa-bookmark masdel"></i></a>
                          </p>
                          <?php
                          $CI = & get_instance();
                          $CI->load->model('admin_categories/Category_model');
                          $arr_data = $CI->Category_model->getCategorybycomposerid($eighthLevel->id);
                          ?>
                          <!---start ninthLevel loop--->
                          <?php if (isset($arr_data) && !empty($arr_data)) 
                          {
                          ?>  
                          <div class="accordion-body">
                            <div class="accordion-group" data-behavior="accordion" data-multiple="true">  
                          <?php 
                            foreach($arr_data as $ninthLevel) 
                            {
                          ?>
                            <p class="accordion-header" style="margin-right: -40px;"><?php echo $ninthLevel->name; ?>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $ninthLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $ninthLevel->name."+".$ninthLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
                            <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($ninthLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
                            <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($ninthLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
                            <a href="#"><i class="far fa-bookmark masdel"></i></a>
                            </p>
                            <?php 
                            $CI = & get_instance();
                            $CI->load->model('admin_categories/Category_model');
                            $arr_data = $CI->Category_model->getCategorybycomposerid($ninthLevel->id);
                            ?>
                            <!---start tenthLevel loop--->
                            <?php if (isset($arr_data) && !empty($arr_data)) 
                            {
                            ?>  
                            <div class="accordion-body">
                              <div class="accordion-group" data-behavior="accordion" data-multiple="true">  
                            <?php 
                              foreach($arr_data as $tenthLevel) 
                              {
                            ?>
                              <p class="accordion-header" style="margin-right: -40px;"><?php echo $tenthLevel->name; ?>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $tenthLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $tenthLevel->name."+".$tenthLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
                              <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($tenthLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
                              <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($tenthLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
                              <a href="#"><i class="far fa-bookmark masdel"></i></a>
                              </p>
                              <?php
                              $CI = & get_instance();
                              $CI->load->model('admin_categories/Category_model');
                              $arr_data = $CI->Category_model->getCategorybycomposerid($tenthLevel->id);
                              ?>
                              <!---start eleventhLevel loop--->
                              <?php if (isset($arr_data) && !empty($arr_data)) 
                              {
                              ?>  
                              <div class="accordion-body">
                                <div class="accordion-group" data-behavior="accordion" data-multiple="true">  
                              <?php 
                                foreach($arr_data as $eleventhLevel) 
                                {
                              ?>
                                <p class="accordion-header" style="margin-right: -40px;"><?php echo $eleventhLevel->name; ?>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $eleventhLevel->name; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $eleventhLevel->name."+".$eleventhLevel->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url(); ?>assets/img/wikipedia.png" style="width: 2%;"></a>
                                <a href="mailto:?body=<?php echo base_url()."shared_documents/doc/".base64_encode($eleventhLevel->id); ?>"><i class="fas fa-envelope masenv"></i></a>
                                <a href="#myModal" data-toggle="modal" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($eleventhLevel->id); ?>"><i class="fas fa-share-alt masshar resetInput"></i></a>
                                <a href="#"><i class="far fa-bookmark masdel"></i></a>
                                </p>
                                <!---start twelfthlevel loop--->
                                
                                <!---end twelfthlevel loop--->
                              <?php
                                }
                              ?>
                              <!---start for pdf/txt display loop--->
                                  <?php
                                  $CI = & get_instance();
                                  $dpath = $this->Category_model->getRevArrayCatbyId($tenthLevel->id,$tenthLevel->parent_id);
                                  $arr_img_pdf_txt = $this->Category_model->getImagesById($tenthLevel->id);
                                  //dd($arr_img_pdf_txt);
                                  //dd($dpath);
                                  foreach ($arr_img_pdf_txt as $varData) 
                                  {
                                  $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                                  ?>
                                  <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
                                  <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                                  <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($tenthLevel->id)."_".base64_encode($tenthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                                  <?php } else { ?>
                                  <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($tenthLevel->id)."_".base64_encode($tenthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                                  <?php } ?></a>
                                  <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                                  <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                                  <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                                  </div>
                                  <?php 
                                  }
                                  ?>
                                  <!---end for pdf/txt display loop--->
                                </div>
                              </div>
                              <?php
                              }
                              ?>
                              <!---end eleventhLevel loop--->
                            <?php
                              }
                            ?>
                              <!---start for pdf/txt display loop--->
                                <?php
                                $CI = & get_instance();
                                $dpath = $this->Category_model->getRevArrayCatbyId($ninthLevel->id,$ninthLevel->parent_id);
                                $arr_img_pdf_txt = $this->Category_model->getImagesById($ninthLevel->id);
                                //dd($arr_img_pdf_txt);
                                //dd($dpath);
                                foreach ($arr_img_pdf_txt as $varData) 
                                {
                                $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                                ?>
                                <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
                                <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                                <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($ninthLevel->id)."_".base64_encode($ninthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                                <?php } else { ?>
                                <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($ninthLevel->id)."_".base64_encode($ninthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                                <?php } ?></a>
                                <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                                <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                                <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                                </div>
                                <?php 
                                }
                                ?>
                                <!---end for pdf/txt display loop--->
                              </div>
                            </div>
                            <?php
                            }
                            ?>
                            <!---end tenthLevel loop--->
                          <?php
                            }
                          ?>
                          <!---start for pdf/txt display loop--->
                              <?php
                              $CI = & get_instance();
                              $dpath = $this->Category_model->getRevArrayCatbyId($eighthLevel->id,$eighthLevel->parent_id);
                              $arr_img_pdf_txt = $this->Category_model->getImagesById($eighthLevel->id);
                              //dd($arr_img_pdf_txt);
                              //dd($dpath);
                              foreach ($arr_img_pdf_txt as $varData) 
                              {
                              $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                              ?>
                              <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
                              <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                              <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($eighthLevel->id)."_".base64_encode($eighthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                              <?php } else { ?>
                              <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($eighthLevel->id)."_".base64_encode($eighthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                              <?php } ?></a>
                              <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                              <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                              <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                              </div>
                              <?php 
                              }
                              ?>
                              <!---end for pdf/txt display loop--->
                            </div>
                          </div>
                          <?php
                          }
                          ?>
                          <!---end ninthLevel loop--->
                        <?php
                          }
                        ?>
                        <!---start for pdf/txt display loop--->
                            <?php
                            $CI = & get_instance();
                            $dpath = $this->Category_model->getRevArrayCatbyId($seventhLevel->id,$seventhLevel->parent_id);
                            $arr_img_pdf_txt = $this->Category_model->getImagesById($seventhLevel->id);
                            //dd($arr_img_pdf_txt);
                            //dd($dpath);
                            foreach ($arr_img_pdf_txt as $varData) 
                            {
                            $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                            ?>
                            <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
                            <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                            <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($seventhLevel->id)."_".base64_encode($seventhLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                            <?php } else { ?>
                            <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($seventhLevel->id)."_".base64_encode($seventhLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                            <?php } ?></a>
                            <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                            <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                            <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                            </div>
                            <?php 
                            }
                            ?>
                            <!---end for pdf/txt display loop--->
                          </div>
                        </div>
                        <?php
                        }
                        ?>
                        <!---end eighthLevel loop--->
                      <?php
                        }
                      ?>
                      <!---start for pdf/txt display loop--->
                          <?php
                          $CI = & get_instance();
                          $dpath = $this->Category_model->getRevArrayCatbyId($sixthLevel->id,$sixthLevel->parent_id);
                          $arr_img_pdf_txt = $this->Category_model->getImagesById($sixthLevel->id);
                          //dd($arr_img_pdf_txt);
                          //dd($dpath);
                          foreach ($arr_img_pdf_txt as $varData) 
                          {
                          $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                          ?>
                          <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 

                          <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                          <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($sixthLevel->id)."_".base64_encode($sixthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                          <?php } else { ?>
                          <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($sixthLevel->id)."_".base64_encode($sixthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                          <?php } ?></a>
                          <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                          <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                          <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                          </div>
                          <?php 
                          }
                          ?>
                          <!---end for pdf/txt display loop--->
                        </div>
                      </div>
                      <?php
                      }
                      ?>
                      <!---end seventhLevel loop--->
                    <?php
                      }
                    ?>
                    <!---start for pdf/txt display loop--->
                        <?php
                        $CI = & get_instance();
                        $dpath = $this->Category_model->getRevArrayCatbyId($fifthLevel->id,$fifthLevel->parent_id);
                        $arr_img_pdf_txt = $this->Category_model->getImagesById($fifthLevel->id);
                        //dd($arr_img_pdf_txt);
                        //dd($dpath);
                        foreach ($arr_img_pdf_txt as $varData) 
                        {
                        $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                        ?>
                        <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
                        <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                        <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($fifthLevel->id)."_".base64_encode($fifthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                        <?php } else { ?>
                        <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($fifthLevel->id)."_".base64_encode($fifthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                        <?php } ?></a>
                        <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                        <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                        <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                        </div>
                        <?php 
                        }
                        ?>
                        <!---end for pdf/txt display loop--->
                      </div>
                    </div>
                    <?php
                    }
                    ?>
                    <!---end sixthLevel loop--->
                  <?php
                    }
                  ?>
                  <!---start for pdf/txt display loop--->
                      <?php
                      $CI = & get_instance();
                      $dpath = $this->Category_model->getRevArrayCatbyId($fourthLevel->id,$fourthLevel->parent_id);
                      $arr_img_pdf_txt = $this->Category_model->getImagesById($fourthLevel->id);
                      //dd($arr_img_pdf_txt);
                      //dd($dpath);
                      foreach ($arr_img_pdf_txt as $varData) 
                      {
                      $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                      ?>
                      <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
                     <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                      <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($fourthLevel->id)."_".base64_encode($fourthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                      <?php } else { ?>
                      <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($fourthLevel->id)."_".base64_encode($fourthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                      <?php } ?></a>
                      <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                      <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                      <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                      </div>
                      <?php 
                      }
                      ?>
                      <!---end for pdf/txt display loop--->
                    </div>
                  </div>
                  <?php
                  }
                  ?>
                  <!---end fifthLevel loop--->
                <?php
                  }
                ?>
                <!---start for pdf/txt display loop--->
                    <?php
                    $CI = & get_instance();
                    //echo $thirdLevel->id;die;
                    //echo $thirdLevel->parent_id;
                    $dpath = $this->Category_model->getRevArrayCatbyId($thirdLevel->id,$thirdLevel->parent_id);
                    $arr_img_pdf_txt = $this->Category_model->getImagesById($thirdLevel->id);
                    //dd($arr_img_pdf_txt);
                    //dd($dpath);
                    foreach ($arr_img_pdf_txt as $varData) 
                    {
                    $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                    ?>
                    <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
                  
                    <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                    <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($thirdLevel->id)."_".base64_encode($thirdLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                    <?php } else { ?>
                    <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($thirdLevel->id)."_".base64_encode($thirdLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                    <?php } ?></a>

                    <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                    <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                    <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                    </div>
                    <?php 
                    }
                    ?>
                    <!---end for pdf/txt display loop--->
                  </div>
                </div>
                <?php
                }
              ?>
                <!---end fourthLevel loop--->
              <?php
                }
              ?>
              <!---start for pdf/txt display loop--->
                  <?php
                  $CI = & get_instance();
                  $dpath = $this->Category_model->getRevArrayCatbyId($secondLevel->id,$secondLevel->parent_id);
                  $arr_img_pdf_txt = $this->Category_model->getImagesById($secondLevel->id);
                  //dd($arr_img_pdf_txt);
                  //dd($dpath);
                  foreach ($arr_img_pdf_txt as $varData) 
                  {
                  $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                  ?>
                  <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
                  
                  <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                  <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($secondLevel->id)."_".base64_encode($secondLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                  <?php } else { ?>
                  <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($secondLevel->id)."_".base64_encode($secondLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                  <?php } ?></a>
                  <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                  <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                  <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                  </div>
                  <?php 
                  }
                  ?>
                  <!---end for pdf/txt display loop--->
                </div>
              </div>
              <?php
              }
              ?>
              <!---end thirdLevel loop-->
              <?php
              }
            ?>
            <!---start for pdf/txt display loop--->
                <?php
                $CI = & get_instance();
                $dpath = $this->Category_model->getRevArrayCatbyId($array_list->id,$array_list->id->parent_id);
                $arr_img_pdf_txt = $this->Category_model->getImagesById($array_list->id);
                //dd($arr_img_pdf_txt); die();
                //dd($dpath);
                foreach ($arr_img_pdf_txt as $varData) 
                {
                $ext = pathinfo($varData->image, PATHINFO_EXTENSION);
                ?>
                <div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
                <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                <a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($array_list->id)."_".base64_encode($array_list->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                <?php } else { ?>
                <a href="<?php echo base_url()."downloadfile/find/"; ?><?php echo base64_encode($array_list->id)."_".base64_encode($array_list->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
                <?php } ?></a>


                <a href="#"><i class="fas fa-envelope pdfenv"></i></a>
                <a href="#myModal" data-toggle="modal"><i class="fas fa-share-alt pdfshar"></i></a>
                <a href="#"><i class="far fa-bookmark pdfdel"></i></a>
                </div>
                <?php 
                }
                ?>
                <!---end for pdf/txt display loop--->
              </div>
            </div>
            <?php
            }
            ?>
            <!---end secondLevel loop---->
          <?php
          }
          else
          {
            echo "Sorry, No Record Found!";
          }
          ?>
        </div>
      </div>

<!--========================== master tabs End =======================-->
      <!---------------------------->
        </ul>
    </div>
  </div>
</div>


     <!--========================== modal =======================-->
 
      
<div class="container">


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header" style="background-color: #666; height: 56px;">
    <h4 style=" color:#fff; font-size: 26px;">Please copy the below URL and share it as you want:</h4>
          <button type="button" class="close" data-dismiss="modal" style="padding: 6px 16px;">&times;</button>
         
        </div>
        <div class="modal-body" style="padding: 0rem">
          <form>
            <input type="text" class="form-control formData" name="link" placeholder="write your text" value="" style="height: 65px; border: none;">
          </form>
        </div>
        <div class="modal-footer" style="background-color: #666; height: 30px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


     <!--========================== modal end =======================-->







<!--========================== End personal liberary =======================-->
<!-- JS VENDOR -->
<script type="text/javascript">
   $(document).ready(function() {

       $("#MyNewTabs").minimalTabs();
   
       $("#TabTitleS1").click();

   
       $("#MyOldTabs").minimalTabs();
   
       $("#TabTitle3").click();
   
   
   
   });
   
</script>
<script type="text/javascript">
   $(function() {
   
       $('.selectpicker').selectpicker();
   
   });
   
</script>
<script type="text/javascript">
$(function() {
  $(".resetInput").on("click", function() {
    var nex = $(this).parent().attr('data-offerid');
    //alert(nex);
    $(".formData").val(nex);

  });

});
</script>
<script type="text/javascript">
   $( document ).ready(function() {
   $(".tog").click(function(){
   
   $('img',this).toggle();
   var nextSectionWithId = $(this).closest("div").nextAll("div[id]:first");
   if (nextSectionWithId) {
        var sectionId = nextSectionWithId.attr('id');
        //alert(sectionId);
        sectionId.toggle();
    }
  
   //alert(this.attr('id'));
   //$(this).removeClass('collapse');
   // $('.wk').show();
   
   });
   });
   
</script>
<script>
   // When the user scrolls down 20px from the top of the document, show the button
   
   window.onscroll = function() {scrollFunction()};
   
   
   
   function scrollFunction() {
   
     if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
   
       document.getElementById("myBtn").style.display = "block";
   
     } else {
   
       document.getElementById("myBtn").style.display = "none";
   
     }
   
   }
   
   
   
   // When the user clicks on the button, scroll to the top of the document
   
   function topFunction() {
   
     document.body.scrollTop = 0;
   
     document.documentElement.scrollTop = 0;
   
   }
   
</script>
<script>
function myFunction() {
  //window.location.href="https://www.youtube.com/results?search_query=++Collections-Bassoon";
  window.open(
  'https://www.youtube.com/results?search_query=++Collections-Bassoon',
  '_blank' // <- This is what makes it open in a new window.
);
}
</script>

 <script src="js/jquery.simpleaccordion.js"></script>
        <script>
            $(document).ready(function() {
                $('[data-behavior=accordion]').simpleAccordion({cbOpen:accOpen, cbClose:accClose});
            });


            function accClose(e, $this) {
                $this.find('span').fadeIn(200);
            }

            function accOpen(e, $this) {
                $this.find('span').fadeOut(200)
            }

        </script>