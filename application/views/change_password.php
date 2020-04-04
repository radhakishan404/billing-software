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

                        <li class="active"><a href="<?php echo base_url('company/change_password'); ?>">Change Password</a></li>

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
                            <div class="caption-subject font-green-haze bold uppercase">Change Password</div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="box-body">
                    <!-- /.box-header -->
                    <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'login');
                    echo form_open_multipart(base_url('home/change_password'), $attributes);
                    ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label require" for="cpass">Current Password</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Current Password" name="cpass" id="cpass">
                            </div>
                            <div class="col-md-offset-3 col-sm-8">
                                <label_error id="cpass" class="error" style="display: none;">This field is required.</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label require" for="npass">New Password</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="New Password" name="npass" id="npass">
                            </div>
                            <div class="col-md-offset-3 col-sm-8">
                                <label id="npass_error" class="error" style="display: none;">This field is required.</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label require" for="conpass">Confirm New Password</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="New Password" name="conpass" id="conpass">
                            </div>
                            <div class="col-md-offset-3 col-sm-8">
                                <label id="conpass_error" class="error" style="display: none;">This field is required.</label>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-info btn-flat" type="reset" >Reset</button>
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

    $(document).ready(function () {
        $('#btnSubmit').click(function(){
            // customer error
            if($.trim($('#cpass').val()).length == 0)
            {
                document.getElementById('cpass_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('cpass_error').style.display = 'none';
            }
            if($.trim($('#npass').val()).length == 0)
            {
                document.getElementById('npass_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('npass_error').style.display = 'none';
            }
            if($.trim($('#conpass').val()).length == 0)
            {
                document.getElementById('conpass_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('conpass_error').style.display = 'none';
            }
        });
    });

</script>