/*$.validator.setDefaults( {
			submitHandler: function () {
				alert( "submitted!" );
			}
		} );
*/	

	$( document ).ready( function () {

    /*********** Login Page *****************/		
      $( "#login" ).validate( {
				rules: {
					password: {
						required: true
					},
					email: {
						required: true,
						email: true
					},
				},
				messages: {
					password: {
						required: "Please enter a password",
					},
					email: {
						required: "Please enter an email",
						email: "Please enter a valid email address",
					},
					
				},
				errorElement: "em",
					errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs

					element.parents( ".fieldinner" ).addClass( "has-feedback" );
					element.parents( ".fieldinner" ).children(".form-control").addClass( "inputerror" );
					
					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "div.fieldinner" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
					
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".fieldinner" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".fieldinner" ).addClass( "has-success" ).removeClass( "has-error" );
					$( ".fieldinner" ).children(".form-control").removeClass( "inputerror" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			});


/*********** Forgot Password Page *****************/		
$( "#forgetform" ).validate( {
	rules: {
		email: {
			required: true,
			email: true
		},
	},
	messages: {
		email: {
			required: "Please enter an email",
			email: "Please enter a valid email address",
		},
		
	},
	errorElement: "em",
		errorPlacement: function ( error, element ) {
		// Add the `help-block` class to the error element
		error.addClass( "help-block" );

		// Add `has-feedback` class to the parent div.form-group
		// in order to add icons to inputs

		element.parents( ".fieldinner" ).addClass( "has-feedback" );
		element.parents( ".fieldinner" ).children(".form-control").addClass( "inputerror" );
		
		if ( element.prop( "type" ) === "checkbox" ) {
			error.insertAfter( element.parent( "div.fieldinner" ) );
		} else {
			error.insertAfter( element );
		}

		// Add the span element, if doesn't exists, and apply the icon classes to it.
		if ( !element.next( "span" )[ 0 ] ) {
			$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
		}
	},
	success: function ( label, element ) {
		// Add the span element, if doesn't exists, and apply the icon classes to it.
		if ( !$( element ).next( "span" )[ 0 ] ) {
			$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
		}
		
	},
	highlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".fieldinner" ).addClass( "has-error" ).removeClass( "has-success" );
		$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
	},
	unhighlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".fieldinner" ).addClass( "has-success" ).removeClass( "has-error" );
		$( ".fieldinner" ).children(".form-control").removeClass( "inputerror" );
		$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
	}
});
/*********** Change Password Page *****************/		
$( "#changepassword" ).validate( {
	rules: {
		newpassword: {
			required: true,
			minlength: 6
		},
		confirmpassword: {
		   required: true,
		   minlength: 6,
		   equalTo: "#newpassword"
		},
	},
	messages: {
		newpassword: {
			required: "Please provide a password",
			minlength: "Your password must be at least 6 characters long"
		},
		confirmpassword: {
			required: "Please provide a password",
			minlength: "Your password must be at least 6 characters long",
			equalTo: "Please enter the same password as above"
		},
	},
	errorElement: "em",
		errorPlacement: function ( error, element ) {
		// Add the `help-block` class to the error element
		error.addClass( "help-block" );

		// Add `has-feedback` class to the parent div.form-group
		// in order to add icons to inputs

		element.parents( ".fieldinner" ).addClass( "has-feedback" );
		element.parents( ".fieldinner" ).children(".form-control").addClass( "inputerror" );
		
		if ( element.prop( "type" ) === "checkbox" ) {
			error.insertAfter( element.parent( "div.fieldinner" ) );
		} else {
			error.insertAfter( element );
		}

		// Add the span element, if doesn't exists, and apply the icon classes to it.
		if ( !element.next( "span" )[ 0 ] ) {
			$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
		}
	},
	success: function ( label, element ) {
		// Add the span element, if doesn't exists, and apply the icon classes to it.
		if ( !$( element ).next( "span" )[ 0 ] ) {
			$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
		}
		
	},
	highlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".fieldinner" ).addClass( "has-error" ).removeClass( "has-success" );
		$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
	},
	unhighlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".fieldinner" ).addClass( "has-success" ).removeClass( "has-error" );
		$( ".fieldinner" ).children(".form-control").removeClass( "inputerror" );
		$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
	}
});


