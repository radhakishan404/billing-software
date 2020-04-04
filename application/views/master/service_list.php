
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
                    <div class="caption"><i class="glyphicon glyphicon-cog"></i><span class="caption-subject font-green-haze bold uppercase">Service List</span></div>
                    <a class="btn green-haze btn-outline btn-circle btn-sm" href="<?php echo base_url('service/add'); ?>"><i class="fa fa-plus"></i>  Add Service
                    </a>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <!-- <div class="table-responsive"> -->
                        <!-- <div class="dataTab/les_length"> -->
                        <table class="table table-striped table-bordered table-advance table-hover" id="item_list">
                            <thead>
                                <tr>
                                    <th style="width: 10%">
                                        <i class="fa"></i><b> Service Name </b>
                                    </th>
                                    <th>
                                        <i class="fa"></i><b> Status </b>
                                    </th>
                                    <th>
                                        <i class="fa "></i><b> Action </b>
                                    </th> 
                                </tr>
                            </thead>
                            <tbody>
                                
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
<script src="<?php echo base_url('resources/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
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
            url : "<?php echo base_url("service/ajaxlist") ?>",
            type : 'GET'
        },
    })
    });
</script>