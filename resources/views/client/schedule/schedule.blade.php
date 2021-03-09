@extends('layouts.admin')
@section('content')
<div class="card">
   
    <div class="card-header">
        <h4>Schedule</h4>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                        <form action="{{ route("admin.schedule.filterbydate") }}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <small>From : </small>
                                                <input type="text" id="date_from" name="date_from" class="form-control filterdate" placeholder="Choose a Date" autocomplete="off" required /> 
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <small>To : </small>
                                                <input type="text" id="date_to" name="date_to" class="form-control filterdate" placeholder="Choose a Date" autocomplete="off" required /> 
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <br>
                                             <input class=" form-group btn btn-info" type="submit" value="Filter">  
                                        </div>
                                    </div>
                                </div>                            
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div align="right">
                            <button type="button" name="create_record" id="create_record" data-toggle="modal" data-target="#exampleModal" class=" btn btn-success">Add Schedule</button>
                            <a href="{{ route("admin.schedule.list") }}" class=" btn btn-success">List</a>
                        </div>
                    </div>
               
            </div>
        </div>
       
    
    </div>

    <div class="card-body">  
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

        <div id='calendar'></div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-submit" action="" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <span id="form_result"></span>
                            
                            <div class="form-group">
                                <label for="date_timeL">Date : </label>
                                <input type="text" id="date_time" name="date_time" class="form-control date" placeholder="Choose a Date" autocomplete="off" required /> 
                            </div>

                            <div class="form-group">
                                <label for="date_timeT">Time : </label>
                                <input type="text" id="time" name="time" class="form-control timepicker" placeholder="Choose a Time" autocomplete="off" required /> 
                            </div>

                            
                            <div class="form-group">
                                <label class="control-label" >General Checkup: </label>
                                <select name="purpose_id" id="purpose_id" class="form-control select2">
                                    <option value="" disabled selected>Select Purposes</option>
                                    @foreach ($purposes as $purpose)
                                        <option value="{{$purpose->id}}">{{$purpose->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <input class="btn btn-success" type="submit" value="Submit">
                            <input type="hidden" name="_token" id="csrftoken" value="{{ csrf_token() }}">
                            
                            </form>
                        </div>
                        <div class="modal-footer showError">
                        </div>
                    </div>
                </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
@parent


<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: events,
                selectable: true,
                selectHelper: true,
                select: (start, end, allDay) => {
                          var startDate = moment(start),
                          endDate = moment(end),
                          date = startDate.clone(),
                          isWeekend = false;

                          while (date.isBefore(endDate)) {
                              if (date.isoWeekday() == 6 || date.isoWeekday() == 7) {
                              isWeekend = true;
                              }    
                              date.add(1, 'day');
                          }

                          var clickdate = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                          var today = moment().format('YYYY-MM-DD');

                          if (isWeekend) {
                              alert('can\'t add event - weekend');

                              return false;
                          }
                          else if(clickdate < today){
                           alert("Past date event not allowed ");
                           $('#calendar').fullCalendar('unselect');
                           return false
                            }
                         document.getElementById("date_time").value = clickdate;
                         $("#exampleModal").modal("show");
                     }

            })
        });

        

    function getCustomerData(){
        $.ajax({
            url: "getdata", 
            type: "get",
            dataType: "HTMl",
            success: function(response){
                $("#calendar").html(response);
            }	
        })
    }
    
    

    $('#form-submit').on('submit',function(event) {
        event.preventDefault();
        var form = $(this);
    $.ajax({
           url: "schedule",
           type: "POST",
           dataType: "JSON",
           data:  new FormData(this),
    contentType: false,
          cache: false,
    processData: false,
     beforeSend: function(){
        $(".load").fadeIn();
    },
        success: function(data){
            if(data == "success"){
                $("#exampleModal").modal("hide");
                swal("Great", "Successfully Client Data Inserted", "success");
                form[0].reset();
                location.reload();
            }
            else if(data == "maxdate"){
                
                $('#form_result').html('<div class="alert alert-danger">Error, Your chosen date  is full</div>');
                form[0].reset();
                
            }
            else if(data == "onedate"){
                
                $('#form_result').html('<div class="alert alert-danger">Error, You have already scheduled in this date </div>');
                form[0].reset();
            }
            else if(data == "notofficehr"){
                
                $('#form_result').html('<div class="alert alert-danger">Error, The Clinic open time are 8:00 AM TO 4:00 PM </div>');
                form[0].reset();
            }
            else if(data == "onetime"){
                
                $('#form_result').html('<div class="alert alert-danger">Error, Your chosen time is not available </div>');
                form[0].reset();
            }
        },

        error: function(xhr, XMLHttpRequest, textStatus, errorThrown) {
            return getErrorData(xhr.responseText);
            
         },

        complete: function(){
				$(".load").fadeOut();
			},
        });

        
    });

    function getErrorData(error){
        $.ajax({
            url: "errordata/"+error,
            type: "get",
            dataType: "HTMl",
            success: function(response){
                console.log(response);
                $(".showError").html(response);
            }
        })
    };
    
    $('.modal').on('hidden.bs.modal', function () {
    $('.showError').html('');
    })


</script>
@stop