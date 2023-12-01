$('.deleteclass').click(function()
{
	var id = $(this).attr('data-id');
	var table = $(this).attr('data-table');
	var url = $(this).attr('data-url');
	console.log('id',id, table, url);
	$('.delete-main').attr('data-id',id);
	$('#deleteform').children('input[name="id"]').val(id);
	$('#deleteform').attr('action',url);
});


$('input[type="checkbox"].changestatus').click(function(event) {
//    this.checked = false; // reset first
   var id = $(this).attr('data-id');
	var table = $(this).attr('data-table');
	var url = $(this).attr('data-url');

	$('#statusform').children('input[name="id"]').val(id);
	$('#statusform').attr('action',url);

    var checkbox = $(this);
      if (checkbox.is(":checked")) {
       //check it 
       console.log('checked');
       $('#statusform').children('input[name="status"]').val('1');
      } else {
         console.log('unchecked');
         $('#statusform').children('input[name="status"]').val('0');
       // this.checked=!this.checked;
      }
    event.preventDefault();
    // event.stopPropagation() like in Zoltan's answer would also spare some
    // handler execution time, but is no more needed here

    // then do the heavy processing:
   
});


$('.classassign').click(function(){
    var ids = $(this).attr('data-id');
    $('.form-select').attr('data-formid',ids);
     getdataofassignform('',ids);
});

 $('.form-select').change(function() {
  var ids = $(this).val();
  var formid = $(this).attr('data-formid');
  getdataofassignform(ids,formid);
  console.log(ids,formid);
});

$(document).on("click",".deleteuserlist",function() {
 var urls = $('.mainurl').val(); 
var data = new FormData();
data.append('userid', $(this).attr('data-id'));
data.append('formid', $(this).attr('data-formid'));
$.ajax({
headers: {
'X-CSRF-Token': $('input[name="_token"]').val()
},
type: 'post',
url: urls+"/deleteassignedorganization",
data:data,
dataType:'json',
cache: false,
contentType: false,
processData: false,
success: function (data) {
if(data.erro==202)
{  
}

if(data.erro==101)
          {
             if(data.htmlclass != undefined && data.htmlclass != null)
                {
                    $('.'+data.htmlclass+'name').html(data.html);
                }
          }
},
}); 
});

/************************ assign form and get assigned user data **********/
 function getdataofassignform(ids='',formid)
  {
    var urls = $('.mainurl').val();
  console.log('-----');
  console.log(ids,formid);
    var data = new FormData();
    data.append('ids', ids);
    data.append('formid', formid);

  $.ajax({
  headers: {
    'X-CSRF-Token': $('input[name="_token"]').val()
  },
      type: 'post',
      url: urls+"/assignform",
      data:data,
      dataType:'json',
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        if(data.erro==202)
          {  
          }

          if(data.erro==101)
          {
             if(data.htmlclass != undefined && data.htmlclass != null)
                {
                    $('.'+data.htmlclass+'name').html(data.html);
                }
          }
      },
  }); 
  }


 