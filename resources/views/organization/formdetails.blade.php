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
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-12 px-2 mb-3 d-flex ">
                     <a href="{{url('/')}}/organization/forms" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/organization/assets/img/backarrow.svg"/></a>
                     <div>
                        <h1 class="headmain mb-1">Form Details</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{url('/')}}/organization/forms">Forms</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Form Details</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget">
                        <div class="widget-content">
                           <div class="row">
                              <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
                                 <div class="formdetail">
                                    <h3 class="m-0">Form</h3>
                                    <img src="{{url('/')}}/resources/views/organization/assets/img/formsdetail.png"/>
                                 </div>
                              </div>
                              <div class="col-xl-6 offset-xl-1 offset-lg-1 col-lg-6 col-md-12 col-sm-12 col-12">
                                 <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                       <div class="form-group detailform">
                                          <label>Form ID</label>
                                          <p>{{ $full_detail->id }}</p>
                                       </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                       <!--<div class="form-group detailform">-->
                                       <!--   <label>Status</label>-->
                                       <!--   <p><span class="status statuscompleted"></span> Completed</p>-->
                                       <!--</div>-->
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                       <div class="form-group detailform">
                                          <label>Form Name</label>
                                          <p>{{ $full_detail->form_title }}</p>
                                       </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                       <div class="form-group detailform">
                                          <label>Date</label>
                                          <p>{{ \Carbon\Carbon::parse($full_detail->created_at)->format('d M Y'); }}</p>
                                       </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                       <!--<div class="form-group detailform">-->
                                       <!--   <label>User</label>-->
                                       <!--   <p>John Delahay</p>-->
                                       <!--</div>-->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                   <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 px-2 mb-3">
                     <div class="widget d-flex p35 align-items-center">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/organization/assets/img/dashicon3.png"/></span>
                        <div class="stats-cont">
                           <h2>{{$pending}}<span>Pending Forms</span></h2>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 px-2 mb-3">
                     <div class="widget d-flex p35 align-items-center">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/organization/assets/img/dashicon2.png"/></span>
                        <div class="stats-cont">
                           <h2>{{$needaction}}<span>Require Action</span></h2>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 px-2 mb-3">
                     <div class="widget d-flex p35 align-items-center">
                        <span class="icon-stats"><img src="{{url('/')}}/resources/views/organization/assets/img/dashicon3.png"/></span>
                        <div class="stats-cont">
                           <h2>12<span>Inactive Today</span></h2>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2">
                    <div class="widget mb-3">
                        <div class="widget-heading d-flex justify-content-between">
                           <h5 class="mb-0">Interactive Map</h5>
                           <select class="task-action mapchangeboxclass" id="mapchangeboxid" >
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
                         <div id="map"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12  px-2">
                          <div class="widget  mb-3">
                        <div class="widget-heading d-flex justify-content-between">
                           <h5 class="mb-0">Submission Count</h5>
                          
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
                     <div class="widget widget-table-two p-0 mb-3">
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
                              <!--<a href="{{url('/')}}/organization/submissions">View All</a>-->
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
                                    <tr> <td>No record found</td></tr>
                                  @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                       
                  </div>
               </div>
            </div>
         </div>
      </div>
     @include('organization.layout.footer')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWbsC3b6QgedZG8VQe2ux5lovNGxTptZM"></script>
<div id="map"></div>
<style>
  #map {
    height: 400px;
    width: 100%;
  }
</style>
<script>
    
  function initMap(locations,formsid) {
      
     var ukBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(49.823809, -5.036835), // Southwest corner (latitude, longitude)
            new google.maps.LatLng(59.360001, 1.767611)   // Northeast corner (latitude, longitude)
        );

     var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: ukBounds.getCenter(),
        restriction: {
            latLngBounds: ukBounds,
            strictBounds: false
        } // Center the map based on the bounds // Center the map on the first location
    });
    map.fitBounds(ukBounds);
    // Create markers for each location
    for (var i = 0; i < locations.length; i++) {
      var location = locations[i];
      
      var marker = new google.maps.Marker({
        position: location,
        map: map
      });

      var formId = formsid[i]; // Generate a unique form ID value for each location

      var infowindow = new google.maps.InfoWindow();

      google.maps.event.addListener(marker, 'click', (function(marker, formId) {
        return function() {
          var content = '<div ><a target="_blank" href="{{url('/organization/submissionsdetails/')}}/' + formId + '">Submission ID :'+formId+'</a></div>';
          infowindow.setContent(content);
          infowindow.open(map, marker);
        };
      })(marker, formId));
      
     
    }
    

    
  }
 // Call the initMap function with an array of latitude-longitude pairs
     locations=[];
     formsid=[];
      // Call the initMap function with an array of latitude-longitude pairs
      var locationsObject =<?php echo $lat_lng ?>;
      
      $.each(locationsObject, function (i) {
        $.each(locationsObject[i], function (key, val) {
            
              formsid.push(i);
              $.each(val, function (key, val) {
                 
                     lt=parseFloat(key);
                  ln=parseFloat(val);
                   locations.push({lat:lt, lng:ln});
              });
        });
    });
    console.log(locationsObject);
    if(locations.length)
    { 
      google.maps.event.addDomListener(window, 'load', function() {
          
        initMap(locations,formsid);
      });
    }else{
        $("#map").append('<img style="display: block; margin-left: auto; margin-right: auto; margin-top: 20px; width: 200px; height: 200px;" src="https://studio.uxpincdn.com/studio/wp-content/uploads/2021/06/10-error-404-page-examples-for-UX-design-1024x512.png.webp">');
    }
    
     


 // map Changes 
