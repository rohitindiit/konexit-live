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
                     <a href="{{url('/')}}/organization/document" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/organization/assets/img/backarrow.svg"/></a>
                     <div>
                        <h1 class="headmain mb-1">Docments</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{url('/')}}/organization/document">Document</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Assign Document</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget">
                        <div class="widget-content">
                           <div class="row">
                             
                              <div class="col-xl-12  col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="row">
                                    <div class="table-responsive">
                              <table class="table"  id="docassgintable">
                                 <thead>
                                    <tr>
                                      
                                       <th>
                                          <div class="th-content">Id</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Email</div>
                                       </th>
                                        <th>
                                          <div class="th-content">Assign</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                   
                                    @foreach($users as $f)
                                    <tr>
                                        @php
                                            $index1 = $formatted_number = sprintf("%03d", $f->id);
                                           
                                         @endphp
                                       <td>
                                          <div class="td-content">APP{{$index1}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$f->email}}</div>
                                       </td>
                                      <td>
                                          <div class="td-content"><input type="checkbox" id="{{$f->id}}" <?php if(in_array($f->id,$ids)){ ?> checked <?php } ?> class="checku"></div>
                                       </td>
                                      
                                    </tr>
                                    @endforeach
                                  
                                 
                                 </tbody>
                              </table>
                           </div>
                                 </div>
                                   <div class="d-flex justify-content-center">
                                 {{ $users->links()}}
                                      </div>
                              </div>
                              <a href="{{route('document.main')}}" class="btn btn-primary btn-rounded mt-3 ">
                               Save
                             </a>
                           </div>
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
    .dataTables_filter {
     display: block; 
}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
    $(".checku").change(function(){
        
        if ($(this).prop('checked')==true){ 
            type="add";
        }else{
            type="delete";
        }
     userid = $(this).attr('id'); 
       $.ajax({
                    url: "{{route('assgin.doc.user')}}", // Replace with your API endpoint
                    type: "post",
                    dataType: "json",
                    data:{'type':type,'user_id':userid,'docid':"{{$docid}}",'_token':"{{csrf_token()}}"},
                    success: function(data) {
                      console.log(data);
                    }
                   
                });
    });
    
      DataTable = $('#docassgintable').DataTable({
        "searching": true,
      });
</script>
