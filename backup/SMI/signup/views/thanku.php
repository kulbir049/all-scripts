<?php //dd($transaction_data); ?>
<div class="full-width main-layer">
    <div class="container">
        <div class="col-sm-12">
            <div class="thanks-link all-included text-center" style="text-align:center;">
			<?php get_flashdata(); ?>
             <!--    <span class="one" style="font-size: 8vw;font-weight: 100;font-stretch: condensed;color: #a69e5f;text-shadow: 1px 1px 10px;">T</span>
                <span class="two" style="font-size: 8vw;font-weight: 100;font-stretch: condensed;color: #f2a7ae;text-shadow: 1px 1px 10px;" >H</span>
                <span class="three" style="font-size: 8vw;font-weight: 100;font-stretch: condensed;color: #67d2f6;text-shadow: 1px 1px 10px;">A</span>
                <span class="four" style="font-size: 8vw;font-weight: 100;font-stretch: condensed;color: #453e5d;text-shadow: 1px 1px 10px;">N</span>
                <span class="five" style="font-size: 8vw;font-weight: 100;font-stretch: condensed;color: #9b8dc2;text-shadow: 1px 1px 10px;">K</span>
                <span class="six" style="font-size: 8vw;font-weight: 100;font-stretch: condensed;color: #fb8d68;text-shadow: 1px 1px 10px;">S</span> -->
                 <p class="text-center manuim23" style="position: relative;bottom: 22px; font-weight:bold;font-size: 26px; color: #000; margin-top: 60px; text-align: center;">Your Registration is successfull.</p>
                 <?php if($_SESSION['role_id']==3){?>
                <p class="text-center manuim23" style="position: relative;bottom: 22px; font-weight:bold;font-size: 26px; color: #000;">Your transaction id is <?php echo strtotime('now'); ?> for future reference.</p> <?php } ?>
            </div>

        </div> 
        <!-- <p style="text-align: -webkit-center;text-align-center;"><a href="<?php echo base_url(); ?>login" class="buttnyu" style="padding: 13px 25px;background-color: #c9c9c7;color: #000;font-weight: 600;transition-duration: 0.30s; text-decoration:none;">LOG IN</a></p> -->
        <p style="text-align: -webkit-center;text-align-center; margin-top: 40px;"><a href="<?php echo base_url(); ?>" class="buttnyu" style="padding: 13px 25px;background-color: #c9c9c7;color: #000;font-weight: 600;transition-duration: 0.30s; text-decoration:none;">CONTINUE BROWSING WEBSITE</a></p>
    </div>
</div>