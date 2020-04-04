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
    <?php echo $this->session->flashdata('delete_message'); ?>
</div>
<?php } ?>
	<div class="row">
		<div class="col-md-3">
			<!-- Profile Image -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Manage Admin Settings</h3>
				</div>
				<div class="box-body no-padding" style="display: block;">
					<ul class="nav nav-pills nav-stacked">

					<li><a href="<?php echo base_url('company/profile'); ?>">Personal Details</a></li>

					<li><a href="<?php echo base_url('company/change_password'); ?>">Change Password</a></li>

					<li><a href="<?php echo base_url('company/details'); ?>">Company Settings</a></li>					

					<li class="active"><a href="<?php echo base_url('company/location'); ?>">Locations / Branches</a></li>

					</ul>
				</div>
				<!-- /.box-body -->
			</div>        
		</div>
		<!-- /.col -->
		<div class="col-md-9">

			<div class="box box-default">
				<div class="box-body">
					<div class="row">
						<div class="col-md-9">
							<div class="caption"><i class="glyphicon glyphicon-map-marker"></i><span class="caption-subject font-green-haze bold uppercase">Location List</span></div>
						</div> 
						<div class="col-md-3">
							<a class="btn green-haze btn-outline btn-circle btn-sm" href="<?php echo base_url('company/add'); ?>"><i class="fa fa-plus"></i>  Add New Location
                    		</a>
						</div>
					</div>
				</div>
			</div>

			<div class="box">
				<!-- /.box-header -->
				<div class="box-body">
					<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
						<div class="row">
							<div class="col-sm-12">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-advance table-hover" id="item_list">
			                            <thead>
			                                <tr>
			                                    <th>
			                                        <i class="fa"></i><b> Location Name </b>
			                                    </th>
			                                    <th>
			                                        <i class="fa"></i><b> Delivery Address </b>
			                                    </th>
			                                    <th>
			                                        <i class="fa "></i><b> Default Location </b>
			                                    </th> 
			                                    <th>
			                                        <i class="fa "></i><b> Phone </b>
			                                    </th> 
			                                    <th>
			                                        <i class="fa "></i><b> Action </b>
			                                    </th> 
			                                </tr>
			                            </thead>
			                            <tbody>
			                                <?php foreach($lists as $ls) { ?>
			                                	<tr>
			                                		<td><?php echo $ls['name']; ?></td>
			                                		<td><?php echo $ls['address']; ?></td>
			                                		<td><?php echo $ls['is_default']=='1'?'Yes':'No'; ?></td>
			                                		<td><?php echo $ls['phone']; ?></td>
			                                		<td>
			                                			<?php
				                                            echo anchor("company/edit/".$row['id'],"<i class='icon-pencil'></i>",array("class" => "btn paddd btn-xs btn-success", "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Edit")).' ';

				                                            echo anchor("company/delete/".$row['id'],"<i class='icon-trash'></i>",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn paddd btn-xs btn-danger", "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Delete"));
			                                            ?>
			                                		</td>

			                                	</tr>
			                                <?php } ?>
			                            </tbody>
			                        </table>
								</div>
							</div>
							<!-- /.nav-tabs-custom -->
						</div>
						<!-- /.col -->
					</div>
				</div>
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
        'autoWidth'   : true
    })
    });
</script>