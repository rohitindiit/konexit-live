<div id="exampleModal" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <form action="{{ url('/delete-data') }}" method="POST"  id="deleteform" >
        @csrf
        <input type="hidden" name="id" value="">
      <div class="modal-header flex-column">
        <!-- <div class="icon-box">
          <i class="material-icons">&#xE5CD;</i>
        </div> -->            
        <h4 class="modal-title w-100">Are you sure?</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete these records? This process cannot be undone.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary delete-main">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>  



<div id="exampleModal2" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <form action="{{ url('/change-status') }}" method="POST"  id="statusform" >
        @csrf
        <input type="hidden" name="id" value="">
        <input type="hidden" name="status" value="">
      <div class="modal-header flex-column">
        <!-- <div class="icon-box">
          <i class="material-icons">&#xE5CD;</i>
        </div> -->            
        <h4 class="modal-title w-100">Are you sure?</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Do you really want to change the status of this record?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary change-status">Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div> 

<!-- Map draw starts from here -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    let locationViewLinks = document.querySelectorAll('.locationView');

    locationViewLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            let lat = this.getAttribute('data-lat');
            let lng = this.getAttribute('data-lng');

            let modal = document.getElementById('locationModal');

            if (modal) { // Check if the modal element is found
                let mapContainer = modal.querySelector('.modal-body #map');
                mapContainer.innerHTML = ''; // Clear any previous map content

                let iframe = document.createElement('iframe');
                iframe.setAttribute('width', '100%');
                iframe.setAttribute('height', '100%');
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('style', 'border:2');
                iframe.setAttribute('src', `https://www.google.com/maps/embed/v1/place?key=AIzaSyAGkrWW6F88zP1dHFVVwknfHv-o-NBal1U&q=${lat},${lng}&center=${lat},${lng}&zoom=18&maptype=roadmap`);
                iframe.setAttribute('allowfullscreen', '');

                mapContainer.appendChild(iframe);

                new bootstrap.Modal(modal).show();
            }
        });
    });
});
</script>
<!-- Map draw ends here -->
       
      <script src="{{url('/')}}/resources/views/Admin/assets/js/libs/jquery-3.1.1.min.js"></script>
      <script src="{{url('/')}}/resources/views/Admin/assets/bootstrap/js/popper.min.js"></script>
      <script src="{{url('/')}}/resources/views/Admin/assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="{{url('/')}}/resources/views/Admin/assets/css/perfect-scrollbar/perfect-scrollbar.min.js"></script>
      <script src="{{url('/')}}/resources/views/Admin/assets/js/app.js"></script>
      <script src="{{url('/')}}/resources/views/Admin/assets/js/admin.js"></script>
      <script src="{{url('/')}}/resources/js/validation.js"></script>
      <script src="{{url('/')}}/resources/views/Admin/assets/js/form-validations.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
      <script>
         $(document).ready(function() {
             App.init();
         });
      </script>
      <script src="{{url('/')}}/resources/views/Admin/assets/js/custom.js"></script>
      <script src="{{url('/')}}/resources/views/Admin/assets/js/apex/apexcharts.min.js"></script>
      <script src="{{url('/')}}/resources/views/Admin/assets/js/dash_1.js"></script>
      <script>
         $(document).on('click', '.dropdown.downloaddrop .dropdown-menu', function (e) {
          e.stopPropagation();
         });

          $(document).on('click', '.filterdrop .dropdown-menu', function (e) {
          e.stopPropagation();
         });
      </script>
      <script type="text/javascript" src="{{url('/')}}/resources/views/Admin/assets/js/moment.min.js"></script>
      <script type="text/javascript" src="{{url('/')}}/resources/views/Admin/assets/js/daterangepicker.min.js"></script>
      <script type="text/javascript">
         $(function() {
         
             var start = moment();
             var end = moment();
         
             function cb(start, end) {
                 $('#reportrange span').html(start.format('MM/D/YYYY') + ' - ' + end.format('MM/D/YYYY'));
             }
         
             $('#reportrange').daterangepicker({
                 startDate: start,
                 endDate: end,
                 ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                 }
             }, cb);
         
             cb(start, end);
             
         });
      </script>
      @if(request()->is('organisations2'))
        <script src="{{url('/')}}/resources/views/Admin/assets/js/jquery.dataTables.min.js"></script>
      <script>
         $(document).ready(function() {
         $('#example').dataTable({
          "bPaginate": true,
          "oLanguage": {
              "oPaginate": {
                "sPrevious": "<< ",
                "sNext" : " >>",
                "sFirst": "<<",
                "sLast": ">>"
                }
              },
           "bLengthChange": false,
           "bFilter": true,
           "bInfo": false,
           "bAutoWidth": false,
            processing: true,
            serverSide: true,
            "ajax": {
              headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
             },
            "type": "POST",
            "url": "{{url('/getorganisationdata')}}",
            "dataType": "json",
            "contentType": 'application/json; charset=utf-8',
            "data": function (data) {
            // Grab form values containing user options
            var form = {};
            $.each($("form").serializeArray(), function (i, field) {
            form[field.name] = field.value || "";
            });
            // Add options used by Datatables
            var info = { "start": 0, "length": 10, "draw": 1 };
            $.extend(form, info);
            return JSON.stringify(form);
            },
            "complete": function(response) {
            console.log(response);
            }
            }
         });
         });
         $('#searchtop').keyup(function() {
          var table = $('#example').DataTable();
          table.search($(this).val()).draw();
         });
         $(document).on('click', '.dropdown.filterdrop .dropdown-menu', function (e) {
         e.stopPropagation();
         });
      </script>
      @endif

     @if(Route::is('admin.submission_media'))
     <link rel="stylesheet" href="{{url('/')}}/resources/css/jquery.lbt-lightbox.min.css" />
     <script src="{{url('/')}}/resources/js/jquery.lbt-lightbox.min.js"></script>
     <script>
                $('#gallery').lbtLightBox({
                qtd_pagination: 6,
                pagination_width: "160px",
                pagination_height: "160px",
                custom_children: ".box img",
                captions: true,
                captions_selector: ".caption p",
                });
     </script>
     @endif
 
    @if(request()->is('forms') || Route::is('adminorganization.users') || Route::is('admin.submissions') || request()->is('forms*'))
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/resources/views/Admin/assets/flatpickr/flatpickr.css">
    <script src="{{url('/')}}/resources/views/Admin/assets/flatpickr/flatpickr.js"></script>

    <script src="{{url('/')}}/resources/views/Admins/assets/js/tagsinput.js"></script>

      <script>
       var check_in = flatpickr(document.getElementById('basicFlatpickr1'),{
          maxDate: "today"
       });
       var check_out = flatpickr(document.getElementById('basicFlatpickr2'),{
          maxDate: "today"
       });
        check_in.set("onChange", function(selectedDates, dateStr, instance) { 
         check_out.set("minDate", dateStr); //increment by one day
        });
        check_out.set("onChange", function(selectedDates, dateStr, instance) { 
         check_in.set("maxDate", dateStr); 
        });
          $(document).on('click', '.dropdown.filterdrop .dropdown-menu', function (e) {
         e.stopPropagation();
         });

          $('.titleditor').click(function(){
            var title = $(this).attr('data-value');
            var id = $(this).attr('data-id');
             var customstatus = $(this).attr('custom-status');
            //  if(customstatus=="0")
            //  {
            //      st = "Pending"
            //  }
             
            //   if(customstatus=="1")
            //  {
            //      st = "Complete"
            //  }
             
            //  if(customstatus=="2")
            //  {
            //      st = "Need action"
            //  }
            
            console.log('-------',title,id);
            $('.formidclass').val(id);
            $('.titleclass').val(title);
            $("#dstatus").val(customstatus)
          });

      </script>
      
       <link href="{{url('/')}}/resources/css/tags-standalone.min.css" rel="stylesheet" />
      <!--  <script src="{{url('/')}}/resources/js/tags.js"></script> -->
  <script type="module">
     import Tags from "{{url('/')}}/resources/js/tags.js";
    //import Tags from "./tags.js";
    Tags.init("select[multiple]:not(#regular)");
    // Multiple inits should not matter
    Tags.init("select[multiple]:not(#validationTagsJson)");


$('.classassign').on('click', function() 
{
   const el = document.getElementById("validationTagsJson");
    /** @type {Tags} */
    let inst = Tags.getInstance(el);
    inst.removeAll();
});


     $('input').on('beforeItemRemove', function(event) {
          console.log('event == ', event);
        // event.item: contains the item
        // event.cancel: set to true to prevent the item getting removed
        });

    // Reset does not fire a change input
    document.getElementById("validationTagsJson").addEventListener("change", function (ev) {
   //   console.log(this.selectedOptions);
    });



  </script>

  <style>
    body {
      font-family: sans-serif;
    }

    .mb-3 {
      margin-bottom: 1em;
    }

    .container {
      padding: 2em
    }

    .form-control .badge button {
        display: none !important;
     }

  </style>

    @endif
   </body>
</html>