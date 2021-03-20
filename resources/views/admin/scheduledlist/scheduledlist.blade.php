@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Scheduled List</h4>
            <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                        <form action="{{ route("admin.scheduled-list.filterbydate") }}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <small>Filter by date: / Date after current date </small>
                                                <input type="text" id="date" name="date" class="form-control filterdate" placeholder="Choose a Date" autocomplete="off" required /> 
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
                   
               
            </div>
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
                                Reference Number
                            </th>
                            <th>
                                Client Name
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
                                Date
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
                        @foreach($historys as $key => $history)
                            <tr data-entry-id="{{ $history->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $history->reference_number ?? '' }}
                                </td>
                                
                                <td>
                                    {{ $history->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $history->purpose->name ?? '' }}
                                </td>
                                <td>
                                    {{ $history->purpose_text ?? '' }}
                                </td>
                                <td>
                                    {{ $history->time ?? '' }}
                                </td>
                                <td>
                                    {{ $history->date_time->format('Y-m-d') ?? '' }}
                                </td>
                                <td>
                                    @if ($history->isCancel == 0)
                                    <center><p style="border-bottom: 2px yellow solid">On Process</p> </center>
                                    @elseif ($history->isCancel == 1)
                                        <p style="border-bottom: 2px red solid">Cancel</p>
                                    @elseif ($history->isCancel == 2)
                                         <p style="border-bottom: 2px green solid">Done</p>
                                    @endif
                                </td>
                                <td>
                                       <a class="btn btn-xs btn-info" href="{{ route('admin.scheduled-list.edit', $history->id) }}">
                                            Change Status
                                        </a>     
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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


</script>
@endsection