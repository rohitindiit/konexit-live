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
                  <div class="col-xl-12 col-12 px-2">
                     <h1 class="headmain mb-0">Organization Submissions</h1>
                     <p  class="subhead  mb-0">Here are some tips and setup tasks to help you get started</p>
                  </div>
               </div>
               <div class="row">
                   
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
                                          <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink104">
                                            <form action="{{ url('/submissions/'.$orgid) }}" method="GET"  id="searchform" >
                                             <h2>Filters</h2>
                                             <div class="form-group">
                                                <label>Form name</label>
                                                <input type="text" name="search" placeholder="Search"  class="searchtable" id="searchtop">
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
                                    <div class="col-md-6 text-right">
                                       <input type="text" placeholder="Search"  class="searchtable" id="searchtop">
                                    </div>
                                 </div>
                              </div>
                              <table class="table"  id="example">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Actions</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Submitted on</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Form Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Status</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Submitted by</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Organisation</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Submission ID</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Download</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                      @if(isset($submissions) && count($submissions) > 0)
                                      @foreach($submissions as $s)
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails/{{$s->id}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{date('j M Y', strtotime($s->created_at))}}<span class="timeframe">{{date('g:i A', strtotime($s->created_at))}}</span></div>
                                       </td>
                                       <td>
                                           @if($s->changedtitle != '' &&  $s->changedtitle != null)
                                           <div class="td-content">{{$s->changedtitle}}</div>
                                           @elseif($s->formtitle != '' &&  $s->formtitle != null)
                                           <div class="td-content">{{$s->formtitle}}</div>
                                           @endif
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 pendingstatus2"><span></span> <?php echo ($s->status == 0) ? 'Pending' : (($s->status == 1) ? 'Completed' : 'Need Action'); ?>  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>                                                    
      </label>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" class="radiobtn02" value="0" name="radiobtn02{{$s->id}}" id="radio001{{$s->id}}"  <?php echo ($s->status == 0) ? 'checked' : ''; ?> />	
                                                         <label  for="radio001{{$s->id}}">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" class="radiobtn02" value="1" name="radiobtn02{{$s->id}}" id="radio002{{$s->id}}" <?php echo ($s->status == 1) ? 'checked' : ''; ?> />	
                                                         <label  for="radio002{{$s->id}}">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" class="radiobtn02" value="2" name="radiobtn02{{$s->id}}" id="radio003{{$s->id}}" <?php echo ($s->status == 2) ? 'checked' : ''; ?> />	
                                                         <label  for="radio003{{$s->id}}">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3 apply-button">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$s->user_first_name.' '.$s->user_last_name}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$s->organization_name}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$s->id}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                     <!-- <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio1"/>	
                                                         <label  for="radio1">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>-->
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio2"/>	
                                                         <label  for="radio2">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <!--<button class="btn btn-primary mt-3">Download</button>-->
                                                    <a href="{{ route('admin.submission.csv', ['id' => $s->id, 'parentid' => $s->organization_id ]) }}" class="btn btn-primary mt-3">Download</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                   <!-- <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 needactionstatus2"><span></span>Need Action  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn03" id="radio004"/>	
                                                         <label  for="radio004">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn03" id="radio005"/>	
                                                         <label  for="radio005">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn03" id="radio006"/>	
                                                         <label  for="radio006">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Wonka Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
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
                                                         <input type="radio" name="radiobtn2" id="radio3"/>	
                                                         <label  for="radio3">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn2" id="radio4"/>	
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 completedstatus2"><span></span>Completed  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn04" id="radio007"/>	
                                                         <label  for="radio007">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn04" id="radio008"/>	
                                                         <label  for="radio008">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn04" id="radio009"/>	
                                                         <label  for="radio009">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Wonka Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink3">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn3" id="radio5"/>	
                                                         <label  for="radio5">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn3" id="radio6"/>	
                                                         <label  for="radio6">
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 needactionstatus2"><span></span>Need Action  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn05" id="radio0010"/>	
                                                         <label  for="radio0010">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn05" id="radio0011"/>	
                                                         <label  for="radio0011">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn05" id="radio0012"/>	
                                                         <label  for="radio0012">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Gekko & Co</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink4">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn4" id="radio7"/>	
                                                         <label  for="radio7">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn4" id="radio8"/>	
                                                         <label  for="radio8">
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 pendingstatus2"><span></span>Pending  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn06" id="radio0013"/>	
                                                         <label  for="radio0013">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn06" id="radio0014"/>	
                                                         <label  for="radio0014">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn06" id="radio0015"/>	
                                                         <label  for="radio0015">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Ollivander's Wand</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink21" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink21">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn5" id="radio21"/>	
                                                         <label  for="radio21">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn5" id="radio22"/>	
                                                         <label  for="radio22">
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 needactionstatus2"><span></span>Need Action  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn07" id="radio0016"/>	
                                                         <label  for="radio0016">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn07" id="radio0017"/>	
                                                         <label  for="radio0017">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn07" id="radio0018"/>	
                                                         <label  for="radio0018">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink22" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink22">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn6" id="radio23"/>	
                                                         <label  for="radio23">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn6" id="radio24"/>	
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 completedstatus2"><span></span>Completed  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn08" id="radio0019"/>	
                                                         <label  for="radio0019">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn08" id="radio0020"/>	
                                                         <label  for="radio0020">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn08" id="radio0021"/>	
                                                         <label  for="radio0021">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Cyberdyne</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink23" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink23">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn7" id="radio25"/>	
                                                         <label  for="radio25">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn7" id="radio26"/>	
                                                         <label  for="radio26">
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 needactionstatus2"><span></span>Need Action  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn09" id="radio0022"/>	
                                                         <label  for="radio0022">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn09" id="radio0023"/>	
                                                         <label  for="radio0023">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn09" id="radio0024"/>	
                                                         <label  for="radio0024">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink24" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink24">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn8" id="radio27"/>	
                                                         <label  for="radio27">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn8" id="radio28"/>	
                                                         <label  for="radio28">
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 pendingstatus2"><span></span>Pending  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn010" id="radio0025"/>	
                                                         <label  for="radio0025">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn010" id="radio0026"/>	
                                                         <label  for="radio0026">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn010" id="radio0027"/>	
                                                         <label  for="radio0027">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Genco Pura Olive</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink11" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink11">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn9" id="radio11"/>	
                                                         <label  for="radio11">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn9" id="radio12"/>	
                                                         <label  for="radio12">
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 completedstatus2"><span></span>Completed  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn011" id="radio0028"/>	
                                                         <label  for="radio0028">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn011" id="radio0029"/>	
                                                         <label  for="radio0029">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn011" id="radio0030"/>	
                                                         <label  for="radio0030">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink12">
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 needactionstatus2"><span></span>Need Action  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn012" id="radio0031"/>	
                                                         <label  for="radio0031">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn012" id="radio0032"/>	
                                                         <label  for="radio0032">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn012" id="radio0033"/>	
                                                         <label  for="radio0033">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Wonka Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink13" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink13">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn11" id="radio15"/>	
                                                         <label  for="radio15">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn11" id="radio16"/>	
                                                         <label  for="radio16">
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="form-status2 pendingstatus2"><span></span>Pending <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Status</h2>
                                                   <div class="radiobtn2">
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn013" id="radio0034"/>	
                                                         <label  for="radio0034">																			    
                                                         <span class="checkmark"></span> Pending
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn013" id="radio0035"/>	
                                                         <label  for="radio0035">
                                                         <span class="checkmark"></span> Completed
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner2">
                                                         <input type="radio" name="radiobtn013" id="radio0036"/>	
                                                         <label  for="radio0036">
                                                         <span class="checkmark"></span> Need Action
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Apply</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink14">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn12" id="radio17"/>	
                                                         <label  for="radio17">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn12" id="radio18"/>	
                                                         <label  for="radio18">
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
                                    </tr>-->
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        
                         <div class="d-flex justify-content-center">
                                         {!! $submissions->links() !!}
                                      </div>
                                      
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     @include('Admin.layout.footer')
     
<script>
// jQuery document ready
$(document).ready(function() {
    var selectedValue; // Variable to store the selected radio button value

    // Handle radio button change event
    $('.radiobtn02').change(function() {
        selectedValue = $(this).val(); // Update the selectedValue variable
    });
var csrfToken = $('meta[name="csrf-token"]').attr('content');
    // Handle Apply button click event
    $('.apply-button').click(function() {
        var submissionId = $(this).siblings('.radiobtn2').find('.radiobtn02:checked').attr('name').replace('radiobtn02', ''); // Extract the submission ID from the radio button name
        var baseUrl2 = window.location.origin;
        var baseUrl = "<?php echo url('/'); ?>";

        // Perform an AJAX request to post the value to the specific URL
        $.ajax({
            url: baseUrl +'/submitted_from_status',
            method: 'POST',
             headers: {
              'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            data: {
                submissionId: submissionId,
                value: selectedValue
            },
            success: function(response) {
                // Success callback function
                console.log('Value posted successfully.');
                window.location.reload();
            },
            error: function(xhr, status, error) {
                // Error callback function
                console.error('Error posting value:', error);
            }
        });
    });
});
</script>   