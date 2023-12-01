@include('Admin.layout.header')
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
        @include('Admin.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row mb-3 layout-top-spacing align-items-center">
                  <div class="col-xl-12 col-12 px-2 d-flex ">
                     <a href="{{url('/')}}/{{$organisation->id}}/users" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/Admin/assets/img/backarrow.svg"/></a>
                     <div>
                        <h1 class="headmain mb-1">Add User</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{url('/')}}/organisations">Organisations</a></li>
                              <li class="breadcrumb-item"><a href="{{url('/')}}/{{$organisation->id}}/users">Users</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add User</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <form action="{{ route('add.organization.users',['id'=>$organisation->id]) }}" method="POST"  id="addorganisationuserform" onsubmit="return false">
                        @csrf
                     <div class="widget formusers">
                        <div class="widget-content px-2">
                           <h3 class="headmaininner">Add User</h3>
                           <div class="row px-2">
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>First Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter First Name"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Last Name</label>
                                    <input type="text"  name="lname" class="form-control" placeholder="Enter Last Name"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Email</label>
                                    <input type="email"  name="email" class="form-control" placeholder="Enter Email"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                       <option value="" selected>Select</option>
                                       <option value="1">Active</option>
                                       <option value="0">Inactive</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Confirm Password</label>
                                    <input type="password"  name="confirmpassword"  class="form-control" placeholder="Confirm Password"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Upload Image</label>
                                    <div class="uploadimg">
                                       <label for="uploadimg">
                                          <img id="pic" src="{{url('/')}}/resources/views/Admin/assets/img/uploadimg.png"/>
                                          <p>Drag & Drop image here</p>
                                       </label>
                                        <input type="file" id="uploadimg" class="profilehideimg" name="profile" name="uploadimg" oninput="pic.src=window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 px-2">
                                 <div class="form-group">
                                    <label class="d-flex align-items-center">
                                    <input type="checkbox" name="confirmation_email" value="1" class="mr-1" checked=""/>Send confirmation email?
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary mt-3 submit-button4">
                     Save
                     </button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
        @include('Admin.layout.footer')