@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
       
       

        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="text-center display-4 my-4">User Profile</h2>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                
                @if($UserInfo)
                    <div class="d-flex justify-content-center">
                      
                            <div class="card ">
                                <img src="{{$UserInfo->profile_image->large}}"  alt="...">
                               
                                <div class="card-body">
                                    <h5 class="card-title">UserName: {{$UserInfo->name}}</h5>
                                    <h5 class="card-title"><a  href="{{$UserInfo->links->html}}">link to the user portfolio </a></h5>
                                    <h5 class="card-title">Total Likes: {{$UserInfo->total_likes}}</h5>
                                    <h5 class="card-title"><a href="{{route('ShowgivenUserStatistics', ['username' => $UserInfo->username])}}"> User Statistic </a> </h5>
                                </div>
                            </div>
                      
                    </div>
                @else 
                No User founded

                @endif
                    
               
                
             
                
            </div>
        </div>
    </div>
</div>
@endsection