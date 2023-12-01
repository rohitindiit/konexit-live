$( document ).ready( function () {

    /*********** Profile Page *****************/		
      $( "#profileform" ).validate( {
				rules: {
					name: {
						required: true
					},
					lname: {
						required: true
					},
					email: {
						required: true,
						email: true
					},
				},
				messages: {
					name: {
						required: "Please enter  first name",
					},
					lname: {
						required: "Please enter  last name",
					},
					email: {
						required: "Please enter  email",
					},
				},
				errorElement: "em",
					errorPlacement: function ( error, element ) {
					error.addClass( "help-block" );
                    element.parents( ".fieldinner" ).addClass( "has-feedback" );
					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "div.fieldinner" ) );
					} else {
						error.insertAfter( element );
					}
                  if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
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
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			});


   /*********** Password Page *****************/   
      $( "#passwordform" ).validate( {
        rules: {
          currentpassword: {
            required: true
          },
          newpassword: {
            required: true,
            minlength: 6,
            /*pattern: /^[a-zA-Z'.\s]{1,40}$/*/
          },
          confirmpassword: {
            required: true,
            equalTo: "#newpassword"
          },
        },
        messages: {
          currentpassword: {
            required: "Please enter  current password",
          },
          newpassword: {
            required: "Please enter  new password",
              minlength: "Your password must be at least 6 characters long",
            /*  regx: "Please enter a valid password"*/
          },
          confirmpassword: {
            required: "Please enter  confirmed password",
            equalTo: "Please enter the same password as above"
          },
        },
        errorElement: "em",
          errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
                    element.parents( ".fieldinner" ).addClass( "has-feedback" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "div.fieldinner" ) );
          } else {
            error.insertAfter( element );
          }
                  if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
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
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
      });



      /*********** title Page *****************/   
      $( "#titleform" ).validate( {
        rules: {
          title: {
            required: true
          },
        },
        messages: {
          title: {
            required: "Please enter  title of form",
          },
        },
        errorElement: "em",
          errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
                    element.parents( ".fieldinner" ).addClass( "has-feedback" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "div.fieldinner" ) );
          } else {
            error.insertAfter( element );
          }
                  if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
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
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
      });



  /*********** Add Organisation Page *****************/    
      $( "#addorganisationform" ).validate( {
        rules: {
          name: {
            required: true
          },
        division: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
           password: {
            required: true,
            minlength: 6,
            /*pattern: /^[a-zA-Z'.\s]{1,40}$/*/
          },
          confirmpassword: {
            required: true,
            equalTo: "#password"
          },
          profile: {
            required: true
          },
          user_quota: {
            required: true
          },
        },
        messages: {
          name: {
            required: "Please enter  Company name",
          },
           division: {
             required: "Please enter  division",
          },
          email: {
            required: "Please enter  email",
          },
           password: {
            required: "Please enter  password",
              minlength: "Your password must be at least 6 characters long",
            /*  regx: "Please enter a valid password"*/
          },
          confirmpassword: {
            required: "Please enter  confirmed password",
            equalTo: "Please enter the same password"
          },
          profile: {
            required: "Please enter  organisation logo",
          },
          user_quota: {
            required: "Please enter  user quota",
          },
        },
        errorElement: "em",
          errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
          console.log('element == ', element);
                    element.parents( ".fieldinner" ).addClass( "has-feedback" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "div.fieldinner" ) );
          } else {
            error.insertAfter( element );
          }
                  if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
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
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
      });

 /*********** Edit Organisation Page *****************/    
      $( "#editorganisationform" ).validate( {
        rules: {
          name: {
            required: true
          },
           division: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
           password: {
            minlength: 6,
            /*pattern: /^[a-zA-Z'.\s]{1,40}$/*/
          },
          confirmpassword: {
            equalTo: "#password"
          },
          user_quota: {
            required: true
          },
        },
        messages: {
          name: {
            required: "Please enter  Company name",
          },
           division: {
            required: "Please enter  division",
          },
          email: {
            required: "Please enter  email",
          },
           password: {
              minlength: "Your password must be at least 6 characters long",
            /*  regx: "Please enter a valid password"*/
          },
          confirmpassword: {
            equalTo: "Please enter the same password"
          },
          user_quota: {
            required: "Please enter  user quota",
          },
        },
        errorElement: "em",
          errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
          console.log('element == ', element);
                    element.parents( ".fieldinner" ).addClass( "has-feedback" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "div.fieldinner" ) );
          } else {
            error.insertAfter( element );
          }
                  if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
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
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
      });    

/*********** Add User Organisation *****************/    
      $( "#addorganisationuserform" ).validate( {
        rules: {
          name: {
            required: true
          },
           lname: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
           status: {
            required: true
          },
           password: {
            required: true,
            minlength: 6,
            /*pattern: /^[a-zA-Z'.\s]{1,40}$/*/
          },
          confirmpassword: {
            required: true,
            equalTo: "#password"
          },
        },
        messages: {
          name: {
            required: "Please enter  first name",
          },
           lname: {
            required: "Please enter  last name",
          },
          email: {
            required: "Please enter  email",
          },
           status: {
            required: "Please select status of user",
          },
          password: {
            required: "Please enter  password",
              minlength: "Your password must be at least 6 characters long",
            /*  regx: "Please enter a valid password"*/
          },
          confirmpassword: {
            required: "Please enter  confirmed password",
            equalTo: "Please enter the same password"
          },
        },
        errorElement: "em",
          errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
          console.log('element == ', element);
                    element.parents( ".fieldinner" ).addClass( "has-feedback" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "div.fieldinner" ) );
          } else {
            error.insertAfter( element );
          }
                  if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
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
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
      }); 

 /*********** Edit User Organisation *****************/    
      $( "#editorganisationform" ).validate( {
        rules: {
          name: {
            required: true
          },
           lname: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
           status: {
            required: true
          },
           password: {
            minlength: 6,
            /*pattern: /^[a-zA-Z'.\s]{1,40}$/*/
          },
          confirmpassword: {
            equalTo: "#password"
          },
        },
        messages: {
          name: {
            required: "Please enter  first name",
          },
           lname: {
            required: "Please enter  last name",
          },
          email: {
            required: "Please enter  email",
          },
           status: {
            required: "Please select status of user",
          },
          password: {
              minlength: "Your password must be at least 6 characters long",
            /*  regx: "Please enter a valid password"*/
          },
          confirmpassword: {
            equalTo: "Please enter the same password"
          },
        },
        errorElement: "em",
          errorPlacement: function ( error, element ) {
          error.addClass( "help-block" );
          console.log('element == ', element);
                    element.parents( ".fieldinner" ).addClass( "has-feedback" );
          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "div.fieldinner" ) );
          } else {
            error.insertAfter( element );
          }
                  if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
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

/*********** Profile Page *****************/
	$( ".submit-button" ).click(function( ) {
	  if($('#profileform').valid())
		{
		  var file_data = $('#choosefile').prop('files')[0];
		   var data = new FormData();
	       data.append('choosefile', file_data);
          var other_data = $('#profileform').serializeArray();
          $.each(other_data,function(key,input){
          data.append(input.name,input.value);
          });
		  ajaxtosubmitform('profileform','/profile-update',data,'submit-button','Save')
		}
	});

/*********** Password Page *****************/
$( ".submit-button1" ).click(function( ) {
  if($('#passwordform').valid())
  {
    var data = new FormData();
    var other_data = $('#passwordform').serializeArray();
     $.each(other_data,function(key,input){
     data.append(input.name,input.value);
    });
    ajaxtosubmitform('passwordform','/update-password',data,'submit-button1','Save')
  }
});

/*********** add organisation Page *****************/
$( ".submit-button2" ).click(function( ) {
  if($('#addorganisationform').valid())
  {
      var file_data = $('#uploadimg').prop('files')[0];
      var data = new FormData();
      data.append('choosefile', file_data);
    var other_data = $('#addorganisationform').serializeArray();
     $.each(other_data,function(key,input){
     data.append(input.name,input.value);
    });
    ajaxtosubmitform('addorganisationform','/add-organisation',data,'submit-button2','Save')
  }
});

/*********** edit organisation Page *****************/
$( ".submit-button3" ).click(function( ) {
  if($('#editorganisationform').valid())
  {
      var file_data = $('#uploadimg').prop('files')[0];
      var data = new FormData();
      if(file_data != undefined && file_data != null)
      {
        data.append('choosefile', file_data);
      }
    var other_data = $('#editorganisationform').serializeArray();
     $.each(other_data,function(key,input){
     data.append(input.name,input.value);
    });
    ajaxtosubmitform('editorganisationform','/edit-organisation',data,'submit-button3','Save')
  }
});


/*********** Add User organisation *****************/
$( ".submit-button4" ).click(function( ) {
  if($('#addorganisationuserform').valid())
  {
      var file_data = $('#uploadimg').prop('files')[0];
      var data = new FormData();
      if(file_data != undefined && file_data != null)
      {
        data.append('choosefile', file_data);
      }
    var other_data = $('#addorganisationuserform').serializeArray();
     $.each(other_data,function(key,input){
     data.append(input.name,input.value);
    });
    ajaxtosubmitform('addorganisationuserform','/user-organisation',data,'submit-button4','Save')
  }
});

/*********** Edit User organisation *****************/
$( ".submit-button5" ).click(function( ) {
  if($('#editorganisationuserform').valid())
  {
      var file_data = $('#uploadimg').prop('files')[0];
      var data = new FormData();
      if(file_data != undefined && file_data != null)
      {
        data.append('choosefile', file_data);
      }
    var other_data = $('#editorganisationuserform').serializeArray();
     $.each(other_data,function(key,input){
     data.append(input.name,input.value);
    });
    ajaxtosubmitform('editorganisationuserform','/user-organisation',data,'submit-button5','Save')
  }
});



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
        cache: false,
        contentType: false,
        processData: false,
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

              if(data.html != undefined && data.html != null)
              {
                $('#'+data.htmlid).attr('src',data.html);
              }

              if(data.htmlclass != undefined && data.htmlclass != null && data.html != undefined && data.html != null)
                {
                    $('.'+data.htmlclass+'class').attr('src',data.html);
                }

                if(data.htmlclass != undefined && data.htmlclass != null)
                {
                    $('.'+data.htmlclass+'name').html(data.data.name);
                }

              if(data.resetform != undefined && data.resetform != null && data.resetform == 'yes')
              {
                $('#'+formid)[0].reset();
              }

            }
        },
    }); 
}


function successmessage(msg,type)
{
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
