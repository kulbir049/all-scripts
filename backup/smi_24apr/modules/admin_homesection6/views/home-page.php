<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
             <!-- <ul class="nav  panel_toolbox">
                    <li><a href="<?php echo base_url('admin/homesection6/add'); ?>"><span
                                    class="glyphicon glyphicon-plus"></span></a>
                    </li>
                </ul>-->
                <h1 style="text-align: center;"><?php echo $title; ?></h1>
                <div class="clearfix"></div>
            </div>
            <div class="x_content table-responsive">
              <?php get_flashdata(); ?>
                <table id="myTable" class="table table-bordered table-striped sortable display">
                    <thead style="background-color: #2A3F54; color: white;">
                    <tr class="headings">
                        <th data-defaultsign="AZ">Title
                             <i class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                        </th>
                        <th data-defaultsign="AZ">Description
                            <i class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                        </th>
                        <th data-defaultsign="month">Created On <i
                                    class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                        </th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="target-content">
                    <?php
                    if(!empty($home_list)) {
                        foreach ($home_list as $rows) {
                            if ($rows->status == '1') {
                                $color = 'green';
                                $tooltip = 'Active';
                                $sts = 0;
                                $icon = 'glyphicon glyphicon-ok';
                            } else {
                                $color = 'red';
                                $tooltip = 'Deactive';
                                $sts = 1;
                                $icon = 'glyphicon glyphicon-remove';
                            }
                            ?>
                            <tr style="">
                                <td class="col-md-2">
                                    <?php echo(!empty($rows) && is_object($rows) ? $rows->title : ''); ?>
                                </td>
                                <td class="col-md-2">
                                    <?php echo(!empty($rows) && is_object($rows) ? $rows->description : ''); ?>
                                </td>
                                <td class="col-md-2"><?php echo(!empty($rows) && is_object($rows) ? $rows->created_on : ''); ?></td>
                                <!--<td class="col-md-2"><?php echo(!empty($rows) && is_object($rows) ? $rows->updated_on : ''); ?></td>-->
                                <td class="col-md-2">
                                    <a href="javascript:void(0)" title="<?php echo $tooltip; ?>"
                                       onclick="confirm_status('<?php echo $sts ?>', '<?php echo $rows->id; ?>', '<?php echo getRealIpAddr(); ?>')"><span
                                                id="<?php echo 'status' . $rows->id; ?>" class="<?php echo $icon; ?>"
                                                style="color:<?php echo $color; ?>"></span></a>
                                </td>
                                <td class="text-center">
                                    <a title="Edit"
                                       href="<?php echo site_url('admin/homesection6/edit/' . base64_encode($rows->id)); ?>"><span
                                                class="glyphicon glyphicon-pencil castumicon"
                                                style="color:#008000"></span></a>
                                    <!--<a title="Delete" href="javascript:void(0);" ip="<?php echo getRealIpAddr(); ?>"
                                       class="delete-record"
                                       id="<?php echo(!empty($rows) && is_object($rows) ? $rows->id : ''); ?>"><span
                                                class="glyphicon glyphicon-trash" style="color:#cc0000"></span></a>-->
                                </td>
                            </tr>

                            <?php
                        }
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
        var url_path = "<?php echo base_url('admin_homesection6/deleteRecord'); ?>";
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
        var url_path = "<?php echo base_url('admin_homesection6/changeStatus'); ?>";
        var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";
       /* if (ip == '127.0.0.1') {
            var url_path = "/admin_city/changeStatus";
            var img_path = "/assets/admin/images/default.svg";

        } else {
            var url_path = "/homedevo/admin_city/changeStatus";
            var img_path = "/homedevo/assets/admin/images/default.svg";
        }*/
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
            