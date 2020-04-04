<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources'); ?>/custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css"/>

<link rel="stylesheet" href="<?php echo base_url('resources/materialDate'); ?>/css/bootstrap-material-datetimepicker.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
<!-- <script type="text/javascript" src="https://rawgit.com/FezVrasta/bootstrap-material-design/master/dist/js/material.min.js"></script> -->
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('resources/materialDate'); ?>/js/bootstrap-material-datetimepicker.js"></script>
<script type="text/javascript">
$(function () {
$('.materialDate').bootstrapMaterialDatePicker
    ({
        time: false,
        clearButton: true,
        format: 'DD-MM-YYYY'
    });
});
</script>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="caption"><i class="icon-equalizer "></i><span class="caption-subject font-green-haze bold uppercase">Package Add</span></div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add');
                    echo form_open_multipart(base_url('package/add'), $attributes);
                ?>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label require">User Name </label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon" for="name">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <select  class="form-control selectname" name="name" id="name" data-hide-disabled="true" data-live-search="true" required>
                                        <option value="">Select</option>
                                        <?php foreach ($users as $u) { ?>
                                            <option value="<?php echo $u['id']; ?>"><?php echo $u['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="name_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="s_date" class="col-sm-4 control-label require">Start Date</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-o"></i>
                                    </div>
                                    <input type="text" class="form-control materialDate" id="s_date" name="s_date" placeholder="dd-mm-yyyy" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="s_date_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-4 control-label require">End Date</label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-o"></i>
                                    </div>
                                    <input type="text" class="form-control materialDate" id="e_date" name="e_date" placeholder="dd-mm-yyyy" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="e_date_error" class="error" style="display: none;">This field is required.</label>
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
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="status_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo base_url('package/lists'); ?>" class="btn btn-info btn-flat">Cancel</a>
                        <button class="btn btn-primary pull-right btn-flat" type="submit" id="btnSubmit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            if($.trim($('#s_date').val()).length == 0)
            {
                document.getElementById('s_date_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('s_date_error').style.display = 'none';
            }
            if($.trim($('#e_date').val()).length == 0)
            {
                document.getElementById('e_date_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('e_date_error').style.display = 'none';
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