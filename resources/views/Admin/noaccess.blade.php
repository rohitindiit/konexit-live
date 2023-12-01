@include('Admin.layout.header')
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('Admin.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row  layout-top-spacing">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                      <div class="no-permission p-5 mt-5">
                          <img src="{{url('/')}}/resources/views/organization/assets/img/nopermission.png"/>
                          <h2>We Are Sorry...</h2>
                          <p>You do not have permission to access this page.</p>
                    </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('Admin.layout.footer')
      <script>
          $("#change_role").change(function(){
              selected = $(this).val();
              if(selected=='4'){
                   $('.orgdiv').css('display','block'); 
                   $("#userorg").prop('required',true);
              }else{
                   $('.orgdiv').css('display','none'); 
                   $("#userorg").prop('required',false);
              }
            
          });
          
          $('#addpernt').validate({
            // Specify validation rules
            rules: {
              user_name: 'required',
              user_email: {
                required: true,
                email: true
              },
              user_password: {
                required: true,
                minlength: 6
              },
              user_role:{
                    required: true,
              },
              user_confirmpasswordy: {
                
                equalTo: '#password'
              },
              
            },
            
            // Specify validation error messages
            messages: {
              user_name: 'Please enter your name',
              user_email: {
                required: 'Please enter your email address',
                email: 'Please enter a valid email address'
              },
              user_password: {
                required: 'Please enter a password',
                minlength: 'Your password must be at least 6 characters long'
              },
              user_role: {
                required: 'Please select a role',
                minlength: 'Your password must be at least 6 characters long'
              },
              user_confirmpasswordy: {
                required: 'Please confirm your password',
                equalTo: 'Passwords do not match'
              },
            },
            
            
          });
      </script>