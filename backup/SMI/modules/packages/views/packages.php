
	<section class="inner-slider-container">
		<div id="inner-page-slider" class="owl-carousel">
		<?php
		foreach($banner as $bannerData){
		?>
		  <div class="item">
			  <?php
				$path = FCPATH . 'assets/uploads/banner_image/' . $bannerData->image;
				if (file_exists($path) && ($bannerData->image!= "")) {
				?>
				<img class="d-block w-100" src="<?php echo base_url(); ?>assets/uploads/banner_image/<?php echo $bannerData->image; ?>">
				<?php } else { ?>
				<img src="<?php echo base_url(); ?>assets/image/no_image.jpg"
                             class="d-block w-100">
           <?php } ?>
		      <div class="inner-slider-caption">
		      	<?php echo $bannerData->link; ?>
		      </div>
		  </div>
		<?php } ?>
		 
		</div>

		<a href="javascript:void 0;" class="inner-slider-btn prev-custom"><img src="<?php echo base_url();?>assets/images/left-arrow.png"></a>
		<a href="javascript:void 0;" class="inner-slider-btn next-custom"><img src="<?php echo base_url();?>assets/images/right-arrow.png"></a>
	</section>
<div class="breadcrumb-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb mb-0 custom px-0">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
					<li class="breadcrumb-item active">Package</li>
					
			  	</ol>
			</div>
		</div>
	</div>
</div>

	<section class="content-box">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="box effect2 text-center">
						<div class="tab-heading mb-4"><?php echo $package['title']; ?></div>
						<h5><?php echo $package['content_text']; ?></h5>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php include "footer.php"; ?>
<script>
	$(document).ready(function() {
	 
	  var owl = $("#inner-page-slider");
	 
	  owl.owlCarousel({
	    items:1,
	    loop:true,
	    autoplay:true,
	    autoplayTimeout:3000000,
	    autoplayHoverPause:true,
	    dots:false,
	    animateOut: 'zoomOut',
    	animateIn: 'zoomIn',
	});
	$('.inner-slider-btn.prev-custom').on('click',function(){
	    owl.trigger('prev.owl.carousel');
	})
	$('.inner-slider-btn.next-custom').on('click',function(){
	    owl.trigger('next.owl.carousel');
	})
	 
	});
</script>
</body>
</html>
