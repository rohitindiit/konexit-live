@include('Admin.layout.header')

<style>
  *{
    margin:0;
    font-family: 'Inter',sans-serif;
}
#gallery{
     text-align: center;
    width: 100%;
    margin: auto;
    padding: 0px;
    display: flex;
    flex-wrap: wrap;
}
.box{
    box-sizing:padding-box;
    width:100%;
    max-width: 293px;
    float: left;
    border:1px solid #afafaf;
    margin:10px;
    box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.5);
    opacity:0.7;
}

.box img{
    width:100%;
    margin:0;
    padding:0;
    object-fit: cover;
    height: 130px;
}

#gallery .caption{
    padding:10px;
    margin:0;
    font-size: 20px;
    font-weight: bold;
}

#gallery .box:hover{
    opacity: 1;
    transition: transform 0.5s ease-in-out;
    z-index: 999999;
    transform:scale(1.05);
}

#gallery .box{
 margin: 0;
    max-width: initial;
    width: 15%;
    margin-right: 10px;
    margin-bottom: 11px;
    border-radius: 10px;
    overflow: hidden;
    margin-left: 5px;

}


/*========--------- Responsive -------==========*/

@media(max-width:830px){
    .box{
        width:29%;
    }
}
@media(max-width:637px){
    .box{
        width:42%;
    }
}
@media(max-width:450px){
    .box{
        width:100%;
    }
}



.lead { font-size: 1.5rem; font-weight: 300; }
.container { margin: 30px auto; max-width: 960px; text-align: center; }

#lbt-lightbox-media img{
    height:350px !important;
    width:350px !important;
    object-fit:cover;
}

</style>

      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('Admin.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row layout-top-spacing">
                  <div class="col-xl-7 col-12 px-2 d-flex mb-3 ">
                     <a href="{{url('/')}}/submissionsdetails/{{$submissions->id}}" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/Admin/assets/img/backarrow.svg"/></a>				     
                     <div>
                        <h1 class="headmain mb-1">Submitted Media</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{url('/')}}/submissions">Submissions</a></li>
                              <li class="breadcrumb-item"><a href="{{url('/')}}/submissionsdetails/{{$submissions->id}}">Submissions Details</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Submitted Media</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
                  <?php 
                  $audios = [];
                   if(isset($formdata) && count($formdata) > 0)
                                        { 
                                            
                                            foreach($formdata as $f)
                                            {
                                                if($f->type == 'MyNewComponent' && !empty($f->value))
                                                {
                                                    $audios[] = $f->value;
                                                }
                                            }
                                        }
                                        

                  ?>
                  
                  <div class="col-xl-5 col-12 px-2 text-right">
                     <button class="btn btn-primary btn2 btn3">Download</button>
                  </div>
                   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-6 px-4">
                     <div class="widget">
                        <div class="widget-content">
                           <h3 class="headmaininner">Submitted Media</h3>
                           <div class="row   mt-5">
                              
                               @if(isset($audios) && is_array($audios) && count($audios) > 0)
                               
                                      @foreach($audios as $a)
                                     
                              <div class="col-md-4">
                                 <div class="formgroup submittedata">
                                    <div class="subcont"><b></b> </div>
                                    @if($a != '' && is_string($a))
                                    <audio controls style="width:100%; margin-bottom:11px">
                                    <source src="data:audio/mp3;base64,{{ $a }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                    </audio>
                                    @endif
                                 </div>
                              </div>
                             
                              @endforeach
                            @endif
                              
                           </div>
                          
                            <?php 
                                        if(isset($formdata) && count($formdata) > 0)
                                        { $img = ''; $signature = ''; $img_label = ''; $signature_label = '';
                                            $imgcount = 0; $signcount = 0;
                                            $images = [];
                                            foreach($formdata as $f)
                                            {
                                                if($f->type == 'file' && is_array($f->value))
                                                {
                                                   foreach($f->value as $vl)
                                                   {
                                                       if($imgcount == 0)
                                                       {
                                                           $img = $vl;
                                                          
                                                           $img_label = $f->label;
                                                       }
                                                        $images[] = $vl;
                                                       $imgcount++;
                                                   }
                                                }
                                                if($f->type == 'file' && !is_array($f->value) && !empty($f->value))
                                                {
                                                    
                                                    $images[] = $f->value;
                                                }
                                                if($f->type == 'signature' && !empty($f->value))
                                                {
                                                     $images[] = $f->value;
                                                    $signature = $f->value;
                                                    $signature_label = $f->label;
                                                    $signcount++;
                                                }
                                            }
                                        }
                                
                                     
                                        ?>
                                 
                            @if(isset($images) || isset($signature))                
                           <div class="row">
                               @if(isset($images) && $images != '')
                               
                                
                              <div class="col-md-12 mb-3">
                                 <div class="formgroup submittedata">
                                   
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
                                    </style>
                                     <div id="gallery">
                                    @foreach($images as $f)
                                    <div class="box">
                                      <img src="{{$f}}" alt="image1">
                                    </div>
                                   @endforeach
                                     
                                     </div>
                                 </div>
                              </div>
                              
                              
                              
                              @endif
                           </div>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('Admin.layout.footer')