$(function () {
    
    $("#outlet_assign_product").validate({
        highlight: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-error');
        }
    });
    
    $("#add_society").validate({
        highlight: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-error');
        }
    });
    
    $("#booking_add").validate({
        highlight: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-error');
        }
    });
    
    $("#sales_forcast_booking_add").validate({
        highlight: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-error');
        }
    });
    
    $("#sales_forcast_booking_completion").validate({
        highlight: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-error');
        }
    });
    
    $("#credit_outlet").validate({
        rules: {
            'data[outlet_id]': "required",
            'data[amount]': "required",
            'data[description]': "required"

        },
        messages: {
            'data[outlet_id]':'Please select outlet'
        },
        
         highlight: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-error');
        }
        
    });
    
    $("#outlet_item_assign_csv").validate({
        rules: {
            'date': "required",
            'file': "required"

        },
        messages: {
            'data[outlet_id]':'Please select outlet'
        },
        
         highlight: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
          jQuery(element).closest('.form-group').removeClass('has-error');
        }
        
    });
    
    
    $("#item_purchase_cancel").validate({
        rules: {
            'reason': "required"
        },
        messages: {
            'name': "Name required",
        }
    });
    
    $("#item_add").validate({
        rules: {
            'data[sr_no]': "required",
            'data[name]': "required",
            'data[hindi_name]': "required",
            'data[unit]': "required"

        },
        messages: {
            'name': "Name required",
        }
    });
    
    $("#item_edit").validate({
        rules: {
            'data[sr_no]': "required",
            'data[name]': "required",
            'data[unit]': "required"

        },
        messages: {
            'name': "Name required",
        }
    });

    $("#vendor_add").validate({
        rules: {
            'data[name]': "required",
            'data[contact_no]': "required",
            'data[address]': "required"

        },
        messages: {
            'name': "Name required",
        }
    });
    
    $("#outlet_add").validate({
        rules: {
            'data[type]': "required",
            'data[contact_person_name]': "required",
            'data[contact_no]': "required",
            'data[address]': "required",
            'data[identification_no]': "required",

        },
        messages: {
            'name': "Name required",
        }
    });
    
    /*$("#users_add").validate({
        rules: {
            'name': "required",
            'email': "required",
            'status': "required",
            'role': "required",
            mobile_no: {
                required: true,
                minlength: 10,
                maxlength: 15
            }
        },
        messages: {
            'name': "Name required",
        }
    });
    
    $("#product_add_form").validate({
        rules: {
            'name[]': "required",
            'url[]': "required",
            'image[]': "required"
        },
        messages: {
            'name[]': "Name required",
        }
    });
    
     $("#group_add").validate({
        rules: {
            name: "required",
            status: "required"
        },
        messages: {
            name: "Name required",
        }
    });

    $("#risk_edit").validate({
        rules: {
            name: "required"
        },
        messages: {
            name: "Code required",
        }
    });
    
    $("#category_add").validate({
        rules: {
            status: "required",
            name: "required",
            image: "required",
        },
        messages: {
            name: "Category name required",
        }
    });
    
    $("#category_edit").validate({
        rules: {
            status: "required",
            name: "required"
        },
        messages: {
            name: "Category name required",
        }
    });
    
     $("#disease_add").validate({
        rules: {
            category_id: "required",
            status: "required",
            name: "required"
        },
        messages: {
            name: "Disease name required",
        }
    });
    
    $("#disease_edit").validate({
        rules: {
            category_id: "required",
            status: "required",
            name: "required"
        },
        messages: {
            name: "Disease name required",
        }
    });
    
    $("#disease_test_add").validate({
        rules: {
            disease_id: "required",
            status: "required",
            name: "required"
        },
        messages: {
            name: "Disease test name required",
        }
    });  */

});