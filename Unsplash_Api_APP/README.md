<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## how to run this project 

 clone the project  

1)  composer install 

2)   create .env file
   
   

3) copy all the data from env.example and paste it in .env file

change the data with your database Info .

    ###### DB_CONNECTION=mysql
    ###### DB_HOST=127.0.0.1
    ###### DB_PORT=3306
    ###### DB_DATABASE=your database name
    ###### DB_USERNAME=your database username
    ###### DB_PASSWORD=your database password



3) under  https://unsplash.com/developers

   create an application, copy the access key and secret key
   and check all the scopes for  your App.

4) change the value of client_id and client_secret in .env file like the following:

   client_id: value of access key from your application under https://unsplash.com/developers

   client_secret:value secret key from your application under  https://unsplash.com/developers


5) in your developer Unsplash App change the redirect url  to adjust your configuration


  (locally) if you want to test it locally :
  
  give the following link  http://127.0.0.1:8000/authorization

  if you want to test it on your server , adjust it with any link you want and then change it 
  under services/MarketAuthenticationService.php

  here you can change the http://127.0.0.1:8000/authorization with the link from your application in unsplash account

      'redirect_uri' => 'http://127.0.0.1:8000/authorization', 
 
      change it to :
 
     'redirect_uri' => 'https://your_link ', 


6) excute  php artisan migrate in command line  und if you have any problem with your database just run  (php artisan migrate:refresh)


7) run  php artisan serve in command line



# Description 


## Photos
)after running the App ,it will  make public photos requests in home page depend only on the client id  and it will save all the photosinfo  automatically

in the database .the photos will be chosed randomally from unsplash API.

unsplash API will change the photos randomally after several minutes

so if the photos are the same after calling the home page,they will just be updated in the database .

if new photos appears ,then they will be saved in the database .


)after login in the APP 


after login through the api ,the access token will saved in the database and automatically all info from the logged user
will be saved in the database like username , firstname lastname, likes and also the statistiks from these user like views, and downloads


## Photo Statistik
under (http://127.0.0.1:8000/)

you will be able to see photo statistik just after login with your API

you can see the statistik of every photo from home page (/)after klick the statistik link  that have been shown for every photo.



after clicking the link ,the statistik info for the clicked photo will saved too to the database like views and downloads


## search for a specefic user 
http://127.0.0.1:8000/home

you can look for a user by giving the username 

# UserInfo
the public info for the given user will show like name , username ,likes etc and the info will saved in the database too.

# UserStatistik
if you clicked on statistik user info , API request will occur and the info will be saved in the database too.


# Dashboard

## top 10 Users with the most downloads

## top 10 Users with the most views

## top 10 Users with the most likes

## top 10 Photos with the most downloads

## top 10 Photos with the most views

## top 10 Photos with the most likes



## schedule Tasks

the cron job will execute every hour 

change it to pass your needs .


to test cronjob locally 

in the command line :
php artisan log:cron
php artisan schedule:run

on  the server configure it to the time you want:
* * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1



# Notice:

- in this project the focus was on laravel therefore GUI was not considered 
- some bootstrap classes were added 
- in the future everything would be adjusted with reactjs with new features from Unsplash API

 




