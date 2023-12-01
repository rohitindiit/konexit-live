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
                  <div class="col-xl-7 col-12 px-2 ">
                     <h1 class="headmain mb-0">Organization User Forms</h1>
                     <p  class="subhead  mb-0">Here are some tips and setup tasks to help you get started</p>
                  </div>
                 <!-- <div class="col-xl-5 col-12 px-2 text-right">
                     <a href="javascript:void(0)"  data-toggle="modal" data-target="#addformModal" class="btn btn-primary btn2">Add Form</a>
                  </div>-->
               </div>
               <input type="hidden" name="mainurl" class="mainurl" value="{{url('/')}}">
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-content">
                           <div class="table-responsive">
                              <div class=" py-4 p-3 searchfilter">
                                 <div class="row ">
                                    <div class="col-md-6">
                                       <div class="dropdown filterdrop">
                                          <a class="dropdown-toggle " href="javascript:void(0);" id="dropdownMenuLink104" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span><img src="{{url('/')}}/resources/views/Admin/assets/img/filter.svg"/> Filters</span> <img src="{{url('/')}}/resources/views/Admin/assets/img/arow-down6.svg"/>
                                          </a>
                                          <div class="dropdown-menu position-absolute designable-css" aria-labelledby="dropdownMenuLink104">
                                             <form action="{{ url($url) }}" method="GET"  id="searchform" >
                                             <h2>Filters</h2>
                                             <div class="form-group">
                                                <label>Form name</label>
                                                <input type="text" name="search" placeholder="Search"  class="searchtable" id="searchtop">
                                                <!-- <select class="form-control">
                                                   <option>HGV vehicle check</option>
                                                   <option>HGV vehicle check and defect report (SC)</option>
                                                </select> -->
                                             </div>
                                             <hr>
                                             <div class="form-group">
                                                <label class="mb-1">Date Range</label>
                                                <div class="row pad-lr-10">
                                                   <div class="col-md-6 px-1">
                                                      <div class="daterange">
                                                         <span>From</span>
                                                         <input id="basicFlatpickr1" name="from_date" value="" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Select Date..">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6 px-1">
                                                      <div class="daterange">
                                                         <span>To</span>
                                                         <input id="basicFlatpickr2" name="to_date"  value="" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Select Date..">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="btn-bottom text-left mt-4">
                                                <button  class="btn btn-secondary btn-outline-secondary">Reset</button>
                                                <button class="btn btn-primary">Apply</button>
                                             </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                  <!--   <div class="col-md-6 text-right">
                                       <input type="text" placeholder="Search"  class="searchtable" id="searchtop">
                                    </div> -->
                                 </div>
                              </div>
                              <table class="table"  id="example">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Actions</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Form ID</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Assign Date</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Form Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Status</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Download</div>
                                       </th>
                                       <!--<th>
                                          <div class="th-content">Assign</div>
                                       </th>-->
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @if(isset($forms) && count($forms) > 0)
                                      @foreach($forms as $f)
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle notdisplay" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formedit/{{$f->id}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/>Edit</a>
                                                    <a class="dropdown-item titleditor" href="javascript:void(0);" data-toggle="modal" data-target="#editformModal" data-value="{{$f->form_title}}" data-id="{{$f->id}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/>Edit Title</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails/{{$f->id}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item deleteclass" data-id="{{$f->id}}" data-table="forms" data-url="{{url('/delete-forms')}}" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$f->formid}} </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{date('j M Y', strtotime($f->assigndate))}} <!--$f->created_at->format('j F Y');   --> </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$f->form_title}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <span class="form-status completedstatus"><span></span>Completed</span>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio3"/>	
                                                         <label  for="radio3">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio4"/>	
                                                         <label  for="radio4">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                     <!--  <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download classassign"  data-toggle="modal" data-id="{{$f->id}}" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>-->
                                    </tr>
                                      @endforeach
                                     @endif
                                 </tbody>
                              </table>
                           </div>
                        </div>
                         <div class="d-flex justify-content-center">
                                       {!! $forms->links() !!}
                                      </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Assign Modal Start -->
      <div class="modal fade modalform" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body">
                  <h5 class="modal-title mb-2">Assign</h5>
                  <div class="modal-inner mb-3">
                     <div class="form-group">
                       <!--  <input type="text" class="assigninputs" value="" data-role="tagsinput" placeholder="Search for user" /> -->

                        <select class="form-select" id="validationTagsJson" name="tags_json[]" multiple 
                        data-allow-new="false" 
                        data-autoselect-first="0"
                        data-not-found-message="No valid results"
                        data-server="{{url('/search-organizations')}}" 
                        data-live-server="1" (change)="selectedvale(e);" 
                        data-formid="" 
                        data-allow-clear="true">
            <option disabled hidden value="">Choose a tag...</option>
          </select>


                     </div>
                     <hr>
                     <div class="userasignlist">
                        <div  ss-container>
                           <ul class="assignedusersname">
                             <!--  <li>
                                 <div>
                                    <h3>John Delahay</h3>
                                    <p class="mb-0">Johndelahay22@gmail.com</p>
                                 </div>
                                 <a href="javascript:void(0)" class="deleteuserlist">
                                 <img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
                                 </a>
                              </li>
                              <li>
                                 <div>
                                    <h3>Benjamin</h3>
                                    <p class="mb-0">Benjamin562@gmail.com</p>
                                 </div>
                                 <a href="javascript:void(0)" class="deleteuserlist">
                                 <img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
                                 </a>
                              </li>
                              <li>
                                 <div>
                                    <h3>Jackson</h3>
                                    <p class="mb-0">Jackson888@gmail.com</p>
                                 </div>
                                 <a href="javascript:void(0)" class="deleteuserlist">
                                 <img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
                                 </a>
                              </li>
                              <li>
                                 <div>
                                    <h3>John Delahay</h3>
                                    <p class="mb-0">Johndelahay22@gmail.com</p>
                                 </div>
                                 <a href="javascript:void(0)" class="deleteuserlist">
                                 <img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
                                 </a>
                              </li>
                              <li>
                                 <div>
                                    <h3>Benjamin</h3>
                                    <p class="mb-0">Benjamin562@gmail.com</p>
                                 </div>
                                 <a href="javascript:void(0)" class="deleteuserlist">
                                 <img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
                                 </a>
                              </li>
                              <li>
                                 <div>
                                    <h3>Jackson</h3>
                                    <p class="mb-0">Jackson888@gmail.com</p>
                                 </div>
                                 <a href="javascript:void(0)" class="deleteuserlist">
                                 <img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
                                 </a>
                              </li>
                              <li>
                                 <div>
                                    <h3>John Delahay</h3>
                                    <p class="mb-0">Johndelahay22@gmail.com</p>
                                 </div>
                                 <a href="javascript:void(0)" class="deleteuserlist">
                                 <img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
                                 </a>
                              </li>
                              <li>
                                 <div>
                                    <h3>Benjamin</h3>
                                    <p class="mb-0">Benjamin562@gmail.com</p>
                                 </div>
                                 <a href="javascript:void(0)" class="deleteuserlist">
                                 <img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
                                 </a>
                              </li>
                              <li>
                                 <div>
                                    <h3>Jackson</h3>
                                    <p class="mb-0">Jackson888@gmail.com</p>
                                 </div>
                                 <a href="javascript:void(0)" class="deleteuserlist">
                                 <img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
                                 </a>
                              </li> -->
                           </ul>
                        </div>
                     </div>
                  </div>
                  <button type="button" class="btn btn-secondary btn-outline-secondary mr-2" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Assign Modal Ends -->
      <!-- Add Form Modal Start -->
      <div class="modal fade modalform" id="addformModal" tabindex="-1" aria-labelledby="addformModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content px-3 py-3">
               <div class="modal-body mb-3">
                  <form action="{{ url('/formbuilder') }}" method="GET" id="titleform" >
                  <h5 class="modal-title mb-3">Add Form</h5>
                  <div class="modal-inner formusers">
                     <div class="form-group  mb-4 fieldinner">
                        <label>Form Name</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Form Name" value=""/>
                     </div>
                  </div>
                  <button type="button" class="btn btn-secondary btn-outline-secondary mr-2" data-dismiss="modal">Cancel</button>
                  <!-- <a href="{{url('/')}}/formbuilder" class="btn btn-primary">Proceed</a> -->
                  <button type="submit" class="btn btn-primary">Proceed</button>
                 </form>
               </div>
            </div>
         </div>
      </div>
      <!--  Add Form Modal Ends -->

      <!-- Edit Form Modal Start -->
      <div class="modal fade modalform" id="editformModal" tabindex="-1" aria-labelledby="addformModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content px-3 py-3">
               <div class="modal-body mb-3">
                  <form action="{{ route('edit.formtitle') }}" method="POST" id="titleform" >
                     @csrf
                  <h5 class="modal-title mb-3">Edit Form Title</h5>
                  <input type="hidden" name="formid" class="formidclass" value="">
                  <div class="modal-inner formusers">
                     <div class="form-group  mb-4 fieldinner">
                        <label>Form Title</label>
                        <input type="text" class="form-control titleclass" name="title" placeholder="Enter Form Title" value=""/>
                     </div>
                  </div>
                  <button type="button" class="btn btn-secondary btn-outline-secondary mr-2" data-dismiss="modal">Cancel</button>
                  <!-- <a href="{{url('/')}}/formbuilder" class="btn btn-primary">Proceed</a> -->
                  <button type="submit" class="btn btn-primary">Proceed</button>
                 </form>
               </div>
            </div>
         </div>
      </div>
      <!--  Edit Form Modal Ends -->
    @include('Admin.layout.footer')