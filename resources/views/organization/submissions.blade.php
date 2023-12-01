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
                     <h1 class="headmain mb-0">Submissions</h1>
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
                                            <form action="{{ url('/organization/submissions') }}" method="GET"  id="searchform" >
                                             <h2>Filters</h2>
                                             <div class="form-group">
                                                <label class="mb-1">Date Range</label>
                                                <div class="row pad-lr-10">
                                                   <div class="col-md-6 px-1">
                                                      <div class="daterange">
                                                         <span>From</span>
                                                         <input <?php if(isset($_GET['from_date']) && $_GET['from_date']!=''){?> style="border-color:red"  <?php } ?> id="basicFlatpickr1" name="from_date" value="{{@$_GET['from_date']}}" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Select Date..">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6 px-1">
                                                      <div class="daterange">
                                                         <span>To</span>
                                                         <input <?php if(isset($_GET['to_date']) && $_GET['to_date']!=''){?> style="border-color:red"  <?php } ?> id="basicFlatpickr2" name="to_date"  value="{{@$_GET['to_date']}}" class="form-control flatpickr flatpickr-input active" type="date" placeholder="Select Date..">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <label>Form type</label>
                                                <select  <?php if(isset($_GET['form_type']) && $_GET['form_type']!=''){?> style="border-color:red"  <?php } ?> name="form_type" placeholder="Form Type" class="form-control selectpicker">
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
                                              <div class="form-group">
                                                <label>Status</label>
                                                <select  <?php if(isset($_GET['status']) && $_GET['status']!=''){?> style="border-color:red"  <?php } ?>  name="status" placeholder="Status" class="form-control selectpicker">
                                                    <option value="">All</option>
                                                    <option value="0" {{@$_GET['status'] == '0' ? 'selected' : ''}}>Pending</option>
                                                    <option value="1" {{@$_GET['status'] == '1' ? 'selected' : ''}}>Completed</option>
                                                    <option value="2" {{@$_GET['status'] == '2' ? 'selected' : ''}}>Need Action</option>
                                                    <!--<option value="2">Need Action</option>-->
                                                </select>
                                             </div>
                                            <div class="form-group">
                                                <label>Form text content</label>
                                                <input <?php if(isset($_GET['content']) && $_GET['content']!=''){?> style="border-color:red"  <?php } ?> type="text" name="content" value="{{@$_GET['content']}}" placeholder="content"  class="searchtable" id="searchtop">
                                             </div>
                                                <div class="form-group">
                                                <label>First name</label>
                                                <input type="text" name="first_name" value="{{@$_GET['first_name']}}" placeholder="First name"  class="searchtable" id="searchtop">
                                             </div>
                                             <div class="form-group">
                                                <label>Surname</label>
                                                <input <?php if(isset($_GET['surname']) && $_GET['surname']!=''){?> style="border-color:red"  <?php } ?>  <?php if(isset($_GET['surname']) && $_GET['surname']!=''){?> style="border-color:red"  <?php } ?> type="text" name="surname" value="{{@$_GET['surname']}}" placeholder="surname"  class="searchtable" id="searchtop">
                                             </div>
                                             <hr>
                                             <div class="form-group">
                                               
                                                <input type="hidden" name="search" value="" placeholder="Search"  class="searchtable" id="searchtop">
                                             </div>
                                          
                                           
                                             <hr>
                                           
                                          
                                         
                                             <hr>
                                             
                                             <div class="btn-bottom text-left mt-4">
                                                <button  class="btn btn-secondary btn-outline-secondary click_change" type="reset">Reset</button>
                                                <button class="btn btn-primary">Apply</button>
                                             </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                   @if(in_array('bluckedit',$permisions)) 
                                    <div class="col-md-6 text-right ">
                                        <div class="bulkedit d-flex align-items-center justify-content-end">
                                            <label>Bulk  Edit</label>
                                            <div id="statuschangeform" class="align-items-center d-flex">
                                              <select name="status" placeholder="Status" class="form-control tableform_select mb-0 mx-2" id="newstatus" >
                                                    <option value="">All</option>
                                                    <option value="0">Pending</option>
                                                    <option value="1">Completed</option>
                                                    <option value="2">Need Action</option>
                                                    <!--<option value="2">Need Action</option>-->
                                                </select>
                                                <button class="btn btn-danger" id="applyforall">Apply</button>
                                                </div>
                                            </div>
                                    </div>
                                    @endif
                                 </div>
                              </div>
                                <div class="table-responsive newresponsive">
                              <table class="table "  id="example">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Actions</div>
                                       </th>
                                       @if(in_array('bluckedit',$permisions))
                                       <th>
                                          <div class="th-content"><input type="checkbox" name="" class="statuschangeform-btn" ></div>
                                       </th>
                                       @endif
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
                                          <div class="th-content">Submission ID</div>
                                       </th>
                                        <th>
                                          <div class="th-content">Form Location</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Comment</div>
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
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/submissionsdetails/{{$s->id}}"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                        @if(in_array('bluckedit',$permisions))
                                       <td>
                                          <div class="td-content">
                                            <input type="checkbox" name="" class="all_status_child" id="{{$s->id}}" >
                                          </div>
                                       </td>
                                       @endif
                                       <td>
                                          <div class="td-content">{{date('j M Y', strtotime($s->created_at))}} <span class="timeframe">{{date('g:i A', strtotime($s->created_at))}}</span></div>
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
                                                <span class="form-status2 <?php echo ($s->status == 0) ? 'needactionstatus2' : (($s->status == 1) ? 'completedstatus2' : 'pendingstatus2'); ?>"><span></span> <?php echo ($s->status == 0) ? 'Pending' : (($s->status == 1) ? 'Completed' : 'Need Action'); ?>  <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/></span>
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
                                          <div class="td-content">{{$s->id}}</div>
                                       </td>
                                       <td>
                                           @if(!empty($s->form_location) && $s->form_location != 'null')
                                            <div class="td-content">
                                              <?php
                                                if($s->form_location != '' || $s->form_location != NULL || !empty($s->form_location)){
                                                     $src_file = url('/').'/resources/views/Admin/assets/img/location.svg';
                                                     $form_location = json_decode($s->form_location);
                                                     $long = $form_location->longitude;
                                                     $lat = $form_location->latitude;
                                                }else{
                                                     $src_file = url('/').'/resources/views/Admin/assets/img/locationOff.svg';
                                                     $long = '';
                                                     $lat = '';
                                                }
                                                ?>
                                              <a  class="locationView" title="View Location" href="javascript:void(0);"  data-lat="{{ $lat }}" data-lng="{{ $long }}"><img src="{{ $src_file }}"/></a>
                                            </div>
                                            @else
                                            <?php $src_file = url('/').'/resources/views/Admin/assets/img/locationOff.svg'; ?>
                                           <div class="td-content">
                                              <a title="No Location" href="javascript:void(0);"><img src="{{ $src_file }}"/></a>
                                           </div>
                                           @endif
                                       </td>
                                       <td>
                                          
                                           @if(\App\Models\SubmissionComments::where('submission_id','=',$s->id)->count()>0)
                                            <img class="open-chat" width="24" height="24" src="https://img.icons8.com/glyph-neue/64/FA5252/chat.png" alt="chat"  data-toggle="modal" data-target="#exampleModalCenter" id="{{$s->id}}"/>
                                           @else
                                              <img class="open-chat" width="24" height="24" src="https://img.icons8.com/material-sharp/24/chat.png" alt="chat"  data-toggle="modal" data-target="#exampleModalCenter" id="{{$s->id}}"/>
                                           @endif
                                        </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                     <!-- <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio1"/>	
                                                         <label  for="radio1">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>-->
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" class="radio2" checked />	
                                                         <label  for="radio2">
                                                         <img src="{{url('/')}}/resources/views/organization/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <!--<button class="btn btn-primary mt-3" onclick="downloadCSV({{ $s->id }})">Download</button>-->
                                                    <a href="{{ route('submission.csv', ['id' => $s->id]) }}" class="btn btn-primary mt-3">Download</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                     @endforeach
                                     @endif
                                 </tbody>
                              </table>
                             
                           </div>
                        </div>
                        <div class="d-flex justify-content-center">
                                        {!! $submissions->appends(request()->query())->links() !!}
                                      </div>
                                      
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Comment</b></h5>
        <div>
            <a href="#" id="viewanchor" style="color: #E22028;">View All</a>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      </div>
      <div class="modal-body">
          <div id="display-section">
               
          </div>
         <div>
             <input type="hidden" id="hidden_submission" value="">
             <textarea class="form-control mb-3" rows="4" id="senddata"></textarea>
             <p id="showerror" style="color:red"></p>
             <span class="btn btn-info send">Send</span>
         </div>
       
      </div>
      
    </div>
  </div>
