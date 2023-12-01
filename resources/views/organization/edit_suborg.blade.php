@include('organization.layout.header')

      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('organization.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row mb-3 layout-top-spacing align-items-center">
                  <div class="col-xl-12 col-12 px-2 d-flex ">
                     <a href="{{route('suborg.view')}}" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/Admin/assets/img/backarrow.svg"/></a>
                     <div>
                        <h1 class="headmain mb-1">Edit Suborganiser</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('suborg.view')}}">Suborganiser</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit Suborganiser</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                      <form action="{{ route('update.suborg.user') }}" method="POST"  id="addpernt" >
                         @csrf
                     <div class="widget formusers">
                        <div class="widget-content px-2">
                           <h3 class="headmaininner">Edit Info</h3>
                           <div class="row px-2">
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>First Name</label>
                                    <input type="text" name="user_first_name" value="{{$suborg->name}}" class="form-control" placeholder="Enter Organisation Name"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Last Name</label>
                                    <input type="text" name="user_last_name" value="{{$suborg->lname}}" class="form-control" placeholder="Enter Organisation Name"/>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="row px-2">
                               <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Division</label>
                                    <input type="text" name="division" class="form-control" placeholder="Enter division" value="{{$suborg->division}}"/>
                                 </div>
                              </div>
                              
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Email</label>
                                    <input type="email"  name="user_email" value="{{$suborg->email}}" class="form-control" placeholder="Enter Email"/>
                                 </div>
                              </div>
                              
                           </div>
                            <div class="row px-2">
                                 <div class="col-md-4 px-2">
                                     <div class="form-group fieldinner">
                                        <label>New Password</label>
                                        <input type="password" name="user_password"  id="user_password" class="form-control" placeholder="Enter Password"/>
                                     </div>
                                  </div>
                              <div class="col-md-4 px-2">
                                     <div class="form-group fieldinner">
                                        <label>Confirm Password</label>
                                        <input type="password" name="user_confirmpasswordy" class="form-control" placeholder="Confirm Password"/>
                                     </div>
                                </div>
                             </div>
                             
                              <div class="col-md-3 px-2">
                                 <div class="form-group">
                                    <label>Upload Image</label>
                                    <div class="uploadimg fieldinner">
                                       <label for="uploadimg">
                                          <img id="pic" src="{{url('/')}}/resources/views/Admin/assets/img/uploadimg.png"/>
                                          <p>Drag & Drop image here</p>
                                       </label>
                                       <input type="file" id="uploadimg" class="profilehideimg" name="user_profile" name="uploadimg" oninput="pic.src=window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="col-md-12 px-2">
                                 <div class="form-group">
                                    <label class="d-flex align-items-center">
                                    <input type="checkbox" name="user_confirmation_email" value="1" class="mr-1" checked=""/>Send confirmation email?
                                    </label>
                                 </div>
                              </div>
                        </div>
                     </div>
                     <input type="hidden" name="uid" value="{{$uid}}">
                     <button type="submit" class="btn btn-primary mt-3 ">
                     Save
                     </button>
                   </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('organization.layout.footer')
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
         
      $(document).ready(function() {
        $.validator.addMethod("requiredIfPasswordExists", function(value, element) {
        var password = $('#user_password').val();
        if (password.length > 0) {
          return value.length > 0;
        }
        return true;
      }, "Confirm password is required when password is specified.");

      $('#addpernt').validate({
        // Specify validation rules
        rules: {
          user_first_name: 'required',
          user_last_name: 'required',
          user_email: {
            required: true,
            email: true
          },
         division: 'required',
          user_confirmpasswordy: {
            equalTo: '#user_password',
            requiredIfPasswordExists: true
          },
        },
        
        // Specify validation error messages
        messages: {
          user_first_name: 'Please enter first name',
          user_last_name: 'Please enter last name',
          user_email: {
            required: 'Please enter your email address',
            email: 'Please enter a valid email address'
          },
        division:{
            required: 'Please enter division',
        },
          user_confirmpasswordy: {
            required: 'Please confirm your password',
            equalTo: 'Passwords do not match'
          },
        },
        

      });
    });
          
          
         
      </script>