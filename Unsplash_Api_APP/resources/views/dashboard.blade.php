@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="display-4 text-center">the most liked photos</h2>
                </div>
            </div>
             
                @foreach($ToptenPhotoLikes as $photolike)
                    
                       
                            <div class="card">
                                
                                <div class="card-body">
                                    <h5 class="card-title">Photo Likes: {{$photolike->total_likes}}</h5>
                                      <h5 class="card-title">Photo image:  {{$photolike->profile_Image}}</h5>
                                  
                                </div>
                            </div>
                        </a>
                 
                @endforeach
           
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="display-4 text-center">the most viewed photos</h2>
                </div>
            </div>
             
                @foreach($ToptenPhotoViews as $photoView)
                    
                       
                            <div class="card">
                                
                                <div class="card-body">
                                    <h5 class="card-title">Photo View: {{$photoView->views}}</h5>
                                      <h5 class="card-title">Photo image: {{ $photoView->photoinfo->profile_Image ?? 'not-exist go to this link to visit the page and after that the data will be saved' }}
                                       
                                     
                                      </h5>
                                  
                                </div>
                            </div>
                        </a>
                 
                @endforeach
           
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="display-4 text-center">the most downloaded photos</h2>
                </div>
            </div>
            
                @foreach($ToptenPhotoDownloads as $photoDownload)
                    
                       
                            <div class="card">
                                
                                <div class="card-body">
                                    <h5 class="card-title">Photo Downlaod: {{$photoDownload->downloads}}</h5>
                                      <h5 class="card-title">Photo image:  {{$photoDownload->photoinfo->profile_Image ?? 'not-exist go to this link to visit the page and after that the data will be saved' }}</h5>
                                  
                                </div>
                            </div>
                        </a>
                 
                @endforeach
           
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="display-4 text-center">Top 10 User Likes</h2>
                </div>
            </div>
            
                @foreach($ToptenUserLikes as $userLike)
                    
                       
                            <div class="card">
                                
                                <div class="card-body">
                                    <h5 class="card-title">User total Likes: {{$userLike->total_likes}}</h5>
                                      <h5 class="card-title">UserName:  {{$userLike->user_name?? 'not-exist go to this link to visit the page and after that the data will be saved' }}</h5>
                                  
                                </div>
                            </div>
                        </a>
                 
                @endforeach
           
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="display-4 text-center">Top 10 User Views</h2>
                </div>
            </div>
            
                @foreach($ToptenUserViews as $userView)
                    
                       
                            <div class="card">
                                
                                <div class="card-body">
                                    <h5 class="card-title">User Views: {{$userView->views}}</h5>
                                      <h5 class="card-title">UserName:  {{$userView->userinfo->user_name?? 'not-exist go to this link to visit the page and after that the data will be saved' }}</h5>
                                  
                                </div>
                            </div>
                        </a>
                 
                @endforeach
           
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="display-4 text-center">Top 10 User Downloads</h2>
                </div>
            </div>
            
                @foreach($ToptenUserDownloads as $userDownload)
                    
                       
                            <div class="card">
                                
                                <div class="card-body">
                                    <h5 class="card-title">User Downlaods: {{$userDownload->downloads}}</h5>
                                      <h5 class="card-title">userName:  {{$userDownload->userinfo->user_name?? 'not-exist go to this link to visit the page and after that the data will be saved' }}</h5>
                                  
                                </div>
                            </div>
                        </a>
                 
                @endforeach
           
        </div>
    </div>
</div>


@endsection
 