</div>
       <!--location modal-->
      <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="locationModalLabel">Location</h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                </div>
                <div class="modal-body">
                    <!-- The location information will be displayed here -->
                    <div class="map mb-2" style="height: 300px;">
                        <div id="map" style="overflow:visible;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      // Get the link element
      var link = document.querySelector('.locationView');
    
      // Add a click event listener
      link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the link from navigating
    
        // Get the latitude and longitude from the data attributes
        var lat = link.dataset.lat;
        var lng = link.dataset.lng;
    
        // Open the map model with the provided latitude and longitude
        openMap(lat, lng);
      });
    
      // Function to open the map model
      function openMap(lat, lng) {
          // Create a new map instance
          var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: parseFloat(lat), lng: parseFloat(lng) },
            zoom: 10, // Adjust the zoom level as needed
            mapTypeId: "roadmap" // Set the map type to "roadmap"
          });
        
           // Create a marker with label
          var marker = new google.maps.Marker({
            position: { lat: parseFloat(lat), lng: parseFloat(lng) },
            map: map,
            label: { text: 'Location Details', fontWeight: 'bold' } // Customize the label text and style as needed
          });
        
          // Create an info window
          var infoWindow = new google.maps.InfoWindow({
            content: 'Latitude: ' + lat + '<br>Longitude: ' + lng
          });
        
          // Add a click event listener to the marker
          marker.addListener('click', function() {
            infoWindow.open(map, marker);
          });
        
          // Override the overflow property for the map container element
          var mapContainer = document.getElementById('map');
          mapContainer.style.overflow = 'visible';
        
          // Adjust the size and position of the map container
          mapContainer.style.width = '100%'; // Set the desired width
          mapContainer.style.height = '300px'; // Set the desired height
          mapContainer.style.position = 'relative'; // Set the desired position (e.g., relative, absolute)
        
          // Open the modal with the map
          // You can use your preferred method to show the modal here
          // For example, you can use a Bootstrap modal or a custom modal implementation
        }
    </script>
      @include('organization.layout.footer')
      
      <script>
    function downloadCSV(id) {
        window.location.href = "{{ route('submission.csv', ['id' => "+id+"]) }}/" + id;
    }
</script>
    
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
            url: baseUrl +'/submitted_from_status_organization',
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

$(".open-chat").click(function(){
     $("#showerror").text("");
        var baseUrl = "<?php echo url('/'); ?>";
       submissionId=  $(this).attr('id');
        $("#viewanchor").attr('href',baseUrl+"/organization/submissionsdetails/"+submissionId);
    
    $("#hidden_submission").val(submissionId);
        $.ajax({
            url: "{{ route('getComments')}}",
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include the CSRF token in the request headers
            },
            data: {
                submissionId: submissionId
               
            },
            success: function(response) {
                data = JSON.parse(response);
             
                $("#display-section").empty();
              $.each(data, function( index, value ) {
                      console.log(value.comment_by );
                       $("#display-section").append("<div style='padding: 10px 0px;margin-bottom:10px;border-bottom: 1px solid #ced4da;'><div class='d-flex align-items-center justify-content-between mb-1'><h6 class='mb-0'><b>"+value.name+"</b></h6><span id='sp' style='opacity:0.75;font-size: 12px;color:#515365'>"+value.created_at+"</span></div><p>"+value.comment+"</p></div>");
                    });
                
            },
            error: function(xhr, status, error) {
                // Error callback function
                console.error('Error posting value:', error);
            }
        });
    });
     
     $(".click_change").click(function(){
        window.location.href="{{url('/')}}/organization/submissions";
    });
    $(".send").click(function(){
        $("#showerror").text("");
         comment = $("#senddata").val();
         submissionId = $("#hidden_submission").val();
        if(comment!=''){
         $.ajax({
            url: "{{ route('submit.comment.by.org.ajax')}}",
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include the CSRF token in the request headers
            },
            data: {
                submission_id: submissionId,
                comment:comment
            },
            success: function(response) {
                data = JSON.parse(response);
                $("#senddata").val("");
                $("#display-section").empty();
              $.each(data, function( index, value ) {
                      console.log(value.comment_by );
                       $("#display-section").prepend("<div style='padding: 10px 0px;margin-bottom:10px;border-bottom: 1px solid #ced4da;'><div class='d-flex align-items-center justify-content-between mb-1'><h6 class='mb-0'><b>"+value.name+"</b></h6><span id='sp' style='opacity:0.75;font-size: 12px;color:#515365'>"+value.created_at+"</span></div><p>"+value.comment+"</p></div>");
                    });
                
            },
            error: function(xhr, status, error) {
                // Error callback function
                console.error('Error posting value:', error);
            }
        });
        }else{
            $("#showerror").text("Please enter a comment");
        }
    });
    
 
    
    $(document).ready(function() {
          $('#statuschangeform').show();
    // Initially hide the form
   

    // Listen for changes in the checkbox
    $('.statuschangeform-btn').change(function() {
    
        
          // Get the checked status of the "All Status" checkbox
        var isChecked = $(this).prop('checked');
       
        // Apply the same checked status to all "All Status Child" checkboxes
        $('.all_status_child').prop('checked', isChecked);
        
    });
    
    $("#applyforall").click(function(){
           status = $("#newstatus").val();
          
            // Initialize an empty array to store the IDs of checked checkboxes
            var checkedIds = [];
    
            // Find all checked "All Status Child" checkboxes
            $('.all_status_child:checked').each(function () {
                checkedIds.push($(this).attr('id'));
            });
            
             $.ajax({
                   url:"{{route('submitted_from_status_multiple.organization')}}",
                    method: 'POST',
                    
                    data: {
                        submissionId: checkedIds,
                        value: status,
                        '_token':"{{csrf_token()}}"
                    },
                    success: function(response) {
                        console.log(response);
                       
                        console.log('Value posted successfully.');
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Error callback function
                        console.error('Error posting value:', error);
                    }
                });
    
            // Log the array of checked IDs to the console
            console.log(checkedIds);
      
    });
});

</script>