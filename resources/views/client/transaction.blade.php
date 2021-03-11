@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Transaction List</h4>
            <div align="right">
            <button type="button" name="create_record" id="create_record" data-toggle="modal" data-target="#exampleModal" class=" btn btn-success">Add Schedule</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Schedule">
                    <thead>
                        <tr>
                            <th width="10">
                            </th>
                            <th>
                                Date Scheduled
                            </th>
                            <th>
                                Time
                            </th>
                            <th>
                                 Purpose
                            </th>
                            <th>
                                 Created At
                            </th>
                            <th>
                                 Scheduled By
                            </th>
                            
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $key => $schedule)
                            <tr data-entry-id="{{ $schedule->id }}">
                                <td>

                                </td>
                                
                                <td>
                                    {{ $schedule->date_time->format('Y-m-d') ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->time ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->purpose->name ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->user->name ?? '' }}
                                </td>
                                <td>
                                       <a class="btn btn-xs btn-info" href="{{ route('admin.schedule.edit', $schedule->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>     
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

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
                                <input type="text" id="date_time" name="date_time" class="form-control date" placeholder="Choose Date And Time" required autocomplete="false" /> 
                            </div>
                            <div class="form-group">
                                <label for="date_timeL">Time: </label>
                                <input type="text" id="time" name="time" class="form-control timepicker" placeholder="Choose Date And Time" required autocomplete="false" /> 
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
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });

  $('.datatable-Schedule:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

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
        },

        error: function(xhr, XMLHttpRequest, textStatus, errorThrown) {
            return getErrorData(xhr.responseText);
            
         },

        complete: function(){
				$(".load").fadeOut();
			},
        });

        
    });

</script>
@endsection