@extends('layouts.app')
@section('content')
<div class="col-md-12 ">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="img/c1.jpg" style="width:640px;height:360px" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="img/c2.png" style="width:640px;height:360px" alt="Second slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
</div>
<br>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                 <div class="card" >
                    <div class="card-body">
                        <a href="img/img1.jpg"  target="_blank">
                         <img class="d-block w-100" src="img/img1.jpg" style="width:100%;height:360px" alt="First slide">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                 <div class="card" >
                    <div class="card-body">
                        <a href="img/img2.jpg"  target="_blank">
                            <img class="d-block w-100" src="img/img2.jpg" style="width:640px;height:360px" alt="First slide">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                 <div class="card" >
                    <div class="card-body">
                    <a href="img/img3.jpg"  target="_blank">
                        <img class="d-block w-100" src="img/img3.jpg" style="width:640px;height:360px" alt="First slide">
                    </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center">
                
                <a href="/register-patient" class="btn-lg btn-primary">REGISTER</a>
                    
                
            </div>
            
          </div>
    </div>
    
    <br>
    
    

@endsection
@section('scripts')
@parent
<script>
</script>
@endsection