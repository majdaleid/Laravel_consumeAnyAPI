<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth')->except(['showProduct']);
        parent::__construct($marketService);
    }

    public function ShowProduct($title,$id)
    {

        $product=$this->marketService->getProduct($id);
   
       //dd($product);
        return view('show')->with(
            [
                'product'=>$product
            ]
        );
    }
}
