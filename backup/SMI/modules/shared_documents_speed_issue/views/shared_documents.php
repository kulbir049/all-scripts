<?php
$keywordsearch=0;
if($this->uri->segment(2) && $this->uri->segment(2)=='keywordsearch'){
  $keywordsearch=1;
}
?>

<style type="text/css">
.tooltip {  position: relative;  display: inline-block;  opacity: 1!important;}

/*.accordion-header.m-comp.open {
  background:  url("assets/img/minus-brown.png") no-repeat 6px center;
  color: #000;
  font-weight: bold;
}

.accordion-header.m-comp {
  background:  url("assets/img/plus-brown.png") no-repeat 6px center;
  color: #000;
  font-weight: bold;
}*/


.tooltip .tooltiptext {visibility: hidden;    width: 493px;    background-color: #555;    color: #fff;    text-align: center;    border-radius: 6px;    padding: 4px 8px;    position: absolute;    z-index: 1;    left: 50%;    margin-left: -60px;    opacity: 1!important;    transition: opacity 0.3s;    margin-top: -36px;    top: 0!important;}

.tooltip .tooltiptext::after {  content: "";  position: absolute;  top: 100%;  left: 50%;  margin-left: -186px;  border-width: 5px;  border-style: solid;  border-color: #555 transparent transparent transparent;}

.tooltip:hover .tooltiptext {  visibility: visible;  opacity: 1;}
.loader_img{width: 50px;}
.pdfdel{right: 20px;}
.pdfdel_file{right: 170px;    position: absolute;  /* float: right; */  margin-top: 3px;  font-size: 24px;    color: #000;}
.accordion-body{padding: 3px 0 20px 20px;}
.option_file_i a i.pdfdel_file{right: 152px;font-size: 20px;}
.option_file_i a i.pdfshar{right: 183px;font-size: 20px;}
.option_file_i a i.pdfenv{right:  258px;font-size: 20px;}
.option_folder_i a i{font-size: 20px!important;}
  .progress_bar_start_box { height: 3px!important;}
.download_icon {right: 214px!important;}
</style>



<!--========================== Start personal liberary =======================-->
<?php 
//dd($objTree);
//$array_list_full = json_decode(json_encode($objTree), True);
//$array_list = $array_list_full['arrChilds']; 
$array_list = $objTree;
//dd($array_list); 
//die(); 
?>
<style type="text/css">
  .selected_tab{background-color: #666666!important; color: #fff!important;}
</style>


<div class="row" style="margin: 0 0 0 0;">
	<div class="container">




<?php  if($array_list[0]->id!=40567 && $array_list[0]->id!=25527){ ?>
		<h2 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 30px; float: left;">Shared Documents</h2>
  <?php } ?>
      <h1 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 25px;"> "<?php echo $array_list[0]->name;?>"</h1>

		<div id="MyNewTabs" class="tabs-container">
      
        <br><br>
        <ul class="tabs-content">
            <!---------------------------->
<!--========================== master tabs =======================-->			 
			<div id="demo_wrap">
				<div class="accordion-group" data-behavior="accordion">
					<?php
					//print_r($array_list);
					if (isset($array_list) && !empty($array_list) && is_array($array_list)) 
					{
						//print_r($array_list);
						foreach ($array_list as $category) 
						{
					?>
					<?php
 $searching_path='';    
 //print_r($permision_logs_array);     
                                     
                        if($category->parent_id == 1 && $cate_type=='comp')
                        {
                          $cate_class="m-comp";
                        }else{
                          $cate_class="";
                        }


if($permision_logs_array[0]=='temporary'){
                  if($category->temp_rename_folder!='')
                        {
                          $folder_name=$category->temp_rename_folder;
                        }else{
                          $folder_name=$category->name;
                        }
}else{
                  if($category->rename_folder!='')
                        {
                          $folder_name=$category->rename_folder;
                        }else{
                          $folder_name=$category->name;
                        }
}
                        



                        if($category->p_custom_text!=''){
                         $custom_text=$category->p_custom_text;
                        }else{
                          $custom_text=$category->custom_text;
                        }
                        ?>
						<div class="accordion-header <?php echo $cate_class;?> view_child_data option_folder_i" id="header_row_<?php echo $category->id;?>">
<?php if($category->searchkeyword==1){ ?>
              <b  title="view data"  class="<?php if($category->searchkeyword==1){ echo 'view_child_data_search'; } ?>" id="<?php echo $category->id; ?>"><a href="<?php echo site_url('home/profile_details/'.$category->folder_user_id); ?>"> <?php echo $category->name; ?></a></b>
            <?php }else{ ?>
              <b class="auto_click_1" onclick="view_child_data_function(this)" title="view data" id="<?php echo $category->id; ?>"> <?php echo $folder_name; ?></b>
            <?php } ?>

              &nbsp;&nbsp; <a href="https://www.youtube.com/results?search_query=<?php echo $folder_name; ?>" target="_blank"><img src="<?php echo base_url();?>assets/img/youtube.png" style="width: 2%;"></a>&nbsp;&nbsp; <a href="https://en.wikipedia.org/wiki/Special:Search?search=<?php echo $folder_name."+".$folder_name; ?>&ns0=1" target="_blank"><img src="<?php echo base_url();?>assets/img/wikipedia.png" style="width: 2%;"></a>
						<?php if($category->keyword!="" ){ ?>
                <a class="tooltip">&nbsp;&nbsp; <i class="fas fa-info-circle" style="font-size: 20px;"></i> 
                	<span class="tooltiptext"><?php echo $category->keyword;?></span>
              </a>
            <?php } ?>
            <?php if($custom_text!="" ){
							?>
							
                        <br/> <b class="front_custom_text_b"><?php echo $custom_text; ?></b>
                        
							<?php
						} 
                if($keywordsearch==1){
                        $searching_path=$this->Comp_model->getDirNamesById($category->parent_id);

                            ?><br/>
						                  <b style="font-weight: 500;font-size: 12px;"><?php echo $searching_path; ?></b>
					          <?php } ?>
      <div class="mail_share_book_icon">		
							<a href="mailto:?subject=Sheet Music&body=To download <?php  echo $folder_name;?> (composer, title, instrument)   click link below <?php echo base_url()."shared_documents/doc/".base64_encode($category->id); ?>" target="_top"><i class="fas fa-envelope masenv"></i></a>
							<a href="#" onclick="share_with_friends(this)" data-offerid="<?php echo base_url()."shared_documents/doc/".base64_encode($category->id); ?>" data-toggle="modal" style="z-index: 999999;"><i class="fas fa-share-alt masshar resetInput"></i></a>
							<!-- <a href="<?php echo site_url(); ?>composerprofile"><i class="far fa-id-card masdel"></i></a> -->
							<a href="<?php echo site_url('home/profile_details/'.$category->folder_user_id); ?>"><i class="far fa-id-card masdel"></i></a>
							<!-- onclick="window.location='<?php //echo site_url("sales/viewlead/".base64_encode($fetch_ld->id));?>'" -->
                 <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?><a href="javascript:void(0);" onclick="bookmark_footer_func('<?php echo $category->id;?>')"><i class="far fa-bookmark pdfdel"></i></a>
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
  <div class="modal fade" id="myModal_share_model" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header" style="background-color: #666; height: 56px;">
		<h4 style=" color:#fff; font-size: 26px;">Please copy the below URL and share it as you want:</h4>
          <button type="button" class="close" data-dismiss="modal" style="padding: 6px 16px;">&times;</button>
         
        </div>
        <div class="modal-body" style="padding: 0rem">
                      <button onclick="copy_myFunction(this)" class="btn btn-info">Copy</button>

          <form>
            <input type="text" id="jitendra" class="form-control formData" name="link" placeholder="write your text" value="" style="height: 65px; border: none;">
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

<script type="text/javascript">
//document.getElementById("jitendra").select();
$(function() {
  $(".resetInput").on("click", function() {
  	var nex = $(this).parent().attr('data-offerid');
  	//alert(nex);
    $(".formData").val(nex);

  });
  
  $("#jitendra").on("click", function() {
  	 $(this).select();

  });

});
// $("div").delegate(".share_with_friends", "click", function(){

//       var share_with_friends=$(this).attr('data-offerid');

//       $('#jitendra').val(share_with_friends);

//       $('#myModal_btn').click();

// });
function share_with_friends(url){

     var share_with_friends=$(url).attr('data-offerid');
      $('#jitendra').val(share_with_friends);

      $('#myModal_share_model').modal('show');

}
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

 <script src="<?php echo base_url(); ?>assets/js/jquery.simpleaccordion.js"></script>
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

          //   var myId = $('.accordion-header').attr('id');
             // if(myId === 1){
          // var imageUrl = "assets/img/plus-brown.png";
        		// $('.accordion-header').css("background-image", "url(" + imageUrl + ")");

        		// $(this).css("background-image", "url(" + imageUrl + ")");
          //   }


          // var myId = $('.accordion-header.m-comp.open');

          //myId.click(function(){
          	// if (!$(this).hasClass('open')) {
           // 		$(this).children().attr("src","assets/img/accordion-opened.png");
           //  }
           //  else  {
           //  	$(this).children().attr("src","assets/img/accordion-closed.png");
           //  }
           //$(".icha0").css("background-color","");
            // $(this).css("background","");
            // $(this).children().css('display', 'block');

           //});

          // $('.accordion-header.m-comp.open').css("background: url("assets/img/plus-brown.png") no-repeat 6px center;",'');
function child_data_visible(parent_id,class_open){
    if(class_open){
            $('#header_row_'+parent_id).removeClass('open');
            $('#header_row_'+parent_id).next('.accordion-body').hide();
    }else{
           $('#header_row_'+parent_id).addClass('open');
            $('#header_row_'+parent_id).next('.accordion-body').show();
    }
            
 }
$(document).ready(function(){
    //$('.view_child_data').click(function(){
$("div").delegate(".bookmark_file", "click", function(){
        var file_id=$(this).attr('id');
        $.ajax({
          type:'POST',  
          url: "<?php echo base_url();?>index.php/comp/bookmark_file",
          cache: false,
          data:{file_id:file_id},
          success: function(html){
            alert("File bookmarked Successfully!");
          }
        });

});
//$("div").delegate(".view_child_data", "click", function(){

 });
 function bookmark_file_fun(file_id){
        //var file_id=$(this).attr('id');
        $.ajax({
          type:'POST',  
          url: "<?php echo base_url();?>index.php/comp/bookmark_file",
          cache: false,
          data:{file_id:file_id},
          success: function(html){
            alert(html);
          }
        });

} 

function view_child_data_function(data){
        var parent_id=$(data).attr('id');
        var title=$(data).attr('title');
        var permision_logs='<?php echo $permision_logs;?>';
        if($('#header_row_'+parent_id).hasClass('open')){ var class_open=true;}else{var class_open=false;};


        $.ajax({
          type:'POST',  
          url: "<?php echo base_url();?>index.php/shared_documents/ajax_child_data",
          cache: false,
          data:{parent_id:parent_id,permision_logs:permision_logs},
          success: function(html){
            //$('#child_data_'+parent_id).html(html);
                  progress_bar_start(parent_id,html);
            //alert(parent_id);
            //if(title!='view data'){
            child_data_visible(parent_id,class_open);
            // }
            //left: 63px; top: -100px; visibility: visible; opacity: 1;
          }
        });
 }
 function progress_bar_start(parent_id,html) {
  var duration = 1000; // it should finish in 5 seconds !
  $('#child_data_'+parent_id+' .progress_bar_start_box').stop().addClass("processing_bg").animate({
  //$('#child_data_'+parent_id+' .progress_bar_start_box').stop().({"background-color": "green", "width": "0%"}).animate({
    width: '100%'
  }, {
    duration: duration,
    progress: function(promise, progress, ms) {
      $(this).text('Processing... '+Math.round(progress * 100) + '%');
    }
  });

setTimeout(function(){
 $('#child_data_'+parent_id).html(html);
 $('.progress_bar_start_box').removeClass('processing_bg'); 
}, 3500);

              

}
setTimeout(function(){ 
  $('.auto_click_1').click();
}, 1000);
        </script>
            <script>
function copy_myFunction(data) {
  var copyText = document.getElementById("jitendra");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  //alert("Copied ");
  $(data).text('Copied');
}
</script>