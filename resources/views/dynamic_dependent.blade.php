<!DOCTYPE html>
<html>
 <head>
  <meta name="_token" content="{{csrf_token()}}" />
  <title>Ajax Dynamic Dependent Dropdown in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
  <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css"/>
 </head>
 <body>
 <br />
  <div class="container box">
        <!-- Modal Start here--> 
<div class="modal fade bs-example-modal-sm" id="myPleaseWait" tabindex="-1" 
    role="dialog" aria-hidden="true" data-backdrop="static"> 
    <div class="modal-dialog modal-sm"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <h4 class="modal-title"> 
                    <span class="glyphicon glyphicon-time"> 
                    </span>Please Wait 
                 </h4> 
            </div> 
            <div class="modal-body"> 
                <div class="progress"> 
                    <div class="progress-bar progress-bar-info 
                    progress-bar-striped active" 
                    style="width: 100%"> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
<!-- Modal ends Here --> 

   <h3 align="center">Choose</h3><br />
   <div class="form-group">
    <select name="state" id="state" class="form-control input-lg dynamic" data-dependent="LG">
     <option value="">----Select State----</option>
     @foreach($state_list as $state)
     <option value="{{ $state->State}}">{{ $state->State }}</option>
     @endforeach
    </select>
   </div>
   <br />
   <div class="form-group">
    <select name="lg" id="lg" class="form-control input-lg dynamic" data-dependent="city">
     <!--<option value="">Select LG</option>-->
    </select>
   </div>
   <br />
   
   {{ csrf_field() }}
   <br />
   <br />
  </div>
  <script src="{{asset('js/app.js')}}"></script>
  <script>
  $(document).ready(function(){
      
      $("#state").change(function(){
              
        var state = $(this).val();
        if(state != ''){
          $('#myPleaseWait').modal('show');
         //console.log(state);
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
            });

            $.ajax({
                  url:"{{ route('dynamicdependent.fetch') }}",
                  method: 'post',
                  data: {
                     state: state                     
                  },
                  error: function(result){
                     //console.log(JSON.stringify(result));
                     alert('error');
                     console.log("error");
                  },
                  success: function(result){
                       //console.log(result);
                       $('#myPleaseWait').modal('hide');
                        if(result){
                          var mylgs = result
                          console.log(mylgs);
                          $('#lg').empty();
                          $('#lg').append('<option value = "">----Select LGA----</option>');
                          $.each(mylgs,function(key,value){
                                $('#lg').append('<option value="'+value.LGA+'">'+value.LGA+'</option>');
                                console.log(key);
                                console.log(value.LGA);
                                
                          }
                         //$('#myPleaseWait').modal('hide');
                          );

                        }

                  }
            });
        }
        else{
            $('#lg').empty();

        }
      });
  });

  </script>

 </body>
</html>
