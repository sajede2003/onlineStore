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
        // dd($allData);

        $params = [
            'allData' =>  $allData ,
        ];
        
        return $this-> render('table', $params);
    }
    
}