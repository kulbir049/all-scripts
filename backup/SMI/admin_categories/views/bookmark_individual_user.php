<?php
$cat_id = (!empty($obj_data) && is_object($obj_data) ? $obj_data->parent_id : '');
//echo $action;
//dd($obj_data);
?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
               
                <div class="clearfix"></div>
                 <h1 style="text-align: center;"><?php echo $title; ?></h1>
            </div>
            <div class="x_content">

                <?php
                get_flashdata();

                $form_attr = array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'add_file_directory', 'method' => 'post', 'autocomplete' => 'off');
                echo form_open('admin_categories/bookmark_individual_user/'.$folder_id.'/'.$this->uri->segment(4), $form_attr);

                
                ?>
<input type="hidden" name="back_url" value="<?php echo $this->uri->segment(4);?>">
<input type="hidden" name="folder_id" value="<?php echo $folder_id;?>">
                <div class="item form-group">
                    <h3 class="control-label col-md-3 col-sm-3 col-xs-12">Member Email or Member ID or User name
                    </h3>
                    
                </div>
                

 <div class="x_content table-responsive">
                <table id="myTable" class="table table-bordered table-striped sortable display">
                    <thead style="background-color: #2A3F54; color: white;">
                        <tr class="headings">
                            <th> Select  <i class="glyphicon glyphicon-sort icon-hover pull-right"></i> </th>
                            <th> Member ID <i class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                            </th>
                            <!--<th> Last Name <i class="glyphicon glyphicon-sort icon-hover pull-right"></i>-->
                            </th>
                            <th data-defaultsign="AZ">Email <i
                                    class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                            </th>
                            <th data-defaultsign="AZ">User name <i
                                    class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                            </th>
                            <th data-defaultsign="AZ">City <i
                                    class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                            </th>       
                             <th data-defaultsign="AZ">State <i
                                    class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                            </th>
                            

                        </tr>
                    </thead>
                    <tbody id="target-content">
                        <?php
                        if(!empty($get_all_user_list)){
                        foreach ($get_all_user_list as $rows){
                            $CI = & get_instance();
                            $CI->load->model('viewcart/Main_model');
                            $member_plan = $CI->Main_model->tablename_sin_col("subscribe_membership_plan","user_email",$rows->user_email);
                            //dd($member_plan['0']);
                            ?>
                            <tr>
                                <td>
                                <input type="checkbox" name="user_detail[]" id="user_detail" class="form-control" autocomplete="off" value="<?php echo $rows->user_id;?>" style="width:16px;">
                            </td>
                                <td><a title="Login" href="<?php echo site_url('login/signIn/'.base64_encode($rows->user_id)); ?>" target="_blank"><?php echo (!empty($rows) && is_object($rows) ? $rows->user_id : ''); ?></a></td>
                               
                                <td><a href="mailto:<?php echo $rows->user_email;?>"><?php echo (!empty($rows) && is_object($rows) ? $rows->user_email : ''); ?></a></td>
                                <td><a title="Login" href="<?php echo site_url('login/signIn/'.base64_encode($rows->user_id)); ?>" target="_blank"><?php echo $rows->user_login_id;?></a></td>
                                <td><?php echo $rows->city; ?></td>
                                 <td><?php echo $rows->state; ?></td>
                                

                        
                        
                        </tr>
                        <?php }} ?>
                        
                    </tbody>
                </table>
            </div>


                                        
                            
                
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3 pull-right"><input type="submit" class="btn btn-success my_button_new" name="submits" value="Submit">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
      $(document).ready(function() {
       //$('#myTable').dataTable();
       $('#myTable').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    });

    $("#myTable tr").click(function() {
    var selected = $(this).hasClass("highlight");
    $("#myTable tr").removeClass("highlight");
    if(!selected)
            $(this).addClass("highlight");
});
</script>