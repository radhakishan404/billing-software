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
<style type="text/css">
    .error
    {
        color: red;
    }
    .top_margin{
        margin-top: -20px;
    }
    .form-horizontal .form-group {
         margin-right: 0px !important; 
         margin-left: 0px !important; 
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
                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => 'add');
                    echo form_open_multipart(base_url('purchase/edit/'.$id), $attributes);
                ?>
                    <div class="box-body">
                    <?php echo validation_errors(); ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="purchase_supplier_name" class="require">Supplier</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <select class="select_search form-control" id="purchase_supplier_name" data-hide-disabled="true" name="purchase_supplier_name" data-live-search="true">
                                        <option value=""></option>
                                        <?php foreach ($supplier as $c) { ?>
                                        <option value="<?php echo $c['id']; ?>" <?php echo $purchase[0]['name']==$c['name']?'selected':''; ?>><?php echo $c['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label id="name_error" class="error" style="display: none;">This field is required.</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="purchase_payment_method" class="require">Payment Method</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <select class="select2 form-control" name="purchase_payment_method" id="purchase_payment_method" data-hide-disabled="true" data-live-search="true" >
                                        <option value="Paypal" <?php echo $purchase[0]['purchase_payment_method']=='Paypal'?'selected':''; ?>>Paypal</option>
                                        <option value="Bank" <?php echo $purchase[0]['purchase_payment_method']=='Bank'?'selected':''; ?>>Bank</option>
                                        <option value="Cash" <?php echo $purchase[0]['purchase_payment_method']=='Cash'?'selected':''; ?>>Cash</option>
                                        <option value="Paytm" <?php echo $purchase[0]['purchase_payment_method']=='Paytm'?'selected':''; ?>>Paytm</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="purchase_date" class="require">Date</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control materialDate" id="purchase_date" type="text" name="purchase_date" placeholder="dd-mm-yyyy" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask value="<?php echo date('d-m-Y', strtotime($purchase[0]["purchase_date"])); ?>">
                                </div>
                                <label id="name_error" class="error" style="display: none;">This field is required.</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><b>Reference</b><span class="text-danger">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <span>INV-</span>
                                    </div>
                                    <input id="purchase_no" name="purchase_no" class="form-control" value="<?php echo $purchase[0]['purchase_no']; ?>" type="text" readonly>
                                </div>
                                <label id="refrence_error" class="error" style="display: none;">This field is required.</label>
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="box-body no-padding">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="purchasePurchase">
                                        <tbody>
                                            <tr class="tbl_header_color dynamicRows">
                                                <th width="15%" class="text-center">Product Name</th>
                                                <th width="10%" class="text-center">HSN/SAC</th>
                                                <th width="10%" class="text-center">Quantity</th>
                                                <th width="10%" class="text-center">Rate(₹)</th>
                                                <th width="15%" class="text-center">Tax(%)</th>
                                                <th width="10%" class="text-center">Tax(₹)</th>

                                                <th width="10%" class="text-center">Discount(%)</th>
                                                <th width="10%" class="text-center">Amount(₹)</th>
                                                <th width="5%"  class="text-center">Action</th>
                                            </tr>
                                            <?php foreach($purchase as $row){ ?>
                                                <tr>
                                                    <td>
                                                        <input type='text' class='form-control text-center' name='item_name[]' value="<?php echo $row['purchase_item_name'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control text-center' name='item_hsn[]' value="<?php echo $row['purchase_item_hsn']; ?>">
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control text-center custom_units' name='item_qty[]' value='<?php echo $row["purchase_item_qty"]; ?>'>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control text-center custom_rate' name='items_rate[]' value='<?php echo $row['purchase_item_rate'] ?>'>
                                                    </td>
                                                    <td>
                                                        <select class='form-control taxListCustom' name='tax_list[]'>
                                                            <option value='GST@0(0.00)' taxrate='0.00' <?php echo $row['purchase_tax_name']=='GST@0(0.00)'?'selected':''; ?> >GST@0(0.00)</option>
                                                            <option value='GST@12(12.00)' taxrate='12.00' <?php echo $row['purchase_tax_name']=='GST@12(12.00)'?'selected':''; ?> >GST@12(12.00)</option>
                                                            <option value='GST@28(28.00)' taxrate='28.00' <?php echo $row['purchase_tax_name']=='GST@28(28.00)'?'selected':''; ?> >GST@28(28.00)</option>
                                                            <option value='GST@5(5.00)' taxrate='5.00' <?php echo $row['purchase_tax_name']=='GST@5(5.00)'?'selected':''; ?> >GST@5(5.00)</option>
                                                            <option value='GST@3(3.00)' taxrate='3.00' <?php echo $row['purchase_tax_name']=='GST@3(3.00)'?'selected':''; ?> >GST@3(3.00)</option>
                                                            <option value='GST@0.25(0.25)' taxrate='0.25' <?php echo $row['purchase_tax_name']=='GST@0.25(0.25)'?'selected':''; ?> >GST@0.25(0.25)</option>
                                                            <option value='GST@18(18.00)' taxrate='18.00' <?php echo $row['purchase_tax_name']=='GST@18(18.00)'?'selected':''; ?> >GST@18(18.00)</option>
                                                        </select>
                                                    </td>
                                                    <td class='text-center'>
                                                        <input type='text' class='form-control taxAmount' name='taxAmount[]' value="<?php echo $row['purchase_tax_amount'] ?>" readonly >
                                                        
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control text-center custom_discount' name='items_discount[]' value='<?php echo $row['purchase_item_discount'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control text-center amount custom_amount' name='items_amount[]' value='<?php echo $row['purchase_item_amount']; ?>' readonly>
                                                    </td>
                                                </tr>

                                                <?php } ?>
                                            <tr class="custom-item">
                                                <td class="add-row text-danger" style="cursor: pointer;"><strong>Add Custom Item</strong></td>
                                                <td colspan="8"></td>
                                            </tr>
                                            <tr class="tableInfo">
                                                <td colspan="7" align="right"><strong>Sub Total(₹)</strong></td>
                                                <td align="left" colspan="2">
                                                    <input type='text' name="subTotal" class="form-control" id = "subTotal" readonly value="<?php echo $purchase[0]['purchase_sub_total']; ?>">
                                                </td>
                                            </tr>
                                            <tr class="tableInfo">
                                                <td colspan="7" align="right"><strong>Total Tax(₹)</strong></td>
                                                <td align="left" colspan="2">
                                                    <input type='text' name="taxTotal" class="form-control" id = "taxTotal" readonly value="<?php echo $purchase[0]['purchase_tax_total']; ?>">
                                                </td>
                                            </tr>
                                            <tr class="tableInfo">
                                                <td colspan="7" align="right">
                                                    <strong>Grand Total(₹)</strong>
                                                </td>
                                                <td align="left" colspan="2">
                                                    <input type='text' name="grandTotal" class="form-control" id = "grandTotal" readonly id="grandTotal" value="<?php echo $purchase[0]['purchase_grand_total']; ?>">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><b>Note</b></label>
                                <textarea placeholder="Description ..." rows="3" class="form-control" name="comments"><?php echo $purchase[0]['purchase_notes']; ?></textarea>
                            </div>
                            <a href="<?php echo base_url('purchase/lists') ?>" class="btn btn-info btn-flat"><b>Cancel</b></a>
                            <button type="submit" name="submit" class="btn btn-primary  pull-right" id="btnSubmit"><b>Submit</b></button>
                        </div>
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
            if($.trim($('#purchase_supplier_name').val()).length == 0)
            {
                document.getElementById('name_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('name_error').style.display = 'none';
            }
            // order date error
            if($.trim($('#purchase_date').val()).length == 0)
            {
                document.getElementById('date_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('date_error').style.display = 'none';
            }

            // refrence error
            if($.trim($('#purchase_no').val()).length == 0)
            {
                document.getElementById('refrence_error').style.display = 'contents';
                $(window).scrollTop(0);
                return false;
            }
            else
            {
                document.getElementById('refrence_error').style.display = 'none';
            }

            if($.trim($('#grandTotal').val()).length == 0)
            {
                alert("You Need to add some data to create Purchase.");
                return false;
            }

            var xxx = document.getElementById("taxAmount").innerHTML;
            document.getElementById("hiddentxtamount").value = xxx;
                
        });
    });


    var taxOptionList = "<select class='form-control taxList' name='tax_id[]'><option value='GST@0(0.00)' taxrate='0.00'>GST@0(0.00)</option><option value='GST@12(12.00)' taxrate='12.00'>GST@12(12.00)</option><option value='GST@28(28.00)' taxrate='28.00'>GST@28(28.00)</option><option value='GST@5(5.00)' taxrate='5.00'>GST@5(5.00)</option><option value='GST@3(3.00)' taxrate='3.00'>GST@3(3.00)</option><option value='GST@0.25(0.25)' taxrate='0.25'>GST@0.25(0.25)</option><option value='GST@18(18.00)' taxrate='18.00'>GST@18(18.00)</option></select>";
    var taxOptionListCustom = "<select class='form-control taxListCustom' name='tax_list[]'><option value='GST@0(0.00)' taxrate='0.00'>GST@0(0.00)</option><option value='GST@12(12.00)' taxrate='12.00'>GST@12(12.00)</option><option value='GST@28(28.00)' taxrate='28.00'>GST@28(28.00)</option><option value='GST@5(5.00)' taxrate='5.00'>GST@5(5.00)</option><option value='GST@3(3.00)' taxrate='3.00'>GST@3(3.00)</option><option value='GST@0.25(0.25)' taxrate='0.25'>GST@0.25(0.25)</option><option value='GST@18(18.00)' taxrate='18.00'>GST@18(18.00)</option></select>";

    var stack = [];

    // add row

$(function () {
    $( "#search" ).autocomplete(
    {
        select: function(event, ui) 
        {
            var e = ui.item;
            if(e.id) 
            {
                if(!in_array(e.id, stack))
                {
                    stack.push(e.id);
                    var taxAmount = roundToTwo((e.price*e.tax_rate)/100);
                    var new_row = '<tr id="rowid'+e.id+'">'+
                          '<td class="text-center">'+ e.value +'<input type="hidden" name="stock_id[]" value="'+e.stock_id+'"><input type="hidden" name="description[]" value="'+e.value+'"></td>'+
                          '<td class="text-center">'+ e.hsn +'<input type="hidden" name="hsn[]" value="'+e.hsn+'"></td>'+
                          '<td><input class="form-control text-center no_units" min="0" data-id="'+e.id+'" data-rate="'+ e.price +'" type="text" id="qty_'+e.id+'" name="item_quantity[]" value="1"><input type="hidden" name="item_id[]" value="'+e.id+'"></td>'+
                          '<td class="text-center"><input min="0"  type="text" class="form-control text-center unitprice" name="unit_price[]" data-id = "'+e.id+'" id="rate_id_'+e.id+'" value="'+ e.price +'"></td>'+
                          '<td class="text-center">'+ taxOptionList +'</td>'+
                          '<td class="text-center taxAmount" style="padding-top: 13px !important;">'+ taxAmount +'</td>'+
                          '<td class="text-center"><input type="text" class="form-control text-center discount" name="discount[]" data-input-id="'+e.id+'" id="discount_id_'+e.id+'" max="100" min="0" value="0"></td>'+
                          '<td><input class="form-control text-center amount" type="text" amount-id = "'+e.id+'" id="amount_'+e.id+'" value="'+e.price+'" name="item_price[]" readonly></td>'+
                          '<td class="text-center"><button id="'+e.id+'" class="btn paddd btn-xs  btn-danger delete_item"  style="margin-top: 5px !important;"><i class="fa fa-remove"></i></button></td>'+
                          '</tr>';
                
                    $(new_row).insertAfter($('table tr.dynamicRows:last'));
                    // Calculate total tax
                    $(function() {
                        $("#rowid"+e.id+' .taxList').val(e.tax_id);
                    });
                    var taxRateValue = roundToTwo(parseFloat( $("#rowid"+e.id+' .taxList').find(':selected').attr('taxrate')));

                    // Calculate subtotal
                    var subTotal = calculateSubTotal();
                    $("#subTotal").val(subTotal);

                    var taxTotal = calculateTaxTotal();
                    $("#taxTotal").val(taxTotal);
                    var grandTotal = (subTotal + taxTotal);
                    $("#grandTotal").val(roundToTwo(grandTotal));

                    $('.tableInfo').show();

                } 
                else 
                {
                    $('#qty_'+e.id).val( function(i, oldval) {
                        return ++oldval;
                    });
                    //console.log(oldval);
                    var q = $('#qty_'+e.id).val();
                    $("#rate_id_"+e.id).val();
                    r = parseFloat($("#rate_id_"+e.id).val());
                
                    $('#amount_'+e.id).val( function(i, amount) {
                        var result = q*r; 
                        var amountId = $(this).attr("amount-id");
                        var qty = parseInt($("#qty_"+amountId).val());
                        var unitPrice = parseFloat($("#rate_id_"+amountId).val());
                        var discountPercent = parseFloat($("#discount_id_"+amountId).val())/100;
                        if(isNaN(discountPercent)){
                          discountPercent = 0;
                        }
                        var discountAmount = qty*unitPrice*discountPercent;
                        var newPrice = parseFloat([(qty*unitPrice)-discountAmount]);
                        return roundToTwo(newPrice);
                    });
               
                    var taxRateValue = parseFloat( $("#rowid"+e.id+' .taxList').find(':selected').attr('taxrate'));
                    var amountByRow = $('#amount_'+e.id).val(); 
                    var taxByRow = roundToTwo(amountByRow*taxRateValue/100);
                    $("#rowid"+e.id+" .taxAmount").val(taxByRow);

                    // Calculate subTotal
                    var subTotal = calculateSubTotal();
                    $("#subTotal").val(subTotal);

                    // Calculate taxTotal
                    var taxTotal = calculateTaxTotal();
                    $("#taxTotal").val(taxTotal);

                    // Calculate GrandTotal
                    var grandTotal = (subTotal + taxTotal);
                    $("#grandTotal").val(roundToTwo(grandTotal));
                }
              
                $(this).val('');
                $('#val_item').html('');
                return false;
            }
        },
        minLength: 1,
        autoFocus: true
    });
});
    // calculate amount with item quantity
    $(document).on('keyup', '.no_units', function(ev)
    {
        var id = $(this).attr("data-id");
        var qty = parseInt($(this).val());
        var token = $("#token").val();
        var from_stk_loc = $("#loc").val();
        // check item quantity in store location
        $.ajax({
            method: "POST",
            url: SITE_URL+"/sales/quantity-validation",
            data: { "id": id, "location_id": from_stk_loc,'qty':qty,"_token":token }
        })
        .done(function( data ) {
            var data = jQuery.parseJSON(data);
            if(data.status_no == 0){
                $("#quantityMessage").html(data.message);
                $("#rowid"+id).addClass("insufficient");
            }
            else
            {
                $("#rowid"+id).removeClass("insufficient");
                $("#quantityMessage").hide();
            }
        });


        if(isNaN(qty)){
            qty = 0;
        }
       
        var rate = $("#rate_id_"+id).val();
        var price = calculatePrice(qty,rate);  

        var discountRate = parseFloat($("#discount_id_"+id).val());     
        if(isNaN(discountRate)){
            discountRate = 0;
        }
        var discountPrice = calculateDiscountPrice(price,discountRate); 
        $("#amount_"+id).val(discountPrice);
      
        var taxRateValue = parseFloat( $("#rowid"+id+' .taxList').find(':selected').attr('taxrate'));
        var amountByRow = $('#amount_'+id).val(); 
        var taxByRow = roundToTwo(amountByRow*taxRateValue/100);
        $("#rowid"+id+" .taxAmount").val(taxByRow);

        // Calculate subTotal
        var subTotal = calculateSubTotal();
        $("#subTotal").val(subTotal);
        // Calculate taxTotal
        var taxTotal = calculateTaxTotal();
        $("#taxTotal").val(taxTotal);
        // Calculate GrandTotal
        var grandTotal = (subTotal + taxTotal);
        $("#grandTotal").val(roundToTwo(grandTotal));
    });

    // calculate amount with discount
    $(document).on('keyup', '.discount', function(ev)
    {
        var discount = parseFloat($(this).val());
        if(isNaN(discount)){
            discount = 0;
        }
        var id = $(this).attr("data-input-id");
        var qty = $("#qty_"+id).val();
        var rate = $("#rate_id_"+id).val();
        var discountRate = $("#discount_id_"+id).val();
        var price = calculatePrice(qty,rate); 
        var discountPrice = calculateDiscountPrice(price,discountRate);       
        $("#amount_"+id).val(discountPrice);

        var taxRateValue = parseFloat( $("#rowid"+id+' .taxList').find(':selected').attr('taxrate'));
        var amountByRow = $('#amount_'+id).val(); 
        var taxByRow = roundToTwo(amountByRow*taxRateValue/100);
        $("#rowid"+id+" .taxAmount").val(taxByRow);

        // Calculate subTotal
        var subTotal = calculateSubTotal();
        $("#subTotal").val(subTotal);
        // Calculate taxTotal
        var taxTotal = calculateTaxTotal();
        $("#taxTotal").val(taxTotal);
        // Calculate GrandTotal
        var grandTotal = (subTotal + taxTotal);
        $("#grandTotal").val(roundToTwo(grandTotal));

    });


    // calculate amount with unit price
    $(document).on('keyup', '.unitprice', function(ev)
    {
        var unitprice = parseFloat($(this).val());
        if(isNaN(unitprice)){
            unitprice = 0;
        }

          
        var id = $(this).attr("data-id");
        var qty = $("#qty_"+id).val();
        var rate = $("#rate_id_"+id).val();
        var discountRate = $("#discount_id_"+id).val();

        var price = calculatePrice(qty,rate);  
        var discountPrice = calculateDiscountPrice(price,discountRate);     
        $("#amount_"+id).val(discountPrice);

        var taxRateValue = parseFloat( $("#rowid"+id+' .taxList').find(':selected').attr('taxrate'));
        var amountByRow = $('#amount_'+id).val(); 
        var taxByRow = roundToTwo(amountByRow*taxRateValue/100);
        $("#rowid"+id+" .taxAmount").val(taxByRow);

        // Calculate subTotal
        var subTotal = calculateSubTotal();
        $("#subTotal").val(subTotal);
        // Calculate taxTotal
        var taxTotal = calculateTaxTotal();
        $("#taxTotal").val(taxTotal);
        // Calculate GrandTotal
        var grandTotal = (subTotal + taxTotal);
        $("#grandTotal").val(roundToTwo(grandTotal));
    });

    $(document).on('change', '.taxList', function(ev){
        var taxRateValue = $(this).find(':selected').attr('taxrate');
        var rowId = $(this).closest('tr').prop('id');
        var amountByRow = $("#"+rowId+" .amount").val(); 

        var taxByRow = roundToTwo(amountByRow*taxRateValue/100);

        $("#"+rowId+" .taxAmount").val(taxByRow);

        // Calculate subTotal
        var subTotal = calculateSubTotal();
        $("#subTotal").val(subTotal);
        // Calculate taxTotal
        var taxTotal = calculateTaxTotal();
        $("#taxTotal").val(taxTotal);
        // Calculate GrandTotal
        var grandTotal = (subTotal + taxTotal);
        $("#grandTotal").val(roundToTwo(grandTotal));

    });

    // Delete item row
    $(document).ready(function(e){
        $('#purchasePurchase').on('click', '.delete_item', function() {
            var v = $(this).attr("id");
            stack = jQuery.grep(stack, function(value) {
            return value != v;
            });

            $(this).closest("tr").remove();

            var taxRateValue = parseFloat( $("#rowid"+v+' .taxList').find(':selected').attr('taxrate'));
            var amountByRow = $('#amount_'+v).val(); 
            var taxByRow = roundToTwo(amountByRow*taxRateValue/100);
            $("#rowid"+v+" .taxAmount").val(taxByRow);

            var subTotal = calculateSubTotal();
            $("#subTotal").val(subTotal);

            var taxTotal = calculateTaxTotal();
            $("#taxTotal").val(taxTotal);
            // Calculate GrandTotal
            var grandTotal = (subTotal + taxTotal);
            $("#grandTotal").val(roundToTwo(grandTotal));           
        });
    });
      
    /**
    * Calcualte Total tax
    *@return  totalTax for row wise
    */
    function calculateTaxTotal (){
        var totalTax = 0;
        $('.taxAmount').each(function() {
            totalTax += parseFloat($(this).val());
        });
        return roundToTwo(totalTax);
    }

    /**
    * Calcualte Sub Total 
    *@return  subTotal
    */
    function calculateSubTotal (){
        var subTotal = 0;
        $('.amount').each(function() {
        subTotal += parseFloat($(this).val());
        });
        return roundToTwo(subTotal);
    }

    /**
    * Calcualte price
    *@return  price
    */
    function calculatePrice (qty,rate){
        var price = (qty*rate);
        return roundToTwo(price);
    }   
    // calculate tax 
    function caculateTax(p,t){
        var tax = (p*t)/100;
        return roundToTwo(tax);
    }   

    // calculate discont amount
    function calculateDiscountPrice(p,d){
        var discount = [(d*p)/100];
        var result = (p-discount); 
        return roundToTwo(result);
    }

    // Custom product line add
    $(".add-row").click(function()
    {
        var markup ="<tr>"
        +"<td><input type='text' class='form-control text-center' name='item_name[]' ></td>"
        +"<td><input type='text' class='form-control text-center' name='item_hsn[]'></td>"
        +"<td><input type='text' class='form-control text-center custom_units' name='item_qty[]' value='1'></td>"
        +"<td><input type='text' class='form-control text-center custom_rate' name='items_rate[]' value='0'></td>"
        +"<td>" +taxOptionListCustom+ "</td>"
        +"<td class='text-center'><input type='text' name='taxAmount[]' class='form-control taxAmount' id='taxAmount' readonly/></td>"
        +"<td><input type='text' class='form-control text-center custom_discount' name='items_discount[]' value='0'></td>"
        +"<td><input type='text' class='form-control text-center amount custom_amount' name='items_amount[]' value='0' readonly></td>"
        +"<td class='text-center'><button class='btn paddd btn-xs btn-danger delete_item' style='margin-top: 5px !important;'><i class='fa fa-remove' ></i></button></td>"
        +"</tr>";
        $("table tbody .custom-item").before(markup);

    });

    // Change the item quantity
    $(document).on('keyup','.custom_units', function()
    {
        var qty = $(this).val();
        var rate = $(this).parents('tr').find('input.custom_rate').val();
        var taxRate = $(this).parents('tr').find('.taxListCustom').find(':selected').attr('taxrate');
        var discountRate = $(this).parents('tr').find('input.custom_discount').val();
        
        var price = calculatePrice(qty,rate);  
        var discountPrice = calculateDiscountPrice(price,discountRate);     
        var taxAmount = roundToTwo((discountPrice*taxRate)/100);
        $(this).parents('tr').find('input.custom_amount').val(discountPrice);
        $(this).parents('tr').find('.taxAmount').val(taxAmount);

        var subTotal = calculateSubTotal();
        $("#subTotal").val(subTotal);
          // Calculate taxTotal
        var taxTotal = calculateTaxTotal();
        $("#taxTotal").val(taxTotal);
          // Calculate GrandTotal
        var grandTotal = (subTotal + taxTotal);
        $("#grandTotal").val(roundToTwo(grandTotal));
    });

    // Change the item rate
    $(document).on('keyup','.custom_rate', function(){
        var rate = $(this).val();
        var qty = $(this).parents('tr').find('input.custom_units').val();
        var taxRate = $(this).parents('tr').find('.taxListCustom').find(':selected').attr('taxrate');
        var discountRate = $(this).parents('tr').find('input.custom_discount').val();
        
        var price = calculatePrice(qty,rate);  
        var discountPrice = calculateDiscountPrice(price,discountRate);     
        var taxAmount = roundToTwo((discountPrice*taxRate)/100);
        $(this).parents('tr').find('input.custom_amount').val(discountPrice);
        $(this).parents('tr').find('.taxAmount').val(taxAmount);

        var subTotal = calculateSubTotal();
        $("#subTotal").val(subTotal);
          // Calculate taxTotal
        var taxTotal = calculateTaxTotal();
        $("#taxTotal").val(taxTotal);
          // Calculate GrandTotal
        var grandTotal = (subTotal + taxTotal);
        $("#grandTotal").val(roundToTwo(grandTotal));
    });

    // Change the discount
    $(document).on('keyup','.custom_discount', function(){
        var discountRate = $(this).val();
        var qty = $(this).parents('tr').find('input.custom_units').val();
        var taxRate = $(this).parents('tr').find('.taxListCustom').find(':selected').attr('taxrate');
        var rate = $(this).parents('tr').find('input.custom_rate').val();
        
        var price = calculatePrice(qty,rate);  
        var discountPrice = calculateDiscountPrice(price,discountRate);     
        var taxAmount = roundToTwo((discountPrice*taxRate)/100);
        $(this).parents('tr').find('input.custom_amount').val(discountPrice);
        $(this).parents('tr').find('.taxAmount').val(taxAmount);

        var subTotal = calculateSubTotal();
        $("#subTotal").val(subTotal);
          // Calculate taxTotal
        var taxTotal = calculateTaxTotal();
        $("#taxTotal").val(taxTotal);
          // Calculate GrandTotal
        var grandTotal = (subTotal + taxTotal);
        $("#grandTotal").val(roundToTwo(grandTotal));
    });
    
    // Change the tax type
    $(document).on('change', '.taxListCustom', function(ev){

        var taxRate = $(this).parents('tr').find(':selected').attr('taxrate');
        var amount = $(this).parents('tr').find('input.amount').val(); 
        var taxAmount = roundToTwo(amount*taxRate/100);
        $(this).parents('tr').find('.taxAmount').val(taxAmount);

        // Calculate subTotal
        var subTotal = calculateSubTotal();
        $("#subTotal").val(subTotal);
        // Calculate taxTotal
        var taxTotal = calculateTaxTotal();
        $("#taxTotal").val(taxTotal);
        // Calculate GrandTotal
        var grandTotal = (subTotal + taxTotal);
        $("#grandTotal").val(roundToTwo(grandTotal));
    });
    /// Craete Round Figure
    function roundToTwo(num) {    
        return +(Math.round(num + "e+2")  + "e-2");
    }

</script>

