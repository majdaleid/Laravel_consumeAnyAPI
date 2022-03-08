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
                    <h2 class="display-2">Products</h2>
                </div>
            </div>
            <div class="row">
                @foreach($photos as $photo)
                    <div class="col-4">
                        <a href="{{$photo->urls->raw}}">
                            <div class="card">
                                <img src="{{$photo->urls->small_s3}}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text"></p>
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