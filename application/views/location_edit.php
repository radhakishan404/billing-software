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
							<div class="caption"><i class="glyphicon glyphicon-map-marker"></i><span class="caption-subject font-green-haze bold uppercase">Location Edit</span></div>
						</div> 
					</div>
				</div>
			</div>
			<div class="box box-default">
				<?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add','style' => 'padding-top : 10px;');
                    echo form_open_multipart(base_url('company/edit/'.$id), $attributes);
                ?>
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label require">Location Name </label>
						<div class="col-sm-6">
							<input type="name" name="name" class="form-control" id="name" placeholder="Location Name" value="<?php echo $details[0]['name']; ?>">
						</div>
						<div class="col-md-offset-3 col-sm-8">
							<label id="name_error" class="error" style="display: none;">This field is required.</label>
						</div>
					</div>
					<div class="form-group">
						<label for="address" class="col-sm-3 control-label require">Delivery Address </label>
						<div class="col-sm-6">
							<input type="name" name="address" class="form-control" id="address" placeholder="Delivery Address" value="<?php echo $details[0]['address']; ?>">
						</div>
						<div class="col-md-offset-3 col-sm-8">
							<label id="address_error" class="error" style="display: none;">This field is required.</label>
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-sm-3 control-label require">Phone </label>
						<div class="col-sm-6">
							<input type="name" name="phone" class="form-control" id="phone" placeholder="Enter Name" data-inputmask='"mask": "9999999999"' data-mask value="<?php echo $details[0]['phone']; ?>">
						</div>
						<div class="col-md-offset-3 col-sm-8">
							<label id="phone_error" class="error" style="display: none;">This field is required.</label>
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-3 control-label require">Email</label>
						<div class="col-sm-6">
							<input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo $details[0]['email']; ?>">
						</div>
						<div class="col-md-offset-3 col-sm-8">
							<label id="email_error" class="error" style="display: none;">This field is required.</label>
						</div>
					</div>

					<?php if($details[0]['is_default'] == '1') { ?>
					<div class="form-group">
						<label for="is_default" class="col-sm-3 control-label require">Default</label>
						<div class="col-sm-6">
							<select name="is_default" id="is_default" class="form-control select2" data-placeholder="Select a State">
	                            <option value="">Select</option>
	                            <option value="1" <?php echo $details[0]['is_default']=='1'?'selected':''; ?>>Yes</option>
	                            <option value="0" <?php echo $details[0]['is_default']=='0'?'selected':''; ?>>No</option>
	                        </select>
	                    </div>
						<div class="col-md-offset-4 col-sm-8">
							<label id="is_default_error" class="error" style="display: none;">This field is required.</label>
						</div>
					</div>
					<?php } ?>
					<div class="box-footer">
			      		<a href="<?php echo base_url('company/location'); ?>" class="btn btn-info btn-flat">Cancel</a>
			      		<button class="btn btn-primary pull-right btn-flat" type="submit" id="btnSubmit">Submit</button>
			      	</div>
	      		</form>
			</div>
		</div>	
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<script type="text/javascript">

    $(document).ready(function () {
        $('#btnSubmit').click(function(){
	        // customer error
	        if($.trim($('#name').val()).length == 0)
	        {
	            document.getElementById('name_error').style.display = 'contents';
	            $(window).scrollTop(0);
	            return false;
	        }
	        else
	        {
	            document.getElementById('name_error').style.display = 'none';
	        }
	        if($.trim($('#address').val()).length == 0)
	        {
	            document.getElementById('address_error').style.display = 'contents';
	            $(window).scrollTop(0);
	            return false;
	        }
	        else
	        {
	            document.getElementById('address_error').style.display = 'none';
	        }
	        if($.trim($('#phone').val()).length == 0)
	        {
	            document.getElementById('phone_error').style.display = 'contents';
	            $(window).scrollTop(0);
	            return false;
	        }
	        else
	        {
	            document.getElementById('phone_error').style.display = 'none';
	        }
	        if($.trim($('#email').val()).length == 0)
	        {
	            document.getElementById('email_error').style.display = 'contents';
	            $(window).scrollTop(0);
	            return false;
	        }
	        else
	        {
	            document.getElementById('email_error').style.display = 'none';
	        }
	        if($.trim($('#is_default').val()).length == 0)
	        {
	            document.getElementById('is_default_error').style.display = 'contents';
	            $(window).scrollTop(0);
	            return false;
	        }
	        else
	        {
	            document.getElementById('is_default_error').style.display = 'none';
	        }
	    });
    });

</script>