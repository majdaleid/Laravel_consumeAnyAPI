@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
       
       

        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="display-2">User Profile</h2>
                </div>
            </div>
            <div class="row">
                
                @if($UserInfo)
                    <div class="col-4">
                        <a href="{{$UserInfo->links->html}}">link to portfolio
                            <div class="card">
                                <img src="{{$UserInfo->profile_image->large}}" class="rounded mx-auto d-block" alt="...">
                               
                                <div class="card-body">
                                    <h5 class="card-title">{{$UserInfo->name}}</h5>
                                    <p class="card-text"></p>
                                </div>
                            </div>
                        </a>
                    </div>
                @else 
                No User founded

                @endif
                    
               
                
             
                
            </div>
        </div>
    </div>
</div>
@endsection