<style type="text/css">
.tooltip {  position: relative;  display: inline-block!important;  opacity: 1!important;  z-index: 1000!important;}
.tooltip .tooltiptext {visibility: hidden;    width: 493px;    background-color: #555;    color: #fff;    text-align: center;    border-radius: 6px;    padding: 4px 8px;    position: absolute;    z-index: 1;    left: 50%;    margin-left: -60px;    opacity: 1!important;    transition: opacity 0.3s;    margin-top: -36px;    top: 0!important;}

.tooltip .tooltiptext::after {  content: "";  position: absolute;  top: 100%;  left: 50%;  margin-left: -186px;  border-width: 5px;  border-style: solid;  border-color: #555 transparent transparent transparent;}

.tooltip:hover .tooltiptext {  visibility: visible;  opacity: 1;}
.loader_img{width: 50px;}
.pdfdel{right: 20px;}
.pdfdel_file{right: 170px;    position: absolute;  /* float: right; */  margin-top: 3px;  font-size: 24px;    color: #000;}
.accordion-body{padding: 3px 0 20px 20px;}
.option_file_i a i.pdfdel_file{right: 152px;font-size: 20px;}
.option_file_i a i.pdfshar{right: 38px;font-size: 20px;}
.option_file_i a i.pdfenv{right:  114px;font-size: 20px;}
.option_file_i{position:relative;}
.mail_share_book_icon .masdel{right:  87px;font-size: 20px;}
.mail_share_book_icon .masenv{right:  123px;font-size: 20px;}
.option_folder_i a i{font-size: 20px!important;}
  .progress_bar_start_box { height: 3px!important;}
.detail{height: auto; display: inline-block;     margin-bottom: 200px;}
.borde p{margin-top:20px!important;}
</style>
    <!--========================== Start Composer profile =======================-->
<?php

$search_keyword=explode(',', $detail->search_keyword);

?>
<script>
//     function isValidURL(string) {
//   var res = string.match(/(http(s)?:\/\/.)?(www\.)?\sheetmusicinternational.com[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
//   return (res !== null)
// };

// var testCase1 = "https://sheetmusicinternational.com/home/profile_details/49";

// alert(isValidURL(testCase1)); 
</script>
     <div class="row" style="margin: 0 0 0 0;">


         <div class="container">

            <h1 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 30px;" class="profile_detail_h2"><?php     echo $detail->title; ?><?php //echo $meta_details['heading_title']; ?></h1>
<?php if($detail->image==''){ 
  $path_image="";
   }else{
  $path_image=base_url()."assets/uploads/composers_image/".$detail->image;
   } ?>
            <div class="row">

                 <div class="col-md-4 col-xs-12">

                     <div class="detail2" style="margin-top: 5%">
                      <?php if($path_image!=''){ ?>
                         <img src="<?php echo $path_image;?>" class="img-responsive <?php if($detail->image==''){ ?> image_size <?php } ?>" style="margin-top: 32px;" alt="<?php echo $detail->image_alt;?>" >
                        <a href="<?php echo base_url(); ?>assets/uploads/composers_image/<?php echo $detail->image; ?>" download><button style="display: block;margin-left: auto;margin-right: auto; margin-top: 10px; cursor: pointer;" id="dwnbtn">Download Image</button></a>
                       <?php } ?>

                              <script> 
                              $(document).ready(function(){
                              $("#dwnbtn").hover(function(){
                              $(this).css("background-color", "black");
                              }, function(){
                              $(this).css("background-color", "lightgrey");
                              });
                              });
                              </script>

                     </div>

                 </div>

                 <div class="col-md-8 col-xs-12">

                     <div class="detail smi-kapil-profile-data" style="margin-top: 7%">

                         <div class="borde">
                             
                             <?php 


                             echo $detail->description; ?>

                             
                           <!--   <a href="#">Read more...</a> -->

                         </div>

                     </div>

                 </div>

             </div>

         </div>

     </div>

<!--========================== Start personal liberary =======================-->
<?php 

//$array_list_full = json_decode(json_encode($objTree), True);
//$array_list = $array_list_full['arrChilds']; 
$array_list = $objTree;
// dd($array_list); 
// die(); 
?>


<div class="row" style="margin: 10px 0 0 0;">
  <div class="container">
   <!--  <h2 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 30px;">Shared Documents</h2> -->
    <div id="MyNewTabs" class="tabs-container">
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
            
              
              <!---start level loop-->
           <?php 
              foreach ($array_list as $root_key => $category) 
            {
          ?>
          <?php
$share_folder_url=base_url()."shared_documents/doc/".base64_encode($category->id);
$share_file_url='';

                          $searching_path='';         
                        if($category->parent_id == 1 && $cate_type=='comp')
                        {
                          $cate_class="m-comp";
                        }else{
                          $cate_class="";
                        }
                        ?>
            <div class="view_child_data_p <?php echo $cate_class;?> view_child_data option_folder_i" id="header_row_<?php echo $category->id;?>">
                <b class="<?php if($root_key==0){echo 'auto_click_1';}?>" onclick="view_child_data_function(this)" title="view data" id="<?php echo $category->id; ?>">
                    <?php echo $category->name; ?>
                    </b>&nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $category->name; ?>" target="_blank"><img src="<?php echo base_url();?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $category->name."+".$category->name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url();?>assets/img/wikipedia.png" style="width: 2%;"></a>
            
            <?php if($category->keyword!="" ){
                            ?>
                            <a class="tooltip">&nbsp;&nbsp; <i class="fas fa-info-circle" style="font-size: 20px; margin-top: 3px;"></i>
                        <span class="tooltiptext"><?php echo $category->keyword; ?></span>
                       </a> 
                            <?php
                        } ?>
            <?php if($category->custom_text!="" ){
              ?>
              
                        <br/> <b class="front_custom_text_b"><?php echo $category->custom_text; ?></b>
                        
              <?php
            } 
                ?>  
                <div class="mail_share_book_icon"> 

<a href="<?php echo site_url('home/profile_details/'.$detail->id); ?>"><i class="far fa-id-card masdel"></i></a>

              <a href="mailto:?subject=Sheet Music&body=To download <?php  echo $category->name;?> (composer, title, instrument)   click link below <?php echo $share_folder_url; ?>" target="_top"><i class="fas fa-envelope masenv"></i></a>
              <a href="#" onclick="share_with_friends(this)"  data-offerid="<?php echo $share_folder_url; ?>" data-toggle="modal" style="z-index: 999999;"><i class="fas fa-share-alt masshar resetInput"></i></a>
              <!-- <a href="<?php echo site_url(); ?>composerprofile"><i class="far fa-id-card masdel"></i></a> -->
              
              <!-- onclick="window.location='<?php //echo site_url("sales/viewlead/".base64_encode($fetch_ld->id));?>'" -->
                 <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>

                   <a href="javascript:void(0);" onclick="bookmark_footer_func(<?php echo $category->id;?>)"><i class="far fa-bookmark pdfdel"></i></a>
                      <?php } else { ?>

                      <a href="<?php echo base_url(); ?>login"><i class="far fa-bookmark pdfdel"></i></a>

                      <?php } ?>
                    </div>
            </div>

            
            
            <!---start secondLevel loop-->
            
            <div class="accordion-body">
                      <div class="accordion-group child_data_<?php echo $category->id;?>" id="child_data_<?php echo $category->id;?>" data-behavior="accordion" data-multiple="true">
                                          <div class="progress_bar_start_box">Processing...</div>
                
                              
                      </div>
                      </div>  
            
            <!---end secondLevel loop---->
          <?php
            //$i++;
            }
            ?>
            <!---end level loop---->
          <?php
          }
          else
          {
            echo "Sorry, No Record Found!";
          }
          ?>
<?php foreach ($search_keyword as $key => $value) {
if($value!=''){ ?>
<div class="view_child_data_p view_child_data_p_search <?php echo $cate_class;?> view_child_data option_folder_i">
<b  title="view data"  class="<?php echo 'view_child_data_search';  ?>" ><a href="<?php echo site_url();?>comp/keywordsearch/<?php echo $array_list[0]->id; ?>/<?php echo $value; ?>"> <?php echo $value; ?></a></b>
</div>
<?php 
} 
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
  <div class="modal fade" id="myModal_share_model" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header" style="background-color: #666; height: 56px;">
    <h4 style=" color:#fff; font-size: 26px;">Please copy the below URL and share it as you want:</h4>
          <button type="button" class="close" data-dismiss="modal" style="padding: 6px 16px;">&times;</button>
         
        </div>
        <div class="modal-body" style="padding: 0rem">
         <button onclick="copy_myFunction(this)" class="btn btn-info copy_fun_btn">Copy</button>

          <form>
            <input type="text" id="jitendra" class="form-control formData copy_myFunction" name="link" placeholder="write your text" value="" style="height: 65px; border: none;">
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
 <script src="<?php echo base_url(); ?>assets/js/libraryData.js"></script>

<script type="text/javascript">
            $(document).ready(function() {
                $('[data-behavior=accordion]').simpleAccordion({cbOpen:accOpen, cbClose:accClose});
            });


            function accClose(e, $this) {
                $this.find('span').fadeIn(200);
            }

            function accOpen(e, $this) {
                $this.find('span').fadeOut(200)
            }

 // function child_data_visible(parent_id,class_open){
 //    if(class_open){
 //            $('#header_row_'+parent_id).removeClass('open');
 //            $('#header_row_'+parent_id).next('.accordion-body').hide();
 //    }else{
 //           $('#header_row_'+parent_id).addClass('open');
 //            $('#header_row_'+parent_id).next('.accordion-body').show();
 //    }
            
 // }
//  function bookmark_file_fun(file_id){
//         //var file_id=$(this).attr('id');
//         $.ajax({
//           type:'POST',  
//           url: "<?php echo base_url();?>index.php/comp/bookmark_file",
//           cache: false,
//           data:{file_id:file_id},
//           success: function(html){
//             alert(html);
//           }
//         });

// }  


// function view_child_data_function(data){
//         var parent_id=$(data).attr('id');
//         var title=$(data).attr('title');
//         if($('#header_row_'+parent_id).hasClass('open')){ var class_open=true;}else{var class_open=false;};


//         $.ajax({
//           type:'POST',  
//           url: "<?php echo base_url();?>index.php/comp/ajax_child_data",
//           cache: false,
//           data:{parent_id:parent_id,page_type:'profile'},
//           success: function(html){
//                         progress_bar_start(parent_id,html);
//             //alert(parent_id);
//            //if(title!='view data'){
//             child_data_visible(parent_id,class_open);
//             // }
//              $("a.tooltip span.tooltiptext").removeAttr('style');
//             //left: 63px; top: -100px; visibility: visible; opacity: 1;
//           }
//         });
//     }


setTimeout(function(){ 
  $('.auto_click_1').click();
}, 1000);


// function progress_bar_start(parent_id,html) {
//   var duration = 3000; // it should finish in 5 seconds !
//   $('#child_data_'+parent_id+' .progress_bar_start_box').stop().addClass("processing_bg").animate({
//   //$('#child_data_'+parent_id+' .progress_bar_start_box').stop().({"background-color": "green", "width": "0%"}).animate({
//     width: '100%'
//   }, {
//     duration: duration,
//     progress: function(promise, progress, ms) {
//       $(this).text('Processing... '+Math.round(progress * 100) + '%');
//     }
//   });

// setTimeout(function(){
//  $('#child_data_'+parent_id).html(html);
//  $('.progress_bar_start_box').removeClass('processing_bg'); 
// }, 3500);

              

// }

function share_with_friends(url){

     var share_with_friends=$(url).attr('data-offerid');
      $('#jitendra').val(share_with_friends);

      $('#myModal_share_model').modal('show');

}
// function show_more(data){
//   var folder_id=$(data).attr('data-folder_id');
//   $('#read_more_less_'+folder_id).hide();
//   $('#read_more_more_'+folder_id).show();
// }
// function hide_more(data){
//   var folder_id=$(data).attr('data-folder_id');
//   $('#read_more_less_'+folder_id).show();
//   $('#read_more_more_'+folder_id).hide();
// } 
// function copy_myFunction(data) {
//   var copyText = document.getElementById("jitendra");
//   copyText.select();
//   copyText.setSelectionRange(0, 99999)
//   document.execCommand("copy");
//   //alert("Copied ");
//   $(data).text('Copied');
// }
        </script>