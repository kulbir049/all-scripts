            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <?php echo $breadcrumb; ?>
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav  panel_toolbox">
					
                      <li><a  href="<?php echo base_url('admin/banner/add'); ?>"><span class="">ADD</span></a>
                      </li>
                    </ul>
                     <h1 style="text-align: center;">Manage Program Notes</h1>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content table-responsive">
                      <?php  get_flashdata(); ?>
                    <table id="myTable" class="table table-bordered table-striped sortable display">
                      <thead style="background-color: #2A3F54; color: white;">
                        <tr class="headings">
                          <th >ID <i class="glyphicon glyphicon-sort icon-hover pull-right"></i></th>
                          <th >Name <i class="glyphicon glyphicon-sort icon-hover pull-right"></i></th>
                          <th >Title <i class="glyphicon glyphicon-sort icon-hover pull-right"></i></th>
                          <th>Image</th>
                          <!-- <th>Link</th> -->
                          <th>Description</th>
                          <th>Created <i class="glyphicon glyphicon-sort icon-hover pull-right"></i></th>
                          <th>Position index <i class="glyphicon glyphicon-sort icon-hover pull-right"></i></th>
                          <th>Status</th>
                          <th>Action</th>
                          </tr>
                      </thead>
                      <tbody id="target-content">
                      <?php
                        foreach($banner as $rows)
                        {
                            if ($rows['status'] == '1') {
                                $color = 'color: green';
                                $tooltip = 'Active';
                                $sts = 0;
								$icon = "glyphicon glyphicon-ok";
                            } else {
                                $color = 'color:red';
                                $tooltip = 'Deactive';
								$icon = "glyphicon glyphicon-remove";
                                $sts = 1;
                            }
                      ?>
								<tr style="" id="tr_row_<?php echo $rows['id'];?>">
                                  <td class="col-md-2">#<?php echo $rows['id'];?></td>
                                  <td class="col-md-2"><?php echo $rows['name'];?></td>
                                  <td class="col-md-2"><?php echo $rows['title'];?></td>
                                    <td class="text-center">
                                        <?php
                                        // $path = COMPOSERS_UPLODES_PATH.$rows['image'];
                                    $path = site_url() . 'assets/uploads/composers_image/' . $rows['image'];
                                         ?>
                                            <img src="<?php echo $path; ?>" alt="image" width="50" height="35" class="img-rounded">
                                        
                                    </td>
								  <!-- <td class="col-md-2"><?php echo $rows['link'];?></td> -->
                  <td class="col-md-2"><?php echo (substr(strip_tags($rows['description']),0, 100));?></td>
								  <td class="col-md-2"><?php echo $rows['created_on']; ?></td>
                                  <td class="col-md-2"><?php echo $rows['position_index']; ?></td>
                                   <td class="col-md-2">
                                   
										<a href="javascript:void(0)" title="<?php echo $tooltip; ?>" onclick="confirm_status('<?php echo $sts ?>', '<?php echo $rows['id']; ?>', '')">
                                   
                                   <span id="<?php echo 'status' . $rows['id']; ?>" class="<?php echo $icon; ?>" style="<?php echo $color; ?>" ></span></a>
                                   
                                   </td>
                                   
                                    <td class="text-center">
                                        <a title="Edit" href="<?php echo site_url('admin/banner/edit/'.base64_encode($rows['id'])); ?>"><span class="glyphicon glyphicon-pencil castumicon" style="color:#008000" ></span></a>
<?php //if($this->session->userdata('role_id')==1){ ?>
                                        <a title="Delete" href="javascript:void(0);" class="delete-record" id="<?php echo (!empty($rows) && is_array($rows) ? $rows['id'] : ''); ?>"><span class="glyphicon glyphicon-trash" style="color:#cc0000"></span></a>
<?php //} ?>                                        
                                    </td>
                                 </tr>
                      <?php
                      }
                      ?>
					
                      </tbody>
                    </table>
                  
                  </div>
                </div>
              </div>
            </div>
            <script type="text/javascript">
                $(".delete-record").click(function (e) {
                    var url_path = "<?php echo base_url('admin_banner/deleteRecord'); ?>";
                    var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";
                    e.preventDefault()
                    var id = $(this).attr('id');
                    var dataString = 'id=' + id;
                    // alert(id);
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
                                           $('#tr_row_'+id).remove(); 

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
                    var url_path = "<?php echo base_url('admin_banner/changeStatus'); ?>";
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
$(document).ready(function() {
       //$('#myTable').dataTable();
        $('#myTable').DataTable( {
        "order": [[ 5, "asc" ]]
    } );
    });
            </script>
      