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

						<li class="active"><a href="<?php echo base_url('company/profile'); ?>">Personal Details</a></li>

						<li><a href="<?php echo base_url('company/change_password'); ?>">Change Password</a></li>

						<li><a href="<?php echo base_url('company/details'); ?>">Company Settings</a></li>					

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
							<div class="caption-subject font-green-haze bold uppercase">Personal Settings</div>
						</div> 
					</div>
				</div>
			</div>

			<div class="box">
				<div class="box-body">
					<!-- /.box-header -->
					<?php
					$attributes = array('class' => 'form-horizontal', 'id' => 'login' );
					echo form_open_multipart(base_url('company/profile'), $attributes);
					?>
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label require" for="name">Name</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="name" id="name" value="<?php echo $details[0]['name']; ?>">
							</div>
							<div class="col-md-offset-4 col-sm-8">
								<label id="name_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label require" for="email">Email</label>

							<div class="col-sm-6">
								<input type="email" class="form-control" name="email" id="email" value="<?php echo $details[0]['email']; ?>">
							</div>
							<div class="col-md-offset-4 col-sm-8">
								<label id="email_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label require" for="number">Phone</label>

							<div class="col-sm-6">
								<input type="text" class="form-control" name="number" id="number" data-inputmask='"mask": "9999999999"' data-mask value="<?php echo $details[0]['number']; ?>">
							</div>
							<div class="col-md-offset-4 col-sm-8">
								<label id="number_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="inputEmail3">GSTIN</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="gstin" value="<?php echo $details[0]['gstin']; ?>">
							</div>
							<div class="col-md-offset-4 col-sm-8">
								<label id="gstin_error" class="error" style="display: none;">This field is required.</label>
							</div>
						</div>
						<div class="form-group">
							<label for="country_selector" class="col-sm-3 control-label require">Country</label>
							<div class="col-sm-6">
								<input type="text" name="country" class="form-control" id="country_selector" value="<?php echo $details[0]['country']; ?>">
								<div class="form-control" style="display:none;">
									<input type="text" class="foc" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here" />
								</div>
							</div>
							<div class="col-md-offset-4 col-sm-8">
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
						<label class="col-sm-3 control-label" for="profile">Profile</label>
						<div class="col-sm-6">
							<input name="file" class="form-control input-file-field" type="file" id="profile"><br>
							<input type="hidden" name="profile" value="<?php echo $details[0]['profile']; ?>">
							<img alt="Profile Image" class="img-responsive asa thumb" id="pro_img" height="80" width="80" src="<?php echo base_url('uploads/profile/'.$details[0]['profile']); ?>" >
						</div>
					</div>

					<!-- /.box-body -->
					<div class="box-footer">
						<button class="btn btn-primary pull-right btn-flat" type="submit" id="btnSubmits">Update</button>
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
	document.getElementById("profile").onchange = function () {
		var reader = new FileReader();

		reader.onload = function (e) {
	        // get loaded data and render thumbnail.
	        document.getElementById("pro_img").src = e.target.result;
	    };

	    // read the image file as a data URL.
	    reader.readAsDataURL(this.files[0]);
	};
</script>