if($('.hiddenmessage').val())
{
	var idof = $('.hiddenmessage').attr('id');
	if(idof == 'sucessmessage')
	{
       successmessage($('.hiddenmessage').val(),'success');
	}

	if(idof == 'errormessage')
	{
		successmessage($('.hiddenmessage').val(),'error');
	}
	$('.hiddenmessage').val('');
}


});

/*********** Login Page *****************/
	$( ".submit-button" ).click(function( ) {
	  if($('#login').valid())
		{
		  var data = $('#login').serialize();
		  ajaxtosubmitform('login','/custom-login',data,'submit-button','Login')
		}
	});


/*********** Forget Password Page *****************/
	$( ".submit-button1" ).click(function( ) {
	  if($('#forgetform').valid())
		{
		  var data = $('#forgetform').serialize();
		  ajaxtosubmitform('forgetform','/forget-password',data,'submit-button1','Reset Your Password')
		}
	});

/*********** Forget Password Page *****************/
$( ".submit-button2" ).click(function( ) {
	var data = $('#verifyotpform').serialize();
	console.log('data == ', data);
	 var digit1 = $('input:text[name=digit1]').val();
	 var digit2 = $('input:text[name=digit2]').val();
	 var digit3 = $('input:text[name=digit3]').val();
	 var digit4 = $('input:text[name=digit4]').val();
	 if(digit1 != '' && digit2 != '' &&  digit3 != '' &&  digit4 != '' )
	 {
	 	console.log('full');
	 	$( ".fieldinner" ).children(".inputcl").removeClass( "inputerror" );
	 	$('#digit4-error').hide();
		 if($('#verifyotpform').valid())
		{
		  var data = $('#verifyotpform').serialize();
		  ajaxtosubmitform('verifyotpform','/verify_otp',data,'submit-button2','Confirm')
		}
	 }else
	 {
	 	$("input#digit-1").css("background-color",'#e22028 !important');
	 	$('#digit4-error').show();
        $( ".fieldinner" ).children(".inputcl").addClass( "inputerror" );
	 	console.log('not full');
	 }
	 return;
});

/*********** Change Password Page *****************/
$( ".submit-button3" ).click(function( ) {
	if($('#changepassword').valid())
	{
	   var data = $('#changepassword').serialize();
	   ajaxtosubmitform('changepassword','/change-password',data,'submit-button3','Submit')
	}
});





/********************  OTP Functionality ******************************/
$('.digit-group').find('input').each(function() {
	$(this).attr('maxlength', 1);
	$(this).on('keyup', function(e) {
		console.log('-');
		var parent = $($(this).parent());
		
		if(e.keyCode === 8 || e.keyCode === 37) {
			var prev = parent.find('input#' + $(this).data('previous'));
			
			if(prev.length) {
				$(prev).select();
			}
		} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
			var next = parent.find('input#' + $(this).data('next'));
			
			if(next.length) {
				$(next).select();
			} else {
				if(parent.data('autosubmit')) {
					parent.submit();
				}
			}
		}
	});
});
/***********************  OTP Functionality ***************************/


	function ajaxtosubmitform(formid,urls,formdata,button,buttontext)
	{
		if(button != '')
		{
			$('.'+button).attr('disabled',true);
			$('.'+button).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
		}
		$.ajax({
          headers: {
              'X-CSRF-Token': $('#'+formid).children('input[name="_token"]').val()
          },
                type: 'post',
                url: $('#'+formid).attr('action'),
                data:formdata,
                dataType:'json',
                success: function (data) {
				if(button != '')
				{
			      $('.'+button).attr('disabled',false);
				  $('.'+button).html(buttontext);
				}

                  if(data.erro==202)
                    {
                      if(data.msg != undefined && data.msg != null && data.msg != '')
                      {
                        successmessage(data.msg,'error');
                      }   
                    }
                    if(data.erro==101)
                    {
                    	console.log('data.msg == ', data.msg);
                      if(data.msg != undefined && data.msg != null && data.msg != '')
                      {
                        successmessage(data.msg,'success');
                      }

                      if(data.redirecturl != undefined && data.redirecturl != null)
                      {
                        window.location.href= data.redirecturl;
                      }

                    }
                },
            }); 
	}




function successmessage(msg,type)
{
	// $('#successtoast').click(function() {
        
    toastr.options = {
  "closeButton": true,
  "debug": true,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
    if(type == 'success')
    {	
      toastr["success"](msg);
    }
    if(type == 'error')
    {	
      toastr["error"](msg);
    }
    if(type == 'warning')
    {	
      toastr["warning"](msg);
    }
}


