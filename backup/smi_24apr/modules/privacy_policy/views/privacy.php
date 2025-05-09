<?php include "header.php"; ?>

	<section class="privacy-banner" style="background-color: #000; height: 400px;">
		<figure class="register-content-box">
			<h1><?php echo $privacys_details['title'];?></h1>
		</figure>
	</section>
	<div class="breadcrumb-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
					<ol class="breadcrumb mb-0 custom px-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
						<li class="breadcrumb-item active">Privacy policy</li>
					</ol>				
			</div>
		</div>
	</div>
</div>
	<section class="core-values-container">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-justify">
	  				<?php echo $privacys_details['content_text'];?>
				</div>
			</div>
	  	</div>
	</section>
