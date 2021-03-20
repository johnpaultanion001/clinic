@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.user-client.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
               
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
               
            </div>

            <div class="form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                <label for="age">Age*</label>
                <input type="number" id="age" name="age" class="form-control" value="{{ old('age', isset($user) ? $user->age : '') }}" required>
                @if($errors->has('age'))
                    <em class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </em>
                @endif
               
            </div>

            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label for="address">Address*</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($user) ? $user->address : '') }}" required>
                @if($errors->has('address'))
                    <em class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </em>
                @endif
                
            </div>

            <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                <label for="contact_number">Contact Number*</label>
                <input type="number" id="contact_number" name="contact_number" class="form-control" value="{{ old('contact_number', isset($user) ? $user->contact_number : '') }}" required>
                @if($errors->has('contact_number'))
                    <em class="invalid-feedback">
                        {{ $errors->first('contact_number') }}
                    </em>
                @endif
                
            </div>

        
            <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-control">
                <span toggle="#current_password-field" class="fa fa-fw fa-eye field_icon toggle-current_password" style="float: right; margin-left: -25px; margin-top: -25px; position: relative; z-index: 2;"></span>
                @if($errors->has('current_password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('current_password') }}
                    </em>
                @endif
               
            </div>

            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control">
                <span toggle="#new_password-field" class="fa fa-fw fa-eye field_icon toggle-new_password" style="float: right; margin-left: -25px; margin-top: -25px; position: relative; z-index: 2;"></span>
                @if($errors->has('new_password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('new_password') }}
                    </em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                <span toggle="#confirm_password-field" class="fa fa-fw fa-eye field_icon toggle-confirm_password" style="float: right; margin-left: -25px; margin-top: -25px; position: relative; z-index: 2;"></span>
                @if($errors->has('confirm_password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('confirm_password') }}
                    </em>
                @endif
            </div>
           
            <div class="col-6 mx-auto">
                <input class="btn btn-info form-control " type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@parent

<script>
   
$("body").on('click', '.toggle-current_password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#current_password");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});

$("body").on('click', '.toggle-new_password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#new_password");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});

$("body").on('click', '.toggle-confirm_password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#confirm_password");
    if (input.attr("type") === "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
});


</script>
@stop