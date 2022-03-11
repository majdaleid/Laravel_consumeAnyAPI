@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <div class="row">
                <div class="col">
                    <h2>Categories</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="list-group">
                       
                        <a href="" class="list-group-item">
                           
                        </a>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="display-2">Public Photos </h2>
                </div>
            </div>
            <div class="row">
                @foreach($photos as $photo)
                    <div class="col-4">
                        <a href="{{$photo->urls->raw}}">
                            <div class="card">
                                <img src="{{$photo->urls->small_s3}}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Photo Likes: {{$photo->likes}}</h5>
                                    <p class="card-text">Photo Link: {{$photo->links->html}}</p>
                                    <p class="card-text">Photo Statistik: {{$photo->links->html}}</p>
                                    <a href="{{route('ShowgivenPhotoStatistics', ['id' => $photo->id])}}">Photo Statistik</a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
 