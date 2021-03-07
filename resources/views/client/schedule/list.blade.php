@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button type="button" name="create_record" id="create_record" data-toggle="modal" data-target="#exampleModal" class="mt-2 btn btn-sm btn-success">Set Schedule</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Schedule List
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Schedule">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            
                            <th>
                                Date And Time
                            </th>
                            <th>
                            Purpose
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
                                    {{ $schedule->date_time ?? '' }}
                                </td>
                                <td>
                                    {{ $schedule->purpose ?? '' }}
                                </td>
                                
                                <td>
                                    
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.schedule.show', $schedule->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.schedule.edit', $schedule->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    
                                        <form action="{{ route('admin.schedule.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    
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
                                <input type="text" id="date_time" name="date_time" class="form-control datetime" placeholder="Choose Date And Time" required /> 
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="purpose" name="purpose" placeholder="Enter Purpose" required></textarea>
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