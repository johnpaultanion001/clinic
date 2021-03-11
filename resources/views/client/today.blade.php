@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
    <p class="text-uppercase">Today</p>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-2 pt-2">
                                    <i class="far fa-user fa-2x"></i>
                                </div>
                                <div class="col-10">
                                    <h5 class="card-title text-uppercase">Hi, {{Auth::user()->name}}</h5>
                                    <a href=""><h6 class="text-primary">More info.</h6></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-2 pt-2">
                                    <i class="far fa-calendar fa-2x"></i>
                                </div>
                                <div class="col-10">
                                    <h5 class="card-title text-uppercase">You have schedule today</h5>
                                    <a href="{{ route("admin.schedule.index") }}"><h6 class="text-primary">More info.</h6></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-uppercase">Anouncements</p>
    <div class="col-md-12">
        <div class="row">
            @foreach ($announcements as $announcement)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-2 pt-2">
                                                <i class="fas fa-bullhorn fa-2x"></i>
                                            </div>
                                            <div class="col-10">
                                                <h5 class="card-title text-uppercase">{{$announcement->title}}</h5>
                                                <h6 class="card-title text-uppercase">{{\Illuminate\Support\Str::limit($announcement->body,50)}}</h6>
                                                <button onclick="singleview(this.value)" value="{{$announcement->id}}" id="v{{$announcement->id}}" class="btn btn-white" style="color:blue;" data-toggle="modal" data-target="#viewModal">Read More</button>
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
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h6 class="text-primary" id="exampleModalLabel">View Announcement</h6>
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:black;">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <div class="container">
            <div class="row" id="view">

            </div>
        </div>
        </div>
        <div class="modal-footer">
        {{-- <button type="submit" class="btn btn-dark" id="addbutton">Save</button> --}}
        </div>
    </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    function singleview(v){
	$.ajax({
		type:"get",
		url:'/admin/announcements/'+v,
		dataType: "html",
		success: function(response){
		$('#view').html(response);
		}
		
	})
}
</script>
@endsection