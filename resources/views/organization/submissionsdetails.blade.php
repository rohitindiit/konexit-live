@include('organization.layout.header')
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('organization.layout.sidebar')
         
          <style>
                .photosubmission1 img{
                        width: 100%;
                        height: 200px;
                        object-fit: cover;

                }
                
                 .photosubmission2 img{
                        width: 100%;
                        height: 200px;
                        object-fit: contain;

                }
.comment_div {
    display: flex;
    flex-wrap: wrap;
}
.comment_div > p {
    flex-grow: 1;
}
.comment_div .comment_sent {
    flex-shrink: 0;
}
.comment_div .comment_sent span {
    font-size: 10px;
    color: #727272;
}
.comment_div .comment_sent span.seen_text {
    display: block;
    text-align: right;
    color: #e22028;
}                
            </style>
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row layout-top-spacing">
                  <div class="col-xl-7 col-12 px-2 d-flex mb-3 ">
                     <a href="{{url('/')}}/organization/submissions" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/Admin/assets/img/backarrow.svg"/></a>				     
                     <div>
                        <h1 class="headmain mb-1">Submissions Details </h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{url('/')}}/organization/submissions">Submissions</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Submissions Details</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-5 col-12 px-2 text-right">
                     <button class="btn btn-primary btn2 btn3">Download</button>
                  </div>
                  
                   <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget">
                        <div class="widget-content">
                           <!--<h3 class="headmaininner">Submitted Data</h3>-->
                            <div class="headmaininner header d-flex">
                                <h3 class="headmaininner">Submitted Data</h3>
                                <div class="dropdown downloaddrop ml-auto">
                                    <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="form-status2 <?php echo ($submissions->status == 0) ? 'needactionstatus2' : (($submissions->status == 1) ? 'completedstatus2' : 'pendingstatus2'); ?>"><span></span><?php echo ($submissions->status == 0) ? 'Pending' : (($submissions->status == 1) ? 'Completed' : 'Need Action'); ?> <img class="ml-2" src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/></span>
                                    </a>
                                    <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                       <h2>Choose Status</h2>
                                       <div class="radiobtn2">
                                          <div class="radioinner2"> 
                                             <input class="radiobtn02" type="radio" value="0" name="radiobtn03{{ $submissions->id }}" id="radio004{{ $submissions->id }}" <?php echo ($submissions->status == 0) ? 'checked' : ''; ?> />	
                                             <label  for="radio004{{ $submissions->id }}">																			    
                                             <span class="checkmark"></span> Pending
                                             </label>														   
                                          </div>
                                          <div class="radioinner2">
                                             <input class="radiobtn02" type="radio" value="1" name="radiobtn03{{ $submissions->id }}" id="radio005{{ $submissions->id }}" <?php echo ($submissions->status == 1) ? 'checked' : ''; ?> />	
                                             <label  for="radio005{{ $submissions->id }}">
                                             <span class="checkmark"></span> Completed
                                             </label>														   
                                          </div>
                                          <div class="radioinner2">
                                             <input class="radiobtn02" type="radio" value="2" name="radiobtn03{{ $submissions->id }}" id="radio006{{ $submissions->id }}" <?php echo ($submissions->status == 2) ? 'checked' : ''; ?> />	
                                             <label  for="radio006{{ $submissions->id }}">
                                             <span class="checkmark"></span> Need Action
                                             </label>														   
                                          </div>
                                       </div>
                                       <button class="btn btn-primary mt-3 apply-button">Apply</button>
                                    </div>
                                 </div>
                            </div>
                           <div class="row   mt-5">
                               @if(isset($formdata) && count($formdata) > 0)
                                      @foreach($formdata as $f)
                                      @if($f->type == 'textfield' || $f->type == 'textarea')
                              <div class="col-md-6">
                                 <div class="formgroup submittedata">
                                    <div class="subcont"><b>{{$f->label}}</b> {{$f->value}}</div>
                                 </div>
                              </div>
                              @elseif($f->type == 'select' || $f->type == 'datetime' || $f->type == 'time' || $f->type == 'radio')
                              <div class="col-md-6">
                                 <div class="formgroup submittedata">
                                    <div class="subcont"><b>{{$f->label}}</b> {{$f->value}}</div>
                                 </div>
                              </div>
                               @elseif($f->type == 'selectboxes' && $f->value != '')
                              <div class="col-md-12 mb-4" style="border-bottom: 1px solid #D9D9D9;">
                                 <div class="formgroup submittedata mb-4">
                                     <?php 
                                        $valueArray = array_column($f->value, 'label');
                                        $filteredArray = array_filter($f->values, function($item) use ($valueArray) {
                                            return !in_array($item->label, $valueArray);
                                        });
                                     ?>
                                     <div class="subcont" style="border-bottom: none!important"><b>{{$f->label}}</b></div>
                                        <div class="row">
                                             <div class="col-md-6">
                                                 <div class="subcont mb-0" style="border-bottom: none!important;text-align: left;padding-bottom:0px;">Selected:</div>
                                                 @foreach($valueArray as $iteration)
                                                 <div class="radiobtn2">																			    
                                                     <span class="text-success" style="font-size: 12px;"><img class="mr-2" width="13px" height="13px" src="https://dev.indiit.solutions/konexits/resources/views/Admin/assets/img/checked.svg">{{ $iteration }}</span> 
                                                 </div>
                                                 @endforeach
                                             </div>
                                             <div class="col-md-6">
                                                 <div class="subcont mb-0" style="border-bottom: none!important;text-align: left;padding-bottom:0px;">Unselected:</div>
                                                 @foreach($filteredArray as $iteration)
                                                 <div class="radiobtn2">																			    
                                                     <span class="text-warning" style="font-size: 12px;"><img class="mr-2" width="13px" height="13px" src="https://dev.indiit.solutions/konexits/resources/views/Admin/assets/img/close.png">{{ $iteration->label }}</span> 
                                                 </div>
                                                 @endforeach
                                             </div>
                                         </div>
                                 </div>
                              </div>
                               @elseif($f->type == 'MyBarcodeComponent')
                             <div class="col-md-12">
                                 <div class="formgroup submittedata">
                                    <div class="subcont"><b>{{$f->label}}</b> {{$f->value}}</div>
                                 </div>
                              </div>
                              @elseif($f->type == 'MyNewComponent')
                              <div class="col-md-12">
                                 <div class="formgroup submittedata">
                                    <div class="subcont"><b>{{$f->label}}</b> </div>
                                    @if($f->value != '')
                                    <audio controls style="width:100%; margin-bottom:11px">
                                    <source src="data:audio/mp3;base64,{{ $f->value }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                    </audio>
                                    @endif
                                 </div>
                              </div>
                              @elseif($f->type == 'file')
                             
                              @endif
                              @endforeach
                            @endif
                             <!-- <div class="col-md-6">
                                 <div class="formgroup submittedata">
                                    <div class="subcont"><b>Check car</b> Checked</div>
                                 </div>
                              </div>-->
                           </div>
                            <?php 
                                        if(isset($formdata) && count($formdata) > 0)
                                        { $img = ''; $signature = ''; $img_label = ''; $signature_label = '';
                                            $imgcount = 0; $signcount = 0;
                                            foreach($formdata as $f)
                                            {
                                                if($f->type == 'file'  && $f->value != '' )
                                                {
                                                   foreach($f->value as $vl)
                                                   {
                                                       if($imgcount == 0)
                                                       {
                                                           $img = $vl;
                                                           $img_label = $f->label;
                                                       }
                                                       $imgcount++;
                                                   }
                                                }
                                                if($f->type == 'signature'  && $f->value != '')
                                                {
                                                    $signature = $f->value;
                                                    $signature_label = $f->label;
                                                    $signcount++;
                                                }
                                            }
                                        }
                                      
                                     
                                        ?>
                                 
                            @if(isset($img) || isset($signature))                
                           <div class="row">
                               @if(isset($img) && $img != '')
                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                 <div class="formgroup submittedata">
                                    <label>{{$img_label}}</label>
                                   
                                    <div class="photosubmission1">
                                       <img src="{{$img}}"/>
                                    </div>
                                 </div>
                              </div>
                              @endif
                              @if(isset($signature) && $signature != '')
                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                 <div class="formgroup submittedata">
                                    <label>{{$signature_label}}</label>
                                    <div class="photosubmission2">
                                       <img src="{{$signature}}"/>
                                    </div>
                                 </div>
                              </div>
                              @endif
                           </div>
                           @endif
                           
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget mb-3">
                        <div class="widget-content">
                           <div class="row align-items-center">
                              <div class="col-md-6">
                                 <h3 class="headmaininner mb-0">Form Media</h3>
                              </div>
                              <div class="col-md-6 text-right">
                                 <div class="formmediaimg">
                                    <div>
                                        @if(isset($formdata) && count($formdata) > 0)
                                      @foreach($formdata as $f)
                                      @if($f->type == 'file'  && $f->value != '')
                                      @foreach($f->value as $vl)
                                       <a class="example-image-link" href="javascript:void(0);" data-lightbox="example-set"><span class="signimg formsign"><img src="{{$vl}}"/></span></a>
                                      @endforeach
                                      @endif
                                      @endforeach
                                      @endif
                                      <!-- <a class="example-image-link" href="{{url('/')}}/resources/views/organization/assets/img/vehicleimg1.jpg" data-lightbox="example-set" ><span class="signimg formimg"><img src="{{url('/')}}/resources/views/organization/assets/img/vehicleimg.png"/></span></a>-->
                                    </div>
                                    <div>
                                        <?php 
                                        if(isset($formdata) && count($formdata) > 0)
                                        {
                                            $count = 0;
                                            foreach($formdata as $f)
                                            {
                                                if($f->type == 'file'  && $f->value != '')
                                                {
                                                   foreach($f->value as $vl)
                                                   {
                                                       $count++;
                                                   }
                                                }
                                                if($f->type == 'signature'  && $f->value != '')
                                                {
                                                  //  $count++;
                                                }
                                            }
                                        }
                                      
                                     
                                        ?>
                                       
                                       @if($count > 0)
                                       <a href="{{url('/organization/submission_media/'.$submissions->id)}}"> <span class="count-media">{{$count}}</span> <span  class="media-arrow"><img src="{{url('/')}}/resources/views/organization/assets/img/arrow-right.svg"/></span></a>
                                      @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                       @if(!empty($submissions->form_location) && $submissions->form_location != "null")
                           <?php $form_location = json_decode($submissions->form_location);?>
                     <div class="widget mh-formdetail  mb-3">
                        <div class="widget-content">
                           <h3 class="headmaininner">Form Location</h3>
                           
                          
                           <div class="form-group detailform">
                              <!--<label>Submitted Location</label>-->
                              <!--<p>Lat: {{$form_location->latitude}}, Long: {{$form_location->longitude}}, Address: {{$form_location->address}}</p>-->
                          
                               @if(!empty($form_location->longitude))
                               
                              <p><b>Lat: </b> <span class="ml-auto">{{$form_location->latitude}}</span></p>
                              <p><b>Long: </b> <span class="ml-auto">{{$form_location->longitude}}</span></p>
                              <p><b>Address: </b> <span class="ml-auto">{{$form_location->address}}</span></p>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="map mb-2">
                                           <iframe
                                              width="100%"
                                              height="250"
                                              frameborder="0" style="border:0"
                                              src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAGkrWW6F88zP1dHFVVwknfHv-o-NBal1U&q=@({{$form_location->latitude}},{{$form_location->longitude}})&center={{$form_location->latitude}},{{$form_location->longitude}}&zoom=18&maptype=roadmap"
                                              allowfullscreen>
                                            </iframe>

                                            <div id="map"></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                          
                           </div>
                          
                          
                           
                        </div>
                     </div>
                      @endif
                     <div class="widget mh-formdetail">
                        <div class="widget-content">
                           <h3 class="headmaininner">Form details</h3>
                           <div class="form-group detailform">
                              <label>Submission Id</label>
                              <p>{{$submissions->id}}</p>
                           </div>
                           <div class="form-group detailform">
                              <label>Submitted By</label>
                              <p>{{$submissions->submitted_by}}</p>
                           </div>
                           <div class="form-group detailform">
                              <label>Form Name</label>
                              <p>{{$submissions->formtitle}}</p>
                           </div>
                           <div class="form-group detailform">
                              <label>Form ID</label>
                              <p>{{$submissions->form_display_ID}}</p>
                           </div>
                           <div class="form-group detailform">
                              <label>Submitted On</label>
                              <p>{{date('j M Y', strtotime($submissions->created_at))}} {{date('g:i A', strtotime($submissions->created_at))}}</p>
                           </div>
                         <div class="form-group detailform">
                              <label>User Division</label>
                              <p>{{App\Models\User::where('id','=',$submissions->userid)->pluck('division')->implode('')}}</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2 formusers">
                     <div class="widget">
                        <div class="widget-content">
                           <h3 class="headmaininner">Comments</h3>
                           @forelse($comments as $comment)
                           <div class="comments">
                    
                              <h5>{{App\Models\User::where('id','=',$comment->comment_by)->pluck('name')->implode('')}} {{App\Models\User::where('id','=',$comment->comment_by)->pluck('lname')->implode('')}} <span style="float:right;color:#727272">{{date('j M Y', strtotime($comment->created_at))}} {{date('g:i A', strtotime($comment->created_at))}}</span></h5>
                             <div class="comment_div">
                              <p>{{$comment->comment}}</p>
                              <div class="comment_sent">
                              @if($comment->user_view=="1")
                              <span>sent to app user</span>
                              @endif
                              @if($comment->app_seen=="1")
                              <span class="seen_text">seen</span>
                              @endif
                              </div>
                             </div>
                              
                            </div>
                            @empty
                            <div class="comments">
                               <p>No comments found.</p>
                               </div>
                           @endforelse
                           
                           <div class="commentsform">
                           <form id="comment_form" method="post" action="{{route('submit.comment.by.org')}}">
                            @csrf 
                               <div class="row">
                                    <div class="col-md-9 col-lg-10">
                                        <div class="form-group">
                                            <div class="comment_checkbox">
                                          <label>Add Comment</label>
                                          <input type="checkbox" name="isshowuser"><span>Send to app user ?</span>
                                          </div>
                                          <input id="comment_box" type="text" class="form-control" name="comment" placeholder="Add your comment here..."/>
                                          <input name="submission_id" value="{{$submissions->id}}" type="hidden" >    
                                        </div>
                                      </div>
                                    <div class="col-md-3 col-lg-2">
                                        <label class="m-0">&nbsp;</label>
                                        <span class="btn btn-primary h-44 w-100" id="save_comment">Submit</span>
                                    </div>
                              </div>
                            </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('organization.layout.footer')
      
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/geocode/json?address=new_york&key=AIzaSyAGkrWW6F88zP1dHFVVwknfHv-o-NBal1U"></script>

 <script>
// jQuery document ready
$(document).ready(function() {
    
    $("#save_comment").click(function(e){
        e.preventDefault()
         $("#myForm").validate();
         if ($("#comment_form").valid()) {
            $("#save_comment").css("display",'none');
            $("#comment_form").submit();
         };
    });

    $( "#comment_form" ).validate( {
            	rules: {
                   comment:{
			        	required: true
			       },
	                	},
                    messages:{
			       comment: {
						required: "Please enter some text",
					},
	            	 },

            });

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
                submissionId: "<?php echo $submissions->id; ?>",
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