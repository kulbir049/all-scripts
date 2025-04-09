<style>
.comp-title {
  cursor:pointer;
} 
.profile_link_p_a{
    top: 50%;
    left: 40%;
    color: #fff;
    font-size: 13px;
    font-family: 'Roboto', sans-serif;
    }
</style>   
<?php //dd($this->session->userdata()); ?>
<!--header already included in application/views/element/front-->
<div class="row" style="margin: 0 0 0 0;">
        <div class="container">
            <?php 
$gaurav_danger=$this->session->flashdata('gaurav_danger');
?>
<?php if($gaurav_danger!=""):?>
<br>
<div class="alert alert-danger text-center"><?= $gaurav_danger?></div>
<?php endif;?>
            <div class="about">
                <h1><?php echo $Home_Section2->title;?></h1>
				<div style="margin-top: -16px;">
				<?php echo $Home_Section2->description;?>
				<p><a href="<?php echo base_url();?>faq">FAQ</a> : Technical help.&nbsp; &nbsp; <a  href="<?php echo base_url();?>faq">Remove Watermarks</a></p>
				</div>
            </div>
        </div>
</div>



<hr style="margin-top: -2px; margin-bottom: -2px;">
<!-- Start Browser composer section  -->
<div class="row" style="margin: 0 0 0 0 ">
	<div class="container">
		<div class="browse">
			<h2 style="margin-bottom: -2px;"><?php echo $Home_Section4->title;?></h2>
			<?php if(count($banner)>0)
			{
			foreach($banner as $composerData){
			$path = FCPATH . 'assets/uploads/composers_image/' . $composerData->image;
			?>
			<a href="<?php echo base_url();?>home/profile_details/<?php echo $composerData->id; ?>">
			    			    <!--<a href="<?php echo site_url('profile-details/'.$composerData->id); ?>">-->
			<div class="c2">
				<?php if (file_exists($path) && ($composerData->image!= "")) 
				{
				?>
				
					<img src="<?php echo base_url(); ?>assets/uploads/composers_image/<?php echo $composerData->image; ?>" style="height: 175px;" alt="<?php echo $composerData->name; ?>">
				<?php 
				} 
				else 
				{
				?>
				<img src="<?php echo base_url(); ?>assets/image/no_image.jpg" class="d-block w-100" style="height: 175px;">
				<?php 
				} 
				?>
				<p class="comp-title"><span class="profile_link_p_a" ><?php echo $composerData->name; ?></span></p>
			</div>
			</a>
			<?php
			}
			}
			?>
			
		</div>
		<br/><br/>
		<div style="text-align: center;display:none;">
              <a href="<?php echo base_url();?>home/allcomposerprofile" style="margin: 15px;" class="btn btn-primary">More Composers</a>
          </div>
	</div>

</div>
<div style="padding-bottom:15px;"></div>
<!--<button class="btn btn-primary view" type="submit">View More</button>-->
<!-- End Browser composer section  -->


<?php
$keywordsearch=0;
if($this->uri->segment(2) && $this->uri->segment(2)=='keywordsearch'){
  $keywordsearch=1;
}
?>

