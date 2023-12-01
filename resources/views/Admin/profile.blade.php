@include('Admin.layout.header')
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('Admin.layout.sidebar')

          @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        <img src="{{ Session::get('image') }}">
        @endif
    
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row layout-top-spacing profilesettings">
                  <div class="col-xl-12 col-12 px-2 mb-3">
                     <h1 class="headmain mb-0">Settings</h1>
                     <!--<p  class="subhead  mb-0">Here are some tips and setup tasks to help you get started</p>-->
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 mb-3 px-2">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="profilesettings-tab" data-toggle="tab" data-target="#profilesettings" type="button" role="tab" aria-controls="profilesettings" aria-selected="true">Profile Settings</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="changepassword-tab" data-toggle="tab" data-target="#changepassword" type="button" role="tab" aria-controls="changepassword" aria-selected="false">Change Password</button>
                        </li>
                     </ul>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget formusers">
                        <div class="widget-content">
                           <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="profilesettings" role="tabpanel" aria-labelledby="profilesettings-tab">
                                <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data" id="profileform" onsubmit="return false">
                                 @if($profile != 'undefined' && $profile != null)
                                 @csrf
                                 <div class="row  p-2">
                                    <div class="col-lg-4 col-md-4">
                                       <div class="companylogo mh-companylogo">
                                          <h3 class="headmaininner">Profile Picture</h3>
                                          <div class="companylogoinner">
                                             <div class="companyimg">
                                                <img  id="profileimage" src="{{$profile->profile ? $profile->profile : url('/resources/views/Admin/assets/img/usericon.svg')}}"/>	
                                                <label for="choosefile">Choose</label>
                                                <input type="file" id="choosefile" name="choosefile" style="display:none"/>													 
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                       <h3 class="headmaininner  mb-4 mt-3">Profile Info</h3>
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="form-group fieldinner">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="Enter First Name" name="name" value="{{ $profile->name ? $profile->name : '' }}"/>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group fieldinner">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" value="{{ $profile->lname ? $profile->lname : '' }}"/>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group fieldinner">
                                          <label>Email</label>
                                          <input type="email" class="form-control" placeholder="Enter Email" name="email" value="{{ $profile->email ? $profile->email : '' }}"/>
                                       </div>
                                       <div class="form-group">
                                          <button type="submit" class="btn btn-height btn-primary mt-3 submit-button">
                                          Save
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                                  @endif
                                 </form>
                              </div>
                              <div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
                                 <div class="row  p-5">
                                    <div class="col-lg-8 offset-lg-2">
                                       <form action="{{ route('update.password') }}" method="POST" id="passwordform" onsubmit="return false"> 
                                        @csrf
                                       <h3 class="headmaininner mb-4">Change Password</h3>
                                       <div class="form-group fieldinner">
                                          <label>Current Password</label>
                                          <div class="form-inner">
                                             <input type="password" name="currentpassword" id="currentpassword" class="form-control" placeholder="***********"/>
                                             <span><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/></span>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label>New Password</label>
                                          <div class="form-inner fieldinner">
                                             <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="***********"/>
                                             <span><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/></span>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label>Confirm Password</label>
                                          <div class="form-inner fieldinner">
                                             <input type="password"  name="confirmpassword" id="confirmpassword" class="form-control" placeholder="***********"/>
                                             <span><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/></span>
                                          </div>
                                       </div>
                                       <button type="submit" class="btn btn-primary  mt-3 btn-height submit-button1">
                                       Save
                                       </button>
                                      </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@include('Admin.layout.footer')