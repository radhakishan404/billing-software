<section class="content">
    <?php if($this->session->flashdata('success_message')){ ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong><?php echo $this->session->flashdata('success_message'); ?>
</div>
<?php } ?>
<?php if($this->session->flashdata('delete_message')){ ?>
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong><?php echo $this->session->flashdata('delete_message'); ?>
</div>
<?php } ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="caption"><i class="icon-equalizer "></i><span class="caption-subject font-green-haze bold uppercase">User Package</span></div>
                    <a class="btn green-haze btn-outline btn-circle btn-sm" href="<?php echo base_url('package/add'); ?>"><i class="fa fa-plus"></i>  Add New Package
                    </a>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive ">
                    <!-- <div class="table-responsive"> -->
                        <!-- <div class="dataTab/les_length"> -->
                        <table class="table table-striped table-bordered table-advance table-hover" id="item_list">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="fa "></i><b> Action </b>
                                    </th>
                                    <th>
                                        <i class="fa"></i><b> User Name </b>
                                    </th>
                                    <th>
                                        <i class="fa"></i><b> Start Date </b>
                                    </th>
                                    <th>
                                        <i class="fa"></i><b> End Date </b>
                                    </th>
                                    <th>
                                        <i class="fa"></i><b> Remain Days </b>
                                    </th>
                                    <th>
                                        <i class="fa"></i><b> Status </b>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($detail)) { ?>
                                <?php foreach ($detail as $row) { 
                                    $now = strtotime(date('Y-m-d')); // or your date as well
                                    $your_date = strtotime($row['end_date']);
                                    $datediff = $your_date - $now;

                                    $remain = round($datediff / (60 * 60 * 24));
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo anchor("package/edit/".$row['id'],"<i class='icon-pencil'></i>",array("class" => "btn paddd btn-xs btn-success", "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Edit")).' ';

                                            echo anchor("package/delete/".$row['id'],"<i class='icon-trash'></i>",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn paddd btn-xs btn-danger", "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Delete"));
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('package/edit/'.$row['id']) ?>" class="btn paddd btn-xs btn-success"><?php echo $row['name']; ?></a>
                                        </td>
                                        <td><?php echo date('d M, Y', strtotime($row['start_date'])); ?></td>
                                        <td><?php echo date('d M, Y', strtotime($row['end_date'])); ?></td>
                                        <td><?php echo max($remain,0); ?></td>
                                        <td><?php if($row['status'] == '1') { echo '<label class="btn paddd btn-xs btn-success">Active</label>'; } else { echo '<label class="btn paddd btn-xs btn-danger">Inactive</label>'; } ?></td>
                                    </tr>
                                <?php } } else { ?> 
                                    <tr>
                                        <td colspan="6" align="center">No Record Found..</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- </div> -->
                    <!-- </div> -->
                </div>
                <!-- /.box-body -->
            </div>
        <!-- /.box -->
        </div>
    <!-- /.col -->
    </div>
<!-- /.row -->
</section>
<!-- <script src="<?php echo base_url('resources/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('resources/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('resources/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#item_list').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        "ajax": {
            url : "<?php echo base_url("package/ajaxlist") ?>",
            type : 'GET'
        },
    })
    });
</script> -->