$(".mapchangeboxclass").change(function(){
         duration = $(this).val(); 
          if(duration=='31_days'){
             $('#mapchangeboxid').daterangepicker({maxSpan: {
                        days: 31
                      }});
             $('#mapchangeboxid').addClass('added');
             $('#mapchangeboxid').on('apply.daterangepicker', function(ev, picker) {
                           var dateRangePicker = $("#mapchangeboxid").data('daterangepicker');
                            // Retrieve the selected start and end dates
                            var startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                            var endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                            $.ajax({
                              url: '{{route('interactive.map.ajax')}}',
                              method: 'POST',
                              data: {id:"{{$id}}",'duration':duration,'start_date':startDate,'endDate':endDate,'_token':"{{csrf_token()}}"},
                              success: function(response) {
                                record = JSON.parse(response);
                                console.log(record);
                                          locations=[];
                                 formsid=[];
                                  // Call the initMap function with an array of latitude-longitude pairs
                                  var locationsObject =record;
                                  
                                  $.each(locationsObject, function (i) {
                                    $.each(locationsObject[i], function (key, val) {
                                        
                                          formsid.push(i);
                                          $.each(val, function (key, val) {
                                             
                                                 lt=parseFloat(key);
                                              ln=parseFloat(val);
                                               locations.push({lat:lt, lng:ln});
                                          });
                                    });
                                });
                                
                                if(locations.length)
                                { 
                                 // google.maps.event.addDomListener(window, 'load', function() {
                                      
                                    initMap(locations,formsid);
                                 // });
                                }else{
                                    $("#map").append('<img style="display: block; margin-left: auto; margin-right: auto; margin-top: 20px; width: 200px; height: 200px;" src="https://studio.uxpincdn.com/studio/wp-content/uploads/2021/06/10-error-404-page-examples-for-UX-design-1024x512.png.webp">');
                                }
                              },
                              error: function(xhr, status, error) {
                              
                                console.log(error);
                              }
                        });
                     });
          }else{
              
               if($('#mapchangeboxid').hasClass("added"))
                {
                  $('#mapchangeboxid').data('daterangepicker').remove();
                  $('#mapchangeboxid').removeAttr('data-daterangepicker-initialized');
                   $('#mapchangeboxid').removeClass('added');
                }
                $("#map").empty();
            
               $.ajax({
                      url: '{{route('interactive.map.ajax')}}',
                      method: 'POST',
                      data: {id:"{{$id}}",'duration':duration,'_token':"{{csrf_token()}}"},
                      success: function(response) {
                        record = JSON.parse(response);
                        console.log(record);
                          // Call the initMap function with an array of latitude-longitude pairs
                                 locations=[];
                                 formsid=[];
                                  // Call the initMap function with an array of latitude-longitude pairs
                                  var locationsObject =record;
                                  
                                  $.each(locationsObject, function (i) {
                                    $.each(locationsObject[i], function (key, val) {
                                        
                                          formsid.push(i);
                                          $.each(val, function (key, val) {
                                             
                                                 lt=parseFloat(key);
                                              ln=parseFloat(val);
                                               locations.push({lat:lt, lng:ln});
                                          });
                                    });
                                });
                                
                                if(locations.length)
                                { 
                                 // google.maps.event.addDomListener(window, 'load', function() {
                                      
                                    initMap(locations,formsid);
                                 // });
                                }else{
                                    $("#map").append('<img style="display: block; margin-left: auto; margin-right: auto; margin-top: 20px; width: 200px; height: 200px;" src="https://studio.uxpincdn.com/studio/wp-content/uploads/2021/06/10-error-404-page-examples-for-UX-design-1024x512.png.webp">');
                                }
                      },
                      error: function(xhr, status, error) {
                      
                        console.log(error);
                      }
                });
          }
          
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
                          url: '{{route('single.submission.countChartForms')}}',
                          method: 'POST',
                          data: {id:"{{$id}}",'duration':'yearly','_token':"{{csrf_token()}}"},
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
                          url: '{{route('single.submission.countChartForms')}}',
                          method: 'POST',
                          data: {id:"{{$id}}",'duration':gettingValue,'_token':"{{csrf_token()}}"},
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
                      url: '{{route('single.submission.countChartForms')}}',
                      method: 'POST',
                      data: {id:"{{$id}}",'duration':gettingValue,'_token':"{{csrf_token()}}"},
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
                          url: '{{route('single.submission.countChartForms')}}',
                          method: 'POST',
                          data: {id:"{{$id}}",'duration':'range','start_date':startDate,'end_date':endDate,'_token':"{{csrf_token()}}"},
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
                              url: '{{route('single.form.submission.table.ajax')}}',
                              method: 'POST',
                              data: {id:"{{$id}}",'duration':duration,'start_date':startDate,'endDate':endDate,'_token':"{{csrf_token()}}"},
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
                      url: '{{route('single.form.submission.table.ajax')}}',
                      method: 'POST',
                      data: {id:"{{$id}}",'duration':duration,'_token':"{{csrf_token()}}"},
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
      
      
      
      //on ready for all chart
       $(document).ready(function(){
      
        
          // submission count form
        
             weekDays=[];
             weekPending=[];
             weekNeedaction=[];
             weekCompleted=[];
              
             $.ajax({
                      url: '{{route('single.submission.countChartForms')}}',
                      method: 'POST',
                      data: {id:"{{$id}}",'duration':'current_week','_token':"{{csrf_token()}}"},
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

