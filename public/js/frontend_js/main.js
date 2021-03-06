/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$(document).ready(function(){

	//Change price with size
	$("#selSize").change(function(){
		var idSize = $(this).val();
		if(idSize == "") return false;
		$.ajax({
			type:'get',
			url:'/get-product-price',
			data:{idSize:idSize},
			success:function(resp){
				var arr = resp.split('#');
				$("#getPrice").html(arr[0]+" Tk.");
				$("#price").val(arr[0]);
				if(arr[1] == 0){
					$("#cartButton").hide();
					$("#availability").text("Out of Stock");
				}else{
					$("#cartButton").show();
					$("#availability").text("In Stock");
				}
			},error:function(){
				alert("test to error");
			}
		});
	});
});
	//Replace main Image with alternative image

$(document).ready(function(){
	$(".subClass").click(function(){
		var imagePath = $(this).attr('src');
		$(".mainClass").attr("src",imagePath);
	});
});

$(document).ready(function() {

	// Instantiate EasyZoom instances
	var $easyzoom = $('.easyzoom').easyZoom();

	// Setup thumbnails example
	var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

	$('.thumbnails').on('click', 'a', function(e) {
		var $this = $(this);

		e.preventDefault();

		// Use EasyZoom's `swap` method
		api1.swap($this.data('standard'), $this.attr('href'));
	});

	// Setup toggles example
	var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

	$('.toggle').on('click', function() {
		var $this = $(this);

		if ($this.data("active") === true) {
			$this.text("Switch on").data("active", false);
			api2.teardown();
		} else {
			$this.text("Switch off").data("active", true);
			api2._init();
		}
	});
});

// Validate Register Form on keyup and submit
$().ready(function(){
	$("#registerForm").validate({
		rules:{
			name:{
				required:true,
				minlength:3,
				accept: "[a-zA-Z]+"
			},
			password:{
				required:true,
				minlength:6
			},
			email:{
				required:true,
				email:true,
				remote:"/check-email"
			}
		},
		messages:{
			name:{
				required: "Please enter your Name",
				minlength: "Your Password must be atleast 6 characters long",
				accept: "Your Name must be consist of letter only"
			},
			password:{
				required: "Please provide your Password",
				minlength: "Your Password must be atleast 6 characters long"
			},
			email:{
				required: "Please enter your Email",
				email: "Please enter valid Email",
				remote: "Email already exists!"
			}
		}
	});
});
//Account Form validation
$().ready(function(){
	$("#accountForm").validate({
		rules:{
			name:{
				required:true,
				minlength: 6,
				accept: "[a-zA-Z]+"
			},
			address:{
				minlength: 5,
				required:true
			},
			city:{
				minlength: 3,
				required:true
			},
			country:{
				required:true
			},
			zipcode:{
				minlength: 3,
				required:true
			},
			phone:{
				minlength: 5,
				required:true
			}

		},
		messages:{
			name:{
				required: "Please enter your Name",
				minlength: "Your Password must be atleast 6 characters long",
				accept: "Your Name must be consist of letter only"
			},
			address:{
				required: "Please provide your Address"
			},
			city:{
				minlength: "Your City Name must be atleast 3 characters long",
				required: "Please provide your City"
			},
			country:{
				required: "Please provide your Country"
			},
			zipcode:{
				minlength: "Your Zipcode must be atleast 3 characters long",
				required: "Please provide your Zipcode"
			},
			phone:{
				minlength: "Your Phone number must be atleast 5 characters long",
				required: "Please provide your Phone"
			}
		}
	});
});

// Validate Login Form on keyup and submit
$().ready(function(){
	$("#registerForm").validate({
		rules:{
			email:{
				required:true,
				email:true,
			},
			password:{
				required:true,
			}
		},
		messages:{
			email:{
				required: "Please enter your Email",
				email: "Please enter valid Email"
			},
			password:{
				required: "Please provide your Password",
			}
		}
	});
});

// Check Current User Password
$(document).ready(function(){
    $("#current_pwd").keyup(function(){
	   var current_pwd = $(this).val();
	   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
       }
    });
	   $.ajax({
		   type:'post',
		   url:'/check-user-pwd',
		   data:{ current_pwd:current_pwd },
		   success:function(resp){
			   if(resp == "false"){
				   $("#chkPwd").html("<font color='red'>Current Password is incorrect</font>")
			   }else if(resp == "true"){
				   $("#chkPwd").html("<font color='green'>Current Password is correct</font>")
			   }
		   },error:function(){
			alert('Error');
		   }
	   });
   });
});

$(document).ready(function(){
    $("#passwordForm").validate({
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
});
//Password Strength Script
$(document).ready(function(){
	$("#password").passtrength({
		minChars: 4,
		passwordToggle: true,
		tooltip: true,
		eyeImg: "/images/frontend_images/eye.svg"
	});
});

$(document).ready(function(){
	$("#billtoship").click(function(){
		if(this.checked){
			$("#shipping_name").val($("#billing_name").val());
			$("#shipping_address").val($("#billing_address").val());
			$("#shipping_city").val($("#billing_city").val());
			$("#shipping_state").val($("#billing_state").val());
			$("#shipping_country").val($("#billing_country").val());
			$("#shipping_pincode").val($("#billing_pincode").val());
			$("#shipping_phone").val($("#billing_phone").val());
		}else{
			$("#shipping_name").val('');
			$("#shipping_address").val('');
			$("#shipping_city").val('');
			$("#shipping_state").val('');
			$("#shipping_country").val('');
			$("#shipping_pincode").val('');
			$("#shipping_phone").val('');			
		}
	})
});

function selectPaymentMethod(){
	if($('#Paypal').is(':checked') || $('#COD').is(':checked')){

	}else{
		alert('Please select Payment Method');
		return false;
	}
}