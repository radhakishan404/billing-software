<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="caption"><span class="caption-subject font-green-haze bold uppercase">Edit</span></div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add');
                    echo form_open_multipart(base_url('supplier/edit/'.$id), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="box-body">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label require">Name </label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="name" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $detail[0]['name']; ?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="name_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-4 control-label require">Email</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo $detail[0]['email']; ?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="email_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="col-sm-4 control-label require">Phone</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number"  data-inputmask='"mask": "9999999999"' data-mask value="<?php echo $detail[0]['mobile']; ?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="mobile_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gstin" class="col-sm-4 control-label">GSTIN</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-registered"></i>
                                    </div>
                                    <input type="text" class="form-control" name="gstin" id="gstin" placeholder="Enter GST Number" value="<?php echo $detail[0]['gstin']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="country_selector" class="col-sm-4 control-label require">Country</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </div>
                                    <input type="text" name="country" class="form-control" id="country_selector" value="<?php echo $detail[0]['country']; ?>">
                                    <div class="form-control" style="display:none;">
                                        <input type="text" class="foc" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here" />
                                    </div>
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="country_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="state" class="col-sm-4 control-label require">State</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </div>
                                    <input type="text" name="state" class="form-control" id="state" placeholder="Enter State" value="<?php echo $detail[0]['state']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-sm-4 control-label require">City</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <input type="text" name="city" class="form-control" id="city" placeholder="Enter City" value="<?php echo $detail[0]['city']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="street" class="col-sm-4 control-label require">Street</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <input type="text" name="street" class="form-control" id="street" placeholder="Enter Street" value="<?php echo $detail[0]['street']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="zipcode" class="col-sm-4 control-label require">Zip Code</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-random"></i>
                                    </div>
                                    <input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="Enter Zip Code" value="<?php echo $detail[0]['zipcode']; ?>">
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label for="status" class="col-sm-4 control-label require">Status</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-hourglass-start"></i>
                                    </div>
                                    <select name="status" id="status" class="form-control select2" data-placeholder="Select a State">
                                        <option value="">Select</option>
                                        <option value="1" <?php echo $detail[0]['status']=='1'?'selected':''; ?>>Active</option>
                                        <option value="0" <?php echo $detail[0]['status']=='0'?'selected':''; ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="status_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo base_url('supplier/lists'); ?>" class="btn btn-info btn-flat">Cancel</a>
                        <button class="btn btn-primary pull-right btn-flat" type="submit" id="btnSubmit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('#btnSubmit').click(function(){
            // supplier error
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
            if($.trim($('#mobile').val()).length == 0)
            {
                document.getElementById('mobile_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('mobile_error').style.display = 'none';
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
            if($.trim($('#status').val()).length == 0)
            {
                document.getElementById('status_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('status_error').style.display = 'none';
            }
        });
    });

</script>