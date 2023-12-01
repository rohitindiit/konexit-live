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
                     <a href="{{route('subadmin.view')}}" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/Admin/assets/img/backarrow.svg"/></a>
                     <div>
                        <h1 class="headmain mb-1">Subadmin Permissions</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('subadmin.view')}}">Subadmin</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
               </div>
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                       <form action="{{ route('admin.add.permission') }}" method="POST"   >
                        @csrf
                     <div class="widget formusers">
                        <div class="widget-content px-2">
                           <h3 class="headmaininner">Add Permissions</h3>
                           <div class="row px-2">
                             <div class="col-md-12 px-2">
                                 <div class="form-group">
                                    <label class="d-flex align-items-center">
                                    <input type="checkbox" name="Dashboard" value="1" {{in_array('dashboard',$permisons)?'checked':''}}  class="mr-1"/>Dashboard
                                    </label>
                                 </div>
                              </div>
                              <div class="col-md-12 px-2">
                                 <div class="form-group">
                                    <label class="d-flex align-items-center">
                                    <input type="checkbox" name="Organisations" value="1" {{in_array('organisations',$permisons)?'checked':''}}  class="mr-1"/>Organisations
                                    </label>
                                 </div>
                              </div>
                               <div class="col-md-12 px-2">
                                 <div class="form-group">
                                    <label class="d-flex align-items-center">
                                    <input type="checkbox" name="SubAdmin" value="1" {{in_array('subAdmin',$permisons)?'checked':''}} class="mr-1"/>SubAdmin
                                    </label>
                                 </div>
                              </div>
                               <div class="col-md-12 px-2">
                                 <div class="form-group">
                                    <label class="d-flex align-items-center">
                                    <input type="checkbox" name="Forms" value="1" {{in_array('forms',$permisons)?'checked':''}}  class="mr-1"/>Forms
                                    </label>
                                 </div>
                              </div>
                               <div class="col-md-12 px-2">
                                 <div class="form-group">
                                    <label class="d-flex align-items-center">
                                    <input type="checkbox" name="Submissions" value="1" {{in_array('submissions',$permisons)?'checked':''}}  class="mr-1"/>Submissions
                                    </label>
                                 </div>
                              </div>
                               <div class="col-md-12 px-2">
                                 <div class="form-group">
                                    <label class="d-flex align-items-center">
                                    <input type="checkbox" name="Settings" value="1" {{in_array('settings',$permisons)?'checked':''}}  class="mr-1"/>Settings
                                    </label>
                                 </div>
                              </div>
                            <input type="hidden" value="{{$uid}}" name="user_id">
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
      @include('Admin.layout.footer')