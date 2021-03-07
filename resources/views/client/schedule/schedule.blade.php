@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3 right">
        <button type="button" name="create_record" id="create_record" data-toggle="modal" data-target="#exampleModal" class="mt-2 btn btn-sm btn-success">Set Schedule</button>
        <a href="{{ route("admin.schedule.list") }}" class="mt-2 btn btn-sm btn-success">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                   List
        </a>
   </div>
    
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.systemCalendar') }}
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
                                <label for="date_timeL">Date And Time: </label>
                                <input type="text" id="date_time" name="date_time" class="form-control date" placeholder="Choose Date And Time" autocomplete="off" required /> 
                            </div>

                            <div class="form-group">
                                <textarea class="form-control"  id="purpose" name="purpose" placeholder="Enter Purpose" required></textarea>
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
                
                //editable: true,
                
                 select: function (start,today,end) {

                     var startDate = moment(start),
                     endDate = moment(end),
                     date = startDate.clone(),
                     isWeekend = false;
                     var today = moment().format('YYYY-MM-DD');
                     var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');

                    if(start < today){
                        alert("Back date event not allowed ");
                        $('#calendar').fullCalendar('unselect');
                        return false
                    }
                    
                   
                                    
                     // var title = prompt(start);
                    document.getElementById("date_time").value = start;
                     //$('#form_result').html(start);
                     $("#exampleModal").modal("show");
                     $('#calendar').fullCalendar('unselect');
                    
                    
                
                 }
                // select: (start, end, allDay) => {
                //         var startDate = moment(start),
                //         endDate = moment(end),
                //         date = startDate.clone(),
                //         isWeekend = false;

                //         while (date.isBefore(endDate)) {
                //             if (date.isoWeekday() == 6 || date.isoWeekday() == 7) {
                //                 isWeekend = true;
                //             }    
                //             date.add(1, 'day');
                //         }

                //         if (isWeekend) {
                //             alert('can\'t add event - weekend');

                //             return false;
                //         }

                //         this.startDate= startDate.format("YYYY-MM-DD");
                //         this.endDate= endDate.format("YYYY-MM-DD");   

                //         document.getElementById("date_time").value = startDate;
                //         $("#exampleModal").modal("show");
                //     }

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
            }else if(data == "maxdate"){
                //swal("Great", "Error, Your choose date  is full", "error");
                $('#form_result').html('<div class="alert alert-danger">Error, Your choose date  is full </div>');
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