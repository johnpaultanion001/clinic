@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h4>Scheduled List - Change Status</h4>
    </div>

    <div class="card-body">
        <form id="form-submit" action="{{ route("admin.scheduled-list.update", [$scheduled_list->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           
           

            <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                <label for="time">Current Status:
                    @if($scheduled_list->isCancel == 0)
                        On Process
                    @elseif($scheduled_list->isCancel == 1)
                        Cancel
                    @elseif($scheduled_list->isCancel == 2)
                        Done
                    @endif
                 </label>
            </div>
            
            <div class="form-group {{ $errors->has('status_id') ? 'has-error' : '' }}">
                <label class="control-label" >Select A Status: </label>
                    <select name="status_id" id="status_id" class="form-control select2">
                        <option value="" disabled selected>Select Status</option>
                        <option value="0">On Process</option>
                        <option value="1">Cancel</option>
                        <option value="2">Done</option>
                    </select>
                    @if($errors->has('status_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('status_id') }}
                        </em>
                    @endif
            </div>
            
            
            <div align="right">
                <a href="{{ route("admin.scheduled-list.index") }}" class="btn btn-success">Back</a>
                <input class="btn btn-info" type="submit" value="Submit">
            </div>
           
        </form>

        

    </div>
    
</div>
@endsection

