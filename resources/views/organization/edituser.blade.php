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
                      <form action="{{ route('organization.edit.organization.users',['userid'=>$organisation->id]) }}" method="POST"  id="editorganisationuserform" onsubmit="return false">
                        @csrf
                     <div class="widget formusers">
                        <div class="widget-content px-2">
                           <h3 class="headmaininner">Edit User</h3>
                           <div class="row px-2">
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter First Name" value="{{$organisation->name}}"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text"  name="lname" class="form-control" placeholder="Enter Last Name" value="{{$organisation->lname}}"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Email</label>
                                    <input type="email"  name="email" class="form-control" placeholder="Enter Email" value="{{$organisation->email}}"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Division</label>
                                    <input type="text" name="division" class="form-control" placeholder="Enter division" value="{{$organisation->division}}"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" placeholder="csdsasd" name="status">
                                       <option value="" >Select Status</option>
                                       <option @if($organisation->status == '1') selected @endif value="1" selected>Active</option>
                                       <option @if($organisation->status == '0') selected @endif value="0">Inactive</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Password</label>
                                    <input type="password"  id="password" class="form-control" name="password" placeholder="Enter Password" value=""/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" value=""/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Upload Image</label>
                                    <div class="uploadimg">
                                       <label for="uploadimg">
                                          @if(isset($organisation->profile) && $organisation->profile != null)
                                          <img id="pic" src="{{$organisation->profile}}"/>
                                           @else
                                    <img id="pic" src="{{url('/')}}/resources/views/Admin/assets/img/uploadimg.png"/>
                                    @endif
                                          <p>Drag & Drop image here</p>
                                       </label>
                                       <input type="file" id="uploadimg" class="profilehideimg" name="profile" name="uploadimg" 
                                       oninput="pic.src=window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                    <button type="submit" class="btn btn-primary mt-3 submit-button5">
                     Save
                     </button>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
       @include('organization.layout.footer')