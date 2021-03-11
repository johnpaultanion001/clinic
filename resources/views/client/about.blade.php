@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
  
        <div class="col-md-12">
        <p class="text-uppercase">About Us</p>
            <div class="row">
                @foreach ($abouts as $about)
                    <div class="col-md-9 mx-2">
                        <div class="card ">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-1 bg-info" >
                                           
                                        </div>
                                        <div class="col-11">
                                            <h5 class="card-title text-uppercase">{{$about->title}}</h5>
                                            <h6 class="card-title text-justify">{!! nl2br($about->body) !!}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection