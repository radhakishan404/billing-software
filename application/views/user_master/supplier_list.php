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

    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-sm-4 col-xs-12">
                    <div class="caption"><span class="caption-subject font-green-haze bold uppercase">List</span></div>
                </div> 
                <div class="col-md-2 col-sm-4 col-xs-12 btn_bottom">
                </div>

                <div class="col-md-2 col-sm-4 col-xs-12">
                    <a class="btn green-haze btn-outline btn-circle btn-sm btn btn-block btn-default btn-flat" href="<?php echo base_url('supplier/add'); ?>"><i class="fa fa-plus"></i>  Add New Supplier
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-body">
            <div class="col-md-2 col-xs-6 border-right">
                <h3 class="bold"><?php echo count($total); ?></h3>
                <span>Total Suppliers</span>
            </div>
            <div class="col-md-2 col-xs-6 border-right">
                <h3 class="bold"><?php echo count($active); ?></h3>
                <span>Active Suppliers</span>
            </div>
            <div class="col-md-2 col-xs-6 border-right">
                <h3 class="bold"><?php echo count($inactive); ?></h3>
                <span>Inactive Suppliers</span>
            </div>
        </div>
        <br>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="<?php echo base_url('supplier/csv'); ?>"><button class="btn green-haze btn-outline btn-sm btn" style="float: left;"><span class="fa fa-download"> &nbsp;</span>Download CSV</button></a>                    
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered table-advance table-hover" id="item_list">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fa"></i><b> Name </b>
                                </th>
                                <th>
                                    <i class="fa"></i><b> Email </b>
                                </th>
                                <th>
                                    <i class="fa"></i><b> Mobile </b>
                                </th>
                                <th>
                                    <i class="fa"></i><b> Status </b>
                                </th>
                                <th width="10%">
                                    <i class="fa "></i><b> Action </b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($total as $r) { ?>
                                <tr>
                                    <td><a href="<?php echo base_url('supplier/edit/'.$r['id']) ?>" class="btn paddd btn-xs btn-success"><?php echo $r["name"]; ?></a></td>
                                    <td><?php echo $r['email']; ?></td>
                                    <td><?php echo $r['mobile']; ?></td>
                                    <td><?php echo $r['status']==1?'<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>'; ?></td>
                                    <td>
                                        <?php
                                        echo anchor("supplier/edit/".$r['id'],"<i class='icon-pencil'></i>",array("class" => "btn paddd btn-xs btn-success", "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Edit")).' ';

                                        echo anchor("supplier/delete/".$r['id'],"<i class='icon-trash'></i>",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn paddd btn-xs btn-danger", "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Delete"));
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        <!-- /.box -->
        </div>
    <!-- /.col -->
    </div>
<!-- /.row -->
</section>

<!-- <script src="<?php echo base_url('resources/'); ?>bower_components/jquery/dist/jquery.min.js"></script> -->
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
        'autoWidth'   : true
    });
});

</script>