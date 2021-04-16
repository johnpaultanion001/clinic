@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">  
                <div class="card-header font-weight-bold text-uppercase text-info">{{ trans('panel.site_title') }} - Register</div>

                <div class="card-body">
                    <form method="POST" id="myForm">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control"  placeholder="Name"  value="{{ old('name') }}" autofocus />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-name"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>
                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control" placeholder="Age" name="age" value="{{ old('age') }}" >
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-age"></strong>
                                    </span>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') }}">
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-email"></strong>
                                    </span>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact_number" type="number" class="form-control" placeholder="Contact Number" name="contact_number" value="{{ old('contact_number') }}">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-contact_number"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">City / Region  </label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" placeholder="City / Region" name="address" value="City Of Antipolo , Rizal" readonly >
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-address"></strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="brgy" class="col-md-4 col-form-label text-md-right">Barangay</label>
                            <div class="col-md-6">
                                    <select name="brgy" id="brgy" class="form-control select2">
                                        <option value="0" disabled selected>Select Barangay</option>
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
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-brgy"></strong>
                                    </span>
                                 
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="unit" class="col-md-4 col-form-label text-md-right">Unit / Apartment No.</label>
                            <div class="col-md-6">
                                <input id="unit" type="text" class="form-control" placeholder="Unit / Apartment No." name="unit" value="{{ old('unit') }}">
                            </div>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-unit"></strong>
                            </span>
                        </div>
                        <div class="form-group row">
                            <label for="floor" class="col-md-4 col-form-label text-md-right">Floor</label>
                            <div class="col-md-6">
                                <input id="floor" type="text" class="form-control"  placeholder="Floor" name="floor" value="{{ old('floor') }}">
                            </div>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-floor"></strong>
                            </span>
                        </div>
                        <div class="form-group row">
                            <label for="bn" class="col-md-4 col-form-label text-md-right">Building Name</label>
                            <div class="col-md-6">
                                <input id="bn" type="text" class="form-control " placeholder="Building Name"  name="bn" value="{{ old('bn') }}">
                            </div>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-bn"></strong>
                            </span>
                        </div>
                        <div class="form-group row">
                            <label for="hb" class="col-md-4 col-form-label text-md-right">House / Building No.</label>
                            <div class="col-md-6">
                                <input id="hb" type="text" class="form-control " placeholder="House / Building No."  name="hb" value="{{ old('hb') }}" >
                            </div>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-hb"></strong>
                            </span>
                        </div>
                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">Street Name</label>
                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" placeholder="Street Name"  name="street" value="{{ old('street') }}" >
                            </div>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-street"></strong>
                            </span>
                        </div>
                        <div class="form-group row">
                            <label for="village" class="col-md-4 col-form-label text-md-right">Village / District</label>
                            <div class="col-md-6">
                                <input id="village" type="text" class="form-control" placeholder="Village / District"  name="village" value="{{ old('village') }}" >
                            </div>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-village"></strong>
                            </span>
                        </div>


                        <div class="form-group row">
                            <label for="village" class="col-md-4 col-form-label text-md-right">Upload Valid ID</label>
                            <div class="col-md-6">
                               <input class="form-control" id="id_img" type="file" accept="image/*" name="id_img" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-id_img"></strong>
                                </span>
                            </div>
                           
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" placeholder="Password" name="password">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password" style="float: right; margin-top: -25px; margin-right: 5px; position: relative; z-index: 2;"></span>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-password"></strong>
                                </span>
                            </div>
                          
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon retoggle-password" style="float: right; margin-right: 5px; margin-top: -25px; position: relative; z-index: 2;"></span>
                            </div>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-password-confirm"></strong>
                            </span>
                        </div>



                      

                       

                        <div class="form-group row ">
                            <div class="col-md-6 offset-md-4 ">
                                <button type="submit" class="btn btn-info font-weight-bold form-control" name="action_button" id="action_button">
                                        REGISTER
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

        $('#myForm').on('submit', function(event){
                event.preventDefault();
                $('.form-control').removeClass('is-invalid')
                var action_url = "{{ route('storeform') }}";
                var type = "POST";

                $.ajax({
                    url: action_url,
                    method:type,
                    dataType:"json",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                         $('#action_button').text("Loading...");
                         $('#action_button').attr("disabled" , true);  
                    },
                    success:function(data){
                        var html = '';
                        $('#action_button').text("REGISTER");
                        $('#action_button').attr("disabled" , false);
                        if(data.errors){
                            $.each(data.errors, function(key,value){
                                if(key == $('#'+key).attr('id')){
                                    $('#'+key).addClass('is-invalid')
                                    $('#error-'+key).text(value)
                                }
                            })
                        }
                        if(data.success){
                            $('.form-control').removeClass('is-invalid')
                            $('#myForm')[0].reset();
                            window.location.href = "/admin/today";
                        }
                        if(data.notindatabases){
                            $('.form-control').removeClass('is-invalid')
                            $.alert({
                                title: 'Error Message',
                                content: data.notindatabases + '</br> </br> Note: If your a new in antipolo city you need to register first in the admin',
                                type: 'red',
                                })
                        }
                       
                    }
                });
            });

</script>


@stop