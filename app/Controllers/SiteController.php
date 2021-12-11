<?php namespace App\Controllers;


use App\Core\Controller;
use App\Helper\Data;

class SiteController extends Controller
{

    public function home()
    {
        $params = [
            'name' => "TheCodeholic",
        ];
        return $this->render('home', $params);
    }

    public function table(){
        
        // get all contact data from db with get data method
        $allData= Data::getData("contact_us");

        $params = [
            'allData' =>  $allData ,
        ];
        
        return $this-> render('table', $params);
    }

    public function product()
    {
        $allProducts = Data::getData('products');
        // dd($allProducts);
        $params = [
            'products' => $allProducts
        ];

        return $this->render('productList' , $params);
    }

    public function cart()
    {
        return $this->render('cart');
    }
    
}