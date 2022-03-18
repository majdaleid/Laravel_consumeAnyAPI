@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="text-center display-4 my-4">{{Auth::user()?"Photos with saved accessToken Requests":"Photos with ClientId Request"}}</h2>
                </div>
            </div>
            <div class="row">
                @foreach($photos as $photo)
                    <div class="col-4">
                        <a href="{{$photo->urls->raw}}"> </a>
                            <div class="card">
                                <img src="{{$photo->urls->small_s3}}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Photo Likes: {{$photo->likes}}</h5>
                                    <p class="card-text">Photo Link:<a> {{$photo->links->html}}</a></p>
                                    <a href="{{route('ShowgivenPhotoStatistics', ['id' => $photo->id])}}">{{Auth::user()?"Photo Statistik(views,downloads)":"login to see photo Statisks(views,downloads)"}}</a>
                                </div>
                            </div>
                        
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
 