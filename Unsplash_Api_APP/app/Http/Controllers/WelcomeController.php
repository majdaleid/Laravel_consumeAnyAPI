<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /*public function ShowWelcomePage()
    {

        $products=$this->marketService->getProducts();
    //dd($products);
        $categories=$this->marketService->getCategories();
        //return view('welcome')->with(
            [
                'products'=>$products,
                'categories'=>$categories,
            ]
        );//
    }*/


    public function ShowWelcomePage()
    {
         $photos=$this->marketService->getPhotos();
        //dd($photos);
    return view('welcome2')->with(
        ['photos'=>$photos
        ]
    );
    }
}
