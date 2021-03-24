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
                            <a href="{{ route("admin.schedule.list") }}" class=" btn btn-success">Trasaction List</a>
                            
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
                                <label class="control-label" >Services: </label>
                                <select name="purpose_id" id="purpose_id" class="form-control select2" required>
                                    <option value="0" disabled selected>Select Services</option>
                                    @foreach ($purposes as $purpose)
                                        <option value="{{$purpose->id}}">{{$purpose->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_timeT">Purpose : </label>
                                <textarea id="purpose" name="purpose" class="form-control" placeholder="Enter a purpose"  required ></textarea> 
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

    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Successfully Scheduled Data Inserted</h5>
                
                </div>
                    <div class="modal-body">
                        View your transaction here
                        <a href="{{ route("admin.schedule.list") }}" >Transaction</a>
                        <br>
                        
                       
                    </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route("admin.schedule.list") }}" >Print Now</a>
                    <button type="button" name="close_transaction" id="close_transaction" class="btn btn-primary">Print Later</button>
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
       
            events={!! json_encode($events) !!}; 
            $('#calendar').fullCalendar({
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
                                $.alert({
                                    title: 'Message Error',
                                    content: 'Can\'t add event - weekend',
                                    type: 'red',
                                })
                              return false;
                          }
                          else if(clickdate < today){
                           $.alert({
                                    title: 'Message Error',
                                    content: 'Past date event not allowed ',
                                    type: 'red',
                                })
                           $('#calendar').fullCalendar('unselect');
                           return false
                            }
                       else if(clickdate == today){
                             $.alert({
                                    title: 'Message Error',
                                    content: 'You can`t make schedule today',
                                    type: 'red',
                                })
                             $('#calendar').fullCalendar('unselect');
                             return false
                             }
                            
                         document.getElementById("date_time").value = clickdate;
                         $("#exampleModal").modal("show");
                     }

            })
        });

$('#close_transaction').click(function(){
    location.reload();
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
                form[0].reset();
                $('#transactionModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
            else if(data == "maxdate"){
                $.alert({
                    title: 'Message Error',
                    content: 'Your chosen date  is full',
                    type: 'red',
                })
                form[0].reset();
                
            }
            else if(data == "onedate"){
                $.alert({
                    title: 'Message Error',
                    content: 'You have already scheduled in this date',
                    type: 'red',
                })
                form[0].reset();
            }
            else if(data == "notofficehr"){
                $.alert({
                    title: 'Message Error',
                    content: 'The Clinic open time are 8:00 AM TO 5:00 PM',
                    type: 'red',
                });
                form[0].reset();
            }
            else if(data == "onetime"){
                $.alert({
                    title: 'Message Error',
                    content: 'Your chosen time is not available',
                    type: 'red',
                })
                form[0].reset();
            }
            else if(data == "holidays"){
                $.alert({
                    title: 'Message Error',
                    content: 'Your chosen date is holiday',
                    type: 'red',
                })
                form[0].reset();
            }
            else if(data == "today"){
                $.alert({
                    title: 'Message Error',
                    content: 'You can`t make schedule today',
                    type: 'red',
                })
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
                $.alert({
                    title: 'Message Error',
                    content: response,
                    type: 'red',
                });
            }
        })
    };
    
    $('.modal').on('hidden.bs.modal', function () {
    $('.showError').html('');
    })


</script>
@stop