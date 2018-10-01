
$(document).ready(function(){
	
	$("#current_pwd").keyup(function(){
		var current_pwd = $("#current_pwd").val();
		$.ajax({
			type:'get',
			url:'/admin/check-pwd',
			data:{current_pwd:current_pwd},
			success:function(resp){
				if(resp == "false"){
					$("#chkPwd").html("<font color='red'>Current Password is Incorrect</font>");
				}else if(resp == "true"){
				    $("#chkPwd").html("<font color='green'>Current Password is Correct</font>");
				}
			},
			error:function(){
				alert("Error");
			}
		});
	});

	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
	    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

    $("#add_category").validate({
		rules:{
			category_name:{
				required:true,
			},
			category_description:{
				required:true,
			},
			category_url:{
				required:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#add_product").validate({
		rules:{
			category_id:{
				required:true,
			},
			product_name:{
				required:true,
			},
			product_code:{
				required:true,
			},
			product_color:{
				required:true,
			},
			product_description:{
				required:true,
			},
			product_price:{
				required:true,
				number:true,
			},
		    product_size:{
				required:true,
			},
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required:true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// $("#delete_category").click(function(){
	// 	if(confirm('Are you sure you want to delete this category?')){
	// 		return true;
	// 	}
	// 	return false;
	// });
 //    $("#delete_product").click(function(){
	// 	if(confirm('Are you sure you want to delete this Product?')){
	// 		return true;
	// 	}
	// 	return false;
	// })
    $(".deleteRecord").click(function(){
    	var id = $(this).attr('rel');
    	var deleteFunction = $(this).attr('rel1');
    	swal({
             title: 'Are you sure?',
             text: "You wil not be able to recover this record again!",
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!',
             cancelButtonText: 'No, cancel!',
             confirmButtonClass: 'btn btn-success',
             cancelButtonClass: 'btn btn-danger',
             buttonStyling: false,
             reverseButtons: true
    	},
    	function(){
    		window.location.href="/admin/"+deleteFunction+"/"+id;
    	});
    });

    $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px;margin-left:180px;margin-top:10px;" /><input type="text" name="size[]" id="size" placeholder="Size" style="width: 120px;margin-left:10px;margin-top:10px;" /><input type="text" name="price[]" id="price" placeholder="Price" style="width: 120px;margin-left:10px;margin-top:10px;" /><input type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px;margin-left:10px;margin-top:10px;" /><a href="javascript:void(0);" class="remove_button" style="margin-left:5px;">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
  });
});
