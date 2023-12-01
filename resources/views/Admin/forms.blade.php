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
                     <h1 class="headmain mb-0">Forms</h1>
                     <p  class="subhead  mb-0">Here are a list of your organisations forms</p>
                  </div>
                  <div class="col-xl-5 col-12 px-2 text-right">
                     <a href="javascript:void(0)"  data-toggle="modal" data-target="#addformModal" class="btn btn-primary btn2">Add Form</a>
                  </div>
               </div>
               <input type="hidden" name="mainurl" class="mainurl" value="{{url('/')}}">
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-content">
                         
                              <div class=" py-4 p-3 searchfilter">
                                 <div class="row ">
                                    <div class="col-md-6">
                                       <div class="dropdown filterdrop">
                                          <a class="dropdown-toggle " href="javascript:void(0);" id="dropdownMenuLink104" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span><img src="{{url('/')}}/resources/views/Admin/assets/img/filter.svg"/> Filters</span> <img src="{{url('/')}}/resources/views/Admin/assets/img/arow-down6.svg"/>
                                          </a>
                                          <div class="dropdown-menu position-absolute designable-css" aria-labelledby="dropdownMenuLink104">
                                             <form action="{{ url('/forms') }}" method="GET"  id="searchform" >
                                             <h2>Filters</h2>
                                             <div class="form-group">
                                                <label>Form name</label>
                                                <input type="text" name="search" placeholder="Search" value="{{@$_GET['search']}}" class="searchtable" id="searchtop">
                                                </div>
                                             <div class="form-group">
                                                <label>First name</label>
                                                <input type="text" name="first_name" value="{{@$_GET['first_name']}}" placeholder="First name"  class="searchtable" id="searchtop">
                                             </div>
                                             <div class="form-group">
                                                <label>Surname</label>
                                                <input type="text" name="surname" value="{{@$_GET['surname']}}" placeholder="surname"  class="searchtable" id="searchtop">
                                             </div>
                                             <div class="form-group">
                                                <label>Form text content</label>
                                                <input type="text" name="content" value="{{@$_GET['content']}}" placeholder="content"  class="searchtable" id="searchtop">
                                             </div>
                                           
                                             <hr>
                                             <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" placeholder="Status" class="form-control selectpicker">
                                                    <option value="">All</option>
                                                    <option value="0" {{@$_GET['status'] == '0' ? 'selected' : ''}}>Pending</option>
                                                    <option value="1" {{@$_GET['status'] == '1' ? 'selected' : ''}}>Completed</option>
                                                    <option value="2" {{@$_GET['status'] == '2' ? 'selected' : ''}}>Need Action</option>
                                                    <!--<option value="2">Need Action</option>-->
                                                </select>
                                             </div>
                                             <hr>
                                             <div class="form-group">
                                                <label>Form type</label>
                                                <select name="form_type" placeholder="Form Type" class="form-control selectpicker">
                                                    <option value="">All</option>
                                                    @foreach($form_name as $name)
                                                        <?php $selected = ''; ?>
                                                        @if($name == @$_GET['form_type'])
                                                        <?php $selected = 'selected="selected"'; ?>
                                                        @endif
                                                        <option {{$selected}} value="{{$name}}">{{$name}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                             </div>
                                             <hr>
                                             <div class="form-group">
                                                <label class="mb-1">Date Range</label>
                                                <div class="row pad-lr-10">
                                                   <div class="col-md-6 px-1">
                                                      <div class="daterange">
                                                         <span>From</span>
                                                         <input id="basicFlatpickr1" name="from_date" value="{{@$_GET['from_date']}}" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Select Date..">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6 px-1">
                                                      <div class="daterange">
                                                         <span>To</span>
                                                         <input id="basicFlatpickr2" name="to_date" value="{{@$_GET['to_date']}}" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Select Date..">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="btn-bottom text-left mt-4">
                                                <button  class="btn btn-secondary btn-outline-secondary click_change">Reset</button>
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
                            <div class="table-responsive">
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
                                          <div class="th-content">Date Created</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Form Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Status</div>
                                       </th>
                                       <!-- <th>-->
                                       <!--   <div class="th-content">Background Location</div>-->
                                       <!--</th>-->
                                       <th>
                                          <div class="th-content">Download</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Assign</div>
                                       </th>
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
                                                    <a class="dropdown-item titleditor" href="javascript:void(0);" data-toggle="modal" data-target="#editformModal" data-value="{{$f->form_title}}" custom-status="{{$f->default_status}}" data-id="{{$f->id}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/>Edit Title/Status</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails/{{$f->id}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item deleteclass" data-id="{{$f->id}}" data-table="forms" data-url="{{url('/delete-forms')}}" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <?php 
                                                    if($f->location_required == '1'){
                                                         $src_file = url('/').'/resources/views/Admin/assets/img/location.svg';
                                                    }else{
                                                         $src_file = url('/').'/resources/views/Admin/assets/img/locationOff.svg';
                                                    }
                                                    ?>
                                                   <a class="dropdown-item" data-id="{{$f->id}}" id="location_toggle" href="javascript:void(0);"><img src="{{ $src_file }}"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$f->formid}} </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$f->created_at->format('j F Y');   }} </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$f->form_title}}</div>
                                       </td>
                                       <td>
                                           
                                          <!--<div class="td-content">-->
                                          <!--   <span class="form-status completedstatus"><span></span>Completed</span>-->
                                          <!--</div>-->
                                           
                                           
                                            @if($f->default_status=="0")
                                             <div class="td-content">
                                             <span class="form-status btn-warning">Pending  </span>
                                             </div>
                                             @endif
                                             @if($f->default_status=="1")
                                              <div class="td-content">
                                               <span class="form-status btn-success">Completed</span>
                                                 </div>
                                                @endif
                                                  @if($f->default_status=="2")
                                                      <div class="td-content">
                                                 <span class="form-status btn-danger"> Need Action </span>
                                                 </div>
                                                  @endif
                                                  @if($f->default_status==NULL)
                                                    <div class="td-content">
                                                     <span class="form-status btn-primary"> N/A </span>
                                                    </div>
                                                   @endif
                                                  
                                          </div>
                                           
                                          
                                      
                                       </td>
                                       <!-- <td>-->
                                       <!--    <div class="td-content switchstatus">-->
                                       <!--      <label class="switch s-success">-->
                                       <!--      <input type="checkbox" value="1"    onchange= >-->
                                       <!--      <span class="slider round"></span>		-->
                                       <!--      <span class="active">ON</span> 												-->
                                       <!--      <span  class="inactive">OFF</span> 												-->
                                       <!--      </label>-->
                                       <!--   </div>-->
                                       <!--</td>-->
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download classassign"  data-toggle="modal" data-id="{{$f->id}}" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                      @endforeach
                                     @endif
                                   <!--  <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022</div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect</div>
                                       </td>
                                       <td>
                                          <div class="td-content"> <span class="form-status completedstatus"><span></span>Completed</span></div>
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
                                                         <input type="radio" name="radiobtn2" id="radio93"/>	
                                                         <label  for="radio93">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn2" id="radio94"/>	
                                                         <label  for="radio94">
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" data-toggle="modal" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022</div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report</div>
                                       </td>
                                       <td>
                                          <div class="td-content"> <span class="form-status inprogressstatus"><span></span>In-progress</span></div>
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
                                                         <input type="radio" name="radiobtn3" id="radio83"/>	
                                                         <label  for="radio83">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn3" id="radio84"/>	
                                                         <label  for="radio84">
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop inprogressdrop">
                                                <a class="dropdown-toggle download" data-toggle="modal" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop ">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022</div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content"> <span class="form-status completedstatus"><span></span>Completed</span></div>
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
                                                         <input type="radio" name="radiobtn4" id="radio73"/>	
                                                         <label  for="radio73">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn4" id="radio74"/>	
                                                         <label  for="radio74">
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" data-toggle="modal" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022</div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report</div>
                                       </td>
                                       <td>
                                          <div class="td-content"> <span class="form-status completedstatus"><span></span>Completed</span></div>
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
                                                         <input type="radio" name="radiobtn5" id="radio63"/>	
                                                         <label  for="radio63">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn5" id="radio64"/>	
                                                         <label  for="radio64">
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" data-toggle="modal" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022</div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check</div>
                                       </td>
                                       <td>
                                          <div class="td-content"> <span class="form-status completedstatus"><span></span>Completed</span></div>
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
                                                         <input type="radio" name="radiobtn6" id="radio53"/>	
                                                         <label  for="radio53">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn6" id="radio54"/>	
                                                         <label  for="radio54">
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" data-toggle="modal" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022</div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report</div>
                                       </td>
                                       <td>
                                          <div class="td-content"> <span class="form-status inprogressstatus"><span></span>In-progress</span></div>
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
                                                         <input type="radio" name="radiobtn7" id="radio43"/>	
                                                         <label  for="radio43">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn7" id="radio44"/>	
                                                         <label  for="radio44">
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop inprogressdrop">
                                                <a class="dropdown-toggle download" data-toggle="modal" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022</div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content"> <span class="form-status completedstatus"><span></span>Completed</span></div>
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
                                                         <input type="radio" name="radiobtn8" id="radio33"/>	
                                                         <label  for="radio33">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn8" id="radio34"/>	
                                                         <label  for="radio34">
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" data-toggle="modal" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022</div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content"> <span class="form-status completedstatus"><span></span>Completed</span></div>
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
                                                         <input type="radio" name="radiobtn9" id="radio23"/>	
                                                         <label  for="radio23">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn9" id="radio24"/>	
                                                         <label  for="radio24">
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" data-toggle="modal" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/formdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/location.svg"/>Location</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022</div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content"> <span class="form-status completedstatus"><span></span>Completed</span></div>
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
                                                         <input type="radio" name="radiobtn10" id="radio13"/>	
                                                         <label  for="radio13">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn10" id="radio14"/>	
                                                         <label  for="radio14">
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
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" data-toggle="modal" data-target="#assignModal">
                                                Assign <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr> -->
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
                        <label>Default status</label>
                        <select class="form-control" name="status">
                            <option>Select Default status</option>
                             <option value="0">Pending</option>
                             <option value="1">Complete</option>
                              <option value="2">Need action</option>
                        </select>
                       
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
                         <label>Default status</label>
                        <select class="form-control" name="status" id="dstatusedit">
                            <option>Select Default status</option>
                             <option value="0">Pending</option>
                             <option value="1">Complete</option>
                              <option value="2">Need action</option>
                        </select>
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
       <script src="{{url('/')}}/resources/views/Admin/assets/js/libs/jquery-3.1.1.min.js"></script>
        <script type="text/javascript">
    $(document).ready(function(e){   
    
 // update location status
  document.getElementById("location_toggle").addEventListener("click", function (ev) {
    //   console.log(ev);
    //   console.log("this", this.getAttribute("data-id"))
          $.ajax({
                      url : "{{ route('location_flag_update') }}",
                      type:'GET',
                      dataType:'json', 
                      data:{'id':this.getAttribute("data-id")},
                        success:function(response)
                        {
                          if(response.code==200)
                          {
                                   location.reload();
                                //   alert(response.message)
                          }
                          else
                          {
                                  alert(response.message)
                          }
                        },error:function(errorResponse)
                        {
                          if(errorResponse.status == 401)
                          {
                             location.reload();
                          }
                        }
                    })
//   alert("hittt")
    });

        // $('#location_toggle').on('click', function () {
        //     alert("hit")
        //     var elm=this;
           
        //             //Updating Location status function starts
                    
        //             // $.ajax({
        //             //   url : "{{ route('location_flag_update') }}",
        //             //   type:'POST',
        //             //   dataType:'json', 
        //             //   data:{'id':$(elm).attr('data-id')},
        //             //     success:function(response)
        //             //     {
        //             //       if(response.code==200)
        //             //       {
                                 
        //             //               alert(response.message)
        //             //       }
        //             //       else
        //             //       {
        //             //               alert(response.message)
        //             //       }
        //             //     },error:function(errorResponse)
        //             //     {
        //             //       if(errorResponse.status == 401)
        //             //       {
        //             //          location.reload();
        //             //       }
        //             //     }
        //             // })
        //             //update location status function ends
        //         }
               
           
        });


</script>
//     <script type="text/javascript">
        $(".click_change").click(function(e){
           e.preventDefault();
        window.location.href="{{url('/')}}/forms";
    });
//     $(document).ready(function(e){   
        
//  // update location status
//         $('.location_toggle').on('click', function () {
//             alert("hit")
//             var elm=this;
           
//                     //Updating Location status function starts
                    
//                     $.ajax({
//                       url : "{{ route('location_flag_update') }}",
//                       type:'POST',
//                       dataType:'json', 
//                       data:{'id':$(elm).attr('data-id')},
//                         success:function(response)
//                         {
//                           if(response.code==200)
//                           {
                                 
//                                   alert(response.message)
//                           }
//                           else
//                           {
//                                   alert(response.message)
//                           }
//                         },error:function(errorResponse)
//                         {
//                           if(errorResponse.status == 401)
//                           {
//                              location.reload();
//                           }
//                         }
//                     })
//                     //update location status function ends
//                 }
               
           
//         });


// </script>
      
     

      <!--  Edit Form Modal Ends -->
    @include('Admin.layout.footer')