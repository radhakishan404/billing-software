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

						<li class="active"><a href="<?php echo base_url('company/details'); ?>">Company Settings</a></li>					

						<li><a href="<?php echo base_url('company/location'); ?>">Locations / Branches</a></li>

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
						<div class="col-md-12">
							<div class="caption-subject font-green-haze bold uppercase">Company Settings</div>
						</div> 
					</div>
				</div>
			</div>

			<div class="box">
				<div class="box-body">
					<!-- /.box-header -->
					<?php
					$attributes = array('class' => 'form-horizontal', 'id' => 'login');
					echo form_open_multipart(base_url('company/details'), $attributes);
					?>
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label require" for="company_name">Full Name</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo $details[0]['company_name']; ?>">
							</div>
							<div class="col-md-offset-3 col-sm-8">
								<label id="name_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="site_short_name">Site Short Name</label>
							<div class="col-sm-6">
								<input type="text" name="site_short_name" id="site_short_name" class="form-control" value="<?php echo $details[0]['site_short_name']; ?>">
							</div>
							<div class="col-md-offset-3 col-sm-8">
								<label id="site_short_name_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label require" for="company_email">Email</label>

							<div class="col-sm-6">
								<input type="email" class="form-control" name="company_email" id="company_email" value="<?php echo $details[0]['company_email']; ?>">
							</div>
							<div class="col-md-offset-3 col-sm-8">
								<label id="company_email_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label require" for="company_phone">Phone</label>

							<div class="col-sm-6">
								<input type="text" class="form-control" name="company_phone" id="company_phone" data-inputmask='"mask": "9999999999"' data-mask value="<?php echo $details[0]['company_phone']; ?>">
							</div>
							<div class="col-md-offset-3 col-sm-8">
								<label id="company_phone_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="company_gstin">GSTIN</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="company_gstin" name="company_gstin" value="<?php echo $details[0]['company_gstin']; ?>">
							</div>
							<div class="col-md-offset-2 col-sm-8">
								<label id="company_gstin_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>
						<div class="form-group">
							<label for="country_selector" class="col-sm-3 control-label require">Country</label>
							<div class="col-sm-6">
								<input type="text" name="country" class="form-control" id="country_selector" value="">
								<div class="form-control" style="display:none;">
									<input type="text" class="foc" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here" />
								</div>
							</div>
							<div class="col-md-offset-3 col-sm-8">
								<label id="country_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>
						<div class="form-group">
							<label for="state" class="col-sm-3 control-label require">State</label>
							<div class="col-sm-6">
								<input type="text" name="state" class="form-control" id="state" placeholder="Enter State" value="<?php echo $details[0]['state']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="city" class="col-sm-3 control-label require">City</label>
							<div class="col-sm-6">
								<input type="text" name="city" class="form-control" id="city" placeholder="Enter City" value="<?php echo $details[0]['city']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="street" class="col-sm-3 control-label require">Street</label>
							<div class="col-sm-6">
								<input type="text" name="street" class="form-control" id="street" placeholder="Enter Street" value="<?php echo $details[0]['street']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="zipcode" class="col-sm-3 control-label require">Zip Code</label>
							<div class="col-sm-6">
								<input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="Enter Zip Code" value="<?php echo $details[0]['zipcode']; ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" for="inputEmail3">Logo</label>
						<div class="col-sm-6">
							<input name="file" class="form-control input-file-field" type="file" id="company_logo"><br>
							<input type="hidden" name="filename" value="<?php echo $details[0]['company_logo']; ?>">
							<img alt="Company Logo" class="img-responsive asa thumb" id="pro_img" height="80" width="80" src="<?php echo base_url('uploads/company/'.$details[0]['company_logo']); ?>">
						</div>
					</div>

					<!-- /.box-body -->
					<div class="box-footer">
						<button class="btn btn-primary pull-right btn-flat" type="submit" id="btnSubmit"><?php if(!empty($details)) { echo "Update"; } else { echo "Submit"; } ?></button>
					</div>
					<!-- /.box-footer -->
				</form>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.nav-tabs-custom -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
</section>

<script type="text/javascript">
	document.getElementById("company_logo").onchange = function () {
		var reader = new FileReader();

		reader.onload = function (e) {
	        // get loaded data and render thumbnail.
	        document.getElementById("pro_img").src = e.target.result;
	    };

	    // read the image file as a data URL.
	    reader.readAsDataURL(this.files[0]);
	};
</script>


<script type="text/javascript">

	$(document).ready(function () {
		$('#btnSubmit').click(function(){
	        // customer error
	        if($.trim($('#company_name').val()).length == 0)
	        {
	        	document.getElementById('name_error').style.display = 'contents';
	        	$(window).scrollTop(0);
	        	return false;
	        }
	        else
	        {
	        	document.getElementById('name_error').style.display = 'none';
	        }
	        if($.trim($('#company_email').val()).length == 0)
	        {
	        	document.getElementById('company_email_error').style.display = 'contents';
	        	$(window).scrollTop(0);
	        	return false;
	        }
	        else
	        {
	        	document.getElementById('company_email_error').style.display = 'none';
	        }
	        if($.trim($('#company_phone').val()).length == 0)
	        {
	        	document.getElementById('company_phone_error').style.display = 'contents';
	        	$(window).scrollTop(0);
	        	return false;
	        }
	        else
	        {
	        	document.getElementById('company_phone_error').style.display = 'none';
	        }
	        if($.trim($('#country_selector').val()).length == 0)
	        {
	        	document.getElementById('country_error').style.display = 'contents';
	        	$(window).scrollTop(0);
	        	return false;
	        }
	        else
	        {
	        	document.getElementById('country_error').style.display = 'none';
	        }
	    });
	});

</script>