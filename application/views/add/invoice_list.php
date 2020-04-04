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

<?php if($this->session->flashdata('success_message')){ ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong><?php echo $this->session->flashdata('success_message'); ?>
</div>
<?php } ?>
<?php if($this->session->flashdata('delete_message')){ ?>
<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
    <?php echo $this->session->flashdata('delete_message'); ?>
</div>
<?php } ?>
    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-sm-4 col-xs-12">
                    <div class="caption"><span class="caption-subject font-green-haze bold uppercase">List</span></div>
                </div> 
                <div class="col-md-2 col-sm-4 col-xs-12 btn_bottom">
                </div>

                <div class="col-md-2 col-sm-4 col-xs-12">
                    <a class="btn green-haze btn-outline btn-circle btn-sm btn btn-block btn-default btn-flat" href="<?php echo base_url('invoice/add'); ?>"><i class="fa fa-plus"></i><b> Create New Invoice</b>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-body">
            <ul class="nav nav-tabs cus" role="tablist">
                <li id="all" class="<?php if($hideclass){ echo ""; } else { echo 'active'; } ?>">
                    <a onclick="allshow()" href="<?php echo base_url('invoice/lists'); ?>"><strong>All</strong> </a>
                </li>
                <li id="Filter" class="<?php if($hideclass){ echo "active"; } else { echo ''; } ?>">
                    <a onclick="filtershow()"><strong>Filter</strong></a>
                </li>
            </ul>
            <div class="<?php if($hideclass){ echo "hideclass"; } else { echo 'activeclasss'; } ?>" id="filtering">
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'listfilter');
                    echo form_open_multipart(base_url('invoice/lists'), $attributes);
                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2" style="display: inline-block;">
                                <div class="form-group" style="margin-right: 5px">
                                    <label for="exampleInputEmail1"><b>From</b></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control materialDate" id="fromdate" type="text" name="fromdate" placeholder="dd-mm-yyyy" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php if($from_date) echo $from_date; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="margin-right: 5px">
                                    <label for="exampleInputEmail1"><b>To</b></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control materialDate" id="todate" type="text" name="todate" placeholder="dd-mm-yyyy" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php if($to_date) echo $to_date; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="margin-right: 5px">
                                    <label for="exampleInputEmail1"><b>Customer</b></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <select class="select2 form-control" id="customer" data-hide-disabled="true" name="customer" data-live-search="true">
                                            <option value="">All</option>
                                            <?php foreach ($customer as $c) { ?>
                                            <option value="<?php echo $c['id']; ?>" <?php if($customer_name == $c['id']) echo 'selected'; ?>><?php echo $c['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <button type="submit" name="filter" class="btn btn-primary btn-flat">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="<?php echo base_url('invoice/csv'); ?>"><button class="btn green-haze btn-outline btn-sm btn" style="float: left;"><span class="fa fa-download"> &nbsp;</span>Download CSV</button></a>                    
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <!-- <div class="table-responsive"> -->
                        <!-- <div class="dataTab/les_length"> -->
                        <table class="table table-striped table-bordered table-advance table-hover" id="item_list">
                            <thead>
                                <tr>
                                    <th class="th" style="width: 12%">
                                        <b>Action</b>
                                    </th>
                                    <th class="th" style="width: 12%">
                                        <b>Invoice No</b>
                                    </th>
                                    <th class="th" >
                                        <b>Invoice Date</b>
                                    </th>
                                    <th class="th" >
                                        <b>Customer Name</b>
                                    </th>
                                    <th class="th" >
                                        <b>Payment Method</b>
                                    </th>
                                    <th class="th" >
                                        <b>Total</b>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($invoice)) { ?>
                                <?php foreach ($invoice as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo anchor("invoice/edit/".$row['id'],"<i class='icon-pencil'></i>",array("class" => "btn paddd btn-xs btn-success", "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Edit")).' ';

                                            echo anchor("invoice/delete/".$row['id'],"<i class='icon-trash'></i>",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn paddd btn-xs btn-danger", "data-toggle" => "tooltip", "data-placement" => "top", "title" => "Delete"));
                                            ?>
                                        </td>
                                        <td><a href="<?php echo base_url('invoice/edit/'.$row['id']) ?>" class="btn paddd btn-xs btn-success"><?php echo $row['invoice_no']; ?></a></td>
                                        <td><?php echo date('d-M Y',strtotime($row['invoice_date'])); ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['invoice_payment_method']; ?></td>
                                        <td><?php echo '<label class="btn paddd btn-xs btn-success">'.$row['invoice_grand_total'].'</label>'; ?></td>
                                    </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="6" align="center"><b>No Record Found..</b></td>
                                    </tr>
                                <?php } ?>
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

<script type="text/javascript">
    function filtershow()
    {
        var filter = document.getElementById("Filter");
        var all = document.getElementById("all");

        filter.classList.add("active");
        all.classList.remove("active");

        document.getElementById('filtering').style.display = 'block';

    }
    function allshow()
    {
        var filter = document.getElementById("Filter");
        var all = document.getElementById("all");

        filter.classList.remove("active");
        all.classList.add("active");

        document.getElementById('filtering').style.display = 'none';
    }
</script>

