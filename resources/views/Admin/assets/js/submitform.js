function submitautoform(formdata,formid)
{
  console.log('----', formdata);
  var title = $('#titles').val();
  var formids = $('#formid').val();
  var defaultstatus = $('#defaultstatus').val();
  var formversionid = $('#formversionid').val();
$.ajax({
  headers: {
      'X-CSRF-Token': $('#'+formid).children('input[name="_token"]').val()
  },
        type: 'post',
        url: $('#'+formid).attr('action'),
        data: JSON.stringify({eventData:formdata,title:title,formid:formids,formversionid:formversionid,defaultstatus:defaultstatus}),
        dataType:'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
	
          if(data.erro==202)
            {
              if(data.msg != undefined && data.msg != null && data.msg != '')
              {
                successmessage(data.msg,'error');
              }   
            }
            if(data.erro==101)
            {
            	console.log('data.msg == ', data.msg);
             /* if(data.msg != undefined && data.msg != null && data.msg != '')
              {
                successmessage(data.msg,'success');
              }*/

              if(data.formid != undefined && data.formid != null && data.formid != '')
              {
                $('#formid').val(data.formid);
              }

              if(data.formversionid != undefined && data.formversionid != null && data.formversionid != '')
              {
                $('#formversionid').val(data.formversionid);
              }

              if(data.redirecturl != undefined && data.redirecturl != null)
              {
                window.location.href= data.redirecturl;
              }

              if(data.html != undefined && data.html != null)
              {
                $('#'+data.htmlid).attr('src',data.html);
              }

              if(data.htmlclass != undefined && data.htmlclass != null && data.html != undefined && data.html != null)
                {
                    $('.'+data.htmlclass+'class').attr('src',data.html);
                }

                if(data.htmlclass != undefined && data.htmlclass != null)
                {
                    $('.'+data.htmlclass+'name').html(data.data.name);
                }

              if(data.resetform != undefined && data.resetform != null && data.resetform == 'yes')
              {
                $('#'+formid)[0].reset();
              }

            }
        },
    }); 
}


function submitautoform2(formdata,formid)
{
  console.log('----', formdata);
  var title = $('#titles').val();
  var formids = $('#formid').val();
  var formversionid = $('#formversionid').val();
$.ajax({
  headers: {
      'X-CSRF-Token': $('#'+formid).children('input[name="_token"]').val()
  },
        type: 'post',
        url: $('#'+formid).attr('action'),
        data: JSON.stringify({eventData:formdata,title:title,formid:formids,formversionid:formversionid}),
        dataType:'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
  
          if(data.erro==202)
            {
              if(data.msg != undefined && data.msg != null && data.msg != '')
              {
                successmessage(data.msg,'error');
              }   
            }
            if(data.erro==101)
            {
              console.log('data.msg == ', data.msg);
             /* if(data.msg != undefined && data.msg != null && data.msg != '')
              {
                successmessage(data.msg,'success');
              }*/

              if(data.formid != undefined && data.formid != null && data.formid != '')
              {
                $('#formid').val(data.formid);
              }

              if(data.formversionid != undefined && data.formversionid != null && data.formversionid != '')
              {
                $('#formversionid').val(data.formversionid);
              }

              if(data.redirecturl != undefined && data.redirecturl != null)
              {
                window.location.href= data.redirecturl;
              }

              if(data.html != undefined && data.html != null)
              {
                $('#'+data.htmlid).attr('src',data.html);
              }

              if(data.htmlclass != undefined && data.htmlclass != null && data.html != undefined && data.html != null)
                {
                    $('.'+data.htmlclass+'class').attr('src',data.html);
                }

                if(data.htmlclass != undefined && data.htmlclass != null)
                {
                    $('.'+data.htmlclass+'name').html(data.data.name);
                }

              if(data.resetform != undefined && data.resetform != null && data.resetform == 'yes')
              {
                $('#'+formid)[0].reset();
              }

            }
        },
    }); 
}


function successmessage(msg,type)
{
 toastr.options = {
  "closeButton": true,
  "debug": true,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
    if(type == 'success')
    { 
      toastr["success"](msg);
    }
    if(type == 'error')
    { 
      toastr["error"](msg);
    }
    if(type == 'warning')
    { 
      toastr["warning"](msg);
    }
}