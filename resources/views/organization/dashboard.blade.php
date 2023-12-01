@include('organization.layout.header')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

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
                     <h1 class="headmain mb-0">Dashboard</h1>
                     <p class="subhead  mb-0">Welcome to Konexit Dashboard</p>
                  </div>
                 
               </div>
               <div class="row layout-top-spacing">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 px-2 mb-3 " onclick="window.open('{{ url('/organization/submissions?from_date=&to_date=&form_type=&status=0&content=&first_name=&surname=&search=') }}', '_blank');" style="cursor: pointer;">
                     <div class="widget d-flex p35 align-items-center">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/organization/assets/img/dashicon3.png"/></span>
                        <div class="stats-cont">
                            <?php if(Session::get('organization')->role=="4"){ ?>
                             <h2> {{App\Models\Submittedform::where('organization_id', Session::get('organization')->parent_id)->where('status','=','0')->count()}}<span>Pendings Forms</span></h2>
                          
                           <?php }else{ ?>
                            <h2>{{App\Models\Submittedform::where('organization_id', Session::get('organization')->id)->where('status','=','0')->count()}}<span>Pendings Forms</span></h2>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 px-2 mb-3 " onclick="window.open('{{ url('/organization/submissions?from_date=&to_date=&form_type=&status=2&content=&first_name=&surname=&search=') }}', '_blank');" style="cursor: pointer;">
                     <div class="widget d-flex p35 align-items-center">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/organization/assets/img/dashicon2.png"/></span>
                        <div class="stats-cont">
                            <?php if(Session::get('organization')->role=="4"){ ?>
                           <h2>{{App\Models\Submittedform::where('organization_id', Session::get('organization')->parent_id)->where('status','=','2')->count()}}<span>Require Action</span></h2>
                            <?php }else{ ?>
                            <h2>{{App\Models\Submittedform::where('organization_id', Session::get('organization')->id)->where('status','=','2')->count()}}<span>Require Action</span></h2>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 px-2 mb-3" onclick="window.open('{{ route('org.inactive.today.user') }}', '_blank');" style="cursor: pointer;">
                     <div class="widget d-flex p35  align-items-center">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/organization/assets/img/dashicon3.png"/></span>
                        <div class="stats-cont">
                             <?php if(Session::get('organization')->role=="4"){ ?> 
                              <h2><?php  $totalusers =  App\Models\User::where('parent_id', Session::get('organization')->parent_id)->distinct('id')->count();
                           $today = \Carbon\Carbon::now()->toDateString();
                           $today_submit = App\Models\Submittedform::where('organization_id', Session::get('organization')->parent_id)->whereDate('created_at',$today)->distinct('userid')->count();
                           echo $totalusers - $today_submit;
                           ?><span>InActive Today</span></h2>
                            <?php }else{ ?>
                           <h2><?php  $totalusers =  App\Models\User::where('parent_id', Session::get('organization')->id)->distinct('id')->count();
                           $today = \Carbon\Carbon::now()->toDateString();
                           $today_submit = App\Models\Submittedform::where('organization_id', Session::get('organization')->id)->whereDate('created_at',$today)->distinct('userid')->count();
                           echo $totalusers - $today_submit;
                           ?><span>InActive Today</span></h2>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                
                 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2" >
                     
                     <div class="widget  mb-3">
                        <div class="widget-heading d-flex justify-content-between">
                           <h5 class="mb-0">User Quota</h5> <span><b>{{$total_users}}</b>/{{$quota}}</b></span>
                         
                        
                        </div>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" style="width: {{$percentage}}%;" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">{{$percentage}}%</div>
                        </div>
                     </div>
                      
                 </div>
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2" >
                     
                     <div class="widget  mb-3">
                        <div class="widget-heading d-flex justify-content-between">
                           <h5 class="mb-0">Submission Count</h5>
                          
                           <!--<select class="task-action" id="orgnisationCount">-->
                           <!--    <option value='yearly'>Yearly</option>-->
                           <!--    <option value='monthly'>Monthly</option>-->
                           <!--    <option value='weekly'>Weekly</option>-->
                           <!--</select>-->
                           
                           <select class="task-action submissionChanges" id="orgnisationCount" >
                                  <option value="current_week">Current Week</option>
                                  <option value="last_week">Last Week</option>
                                  <option value="this_month">Current Month</option>
                                  <option value="last_month">Last Month</option>
                                  <option value="31_days">Date Range</option>
                                  <option value="by_year">By Year</option>
                           </select>
                           
                        </div>
                        <div class="widget-content" id="subcountchart">
                           <div id="submissionYearly" class="orchart customchartapp" ></div>
                        
                        </div>
                     </div>
                       <div class="widget widget-table-two p-0 customw  mb-3">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Form Statistics</h5>
                            <select class="task-action formStaticChanges" id="formstaticCount" >
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                
                                  <option value="current_week">Current Week</option>
                                  <option value="last_week">Last Week</option>
                                  <option value="this_month">Current Month</option>
                                  <option value="last_month">Last Month</option>
                                  <option value="31_days">Date Range</option>
                                  <option value="by_year">By Year</option>
                           </select>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Form Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Active users</div>
                                       </th>
                                        <th>
                                          <div class="th-content">Inactive users</div>
                                       </th>
                                         <th>
                                          <div class="th-content">Total submission</div>
                                       </th>
                                       <th>
                                          <div class="th-content"></div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody id="topfivebodyform">
                                     @forelse($formstate as $state)
                                    <tr>
                                       <td> 
                                          <div class="td-content">{{$state['formtitle'] }}</div>
                                       </td>
                                        <td>
                                          <div class="td-content">{{$state['active'] }}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$state['inactive'] }}</div>
                                       </td>
                                       <td>
                                          <div class="td-content"><span class="badgetable">{{$state['totalsubmission']}}</span></div>
                                       </td>
                                    </tr>
                                    @empty
                                   
                                    <tr> <td>No record found</td></tr>
                                    @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                      <div class="widget widget-table-two p-0">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Submission Count By User<span></span></h5>
                            <select class="task-action submisioncounttableclass" id="submisioncounttableid" >
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                
                                  <option value="current_week">Current Week</option>
                                  <option value="last_week">Last Week</option>
                                  <option value="this_month">Current Month</option>
                                  <option value="last_month">Last Month</option>
                                  <option value="31_days">Date Range</option>
                                  <option value="by_year">By Year</option>
                           </select>
                           <div class="view-action">
                              <!--<a href="{{url('/')}}/organization/user">View All</a>-->
                           </div>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Email</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Submission Count</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody id="submissiontableform">
                                     @forelse($usercount as $user)
                                    <tr>
                                       <td>
                                          <div class="td-content">{{\App\Models\User::where('id','=',$user->userid)->pluck('name')->implode('')}}</div>
                                       </td>
                                       <td>
                                           <div class="td-content">{{\App\Models\User::where('id','=',$user->userid)->pluck('email')->implode('')}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content"><span class="badgetable">{{$user->count}}</span></div>
                                       </td>
                                    </tr>
                                    @empty
                                    <tr><td>No record found</td></tr>
                                  @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                 </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2" >
                       <div class="widget mb-3 pb-0">
                        <div class="widget-heading d-flex justify-content-between">
                           <h5 class="mb-0">Completed Forms</h5>
                          
                           <select class="task-action chartLastChanges" id="date-range-dropdown" >
                                  <option value="current_week">Current Week</option>
                                  <option value="last_week">Last Week</option>
                                  <option value="this_month">Current Month</option>
                                  <option value="last_month">Last Month</option>
                                  <option value="31_days">Date Range</option>
                                  <option value="by_year">By Year</option>
                           </select>
                        
                         
                        </div>
                        <div class="widget-content">
                           <div id="chartbar" class="customchartapp" ></div>
                        </div>
                     </div>
                      <div class="widget widget-table-two p-0 mb-3">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <!--<h5 class="mb-0">Submission Count By User<span>(Last 30 days)</span></h5>-->
                           <div class="view-action">
                                 <h5 class="mb-0">Recent Comments</h5>
                              <!--<a href="{{url('/')}}/organization/user">View All</a>-->
                           </div>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">User</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Comment</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Time of comment</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     @forelse($commentlisting as $com)
                                    <tr onclick="window.open('{{ route('org.submision', $com['formid']) }}', '_blank');">
                                       <td>
                                          <div class="td-content"><?php $obj = App\Models\User::select(['name','profile'])->where('id','=',$com['user_id'])->first()
                                           ?>
                                           <?php if($obj->profile!='' || isset($obj->profile)){ ?>
                                           <img style="width:30px;height:30px;object-fit:cover" class="rounded-circle mr-2" src="{{$obj->profile}}" alt="">
                                           <?}else{ ?>
                                           <img style="width:30px;height:30px;object-fit:cover" class="rounded-circle mr-2" src="https://via.placeholder.com/250" >
                                           <?php }?>
                                           <span>{{$obj->name}}</span>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$com['comment']}}</div>
                                       </td>
                                       <td>
                                           <?php 
                                           $carbonInstance = \Carbon\Carbon::parse($com['time']);
                                            // Format the timestamp in AM/PM format
                                            $formattedDateTime = $carbonInstance->format(' h:i:s A');
                                          
                                            ?>
                                          <div class="td-content"><span>{{date('j M Y', strtotime($com['time']))}}</span> <span> {{ date('g:i A', strtotime($com['time']))}}</span></div>
                                       </td>
                                    </tr>
                                    @empty
                                    <span>No Comment Found</span>
                                    @endforelse
                                   
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                      <div class="widget widget-table-two p-0 mb-3">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Recent Submissions</h5>
                           <div class="view-action">
                              <a href="{{url('/')}}/organization/submissions">View All</a>
                           </div>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
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
                                          <div class="th-content">Submitted by</div>
                                       </th>
                                       <!--th>
                                          <div class="th-content">Organisation</div>
                                       </th-->
                                       <th>
                                          <div class="th-content">Submission ID</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Download</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     @if(isset($recent_submission) && count($recent_submission) > 0)
                                      @foreach($recent_submission as $s)
                                    <tr>
                                       <td>
                                          <div class="td-content whitespacenowrap">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/submissionsdetails/{{$s->id}}"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content whitespacenowrap">{{date('j M Y', strtotime($s->created_at))}}<span class="timeframe">{{date('g:i A', strtotime($s->created_at))}}</span></div>
                                       </td>
                                       <td>
                                          @if($s->changedtitle != '' &&  $s->changedtitle != null)
                                           <div class="td-content whitespacenowrap">{{$s->changedtitle}}</div>
                                           @elseif($s->formtitle != '' &&  $s->formtitle != null)
                                           <div class="td-content whitespacenowrap">{{$s->formtitle}}</div>
                                           @endif
                                       </td>
                                       <td>
                                          <div class="td-content whitespacenowrap">{{$s->user_first_name.' '.$s->user_last_name}}</div>
                                       </td>
                                       <!--td>
                                          <div class="td-content">Acme Corp</div>
                                       </td-->
                                       <td>
                                          <div class="td-content whitespacenowrap">{{$s->id}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content whitespacenowrap">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="{{url('organization/submissions')}}" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio1"/>	
                                                         <label  for="radio1">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio2"/>	
                                                         <label  for="radio2">
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
                                    </tr>
                                    @endforeach
                                     @endif
                                    
                                    <!--tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/> View</a>
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
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Stark Industries</div>
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
                                                         <input type="radio" name="radiobtn2" id="radio3"/>	
                                                         <label  for="radio3">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn2" id="radio4"/>	
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
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/> View</a>
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
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink3">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn3" id="radio5"/>	
                                                         <label  for="radio5">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn3" id="radio6"/>	
                                                         <label  for="radio6">
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
                                    </tr-->
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                
        
                  <!--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">-->
                  <!--jljkl-->
                  <!--</div>-->
                  <!--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">-->
                  <!-- llll-->
                  <!--</div>-->
               </div>
            </div>
         </div>
      </div>
      @include('organization.layout.footer')
      <script>
    
      //submission count    
        
      $("#orgnisationCount").change(function(){
         gettingValue = $(this).val(); 
         
         
         // yearly count 
         if(gettingValue=='by_year'){
                if($('#orgnisationCount').hasClass("added"))
                {
                  $('#orgnisationCount').data('daterangepicker').remove();
                  $('#orgnisationCount').removeAttr('data-daterangepicker-initialized');
                   $('#orgnisationCount').removeClass('added');
                }
             $.ajax({
                          url: '{{route('submission.countChartForms')}}',
                          method: 'POST',
                          data: {'duration':'yearly','_token':"{{csrf_token()}}"},
                          success: function(response) {
                            record = JSON.parse(response);
                           
                            seriesArray= [{
                                    name: 'Pending',
                                        data: record.pending.reverse()
                                    },
                                	{
                                        name: 'Need action',
                                        data: record.needaction.reverse()
                                    },
                                	{
                                        name: 'Completed',
                                        data: record.completed.reverse()
                                }];
                                
                            seriesLabel = record.years.reverse(),
                            submissionChartGraph(seriesArray,seriesLabel);
                                            
                          },
                          error: function(xhr, status, error) {
                          
                            console.log(error);
                          }
                        });
         }
         
         //monthly count
         if(gettingValue=='this_month' || gettingValue=='last_month'){
                if($('#orgnisationCount').hasClass("added"))
                {
                  $('#orgnisationCount').data('daterangepicker').remove();
                  $('#orgnisationCount').removeAttr('data-daterangepicker-initialized');
                   $('#orgnisationCount').removeClass('added');
                }
              monthYear=[];
              monthPending=[];
              monthNeedaction=[];
              monthCompleted=[];
                  $.ajax({
                          url: '{{route('submission.countChartForms')}}',
                          method: 'POST',
                          data: {'duration':gettingValue,'_token':"{{csrf_token()}}"},
                          success: function(response) {
                            record = JSON.parse(response);
                         
                         $.each(record.status, function (key,val) {
                          monthYear.push(key);
                          monthPending.push(val.pending);
                           monthCompleted.push(val.completed);
                           monthNeedaction.push(val.needaction);
                        });
                         
                            seriesArray= [{
                                    name: 'Pending',
                                        data: monthPending
                                    },
                                	{
                                        name: 'Need action',
                                        data:monthNeedaction
                                    },
                                	{
                                        name: 'Completed',
                                        data: monthCompleted
                                }];
                                
                            seriesLabel =monthYear,
                            console.log(seriesLabel);
                            submissionChartGraph(seriesArray,seriesLabel);
                                            
                          },
                          error: function(xhr, status, error) {
                          
                            console.log(error);
                          }
                        });
         }
         
         // weekly count 
         if(gettingValue=='last_week' || gettingValue=='current_week'){
              if($('#orgnisationCount').hasClass("added"))
                {
                  $('#orgnisationCount').data('daterangepicker').remove();
                  $('#orgnisationCount').removeAttr('data-daterangepicker-initialized');
                   $('#orgnisationCount').removeClass('added');
                }
             weekDays=[];
             weekPending=[];
             weekNeedaction=[];
             weekCompleted=[];
             $.ajax({
                      url: '{{route('submission.countChartForms')}}',
                      method: 'POST',
                      data: {'duration':gettingValue,'_token':"{{csrf_token()}}"},
                      success: function(response) {
                        record = JSON.parse(response);
                      
                        $.each(record.allday, function (key,val) {
                          weekDays.push(key);
                          weekPending.push(parseInt(val.pending));
                           weekCompleted.push(parseInt(val.complete));
                           weekNeedaction.push(parseInt(val.needaction));
                         }); 
                         
                            seriesArray= [{
                                    name: 'Pending',
                                        data: weekPending
                                    },
                                	{
                                        name: 'Need action',
                                        data:weekNeedaction
                                    },
                                	{
                                        name: 'Completed',
                                        data: weekCompleted
                                }];
                                
                        seriesLabel = weekDays,
                        submissionChartGraph(seriesArray,seriesLabel);
                                        
                      },
                      error: function(xhr, status, error) {
                      
                        console.log(error);
                      }
                    });
         }
         
         //31 count
         if(gettingValue=='31_days'){
             
               $('#orgnisationCount').daterangepicker({
                   maxSpan: {
                                days: 31
                            }
               });
                
               $('#orgnisationCount').addClass('added');
               $('#orgnisationCount').on('apply.daterangepicker', function(ev, picker) {
                   var dateRangePicker = $("#orgnisationCount").data('daterangepicker');
                   // Retrieve the selected start and end dates
                    var startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    var endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                    
                  monthYear=[];
                  monthPending=[];
                  monthNeedaction=[];
                  monthCompleted=[];
                  $.ajax({
                          url: '{{route('submission.countChartForms')}}',
                          method: 'POST',
                          data: {'duration':'range','start_date':startDate,'end_date':endDate,'_token':"{{csrf_token()}}"},
                          success: function(response) {
                            record = JSON.parse(response);
                          
                         $.each(record.status, function (key,val) {
                          monthYear.push(key);
                          monthPending.push(val.pending);
                           monthCompleted.push(val.completed);
                           monthNeedaction.push(val.needaction);
                        });
                         
                            seriesArray= [{
                                    name: 'Pending',
                                        data: monthPending
                                    },
                                	{
                                        name: 'Need action',
                                        data:monthNeedaction
                                    },
                                	{
                                        name: 'Completed',
                                        data: monthCompleted
                                }];
                                
                            seriesLabel =monthYear,
                            submissionChartGraph(seriesArray,seriesLabel);
                                            
                          },
                          error: function(xhr, status, error) {
                          
                            console.log(error);
                          }
                        });
               });
           
         }
      });
      
      //compelted forms 
      
      $(".chartLastChanges").change(function(){
         
          days = $(this).val();
          if ($(this).val() === '31_days') { 
              
               $('#date-range-dropdown').daterangepicker({
                   maxSpan: {
                              days: 31
                            }
                        });
               $('#date-range-dropdown').addClass('added');
               days="range";
               $('#date-range-dropdown').on('apply.daterangepicker', function(ev, picker) {
                   var dateRangePicker = $("#date-range-dropdown").data('daterangepicker');
                    // Retrieve the selected start and end dates
                    var startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    var endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                    
                     $.ajax({
                          url: '{{route('chart.bar')}}',
                          method: 'POST',
                          data: {'duration':days,'start_date':startDate,'end_date':endDate,'_token':"{{csrf_token()}}"},
                          success: function(response) {
                            record = JSON.parse(response);
                            console.log(record);
                             var options = {
                                 
                                            xaxis: {
                                                title: {
                                                  text: "Time"
                                                }
                                              },
                                              yaxis: {
                                                title: {
                                                  text: "Submission"
                                                }
                                              },
                                              // other options...
                                 
                                 tooltip: {
                                                custom: function({ series, seriesIndex, dataPointIndex, w }) {
                                                  return '<span class="custom-tooltip">Submission Count :' + series[seriesIndex][dataPointIndex] + '</span>';
                                                }
                                              },
                                              series: [{
                                              data: record.count
                                            }],
                                              chart: {
                                              type: 'bar',
                                              height: 250,
                                                toolbar: {
                                                  show: false
                                                }
                                            },
                                            plotOptions: {
                                              bar: {
                                                borderRadius: 4,
                                                horizontal: false,
                                              }
                                            },
                                            dataLabels: {
                                              enabled: false
                                            },
                                            xaxis: {
                                              categories: record.days,
                                            },                  
                                            fill: {
                                            colors: ['#7adb7a']
                                          }
                                            };
                               var chartElement = document.querySelector("#chartbar");
                                if (chartElement) {
                                  while (chartElement.firstChild) {
                                    chartElement.firstChild.remove();
                                  }
                                }              
                             var chart = new ApexCharts(document.querySelector("#chartbar"), options);
                             chart.render();
                                        
                          },
                          error: function(xhr, status, error) {
                            console.log(error);
                          }
                        });
                   
               });
              
          }else{
            if($('#date-range-dropdown').hasClass("added"))
            {
              $('#date-range-dropdown').data('daterangepicker').remove();
              $('#date-range-dropdown').removeAttr('data-daterangepicker-initialized');
               $('#date-range-dropdown').removeClass('added');
            }
          }
         if ($(this).val() != '31_days') { 
                     $.ajax({
                      url: '{{route('chart.bar')}}',
                      method: 'POST',
                      data: {'duration':days,'_token':"{{csrf_token()}}"},
                      success: function(response) {
                        record = JSON.parse(response);
                        console.log(record);
                         var options = {
                             
                                        xaxis: {
                                            title: {
                                              text: "Time"
                                            }
                                          },
                                          yaxis: {
                                            title: {
                                              text: "Submission"
                                            }
                                          },
                                          // other options...
                             
                             tooltip: {
                                            custom: function({ series, seriesIndex, dataPointIndex, w }) {
                                              return '<span class="custom-tooltip">Submission Count :' + series[seriesIndex][dataPointIndex] + '</span>';
                                            }
                                          },
                                          series: [{
                                          data: record.count
                                        }],
                                          chart: {
                                          type: 'bar',
                                          height: 250,
                                          toolbar: {
                                              show: false
                                            }
                                        },
                                        plotOptions: {
                                          bar: {
                                            borderRadius: 4,
                                            horizontal: false,
                                          }
                                        },
                                        dataLabels: {
                                          enabled: false
                                        },
                                        xaxis: {
                                          categories: record.days,
                                        },                  fill: {
                    colors: ['#7adb7a']
                  }
                                        };
                                        
                         var chartElement = document.querySelector("#chartbar");
                                if (chartElement) {
                                  while (chartElement.firstChild) {
                                    chartElement.firstChild.remove();
                                  }
                                }
                                
                         var chart = new ApexCharts(document.querySelector("#chartbar"), options);
                         chart.render();
                                    
                      },
                      error: function(xhr, status, error) {
                        console.log(error);
                      }
                    });
               }
      });
      
      //on ready for all chart
      
      
       $(document).ready(function(){
          
         
         // completed chart bar form
         
          $.ajax({
          url: '{{route('chart.bar')}}',
          method: 'POST',
          data: {'duration':'current_week','_token':"{{csrf_token()}}"},
          success: function(response) {
            record = JSON.parse(response);
            
        
                    var options = {
                         xaxis: {
                                title: {
                                  text: "Time"
                                }
                              },
                              yaxis: {
                                title: {
                                  text: "Submission"
                                }
                              },
                              // other options...
                            
                             tooltip: {
                                custom: function({ series, seriesIndex, dataPointIndex, w }) {
                                  return '<span class="custom-tooltip">Submission Count :' + series[seriesIndex][dataPointIndex] + '</span>';
                                }
                              },
                              series: [{
                              data: record.count,
                            }],
                              chart: {
                              type: 'bar',
                              height: 250,
                              toolbar: {
                                  show: false
                                }
                            },
                            plotOptions: {
                              bar: {
                                borderRadius: 4,
                                horizontal: false,
                              }
                            },
                            dataLabels: {
                              enabled: false,
                            },
                            xaxis: {
                              categories: record.days,
                            },
                             fill: {
                                    colors: ['#7adb7a']
                                  },
                                 
                            };
                    
                            var chart = new ApexCharts(document.querySelector("#chartbar"), options);
                            chart.render();
                            
                         
        
          },
          error: function(xhr, status, error) {
          
            console.log(error);
          }
        });
        
        // submission count form
        
             weekDays=[];
             weekPending=[];
             weekNeedaction=[];
             weekCompleted=[];
              
             $.ajax({
                      url: '{{route('submission.countChartForms')}}',
                      method: 'POST',
                      data: {'duration':'current_week','_token':"{{csrf_token()}}"},
                      success: function(response) {
                        record = JSON.parse(response);
                      
                        $.each(record.allday, function (key,val) {
                          weekDays.push(key);
                          weekPending.push(parseInt(val.pending));
                           weekCompleted.push(parseInt(val.complete));
                           weekNeedaction.push(parseInt(val.needaction));
                         }); 
                         
                            seriesArray= [{
                                    name: 'Pending',
                                        data: weekPending
                                    },
                                	{
                                        name: 'Need action',
                                        data:weekNeedaction
                                    },
                                	{
                                        name: 'Completed',
                                        data: weekCompleted
                                }];
                                
                        seriesLabel = weekDays,
                        submissionChartGraph(seriesArray,seriesLabel);
                                        
                      },
                      error: function(xhr, status, error) {
                      
                        console.log(error);
                      }
                    });
      
      });
      
      // form Static Changes 
      
      $(".formStaticChanges").change(function(){
         duration = $(this).val(); 
          if(duration=='31_days'){
             $('#formstaticCount').daterangepicker({
                 maxSpan: {
                            days: 31
                          }
             });
             $('#formstaticCount').addClass('added');
             $('#formstaticCount').on('apply.daterangepicker', function(ev, picker) {
                           var dateRangePicker = $("#formstaticCount").data('daterangepicker');
                            // Retrieve the selected start and end dates
                            var startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                            var endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                       $.ajax({
                              url: '{{route('form.state.ajax')}}',
                              method: 'POST',
                              data: {'duration':duration,'start_date':startDate,'endDate':endDate,'_token':"{{csrf_token()}}"},
                              success: function(response) {
                                record = JSON.parse(response);
                                console.log(record);
  
                                
                                  $("#topfivebodyform").empty();

                          // Iterate through the response data and generate HTML for each row
                          record.forEach(function(item) {
                             var formtitle = item.formtitle;
                             var totalsubmission = item.totalsubmission;
                              var active = item.active;
                             var inactive = item.inactive;
                             
                             // Get form title via another AJAX call or include it in the original response
                    
                             // Generate HTML for the table row
                             var html = `
                                <tr>
                                   <td>
                                      <div class="td-content">${formtitle}</div>
                                   </td>
                                   <td>
                                      <div class="td-content">${active}</div>
                                   </td>
                                   <td>
                                      <div class="td-content">${inactive}</div>
                                   </td>
                                   <td>
                                      <div class="td-content"><span class="badgetable">${totalsubmission}</span></div>
                                   </td>
                                </tr>
                             `;
                              // Append the generated row to the tbody
                             $("#topfivebodyform").append(html);
                          });
                            
                                  
                              },
                              error: function(xhr, status, error) {
                              
                                console.log(error);
                              }
                        });
                     });
          }else{
              
               if($('#formstaticCount').hasClass("added"))
                {
                  $('#formstaticCount').data('daterangepicker').remove();
                  $('#formstaticCount').removeAttr('data-daterangepicker-initialized');
                   $('#formstaticCount').removeClass('added');
                }
            
               $.ajax({
                      url: '{{route('form.state.ajax')}}',
                      method: 'POST',
                      data: {'duration':duration,'_token':"{{csrf_token()}}"},
                      success: function(response) {
                        record = JSON.parse(response);
                        console.log(record);
                         $("#topfivebodyform").empty();

                          // Iterate through the response data and generate HTML for each row
                          record.forEach(function(item) {
                             var formtitle = item.formtitle;
                             var totalsubmission = item.totalsubmission;
                              var active = item.active;
                             var inactive = item.inactive;
                             
                             // Get form title via another AJAX call or include it in the original response
                    
                             // Generate HTML for the table row
                             var html = `
                                <tr>
                                   <td>
                                      <div class="td-content">${formtitle}</div>
                                   </td>
                                   <td>
                                      <div class="td-content">${active}</div>
                                   </td>
                                   <td>
                                      <div class="td-content">${inactive}</div>
                                   </td>
                                   <td>
                                      <div class="td-content"><span class="badgetable">${totalsubmission}</span></div>
                                   </td>
                                </tr>
                             `;
                    
                             // Append the generated row to the tbody
                             $("#topfivebodyform").append(html);
                             console.log(html);
                          });
                      },
                      error: function(xhr, status, error) {
                      
                        console.log(error);
                      }
                });
          }
          
      });
      
      // submission count table
      
      $(".submisioncounttableclass").change(function(){
         duration = $(this).val(); 
          if(duration=='31_days'){
             $('#submisioncounttableid').daterangepicker({
                 maxSpan: {
                            days: 31
                          }
             });
             $('#submisioncounttableid').addClass('added');
             $('#submisioncounttableid').on('apply.daterangepicker', function(ev, picker) {
                           var dateRangePicker = $("#submisioncounttableid").data('daterangepicker');
                            // Retrieve the selected start and end dates
                            var startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                            var endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                       $.ajax({
                              url: '{{route('form.submission.table.ajax')}}',
                              method: 'POST',
                              data: {'duration':duration,'start_date':startDate,'endDate':endDate,'_token':"{{csrf_token()}}"},
                              success: function(response) {
                                record = JSON.parse(response);
                                $("#submissiontableform").empty();

                                  // Iterate through the response data and generate HTML for each row
                                  record.forEach(function(item) {
                                     var user_name = item.user_name;
                                     var user_email = item.user_email;
                                      var count = item.count;
                                    
                                     
                                     // Get form title via another AJAX call or include it in the original response
                            
                                     // Generate HTML for the table row
                                     var html = `
                                        <tr>
                                           <td>
                                              <div class="td-content">${user_name}</div>
                                           </td>
                                           <td>
                                              <div class="td-content">${user_email}</div>
                                           </td>
                                           
                                           <td>
                                              <div class="td-content"><span class="badgetable">${count}</span></div>
                                           </td>
                                        </tr>
                                     `;
                            
                                     // Append the generated row to the tbody
                                     $("#submissiontableform").append(html);
                                     console.log(html);
                                  });
                              },
                              error: function(xhr, status, error) {
                              
                                console.log(error);
                              }
                        });
                     });
          }else{
              
               if($('#submisioncounttableid').hasClass("added"))
                {
                  $('#submisioncounttableid').data('daterangepicker').remove();
                  $('#submisioncounttableid').removeAttr('data-daterangepicker-initialized');
                   $('#submisioncounttableid').removeClass('added');
                }
            
               $.ajax({
                      url: '{{route('form.submission.table.ajax')}}',
                      method: 'POST',
                      data: {'duration':duration,'_token':"{{csrf_token()}}"},
                      success: function(response) {
                        record = JSON.parse(response);
                        console.log(record);
                         $("#submissiontableform").empty();

                          // Iterate through the response data and generate HTML for each row
                          record.forEach(function(item) {
                             var user_name = item.user_name;
                             var user_email = item.user_email;
                              var count = item.count;
                            
                             
                             // Get form title via another AJAX call or include it in the original response
                    
                             // Generate HTML for the table row
                             var html = `
                                <tr>
                                   <td>
                                      <div class="td-content">${user_name}</div>
                                   </td>
                                   <td>
                                      <div class="td-content">${user_email}</div>
                                   </td>
                                   
                                   <td>
                                      <div class="td-content"><span class="badgetable">${count}</span></div>
                                   </td>
                                </tr>
                             `;
                    
                             // Append the generated row to the tbody
                             $("#submissiontableform").append(html);
                             console.log(html);
                          });
                      },
                      error: function(xhr, status, error) {
                      
                        console.log(error);
                      }
                });
          }
          
      });
      
      function submissionChartGraph(seriesArray,seriesLabel)
      {
             var chartElement = document.querySelector("#submissionYearly");
            if (chartElement) {
              while (chartElement.firstChild) {
                chartElement.firstChild.remove();
              }
            }
            
            var options1 = {
              chart: {
                fontFamily: 'Nunito, sans-serif',
                height: 365,
                type: 'area',
                zoom: {
                  enabled: false
                },
                dropShadow: {
                  enabled: true,
                  opacity: 0.2,
                  blur: 10,
                  left: -7,
                  top: 22
                },
                toolbar: {
                  show: false
                },
                events: {
                  mounted: function(ctx, config) {
                    const seriesData = ctx.getSeries();
                    seriesData.forEach(function(series, index) {
                      const highest = Math.max(...series.data);
                      const highestIndex = series.data.indexOf(highest);
            
                      ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[index][highestIndex]).getTime(),
                        y: highest,
                        label: {
                          style: {
                            cssClass: 'd-none'
                          }
                        },
                        customSVG: {
                          SVG: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="${series.color}" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>`,
                          cssClass: undefined,
                          offsetX: -8,
                          offsetY: 5
                        }
                      });
                    });
                  },
                }
              },
              colors: ['#FEC147', '#E22028', '#48D131'],
              dataLabels: {
                enabled: false
              },
              stroke: {
                show: true,
                curve: 'smooth',
                width: 2,
                lineCap: 'square'
              },
              series: seriesArray,
              labels: seriesLabel,
              xaxis: {
                axisBorder: {
                  show: false
                },
                axisTicks: {
                  show: false
                },
                crosshairs: {
                  show: true
                },
                labels: {
                  style: {
                    fontSize: '12px',
                    fontFamily: 'Nunito, sans-serif',
                    cssClass: 'apexcharts-xaxis-title',
                  },
                }
              },
              yaxis: {
                labels: {
                  style: {
                    fontSize: '12px',
                    fontFamily: 'Nunito, sans-serif',
                    cssClass: 'apexcharts-yaxis-title',
                  },
                }
              },
              grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                  lines: {
                    show: true
                  }
                },
                yaxis: {
                  lines: {
                    show: true,
                  }
                },
                padding: {
                  top: 0,
                  right: 0,
                  bottom: 0,
                  left: -10
                },
              },
              legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetY: -50,
                fontSize: '16px',
                fontFamily: 'Nunito, sans-serif',
                markers: {
                  width: 10,
                  height: 10,
                  strokeWidth: 0,
                  strokeColor: '#fff',
                  fillColors: undefined,
                  radius: 12,
                  onClick: undefined,
                  offsetX: 0,
                  offsetY: 0
                },
                itemMargin: {
                  horizontal: 0,
                  vertical: 20
                }
              },
              tooltip: {
                theme: 'dark',
                marker: {
                  show: true,
                },
                x: {
                  show: false,
                }
              },
              fill: {
                type: "gradient",
                gradient: {
                  type: "vertical",
                  shadeIntensity: 1,
                  inverseColors: false,
                  opacityFrom: 0.28,
                  opacityTo: 0.05,
                  stops: [45, 100]
                }
              },
              responsive: [{
                breakpoint: 1920,
                options: {
                  chart: {
                    height: '227px',
                    width: '100%',
                  },
                  legend: {
                    offsetY: -30,
                  },
                },
              }]
            };
            
            var chart1 = new ApexCharts(
              document.querySelector("#submissionYearly"),
              options1
            );
            chart1.render();


      }
      
     
      
      </script>