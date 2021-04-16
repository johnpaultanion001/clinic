@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('panel.site_title') }} - Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" placeholder="Age" name="age" value="{{ old('age') }}" required autocomplete="age">

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">City / Region  </label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="City / Region" name="address" value="City Of Antipolo , Rizal" readonly >

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="brgy" class="col-md-4 col-form-label text-md-right">Barangay</label>

                            <div class="col-md-6">
                                    <select name="brgy" id="brgy" class="form-control select2 @error('brgy') is-invalid @enderror" required>
                                        <option value="0" disabled selected>Select Brgy</option>
                                            <option value="Calawis">Calawis</option>
                                            <option value="Cupang">Cupang</option>
                                            <option value="Dela Paz(Pob.)">Dela Paz(Pob.)</option>
                                            <option value="Mayamot">Mayamot</option>
                                            <option value="San Isidro(Pob.)">San Isidro(Pob.)</option>
                                            <option value="San Jose(Pob.)">San Jose(Pob.)</option>
                                            <option value="San Roque(Pob.)">San Roque(Pob.)</option>
                                            <option value="Mambugan">Mambugan</option>
                                            <option value="Bagong Nayon">Bagong Nayon</option>
                                            <option value="Beverly Hills">Beverly Hills</option>
                                            <option value="Dalig">Dalig</option>
                                            <option value="Inarawan">Inarawan</option>
                                            <option value="San Juan">San Juan</option>
                                            <option value="San Luis">San Luis</option>
                                            <option value="Santa Cruz">Santa Cruz</option>
                                            <option value="Muntingdilaw">Muntingdilaw</option>
                                    </select>
                                    @error('brgy')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit" class="col-md-4 col-form-label text-md-right">Unit / Apartment No.</label>
                            <div class="col-md-6">
                                <input id="unit" type="text" class="form-control @error('unit') is-invalid @enderror" placeholder="Unit / Apartment No." name="unit" value="{{ old('unit') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="floor" class="col-md-4 col-form-label text-md-right">Floor</label>
                            <div class="col-md-6">
                                <input id="floor" type="text" class="form-control @error('floor') is-invalid @enderror"  placeholder="Floor" name="floor" value="{{ old('floor') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bn" class="col-md-4 col-form-label text-md-right">Building Name</label>
                            <div class="col-md-6">
                                <input id="bn" type="text" class="form-control @error('bn') is-invalid @enderror" placeholder="Building Name"  name="bn" value="{{ old('bn') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hb" class="col-md-4 col-form-label text-md-right">House / Building No.</label>
                            <div class="col-md-6">
                                <input id="hb" type="text" class="form-control @error('hb') is-invalid @enderror" placeholder="House / Building No."  name="hb" value="{{ old('hb') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">Street Name</label>
                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" placeholder="Street Name"  name="street" value="{{ old('street') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="village" class="col-md-4 col-form-label text-md-right">Village / District</label>
                            <div class="col-md-6">
                                <input id="village" type="text" class="form-control @error('village') is-invalid @enderror" placeholder="Village / District"  name="village" value="{{ old('village') }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact_number" type="number" class="form-control @error('contact_number') is-invalid @enderror" placeholder="Contact Number" name="contact_number" value="{{ old('contact_number') }}" required autocomplete="contact_number">

                                @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password" style="float: right; margin-top: -25px; margin-right: 5px; position: relative; z-index: 2;"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon retoggle-password" style="float: right; margin-right: 5px; margin-top: -25px; position: relative; z-index: 2;"></span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent


<script src="{{ asset('js/main.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
     $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }

        });
        $("body").on('click', '.retoggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password-confirm");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }

        });

</script>


@stop