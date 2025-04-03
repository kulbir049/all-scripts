<?php 
error_reporting(0);
?>


<style type="text/css">
    .newslatter ul{margin-left: 35px!important;}
</style>
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

        <?php echo $breadcrumb; ?>

        <div class="x_panel">

            <div class="x_title">

                <ul class="nav navbar-right " style="display: flex;">

                   <?php 
                   if(isset($specialcodelist['id'])){

                    ?>
                    <li> <a title="Edit" href="<?php echo site_url('admin/specialcode/edit/'.base64_encode($specialcodelist['id'])); ?>"><span class="glyphicon glyphicon-pencil castumicon" style="color:#008000" ></span></a>
                    </li>
                    <!-- <li> <a title="Edit" href="<?php echo site_url('admin_gallery/editNews/'.base64_encode($specialcodelist['id'])); ?>"><span class="glyphicon glyphicon-picture castumicon" style="color:#008000" ></span></a>
                    </li> -->
                <?php } ?>

            </ul>

            <div class="clearfix"></div>

        </div>


        <div class="x_content">

            <?php

            get_flashdata();

            





            ?>

            

            <div class="item form-group">

               
                

            </div>


            <br/>
            




            <div class="item form-group">

              

               <div class="col-sm-12 col-xs-12 newslatter">

                   <?php echo $specialcodelist['content_text'];?>

               </div>

           </div>
           

           <div class="ln_solid"></div>
<p style="text-align: center;">
           <a href="<?php echo site_url();?>" style="text-decoration:underline;color:rgb(93,93,93)" target="_blank">Unsubscribe <span class="il">example@gmail.com</span><span></span></a>
    </p>       


       </div>

<?php /*
<?php echo site_url();?>admin_specialcode/sendMail/<?php echo base64_encode($specialcodelist['id']);?>?type=premiumUser
<?php echo site_url();?>admin_specialcode/sendMail/<?php echo base64_encode($specialcodelist['id']);?>?type=standardUser

<?php echo site_url();?>admin_specialcode/sendMail/<?php echo base64_encode($specialcodelist['id']);?>?type=allUser
*/


?>

       <div class="col-md-3 col-sm-3 col-xs-12">
        <a href="javascript:void(0)" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal_premiumUser">Send to Premium users</a>
        

    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <a href="javascript:void(0)" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal_standardUser">Send to Standard users</a>
        

    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <a href="javascript:void(0)" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal_alluser">Send to All users</a>
        

    </div>
    <div class="col-xs-12">
        
        <form action="<?php echo site_url();?>admin_specialcode/sendMailOnEmails" method="post">
            <input type="hidden" name="newslatterID" value="<?php echo $specialcodelist['id'];?>">
            <textarea class="form-control" style="height: 100px;" name="email_address"></textarea>
            <br/>
            <input type="submit" name="multiple_send" value="Send" class="btn btn-info btn-lg" >
        </form>
        

    </div>




</div>
</div>

</div>




<div id="myModal_premiumUser" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Premium User Emails</h4>
      </div>
      <div class="modal-body">
        <textarea style="width: 100%; height: 300px; "><?php echo implode(', ',$premium_user_email); ?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal_standardUser" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Standard User Emails</h4>
      </div>
      <div class="modal-body">
        <textarea style="width: 100%; height: 300px; "><?php echo implode(', ',$standard_user_email); ?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal_alluser" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">All User Emails</h4>
      </div>
      <div class="modal-body" >
        <textarea  style="width: 100%; height: 300px;"><?php echo implode(', ',$all_user_email); ?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send newslatter confirmation</h4>
    </div>
    <div class="modal-body">
        <form action="<?php echo site_url('admin/specialcode/sendMail/'.base64_encode($specialcodelist['id'])); ?>" method="post">
            <select name="user_type" required="true" class="form-control" id="selectSendOption">
                <option value="">Select Option</option>
                <option value="0" disabled>All User</option>
                <option value="1" disabled>Standard User</option>
                <option value="2" disabled>Premium User</option>
                <option value="3" >Individual</option>
            </select>
            <input type="hidden" name="list_email" id="list_email" placeholder="abc@gmail.com, xyz@gmail.com" class="form-control">
            <input type="submit" name="submit" class="btn btn-info" value="Confirm & Send">
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>

</div>
</div>               




<script type="text/javascript">
    $('#selectSendOption').on('change', function() {
      if(this.value==3){
        $('#list_email').attr('type','text');
        $('#list_email').attr('required','true');
    }else{
        $('#list_email').attr('type','hidden');
        $('#list_email').removeAttr('required');
    }
});

    
</script>