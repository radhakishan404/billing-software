<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="caption"><i class="glyphicon glyphicon-cog"></i><span class="caption-subject font-green-haze bold uppercase">Service Add</span></div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add');
                    echo form_open_multipart(base_url('user/add'), $attributes);
                ?>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label require">Service Name </label>
                                <div class="input-group col-sm-8">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-cog"></i>
                                    </div>
                                    <input type="name" name="name" class="form-control" id="name" placeholder="Enter Name">
                                </div>
                                <div class="col-md-offset-4 col-sm-8">
                                    <label id="name_error" class="error" style="display: none;">This field is required.</label>
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
                        <a href="<?php echo base_url('user/lists'); ?>" class="btn btn-info btn-flat">Cancel</a>
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
