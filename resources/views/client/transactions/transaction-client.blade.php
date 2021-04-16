@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Transaction List</h4>
            <h6 class="text-primary">“Reminder to come 30 minutes before the schedule”</h6> 
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Schedule">
                    <thead>
                        <tr>
                            <th width="10">
                            </th>
                            <th>
                                Reference Number
                            </th>
                            <th>
                                 Scheduled By
                            </th>
                            <th>
                                 Service
                            </th>
                            <th>
                                 Purpose
                            </th>
                            <th>
                                Time
                            </th>
                            <th>
                                Date Scheduled
                            </th>
                            <th>
                                 Created At
                            </th>
                            <th>
                                 Status
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                 
                            <tr data-entry-id="{{ $schedule->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $schedule->reference_number ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->purpose->name ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->purpose_text ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->time ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->date_time->format('Y-m-d') ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->created_at ?? '' }}
                                </td>
                                <td>
                                    @if ($schedule->isCancel == 0)
                                    <center><p style="border-bottom: 2px yellow solid">On Process</p> </center>
                                    @elseif ($schedule->isCancel == 1)
                                    <center><p style="border-bottom: 2px red solid">Cancel</p></center>
                                    @elseif ($schedule->isCancel == 2)
                                    <center> <p style="border-bottom: 2px green solid">Done</p></center>
                                    @endif
                                </td>
                                <td>
                                        @if ($schedule->isCancel == 0)
                                        <a class="btn  btn-info " href="{{ route('admin.schedule.edit', $schedule->id) }}">
                                            {{ trans('global.edit') }}
                                        </a> 
                                        @endif
                                           
                                </td>
                            </tr>
                       
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
                                <label for="date_timeL">Date : </label>
                                <input type="text" id="date_time" name="date_time" class="form-control date" placeholder="Choose a Date" autocomplete="off" required /> 
                            </div>

                            <div class="form-group">
                                <label for="date_timeT">Time : </label>
                                <input type="text" id="time" name="time" class="form-control timepicker" placeholder="Choose a Time" autocomplete="off" required /> 
                            </div>

                            
                            <div class="form-group">
                                <label class="control-label" >Services: </label>
                                <select name="purpose_id" id="purpose_id" class="form-control select2">
                                    <option value="" disabled selected>Select Services</option>
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
@endsection
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  //delete by selected
  @can('setting_view')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.schedule.massDestroy') }}",
        className: 'btn-danger',
        action: function (e, dt, node, config) {
            var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
            alert('{{ trans('global.datatables.zero_selected') }}')

            return
            }

            if (confirm('{{ trans('global.areYouSure') }}')) {
            $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
            }
        }
        }
        dtButtons.push(deleteButton)
 @endcan
  //delete by selected

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
                swal("Great", "Successfully Scheduled Data Inserted", "success");
                form[0].reset();
                $("#transactionModal").modal("show");
                setTimeout(function(){
                    location.reload();
                    }, 5000);
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
            else if(data == "holidays"){
                $('#form_result').html('<div class="alert alert-danger">Error, Your chosen date is holiday </div>');
                form[0].reset();
            }
            else if(data == "today"){
                $('#form_result').html('<div class="alert alert-danger">Error, You can`t make schedule today</div>');
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
@endsection