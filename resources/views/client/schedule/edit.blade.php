@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h4>Schedule - Edit</h4>
        <div align="right">
            <button type="button" name="create_record" id="create_record" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger">Cancel this scheduled?</button>
        </div>
    </div>

    <div class="card-body">
        <form id="form-submit" action="{{ route("admin.schedule.update", [$schedule->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           
            <div class="form-group {{ $errors->has('date_time') ? 'has-error' : '' }}">
                
                <p class="feedback">Your Chosen Date: {{$schedule->date_time->format('Y-m-d')}}</p>
                <label for="date_time">Date:</label>
                <input type="text" id="date_time" name="date_time" class="form-control date" autocomplete="off" value="{{$schedule->date_time->format('Y-m-d')}}">
                @if($errors->has('date_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('date_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.start_time_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                <label for="time">Time:</label>
                <input type="text" id="time" name="time" class="form-control timepicker" autocomplete="off" value="{{ old('time', isset($schedule) ? $schedule->time : '') }}">
                @if($errors->has('time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.start_time_helper') }}
                </p>
            </div>
            
            <div class="form-group {{ $errors->has('purpose_id') ? 'has-error' : '' }}">
                <label class="control-label" >Services: </label>
                    <select name="purpose_id" id="purpose_id" class="form-control select2">
                        <option value="{{$schedule->purpose_id}}" disabled selected>{{$schedule->purpose->name}}</option>
                            @foreach ($purposes as $purpose)
                                <option value="{{$purpose->id}}">{{$purpose->name}}</option>
                            @endforeach
                    </select>
                    @if($errors->has('purpose_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('purpose_id') }}
                        </em>
                    @endif
            </div>
            
            
            <div align="right">
                <a href="{{ route("admin.schedule.index") }}" class="btn btn-success">Back</a>
                <input class="btn btn-info" type="submit" value="Submit">
            </div>
           
        </form>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-submit" action="{{ route("admin.schedule.cancel", [$schedule->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                                <p class="feedback">Your Chosen Date: {{$schedule->date_time->format('Y-m-d')}}</p>
                            
                                <div align="right">
                                    <input class="btn btn-danger" type="submit" value="Cancel this scheduled">
                                </div>
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

