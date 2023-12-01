@include('organization.layout.header')
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('organization.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                       <form action="{{ route('organization.add.users') }}" method="POST"  id="addorganisationuserform" onsubmit="return false">
                        @csrf
                     <div class="widget formusers">
                        <div class="widget-content px-2">
                           <h3 class="headmaininner">Add User </h3>
                           <div class="row px-2">
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter First Name"/>
                                    <input type="hidden" value="{{$id}}" name="parent">
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" class="form-control" placeholder="Enter Last Name"/>
                                 </div>
                              </div>
                               <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Division</label>
                                    <input type="text" name="division" class="form-control" placeholder="Enter division"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" placeholder="csdsasd" name="status">
                                       <option value="" selected>Select Status</option>
                                       <option value="1">Active</option>
                                       <option value="0">Inactive</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password"  class="form-control" placeholder="Enter Password"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirmpassword"  class="form-control" placeholder="Confirm Password"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Upload Image</label>
                                    <div class="uploadimg">
                                       <label for="uploadimg">
                                          <img id="pic" src="{{url('/')}}/resources/views/organization/assets/img/uploadimg.png"/>
                                          <p>Drag & Drop image here</p>
                                       </label>
                                       <input type="file" id="uploadimg" name="uploadimg" oninput="pic.src=window.URL.createObjectURL(this.files[0])" style="display:none"/>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 px-2">
                                 <div class="form-group">
                                    <label class="d-flex align-items-center">
                                    <input type="checkbox" name="confirmation_email" value="1" checked="" class="mr-1"/>Send confirmation email?
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <button class="btn btn-primary btn-rounded mt-3 submit-button4">
                     Save
                     </button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('organization.layout.footer')