<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo $breadcrumb; ?>
        <div class="x_panel">
            <div class="x_title">
                <ul class="nav  panel_toolbox">
                    <li><a href="<?php echo base_url(); ?>admin/dbbackup/add"><span
                                    class="">ADD</span></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
				<h1 style="text-align: center;"><?php echo $title; ?></h1>
            </div>
            <div class="x_content table-responsive">
                <?php  get_flashdata(); ?>
                <table id="myTable" class="table table-bordered table-striped sortable display">
                    <thead style="background-color: #2A3F54; color: white;">
                    <tr class="headings">
                        <th data-defaultsign="AZ">ID <i
                                    class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                        </th>
                        <th data-defaultsign="AZ">Name <i
                                    class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                        </th>
                        <th data-defaultsign="month">Created On <i
                                    class="glyphicon glyphicon-sort icon-hover pull-right"></i>
                        </th>
                        
                        
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="target-content">
                    <?php
					if(!empty($country))
					{
                    foreach ($country as $rows) {
						//dd($rows);
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
                        } //print_r($rows);
                        ?>
                        <tr style="">
                            <td class="col-md-2">#<?php echo(!empty($rows) && is_object($rows) ? $rows->id : ''); ?></td>
                            <td class="col-md-2"><?php echo(!empty($rows) && is_object($rows) ? $rows->name : ''); ?></td>
                            <td class="col-md-2"><?php echo(!empty($rows) && is_object($rows) ? $rows->created_on : ''); ?></td>
                            <td class="text-center">
                                <a title="Download Database"
                                   href="<?php echo $rows->path; ?>" download><span
                                            class="glyphicon glyphicon-save castumicon" style="color:#008000"></span></a>
                                <a title="Delete" href="javascript:void(0);" id="<?php echo $rows->id;?>" data-folder_name="<?php echo $rows->name;?>"
                                   class="delete-record"
                                   id="<?php echo(!empty($rows) && is_object($rows) ? $rows->id : ''); ?>"><span
                                            class="glyphicon glyphicon-trash" style="color:#cc0000"></span></a>
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
        var url_path = "<?php echo base_url('admin_dbbackup/deleteRecord'); ?>";
        var img_path = "<?php echo base_url();?>/assets/admin/images/default.svg";

        e.preventDefault()
        var id = $(this).attr('id');
        var folder_name = $(this).attr('data-folder_name');
        var dataString = 'id=' + id;
         //alert(id);
		 //alert(url_path);
		 //return false;
        $.confirm({
            title: 'Deleting Confirmation',
            content: 'Are you sure you want to Delete '+folder_name+'?',
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
        var url_path = "<?php echo base_url('admin_country/changeStatus'); ?>";
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
</script>
           