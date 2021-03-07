@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.schedule.update", [$schedule->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           
            <div class="form-group {{ $errors->has('date_time') ? 'has-error' : '' }}">
                <label for="date_time">{{ trans('cruds.event.fields.start_time') }}</label>
                <input type="text" id="date_time" name="date_time" class="form-control datetime" value="{{ old('date_time', isset($schedule) ? $schedule->date_time : '') }}">
                @if($errors->has('date_time'))
                    <em class="invalid-feedback">
                        {{ $errors->first('date_time') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.event.fields.start_time_helper') }}
                </p>
            </div>
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection