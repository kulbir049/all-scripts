<!-- <?php
//dd($categories);
//die;
?> -->
<script src="https://kit.fontawesome.com/ffec47c7a2.js"></script>
<style type="text/css">
.tooltip {
  position: relative;
  display: inline-block!important;
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
</style>

<?php 
//dd($objTree);
//$array_list_full = json_decode(json_encode($objTree), True);
//$array_list = $array_list_full['arrChilds']; 
$array_list = $objTree;
//dd($array_list); 
//die(); 
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
                <!--<ul class="nav  panel_toolbox">
                    <li><a  href="<?php echo base_url('admin/category/add'); ?>"><span class="glyphicon glyphicon-plus"></span></a>
                    </li>
                </ul>	
                <div class="clearfix"></div>-->
                <p style="text-align: center; color: red; margin-top: 30px;">Hint : type control F then composer name. Screen will jump to composer.</p>
				<div class="abch">

               <ul>

                	<li><a href="<?php echo site_url(); ?>admin_categories">ALL</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/A">A</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/B">B</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/C">C</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/D">D</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/E">E</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/F">F</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/G">G</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/H">H</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/I">I</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/J">J</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/K">K</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/L">L</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/M">M</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/N">N</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/O">O</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/P">P</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/Q">Q</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/R">R</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/S">S</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/T">T</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/U">U</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/V">V</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/W">W</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/X">X</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/Y">Y</a></li>

                    <li><a href="<?php echo base_url() ?>admin_categories/alphaSearch/Z">Z</a></li>

                </ul>
				<button class="btn btn-info" style="margin-left: 81px;"><a href="<?php echo base_url('admin/category/add_directory'); ?>"><span class="">Directory upload</span></a></button>
				<button class="btn btn-info" style="margin-left: 10px; margin-top: 0px;"><a href="<?php echo base_url('admin/category/add'); ?>"><span class="">New Root Folder</span></a></button>
            </div>
				<p class="tabs" style="margin: -5px 10px 0 10px;">
            <a href="<?php echo site_url(); ?>admin_categories">Master Composers</a>
            <a href="<?php echo site_url(); ?>admin_categories/allComposers" style="background-color: #666666; color: #fff;">Composers</a>
            <a href="#">School Music</a>
            
        </p>
				   <div class="clearfix"></div>
            </div>
			
			<!------>
			<div id="demo_wrap">
            <div class="accordion-group" data-behavior="accordion">
				<?php get_flashdata(); ?>
				<?php
				if (isset($array_list) && !empty($array_list) && is_array($array_list)) {
                            foreach ($array_list as $category) {
				?>
                <div class="accordion-header">
				<p><?php echo (!empty($category) && is_object($category) ? $category->name : ''); ?>

				<?php if($category->custom_text!="" ){
							?>
							<a class="tooltip">&nbsp;&nbsp; <i class="fas fa-info-circle" style="font-size: 20px;"></i>
                         <span class="tooltiptext"><?php echo $category->custom_text; ?></span>
                       </a>
							<?php
						} ?>
						
				
                <div class="naoTooltip-wrap">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($category->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/delete_directory/'.base64_encode($category->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/add_composer/'.base64_encode($category->id)); ?>" title="Add Composer"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
				<?php
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				//dd($arr_data);
				if (isset($category->arrChilds) ) 
				
						
				{
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php
						foreach($category->arrChilds as $secondLevel) 
							{
							?>
							
                <div class="accordion-header">
				<p><?php echo $secondLevel->name; ?>
				<div class="naoTooltip-wrap" style="left: -234px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($secondLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
				<?php 
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				 if (isset($secondLevel->arrChilds)) 
								{
								
				
				
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php foreach ($secondLevel->arrChilds as $thirdLevel) { ?>
                <div class="accordion-header">
				<p><?php echo $thirdLevel->name; ?>
                <div class="naoTooltip-wrap" style="left: -216px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($thirdLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
                <?php
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				// if(isset($arr_data) && !empty($arr_data) && is_array($arr_data))
				if (isset($thirdLevel->arrChilds)) 
				{
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php foreach ($thirdLevel->arrChilds as $fourthLevel) { ?>
                <div class="accordion-header">
				<p><?php echo $fourthLevel->name; ?>
                <div class="naoTooltip-wrap" style="left: -216px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($fourthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
                
                <?php
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				// if(isset($arr_data) && !empty($arr_data) && is_array($arr_data))
				if (isset($fourthLevel->arrChilds))
				{
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php foreach($fourthLevel->arrChilds as $fifthLevel) { ?>
                <div class="accordion-header">
				<p><!-- <?php echo (!empty($category) && is_object($category) ? $category->name : ''); ?> -->
					<?php echo $fifthLevel->name; ?>
                <div class="naoTooltip-wrap" style="left: -216px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($fifthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
				<!--------->
				<?php
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				// if(isset($arr_data) && !empty($arr_data) && is_array($arr_data))
				if (isset($fifthLevel->arrChilds)) 
				{
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php foreach ($fifthLevel->arrChilds as $sixthLevel) { ?>
                <div class="accordion-header">
				<p><?php echo $sixthLevel->name; ?>
                <div class="naoTooltip-wrap" style="left: -216px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($sixthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
				<!--------->
				<?php
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				// if(isset($arr_data) && !empty($arr_data) && is_array($arr_data))
				if (isset($sixthLevel->arrChilds))
				{
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php foreach ($sixthLevel->arrChilds as $seventhLevel) { ?>
                <div class="accordion-header">
				<p><?php echo $seventhLevel->name; ?>
                <div class="naoTooltip-wrap" style="left: -216px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($seventhLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
				<!--------->
				<?php
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				// if(isset($arr_data) && !empty($arr_data) && is_array($arr_data))
				if (isset($seventhLevel->arrChilds)) 
				{
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php foreach ($seventhLevel->arrChilds as $eighthLevel) { ?>
                <div class="accordion-header">
				<p><?php echo $eighthLevel->name; ?>
                <div class="naoTooltip-wrap" style="left: -216px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($eighthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
				<!--------->
				<?php
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				// if(isset($arr_data) && !empty($arr_data) && is_array($arr_data))
				if (isset($eighthLevel->arrChilds))
				{
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php foreach ($eighthLevel->arrChilds as $ninthLevel) { ?>
                <div class="accordion-header">
				<p><?php echo $ninthLevel->name; ?>
                <div class="naoTooltip-wrap" style="left: -216px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($ninthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
				<!--------->
				<?php
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				// if(isset($arr_data) && !empty($arr_data) && is_array($arr_data))
				if (isset($ninthLevel->arrChilds))
				{
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php foreach ($ninthLevel->arrChilds as $tenthLevel) { ?>
                <div class="accordion-header">
				<p><?php echo $tenthLevel->name; ?>
                <div class="naoTooltip-wrap" style="left: -216px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($tenthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
				<!--------->
				<?php
				// $CI = & get_instance();
				// $CI->load->model('admin_categories/Category_model');
				// $arr_data = $CI->Category_model->getCategorybycomposerid($category->id);
				// if(isset($arr_data) && !empty($arr_data) && is_array($arr_data))
				if (isset($tenthLevel->arrChilds))
				{
				?>
				<div class="accordion-body">
                <div class="accordion-group" data-behavior="accordion" data-multiple="true">
				<?php foreach ($tenthLevel->arrChilds as $eleventhLevel) { ?>
                <div class="accordion-header">
				<p><?php echo $eleventhLevel->name; ?>
                <div class="naoTooltip-wrap" style="left: -216px;">
				<p>Option</p>
                <div class="naoTooltip nt-right nt-small dd-handle">
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eleventhLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eleventhLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eleventhLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
				<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($eleventhLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eleventhLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eleventhLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eleventhLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eleventhLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
				<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eleventhLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
                </div>
                </div>
                </p>
                </div>
              
                <?php } ?>

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
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($tenthLevel->id)."_".base64_encode($tenthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($tenthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($tenthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                </div>
                </div>
				<?php
				}
				
				?>



				<!--------->
                <?php } ?>
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
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($ninthLevel->id)."_".base64_encode($ninthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($ninthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($ninthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                </div>
                </div>

				<?php
				}
				?>

				<!--------->
                <?php } ?>
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
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($eighthLevel->id)."_".base64_encode($eighthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($eighthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($eighthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                </div>
                </div>

				<?php
				}
				?>
				<!--------->
                <?php } ?>
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
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($seventhLevel->id)."_".base64_encode($seventhLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
	
											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($seventhLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($seventhLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                </div>
                </div>
				<?php
				}
				?>
				<!--------->
                <?php } ?>
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
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($sixthLevel->id)."_".base64_encode($sixthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>

											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($sixthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($sixthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                </div>
                </div>
				<?php
				}
				?>
				<!--------->
                <?php } ?>
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
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($fifthLevel->id)."_".base64_encode($fifthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>

											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($fifthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fifthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                </div>
                </div>
				<?php
				}
				?>
				<!--------->
                <?php } ?>
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
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($fourthLevel->id)."_".base64_encode($fourthLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>

											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($fourthLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($fourthLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                </div>
                </div>
				<?php
				}
				} 
				?>
				<?php
											$CI = & get_instance();
											$dpath = $this->Category_model->getRevArrayCatbyId($thirdLevel->id,$thirdLevel->parent_id);
											$arr_img_pdf_txt = $this->Category_model->getImagesById($thirdLevel->id);
											//dd($arr_img_pdf_txt);
											//dd($dpath);
											foreach ($arr_img_pdf_txt as $varData) 
											{
											$ext = pathinfo($varData->image, PATHINFO_EXTENSION);
											?>

											<div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($thirdLevel->id)."_".base64_encode($thirdLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>

											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($thirdLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($thirdLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                </div>
                </div>
				<?php
				}
				} 
				?>
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
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($secondLevel->id)."_".base64_encode($secondLevel->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($secondLevel->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($secondLevel->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                </div>
                </div>
				<?php
				}
				} 
				?>
				<?php
											$CI = & get_instance();
											$dpath = $this->Category_model->getRevArrayCatbyId($category->id,$category->parent_id);
											$arr_img_pdf_txt = $this->Category_model->getImagesById($category->id);
											//dd($arr_img_pdf_txt);
											//dd($dpath);
											foreach ($arr_img_pdf_txt as $varData) 
											{
											$ext = pathinfo($varData->image, PATHINFO_EXTENSION);
											?>
											<div class="" style="border-bottom: 1px solid #000; margin-right: -37px;"> 
											
											<a href="<?php echo base_url()."downloadfile/showpdf/"; ?><?php echo base64_encode($category->id)."_".base64_encode($category->parent_id); ?>"><img src="<?php if($ext=="pdf"){ echo IMAGE_PATH . "pdf.png"; }else { echo IMAGE_PATH . "txt.png"; }  ?>" style="height: 24px;"><?php  echo $varData->image;?></a>
											</div>
											<div class="naoTooltip-wrap" style="left: -216px;">
											<p>Option</p>
							                <div class="naoTooltip nt-right nt-small dd-handle">
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add Sub Directory" style="text-align: left;"><img src="<?php echo base_url() .'assets/admin/images/adddirectory.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Sub Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add Document"><img src="<?php echo base_url() .'assets/admin/images/addfile.png' ?>" style="height: 24px;">&nbsp;&nbsp; Add Document's</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Move Directory"><img src="<?php echo base_url() .'assets/admin/images/move.png' ?>" style="width: 24px;margin-top: -2px;">&nbsp;&nbsp; Move Directory</a></div> 
											<div><a href="<?php echo site_url('admin/category/rename/'.base64_encode($category->id)); ?>" title="Rename folder"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Rename folder</a></div> 
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Delete Directory"><img src="<?php echo base_url() .'assets/admin/images/trashcan.gif' ?>">&nbsp;&nbsp; Delete Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Copy Directory"><img src="<?php echo base_url() .'assets/admin/images/copy.png' ?>" style="width: 20px;margin-top: 0px;">&nbsp;&nbsp; Copy Directory</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/ctDir.png' ?>" style="height: 24px;">&nbsp;&nbsp; Manage CustomText</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add CustomText"><img src="<?php echo base_url() .'assets/admin/images/notepad.gif' ?>">&nbsp;&nbsp; Edit Composer</a></div>
											<div><a href="<?php echo site_url('admin/category/edit/'.base64_encode($category->id)); ?>" title="Add Keyword"><img src="<?php echo base_url() .'assets/admin/images/editdocument.png' ?>" style="margin-top: -2px;">&nbsp;&nbsp; Add Keywords</a></div>
							                </div>
							                </div>
											<?php 
											}
											?>	
                        
                </div>
                </div>	
				<?php
				}
				}
				}
				?>
                
            </div>
			</div>
			<!------>
			
            
        </div>
    </div>
</div>                
<script type="text/javascript">


    $(".delete-record").click(function (e) {
        var url_path = "<?php echo base_url('admin_categories/deleteRecord'); ?>";
        var img_path = "<?php echo base_url();?>assets/admin/images/default.svg";
        e.preventDefault()
        var id = $(this).attr('id');
        var dataString = 'id=' + id;
		//alert(url_path);
		//alert(img_path);
        $.confirm({
            title: 'Deleting Confirmation',
            content: 'Are you sure you want to Delete?',
            animation: 'scale',
            closeAnimation: 'scale',
            opacity: 0.5,
            buttons: {
                confirm: {
                    text: 'Yes, sure!',
                    btnClass: 'btn-primary',
                    action: function () {
                        e.preventDefault();

                        $.ajax({
                            type: "POST",
                            url: url_path,
                            data: dataString,
                            cache: false,
                            beforeSend: function () {
                                $.loader('on', img_path);
                            },
                            success: function (data) {
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);

                            },
                            complete: function () {
                                $.loader("off", img_path);
                            }
                        });

                    }
                },
                cancel: function () {
                    //$.alert('you clicked on <strong>cancel</strong>');
                },
            }
        });
    });

    function confirm_status(sts, id, ip) {
        var url_path = "<?php echo base_url('admin_categories/changeStatus'); ?>";
        var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";
        var dataString = 'id=' + id + '&sts=' + sts;
        
        if (id) {
            $.ajax({
                type: "POST",
                url: url_path,
                data: dataString,
                cache: false,
                beforeSend: function () {
                    $.loader('on', img_path);
                },
                success: function (data) {

                    setTimeout(function () {
                        location.reload();
                    }, 1000);

                },
                complete: function () {
                    $.loader("off", img_path);
                }
            });
        }
    }

</script>