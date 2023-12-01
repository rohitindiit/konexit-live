@include('Admin.layout.header')
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
        @include('Admin.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-12 px-2 mb-3">
                     <h1 class="headmain mb-0">Dashboard</h1>
                     <p  class="subhead  mb-0">Welcome to Konexit Dashboard</p>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 px-2 mb-3" style="cursor:pointer" onclick="window.open('{{ route('admin.org') }}', '_blank');">
                     <div class="widget d-flex py-35 align-items-center px-3">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon4.png"/></span>
                        <div class="stats-cont">
                           <h2>{{$total_organisations}}<span>Total <br>Organisations</span></h2>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 px-2 mb-3" style="cursor:pointer" onclick="window.open('{{ route('admin.forms') }}', '_blank');">
                     <div class="widget d-flex py-35 align-items-center px-3">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/></span>
                        <div class="stats-cont">
                           <h2>{{$total_users}}<span>Total Users</span></h2>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 px-2 mb-3" style="cursor:pointer" onclick="window.open('{{ route('admin.forms') }}', '_blank');">
                     <div class="widget d-flex py-35 align-items-center px-3">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/></span>
                        <div class="stats-cont">
                           <h2>{{$total_forms}}<span>Total Forms</span></h2>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 px-2 mb-3" style="cursor:pointer" onclick="window.open('{{ route('admin.submissions') }}', '_blank');">
                     <div class="widget d-flex py-35 align-items-center px-3">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/></span>
                        <div class="stats-cont">
                           <h2>{{$total_submissions}}<span>Total <br>Submissions</span></h2>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2" >
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
                        <div class="widget-content customchartapp" id="subcountchart">
                           <div id="submissionYearly" class="orchart" ></div>
                        
                        </div>
                     </div>
                  </div>
                  <!--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2">-->
                  <!--   <div class="widget widget-table-two p-0">-->
                  <!--      <div class="widget-heading mb-0 p-3 d-flex justify-content-between">-->
                  <!--         <h5 class="mb-0">Submission Count By User<span>(Last 30 days)</span></h5>-->
                  <!--         <div class="view-action">-->
                  <!--            <a href="{{url('/')}}/user">View All</a>-->
                  <!--         </div>-->
                  <!--      </div>-->
                  <!--      <div class="widget-content">-->
                  <!--         <div class="table-responsive">-->
                  <!--            <table class="table">-->
                  <!--               <thead>-->
                  <!--                  <tr>-->
                  <!--                     <th>-->
                  <!--                        <div class="th-content">Name</div>-->
                  <!--                     </th>-->
                  <!--                     <th>-->
                  <!--                        <div class="th-content">Email</div>-->
                  <!--                     </th>-->
                  <!--                     <th>-->
                  <!--                        <div class="th-content"></div>-->
                  <!--                     </th>-->
                  <!--                  </tr>-->
                  <!--               </thead>-->
                  <!--               <tbody>-->
                  <!--                  <tr>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content">John Delahay</div>-->
                  <!--                     </td>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content">Johndelahay22@gmail.com</div>-->
                  <!--                     </td>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content"><span class="badgetable">3</span></div>-->
                  <!--                     </td>-->
                  <!--                  </tr>-->
                  <!--                  <tr>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content">Aida Bugg</div>-->
                  <!--                     </td>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content">Aidabugg347@gmail.com</div>-->
                  <!--                     </td>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content"><span class="badgetable">41</span></div>-->
                  <!--                     </td>-->
                  <!--                  </tr>-->
                  <!--                  <tr>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content">Allie Grater</div>-->
                  <!--                     </td>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content">Alliegrater@gmail.com</div>-->
                  <!--                     </td>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content"><span class="badgetable">23</span></div>-->
                  <!--                     </td>-->
                  <!--                  </tr>-->
                  <!--                  <tr>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content">Aida Bugg</div>-->
                  <!--                     </td>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content">Aidabugg347@gmail.com</div>-->
                  <!--                     </td>-->
                  <!--                     <td>-->
                  <!--                        <div class="td-content"><span class="badgetable">23</span></div>-->
                  <!--                     </td>-->
                  <!--                  </tr>-->
                  <!--               </tbody>-->
                  <!--            </table>-->
                  <!--         </div>-->
                  <!--      </div>-->
                  <!--   </div>-->
                  <!--</div>-->
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Submission Count By Organisations<span></span></h5>
                           <div class="view-action">
                              <a href="{{route('admin.submissions')}}">View All</a>
                           </div>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive px-3 table-count-org">
                              <table class="table">
                                 <!-- <thead> -->
                                 <!-- <tr> -->
                                 <!-- <th><div class="th-content">Name</div></th> -->
                                 <!-- <th><div class="th-content">Email</div></th> -->
                                 <!-- <th><div class="th-content"></div></th> -->
                                 <!-- </tr> -->
                                 <!-- </thead> -->
                                 <tbody>
                                    <tr>
                                       <td>
                                          <div class="td-content">Wonka Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Johndelahay22@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content"><span class="badgetable">2</span></div>
                                       </td>
                                    </tr>
                                    @foreach($submission_by_organizations as $so)
                                    
                                    <tr>
                                       <td>
                                          <div class="td-content"><?php $us = \APP\MODELS\USER::select('name','email')->where('id',$so->organization_id)->first(); echo $us->name; ?></div>
                                       </td>
                                       <td>
                                          <div class="td-content"><?php $us = \APP\MODELS\USER::select('name','email')->where('id',$so->organization_id)->first(); echo $us->email; ?></div>
                                       </td>
                                       <td>
                                          <div class="td-content"><span class="badgetable">{{$so->count}}</span></div>
                                       </td>
                                    </tr>
                                   @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Recent Organisations</h5>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Action</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Company Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Email</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Logo</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Users</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($recent_organizations as $org)
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/editorganisation/'.$org->id)}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="{{url('/editorganisation/'.$org->id)}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url($org->id.'/users')}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/forms/'.$org->id)}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/submissions/'.$org->id)}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$org->name}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$org->email}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img style="width:30px;height:30px" src="{{$org->profile}}"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$org->total_users}}</div>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Submissions Count By Forms</h5>
                           <div class="task-action">
                              <!--<div id="reportrange">-->
                              <!--   Date-->
                              <!--   <span></span> <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down4.svg"/></i>-->
                              <!--</div>-->
                           </div>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Form ID</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Form Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Count - 5/15</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($submission_by_form as $sb)
                                    <tr>
                                       <td>
                                          <div class="td-content">{{$sb->formid}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{\APP\MODELS\FORM::where('id',$sb->formid)->pluck('form_title')->implode(', ')}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$sb->count}}</div>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@include('Admin.layout.footer')
<script>
     $(document).ready(function(){
         
     
       weekDays=[];
             weekPending=[];
             weekNeedaction=[];
             weekCompleted=[];
              
             $.ajax({
                      url: '{{route('admin.submission.countChartForms')}}',
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
                          url: '{{route('admin.submission.countChartForms')}}',
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
                          url: '{{route('admin.submission.countChartForms')}}',
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
                      url: '{{route('admin.submission.countChartForms')}}',
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
                          url: '{{route('admin.submission.countChartForms')}}',
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
                          SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="' + series.color + '" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
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
                  inverseColors: !1,
                  opacityFrom: .28,
                  opacityTo: .05,
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