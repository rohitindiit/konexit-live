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
                  <div class="col-xl-12 col-12 px-2 ">
                     <h1 class="headmain mb-0">Forms</h1>
                     <p  class="subhead  mb-0">Here are a list of your organisations forms</p>
                  </div>
               </div>
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-content">
                           
                              <div class=" py-4 p-3 searchfilter">
                                 <div class="row ">
                                    <div class="col-md-6">
                                       <div class="dropdown filterdrop">
                                          <a class="dropdown-toggle " href="javascript:void(0);" id="dropdownMenuLink104" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span><img src="{{url('/')}}/resources/views/organization/assets/img/filter.svg"/> Filters</span> <img src="{{url('/')}}/resources/views/organization/assets/img/arow-down6.svg"/>
                                          </a>
                                          <div class="dropdown-menu position-absolute designable-css" aria-labelledby="dropdownMenuLink104">
                                             <h2>Filters</h2>
                                             <form action="" method="get">
                                             <div class="form-group">
                                                <label>Form type</label>
                                                <select  <?php if(isset($_GET['form_type']) && $_GET['form_type']!=''){?> style="border-color:red"  <?php } ?> name="search" placeholder="Form Type" class="form-control selectpicker">
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
                                                         <input id="basicFlatpickr1" name="from_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6 px-1">
                                                      <div class="daterange">
                                                         <span>To</span>
                                                         <input id="basicFlatpickr2" name="to_date" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
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
                                    <div class="col-md-6 text-right d-none">
                                       <input type="text" placeholder="Search"  class="searchtable" id="searchtop">
                                    </div>
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
                                          <div class="th-content">Date</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Form Name</div>
                                       </th>
                                       <!-- <th>
                                          <div class="th-content">User</div>
                                       </th> -->
                                       <th>
                                          <div class="th-content">Form ID</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Download</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Assign</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     @if($paginator->items() && count($paginator->items()) > 0)
                                      @foreach($paginator->items() as $f)
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails/{{$f->id}}"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
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
                                          <div class="td-content">{{date('j F Y', strtotime($f->assigndate))}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$f->form_title}}</div>
                                       </td>
                                       <!-- <td>
                                          <div class="td-content">John Delahay</div>
                                       </td> -->
                                       <td>
                                          <div class="td-content">{{$f->formid}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio3"/>	
                                                         <label  for="radio3">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio4"/>	
                                                         <label  for="radio4">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                <a class="dropdown-toggle download classassign" data-toggle="modal" data-target="#assignModal"  data-id="{{$f->id}}" >
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/location.svg"/>Location</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13358</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn2" id="radio93"/>	
                                                         <label  for="radio93">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn2" id="radio94"/>	
                                                         <label  for="radio94">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/location.svg"/>Location</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13359</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn3" id="radio83"/>	
                                                         <label  for="radio83">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn3" id="radio84"/>	
                                                         <label  for="radio84">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/location.svg"/>Location</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13368</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn4" id="radio73"/>	
                                                         <label  for="radio73">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn4" id="radio74"/>	
                                                         <label  for="radio74">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/location.svg"/>Location</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13384</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn5" id="radio63"/>	
                                                         <label  for="radio63">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn5" id="radio64"/>	
                                                         <label  for="radio64">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/location.svg"/>Location</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn6" id="radio53"/>	
                                                         <label  for="radio53">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn6" id="radio54"/>	
                                                         <label  for="radio54">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/location.svg"/>Location</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn7" id="radio43"/>	
                                                         <label  for="radio43">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn7" id="radio44"/>	
                                                         <label  for="radio44">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/location.svg"/>Location</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13387</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn8" id="radio33"/>	
                                                         <label  for="radio33">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn8" id="radio34"/>	
                                                         <label  for="radio34">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/location.svg"/>Location</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13392</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn9" id="radio23"/>	
                                                         <label  for="radio23">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn9" id="radio24"/>	
                                                         <label  for="radio24">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/formdetails"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>View</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/>Delete</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/location.svg"/>Location</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13399</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn10" id="radio13"/>	
                                                         <label  for="radio13">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn10" id="radio14"/>	
                                                         <label  for="radio14">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
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
                                                Assign <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
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
                                 {{ $paginator->links()}}
                                      </div>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <input type="hidden" name="mainurl" class="mainurl" value="{{url('/')}}">
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
                        data-server="{{url('/search-users/'.$organizationid)}}" 
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
      
       <script src="{{url('/')}}/resources/views/Admin/assets/js/libs/jquery-3.1.1.min.js"></script>
        <script type="text/javascript">
    $(document).ready(function(e){   
    
 // update location status
  document.getElementById("location_toggle").addEventListener("click", function (ev) {
   
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

    });

        
           
        });


</script>
      <!-- Assign Modal Ends -->
       @include('organization.layout.footer')