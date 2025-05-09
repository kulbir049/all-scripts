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
<?php ?>
<!--Start about section-->
<div class="row" style="margin: 0 0 0 0;">
	<div class="container">
		<div class="about">
			<h1 style="text-align: left; font-family: 'Roboto', sans-serif; "><?php echo $about_us['page']; ?></h1>
			<div style="font-size: 15px;"><?php echo $about_us['content_text']; ?></div>
		</div>
	</div>
</div>
<!--End about section-->
<!--Start General Information section-->
<div class="row" style="margin: 0 0 0 0;">
	<div class="container">
		<div class="general">
			<h3 style="text-align: left; font-family: 'Roboto', sans-serif; font-size: 20px;"><?php echo $Home_Section6->title;?></h3>
			<div style="text-align: left; font-size: 15px;"><?php echo $Home_Section6->description;?></div>
		</div>
	</div>
</div>
<!--End General Information section-->
<!--Start Browser composer section-->
<div class="row" style="margin: 0 0 0 0 ">
	<div class="container">
		<div class="browse">
			<h2 style="font-family: 'Roboto', sans-serif; font-size: 20px;text-align: center;">All Composers</h2>
			<?php if(count($banner)>0)
			{
			foreach($banner as $composerData){
			$path = FCPATH . 'assets/uploads/composers_image/' . $composerData->image;
			?>
			<div class="c2">
				<?php if (file_exists($path) && ($composerData->image!= "")) 
				{
				?>
				<a href="<?php echo base_url();?>home/profile_details/<?php echo $composerData->id; ?>">
					<img src="<?php echo base_url(); ?>assets/uploads/composers_image/<?php echo $composerData->image; ?>" alt="<?php echo $composerData->name; ?>"></a>
				<?php 
				} 
				else 
				{
				?>
				<img src="<?php echo base_url(); ?>assets/image/no_image.jpg" class="d-block w-100">
				<?php 
				} 
				?>
				<p class="comp-title"><a class="profile_link_p_a" href="<?php echo base_url();?>home/profile_details/<?php echo $composerData->id; ?>"><?php echo $composerData->name; ?></a></p>
			</div>
			<?php
			}
			}
			?>
			
			
			
			
			
			
			
		 
		</div>

	</div>

</div>
<!--End Browser composer section-->
<hr>