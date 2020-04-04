<style type="text/css">
    .input-group
    {
        display: -webkit-box;
    }
</style>
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
                    echo form_open_multipart(base_url('product/edit/'.$id), $attributes);
                ?>
                <?php echo validation_errors(); ?>
                    <div class="box-body">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label require">Product Name </label>
                                <div class="input-group col-sm-6">
                                    <input type="name" name="name" class="form-control" id="name" placeholder="Product Name" value="<?php echo $detail[0]['name']; ?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-6">
                                    <label id="name_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hsn" class="col-sm-4 control-label require">HSN/SAC</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" name="hsn" class="form-control" id="hsn" placeholder="HSN/SAC" value="<?php echo $detail[0]['hsn']; ?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-6">
                                    <label id="hsn_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="col-sm-4 control-label require">Quantity</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Quantity" value="<?php echo $detail[0]['quantity']; ?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-6">
                                    <label id="quantity_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tax" class="col-sm-4 control-label require">Tax Type</label>
                                <div class="input-group col-sm-6">
                                    <select class="form-control select2" name="tax" id="tax" tabindex="-1" aria-hidden="true">
                                        <option value=""></option>
                                        <option value="GST@0" <?php echo $detail[0]['tax']='GST@0'?'selected':''; ?>>GST@0</option>
                                        <option value="GST@12" <?php echo $detail[0]['tax']='GST@12'?'selected':''; ?>>GST@12</option>
                                        <option value="GST@28" <?php echo $detail[0]['tax']='GST@28'?'selected':''; ?>>GST@28</option>
                                        <option value="GST@5" <?php echo $detail[0]['tax']='GST@5'?'selected':''; ?>>GST@5</option>
                                        <option value="GST@3" <?php echo $detail[0]['tax']='GST@3'?'selected':''; ?>>GST@3</option>
                                        <option value="GST@0.25" <?php echo $detail[0]['tax']='GST@0.25'?'selected':''; ?>>GST@0.25</option>
                                        <option value="GST@18" <?php echo $detail[0]['tax']='GST@18'?'selected':''; ?>>GST@18</option>
                                    </select>
                                </div>
                                <div class="col-md-offset-4 col-sm-6">
                                    <label id="tax_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-4 control-label">Description</label>
                                <div class="input-group col-sm-6">
                                    <textarea name="description" class="form-control"><?php echo $detail[0]['description']; ?></textarea>
                                </div>
                                <div class="col-md-offset-4 col-sm-6">
                                    <label id="description_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="purchase" class="col-sm-4 control-label require">Purchase Price</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" name="purchase" class="form-control" id="purchase" placeholder="Purchase Price" value="<?php echo $detail[0]['purchase']; ?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-6">
                                    <label id="purchase_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sale" class="col-sm-4 control-label require">Sale Price</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" name="sale" class="form-control" id="sale" placeholder="Sale Price" value="<?php echo $detail[0]['sale']; ?>">
                                </div>
                                <div class="col-md-offset-4 col-sm-6">
                                    <label id="sale_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-4 control-label require">Status</label>
                                <div class="input-group col-sm-6">
                                    <select name="status" id="status" class="form-control select2" data-placeholder="Select a State">
                                        <option value="">Select</option>
                                        <option value="1" <?php echo $detail[0]['status']='1'?'selected':''; ?>>Active</option>
                                        <option value="0" <?php echo $detail[0]['status']='0'?'selected':''; ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-offset-4 col-sm-6">
                                    <label id="status_error" class="error" style="display: none;">This field is required.</label>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="<?php echo base_url('product/lists'); ?>" class="btn btn-info btn-flat">Cancel</a>
                                <button class="btn btn-primary pull-right btn-flat" type="submit" id="btnSubmit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $('#btnSubmit').click(function(){

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

        if($.trim($('#hsn').val()).length == 0)
        {
            document.getElementById('hsn_error').style.display = 'contents';
            $(window).scrollTop(0);
            return false;
        }
        else
        {
            document.getElementById('hsn_error').style.display = 'none';
        }

        if($.trim($('#quantity').val()).length == 0)
        {
            document.getElementById('quantity_error').style.display = 'contents';
            $(window).scrollTop(0);
            return false;
        }
        else
        {
            document.getElementById('quantity_error').style.display = 'none';
        }
        if($.trim($('#tax').val()).length == 0)
        {
            document.getElementById('tax_error').style.display = 'contents';
            $(window).scrollTop(0);
            return false;
        }
        else
        {
            document.getElementById('tax_error').style.display = 'none';
        }
        if($.trim($('#purchase').val()).length == 0)
        {
            document.getElementById('purchase_error').style.display = 'contents';
            $(window).scrollTop(0);
            return false;
        }
        else
        {
            document.getElementById('purchase_error').style.display = 'none';
        }
        if($.trim($('#sale').val()).length == 0)
        {
            document.getElementById('sale_error').style.display = 'contents';
            $(window).scrollTop(0);
            return false;
        }
        else
        {
            document.getElementById('sale_error').style.display = 'none';
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
</script>