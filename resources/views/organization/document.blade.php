@include('organization.layout.header')

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
                   
                     <div>
                        <h1 class="headmain mb-1">Docments</h1>
                       
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget">
                        <div class="widget-content">
                           <div class="row">
                              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                   <form id="documentform" method="post" enctype="multipart/form-data" action="{{route('uplode.document')}}">
                                       @csrf 
                                       <label>Document Title</label>
                                       <input   type="text" name="type" class="form-control" size="20971520" >
                                        <br>
                                        <label>Document</label>
                                      <input type="file" name="documentp"  accept=".pdf" class="form-control" >
                                      <br>
                                      <button class="btn btn-info">Upload</button>
                                   </form>
                                </div>
                             
                           </div>
                           <div class="row" style="margin-top:10px">
                                <div class="col-xl-12  col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="row">
                                    <div class="table-responsive">
                              <table class="table"  id="doctable">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Actions</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Document</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Total Assign</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Uploded By</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Created Time</div>
                                       </th>
                                      
                                    </tr>
                                 </thead>
                                 <tbody>
                                   
                                    @foreach($documents as $f)
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                    <a class="dropdown-item" href="{{url('/')}}/organization/assgindoc/{{$f->id}}"><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/>Assign</a>

                                                   
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                           
                                          <div class="td-content">{{$f->type}} </iframe></div>
                                       </td>
                                        <td>
                                          <div class="td-content">{{\App\Models\UserDoc::where('doc_id','=',$f->id)->count();}} </iframe></div>
                                       </td>
                                        <td>
                                            <?php 
                                             $client =  \App\Models\User::select('name','lname')->where('id','=',$f->uploded_by)->first();
                                            ?>
                                          <div class="td-content">{{$client->name.' '.$client->lname}} </iframe></div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$f->created_at}}</div>
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
  
  $('#documentform').validate({
        // Specify validation rules
        rules: {
           type: 'required',
           documentp: 'required',
        },
        // Specify validation error messages
        messages: {
          type: 'Please enter document title',
          documentp: 'Please Upload pdf',
         
        },
        

      });
      
     
       DataTable = $('#doctable').DataTable({
        "searching": true,
      });
     
</script>
