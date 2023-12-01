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
                     <a href="{{url('/')}}/organisations" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/Admin/assets/img/backarrow.svg"/></a>
                     <div>
                        <h1 class="headmain mb-1">Edit Organisation</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{url('/')}}/organisations">Organisations</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit Organisation</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
               </div>
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                      <form action="{{ route('edit.organisation') }}" method="POST"  id="editorganisationform" onsubmit="return false">
                         @csrf
                         <input type="hidden" name="id" value="{{$organisation->id}}">
                     <div class="widget formusers">
                        <div class="widget-content px-2">
                           <h3 class="headmaininner">Add Info</h3>
                           <div class="row px-2">
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Organisation Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$organisation->name}}" placeholder="Enter Organisation Name"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group">
                                    <label>Division</label>
                                    <input type="text" name="division" class="form-control" placeholder="Enter division" value="{{$organisation->division}}"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Email</label>
                                    <input type="email"  name="email" value="{{$organisation->email}}" class="form-control" placeholder="Enter Email"/>
                                 </div>
                              </div>
                           </div>
                           <div class="row px-2">
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password"/>
                                 </div>
                              </div>
                              <div class="col-md-4 px-2">
                                 <div class="form-group fieldinner">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password"/>
                                 </div>
                              </div>
                           </div>
                             <div class="row px-2">
                               <div class="col-md-4 px-2">
                                     <div class="form-group fieldinner">
                                        <label>App User Quota</label>
                                        <input type="number" class="form-control"  min="0" name="user_quota" value="{{$organisation->user_quota}}" placeholder="User Quota"/>
                                     </div>
                                  </div>
                                    <div class="col-md-4  px-2">
                                     <div class="form-group fieldinner">
                                        <label>Desktop User Quota</label>
                                        <input type="number" class="form-control"  min="0" value="{{$organisation->desktop_quota}}"  name="desktop_quota" placeholder="User Quota"/>
                                     </div>
                                  </div>
                               </div>
                           <div class="row px-2">
                              <div class="col-md-3 px-2">
                                 <div class="form-group">
                                    <label>Upload Image</label>
                                    <div class="uploadimg fieldinner">
                                       <label for="uploadimg">
                                          <img id="pic" src="{{$organisation->profile}}"/>
                                          <p>Drag & Drop image here</p>
                                       </label>
                                       <input type="file" id="uploadimg" class="profilehideimg" name="profile" name="uploadimg" oninput="pic.src=window.URL.createObjectURL(this.files[0])" />
                                    </div>
                                 </div>
                              </div>
                             
                           </div>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary mt-3 submit-button3">
                     Save
                     </button>
                   </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
     @include('Admin.layout.footer')