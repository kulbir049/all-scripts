                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php echo $breadcrumb; ?>
                                <div class="x_panel">
                                    <div class="x_title">
                                        <ul class="nav  panel_toolbox">
                                            <li><a href="<?php echo base_url('admin_specialcode/add'); ?>"><span class="glyphicon glyphicon-plus"></span></a>
                                            </li>
                                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" style="background-color:#000!important;">Help</a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content table-responsive">
                                        <?php get_flashdata(); ?>
                                        <table id="myTable" class="table table-bordered table-striped sortable display">
                                            <thead style="background-color: #2A3F54; color: white;">
                                                <tr class="headings">
                                                    <th data-defaultsign="AZ">ID <i
                                                            class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                                                    </th>
                                                    <th data-defaultsign="AZ">Title <i
                                                            class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                                                    </th>
                                                    <th data-defaultsign="AZ">Discount<i class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                                                    </th>

                                                    <th data-defaultsign="month">Membership Plans <i
                                                                class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                                                    </th>
                                                    <th data-defaultsign="month">Status <i
                                                                class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                                                    </th>
                                                    <th data-defaultsign="month">Created <i
                                                            class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                                                    </th>


                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="target-content">
                                                <?php
                                                foreach ($specialcodelist as $rows) {

                                                ?>
                                                    <tr style="">
                                                        <td>#<?php echo $rows['id']; ?></td>
                                                        <td class="col-md-2"><?php echo $rows['title']; ?></td>
                                                        <td class="col-md-3">
                                                            <div> <?php echo $rows['price']; ?></div>
                                                        </td>

                                                        <td class="col-md-2"><?php
                                                            echo ($rows['membership_plan'] == 3) ? "Standard" : "Premium";
                                                            ?></td>
                                                        <td class="col-md-3">
                                                            <div> <?php echo $rows['status']; ?></div>
                                                        </td>

                                                        <td class="col-md-2"><?php echo $rows['created_at']; ?></td>

                                                        <td class="text-center">
                                                            <a title="Edit" href="<?php echo site_url('admin_specialcode/edit/' . base64_encode($rows['id'])); ?>"><span class="glyphicon glyphicon-pencil castumicon" style="color:#008000"></span></a>
                                                            <a title="Delete" href="javascript:void(0);" ip="<?php echo getRealIpAddr(); ?>" class="delete-record" id="<?php echo (!empty($rows) && is_array($rows) ? $rows['id'] : ''); ?>"><span class="glyphicon glyphicon-trash" style="color:#cc0000"></span></a>


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





                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Newslatter instructions</h4>
                                    </div>
                                    <div class="modal-body">
                                        <b>How to use this ?</b>
                                        <p>description here</p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <script type="text/javascript">
                            $(".delete-record").click(function(e) {
                                var url_path = "<?php echo base_url('admin_specialcode/deleteRecord'); ?>";
                                var img_path = "<?php echo base_url(); ?>/assets/admin/images/default.svg";
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
                                            action: function() {
                                                e.preventDefault();

                                                $.ajax({
                                                    type: "POST",
                                                    url: url_path,
                                                    data: dataString,
                                                    cache: false,
                                                    beforeSend: function() {
                                                        $.loader('on', img_path);
                                                    },
                                                    success: function(data) {
                                                        setTimeout(function() {
                                                            location.reload();
                                                        }, 1000);

                                                    },
                                                    complete: function() {
                                                        $.loader("off", img_path);
                                                    }
                                                });

                                            }
                                        },
                                        cancel: function() {
                                            //$.alert('you clicked on <strong>cancel</strong>');
                                        },
                                    }
                                });
                            });

                            function confirm_status(sts, id, ip) {
                                var url_path = "<?php echo base_url('admin_specialcode/changeStatus'); ?>";
                                var img_path = "<?php echo base_url(); ?>/assets/admin/images/default.svg";
                                var dataString = 'id=' + id + '&sts=' + sts;
                                if (id) {
                                    $.ajax({
                                        type: "POST",
                                        url: url_path,
                                        data: dataString,
                                        cache: false,
                                        beforeSend: function() {
                                            $.loader('on', img_path);
                                        },
                                        success: function(data) {

                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);

                                        },
                                        complete: function() {
                                            $.loader("off", img_path);
                                        }
                                    });
                                }
                            }
                        </script>