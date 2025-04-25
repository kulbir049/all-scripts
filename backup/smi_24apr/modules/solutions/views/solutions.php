
<section class="feature1-banner-container">
		<div class="overlay">
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 p-0">
					<img src="<?php echo base_url()?>assets/uploads/benefit_image/<?php echo $solutions['image']; ?>" class="img-fluid">
					<figure class="register-content-box">
						<h1><?php echo $solutions['title']; ?></h1>
					</figure>
				</div>
			</div>
		</div>
	</section>
<div class="breadcrumb-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb mb-0 custom px-0">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Benifits</a></li>
					<li class="breadcrumb-item active"><?php echo $solutions['title']; ?></li>
				</ol>
			</div>
		</div>
	</div>
</div>

	<section class="vertical-features-tab-section pb-5">
		<div class="fetaures-tabs-row">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-lg-3">
						<ul class="nav nav-tabs flex-column" id="features-main-tab">
						<?php
						$j=1;
						foreach ($sol_tab as $soltab) { ?>
						  <li class="nav-item"><a class="nav-link <?php if($j=='1')echo"active";?>"  data-toggle="tab"  href="#tab-<?php echo $soltab->id; ?>"><?php echo $soltab->title; ?></a></li>
							<?php $j++;} ?>

						</ul>
					</div>

					<div class="col-md-8 col-lg-9">
						<div class="tab-content" id="myTabContent">
						<?php
							$i=1;
							foreach ($sol_tab as $soltab) { ?>						
						  <div class="card tab-pane fade show <?php if($i=='1')echo"active";?>" id="tab-<?php echo $soltab->id; ?>">
						  	<div class="container-fluid">
						  		<div class="row">
						  			<div class="card-header col-sm-12" role="tab" id="heading-A">
			               				<h5 class="mb-0">
											<a data-toggle="collapse" href="#collapse-<?php echo $soltab->id; ?>">
						                        <?php echo $soltab->title; ?>
						                    </a>
										</h5>
						            </div>
						  		</div>

						  		<div id="collapse-<?php echo $soltab->id; ?>" class="collapse row <?php if($i==1){echo 'show';} ?>" data-parent="#myTabContent">
						  			<div class="card-body d-flex flex-wrap">
							  			<div class="col-sm-12">
											<?php
											$path = FCPATH . 'assets/uploads/tab_image/' . $soltab->image;
											if (file_exists($path) && ($soltab->image!= "")) {
											?>
											<img src="<?php echo base_url(); ?>assets/uploads/tab_image/<?php echo $soltab->image; ?>" class="img-fluid d-block mx-auto mb-4 inner-tab-img">
											<?php }else {?>
											<img src="<?php echo base_url(); ?>assets/image/no_image.jpg" class="img-fluid d-block mx-auto mb-4 inner-tab-img">
											<?php }?>
							  			</div>
							  			<div class="col-sm-12">
							  				<div class="tab-pane-content text-justify"><?php echo $soltab->description; ?></div>
							  			</div>
							  		</div>
						  		</div>
						  	</div>
						  </div>
						  <?php $i++;}?>
						</div>
				</div>
			</div>
		</div>
	</section>
