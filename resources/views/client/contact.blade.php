@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
    <p class="text-uppercase">Contact Us</p>
    <div class="col-md-12">
        <div class="row">
            @foreach($contacts as $contact)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                
                                    <div class="col-12">
                                        <h5 class="card-title text-uppercase">{{$contact->title}}</h5>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="card-title">{{$contact->body}}</h6>
                                    </div>
                                    <div class="col-12 bg-primary">
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

</script>
@endsection