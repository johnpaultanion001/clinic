@extends('layouts.app')
@section('content')
<div class="col-md-12">
    
    <div class="row">
        <div class="col-md-7">
            @if(session('success'))
                <div class="alert alert-warning">
                {{session('success')}}
                </div>
            @endif
            @if($errors->count() > 0)
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card bg-dark" style="padding: 20px">
            <h5 class="font-weight-bold">Feel free to leave a message </h5>
                <form id="myForm" action="{{ route("feedback") }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                    <div class="form-row ">
                        <div class="col">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-name"></strong>
                            </span>
                        </div>
                       
                    </div>
                    <div class="form-row" style="padding-top: 20px">
                        <div class="col">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-email"></strong>
                            </span>
                        </div>
                        <div class="col">
                            <input type="number" name="number" id="number" class="form-control" placeholder="Mobile Number" required>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-number"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-row" style="padding-top: 20px">
                        <div class="col">
                            <textarea name="msg" id="msg" class="form-control" placeholder="Comment/Message" required></textarea>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-msg"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-row" style="padding-top: 20px">
                        <button type="submit" class="btn-lg btn-success form-control">Submit</button>
                    </div>
                   
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-success" style="padding: 20px">
                            <div class="row">
                                <div class="col-md-2">
                                    <i class="fas fa-map-marker fa-2x"></i>
                                </div>
                                <div class="col-md-10">
                                    City Health Office M.Santos St.
                                    Brgy. San Roque,Antipolo City
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="card bg-primary" style="padding: 20px">
                            <div class="row">
                                <div class="col-md-2">
                                <i class="fas fa-phone fa-2x"></i>
                                </div>
                                <div class="col-md-10">
                                    86970362 / 09165344707     
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="card bg-info" style="padding: 20px">
                            <div class="row">
                                <div class="col-md-2">
                                    <i class="fab fa-facebook-f  fa-2x"></i>
                                </div>
                                <div class="col-md-10">
                                <a href="https://www.facebook.com/HealthyPolo/"  target="_blank" class="text-decoration-none text-dark"><h5 class="card-title text-uppercase text-white">HealthyPolo</h5></a>     
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
@endsection
