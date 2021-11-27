<?php namespace App\Core;

 class Validation{

    public function loadData($data)
    {
        foreach($data as $key => $value){

            if(property_exists($this , $key)){
                $this -> {$key} = $value;
            }
            // dd($data);
            
        }
        
    }

    public function validate()
    {
        # code...
    }
  
}