<style type="text/css">
.tooltip {  position: relative;  display: inline-block!important;  opacity: 1!important;  z-index: 1000!important;}
.tooltip .tooltiptext {visibility: hidden;    width: 493px;    background-color: #555;    color: #fff;    text-align: center;    border-radius: 6px;    padding: 4px 8px;    position: absolute;    z-index: 1;    left: 50%;    margin-left: -60px;    opacity: 1!important;    transition: opacity 0.3s;    margin-top: -36px;    top: 0!important;}

.tooltip .tooltiptext::after {  content: "";  position: absolute;  top: 100%;  left: 50%;  margin-left: -186px;  border-width: 5px;  border-style: solid;  border-color: #555 transparent transparent transparent;}

.tooltip:hover .tooltiptext {  visibility: visible;  opacity: 1;}
.loader_img{width: 50px;}
.pdfdel{right: 20px;}
.pdfdel_file{right: 170px;    position: absolute;  /* float: right; */  margin-top: 3px;  font-size: 24px;    color: #000;}
.accordion-body{padding: 3px 0 20px 20px;}
.option_file_i a i.pdfdel_file{right: 17px;font-size: 20px;}
.option_file_i a i.pdfshar{right: 50px;font-size: 20px;}
.option_file_i a i.pdfenv{right:  125px;font-size: 20px;}
.option_folder_i a i{font-size: 20px!important;}
.option_file_i {position: relative;}
.front_custom_text_b {padding: 1px 0 0px 50px!important;    margin: 0 !important;}
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
<?php
if($parent_id_root==13763){ ?>
<style type="text/css">
  .mail_share_book_icon{display: none;}
  .music_for_sale_options{display: block; float: right; margin-top: 10px; position: absolute; right: 0; top: 7px;}
</style>
<?php } ?>


	<div class="container">

<?php if($cate_type=='school_music'){ 

    $content_text = $this->Main_model->getdata_tablename_id('cms_page', 'id', '26');
echo $content_text['content_text'];



  ?>
    <?php /*<h2 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 30px;">Free Band and String Music for Schools</h2><br>
    <p style="color: #000; margin-top: 30px; font-family:'Roboto', sans-serif;">Sheet Music International offers downloadable Free Band and String Music for Schools. The School Music Library free for teachers and students to use without a watermark.<br><br>
   Most Music in this section is under copyright. It is licensed for distribution by Sheet Music International for use by it's members and the musicians, students or teachers they work with. It is not licensed for redistribution by another publisher,as part of a published collection or another website for public dist</p>
        <p style="color:red; font-family: 'Roboto', sans-serif;">The School Music Library free for teachers and students to use without a watermark . Log into any account to remove visible watermarks </p><?php */ ?>
      <?php } ?>

<hr style="margin-top: -15px; margin-bottom: -15px;">

		<h2 style="color: #000; margin-bottom: -30px; margin-top: 30px; font-size: 30px;">Alphabetical Search</h2>
		<p style="text-align: center; color: red; margin-top: 30px;">Hint : type control F then composer name. Screen will jump to composer.</p>
		<div id="MyNewTabs" class="tabs-container">
      <?php if($cate_type!='school_music'){ ?>
        <p class="tabs" style="margin: -5px 10px 0 10px;">
            <a href="<?php echo site_url(); ?>comp/mastercomposer" class="<?php if($cate_type=='mastercomposer'){ echo 'selected_tab';}?>"  style="display:none;">Renown Composers</a>
            <a href="<?php echo site_url(); ?>comp" class="<?php if($cate_type=='comp'){ echo 'selected_tab';}?>"  style="display:none;">Composers</a>
            <?php if (($this->session->userdata('user_id')) && $this->session->userdata('auth')==1 ) { ?>
            <a href="<?php echo site_url(); ?>personal_library">Personal Library</a>
            <?php } else { ?>
            <a href="<?php echo site_url(); ?>login">Personal Library</a>
            <?php } ?>
            <a href="<?php echo site_url(); ?>repertoire"  style="display:none;">Repertoire</a>
            <a href="<?php echo site_url(); ?>comp/paid_music" class="<?php if($cate_type=='paid_music'){ echo 'selected_tab';}?>"  style="display:none;">Music for Sale</a>
        </p>
      <?php } ?>
        <div class="abch">
            <ul>
               <li><a href="<?php echo site_url(); ?>comp/alphaSearch/ALL/<?php echo $cate_type;?>">ALL</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/A/<?php echo $cate_type;?>">A</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/B/<?php echo $cate_type;?>">B</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/C/<?php echo $cate_type;?>">C</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/D/<?php echo $cate_type;?>">D</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/E/<?php echo $cate_type;?>">E</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/F/<?php echo $cate_type;?>">F</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/G/<?php echo $cate_type;?>">G</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/H/<?php echo $cate_type;?>">H</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/I/<?php echo $cate_type;?>">I</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/J/<?php echo $cate_type;?>">J</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/K/<?php echo $cate_type;?>">K</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/L/<?php echo $cate_type;?>">L</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/M/<?php echo $cate_type;?>">M</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/N/<?php echo $cate_type;?>">N</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/O/<?php echo $cate_type;?>">O</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/P/<?php echo $cate_type;?>">P</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/Q/<?php echo $cate_type;?>">Q</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/R/<?php echo $cate_type;?>">R</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/S/<?php echo $cate_type;?>">S</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/T/<?php echo $cate_type;?>">T</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/U/<?php echo $cate_type;?>">U</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/V/<?php echo $cate_type;?>">V</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/W/<?php echo $cate_type;?>">W</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/X/<?php echo $cate_type;?>">X</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/Y/<?php echo $cate_type;?>">Y</a></li>
               <li><a href="<?php echo base_url(); ?>comp/alphaSearch/Z/<?php echo $cate_type;?>">Z</a></li>
            </ul>
        </div>
        <br><br>
        <ul class="tabs-content">
<style type="text/css">
  .loader_img_center { display: block;margin: 0 auto;}
  .progress_bar_start_box { height: 3px!important;}
</style>       
            <!---------------------------->
<!--========================== master tabs =======================-->			 
			<div id="demo_wrap">
				<!--*******************folder ajax data here******************-->
        <!--<img src="<?php echo base_url();?>/assets/images/loader.gif" class="loader_img_center">-->
                                                  <div class="progress_bar_start_box" style="color: black;">Processing...</div>

			</div>

<!--========================== master tabs End =======================-->
			<!---------------------------->
        </ul>
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

function share_with_friends(url){
     
     var share_with_friends=$(url).attr('data-offerid');
      $('#jitendra').val(share_with_friends);
      $('.copy_fun_btn').text('Copy');

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
 <script src="<?php echo base_url(); ?>assets/js/libraryData.js"></script>
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

       


    setTimeout(function(){ 
      ajax_root_folder_index('1','mastercomposer','<?php echo $alphaSearch_keyword;?>'); 
    }, 500);




        </script>



<!-- Start General Information section  -->
<div class="row" style="margin: 0 0 0 0;">
	<div class="container">
		<div class="general">
			<h3><?php echo $Home_Section6->title;?></h3>
			<div>
			<?php echo $Home_Section6->description;?>

			</div>
		</div>
	</div>
</div>
<hr style="margin-top: -15px; margin-bottom: -15px;">


    <!--========================== modal =======================-->
 
      
<div class="container">


  <!-- Remove Watermarks Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="max-width: 500px!important;">
    
      <div class="modal-content">
        <div class="modal-header" style="background-color: #666; height: 40px;">
        	<h3 style="color: #fff; margin: 0; padding:0; font-size: 22px; margin-top: -9px;">Sheet Music International</h3>
          <button type="button" class="close" data-dismiss="modal" style="padding: 6px 16px;">&times;</button>

        </div>
        <div class="modal-body" style="padding: 1rem">
        <h4 style="color: #000; margin: 0; padding-bottom: 0px;">Removing Watermarks:</h4>
        <p style="color: #000; padding-left: 25px; margin: 0; padding-bottom: 0px;">Log into your account.<br>
           Watermarked music must be downloaded again</p>
           <h4 style="color: #000; margin: 0; padding-bottom: 0px;">Free Basic Account:</h4>
        <p style="color: #000; padding-left: 25px; margin: 0; padding-bottom: 0px;">Some music will have light watermark<br>
                 School music will have no watermarks</p>
           <h4 style="color: #000; margin: 0; padding-bottom: 0px;">Premium Account:</h4>
        <p style="color: #000; padding-left: 25px; margin: 0; padding-bottom: 0px;">All watermarks removed.</p>

        </div>
        <div class="modal-footer" style="background-color: #666; height: 30px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



 
  
</div>


     <!--========================== modal end =======================-->


<!-- End General Information section  -->
<!--footer already included in application/views/element/front-->
<?php
 

    $flag=1;
    if($this->session->has_userdata("popup")){
        if($this->session->userdata("popup")==0){
            $flag=0;
            $this->session->set_userdata('popup',1);
        }
    }
    
    
    if($flag==0){
         $this->db->update("user",["popup_time"=>$this->session->userdata("popup_time")+1],["user_id"=>$this->session->userdata("user_id")]);
         
       // $this->db->update("",[],["popup_time"=>])
?>
 <!-- Account expire Modal -->
  <div class="modal fade" id="account_expire" role="dialog">
    <div class="modal-dialog" style="max-width: 500px!important;">
    
      <div class="modal-content">
        <div class="modal-header" style="background-color: #666; height: 40px;">
        	<h3 style="color: #fff; margin: 0; padding:0; font-size: 22px; margin-top: -9px;">Sheet Music International</h3>
          <button type="button" class="close" data-dismiss="modal" style="padding: 6px 16px;">&times;</button>

        </div>
        <div class="modal-body" style="padding: 1rem">
        
           <p>      <span style="color:red;">  It is time to renew your premium account.</span>  <a href="<?php echo base_url();?>renew_membership">Click here</a> <span style="color:red;">to renew now.  </span>
                      <span style="color:black;"> This message will appear <?= 2-$this->session->userdata("popup_time");?> more times.</span>
                   </p>
          
        </div>
        <div class="modal-footer" style="background-color: #666; height: 30px;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
	$('#account_expire').modal('show');
</script>
<?php }?>
       