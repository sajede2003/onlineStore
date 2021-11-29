<?php namespace App\Core;

use App\Core\ErrorMessage;

class Validation extends ErrorMessage{
    
    protected ErrorMessage $errorMessage;

    public function __construct() {
        $this->errorMessage = new ErrorMessage();
    }

    

    public  function make($inputData , $rules = [])
    {

        // dd($rules);
        foreach ($rules as $key => $value) {
            if($value = $rules){
                $this->required($inputData);
            }
            if($value = $rules){
                $this->length($inputData);
            }
        }

        
        return $this->valid();
        
    }


    public  function required($inputData)
    {
        foreach ($inputData as $key => $value) {
            // dd($inputData);
            if(empty($value)){
                $this->errors[$key] = 'please enter '.$key ;
            }
        }   
    }

    public function length($inputData)
    {
        foreach ($inputData as $key => $value) {
            // dd($value);
            if(strlen($value == 11)){
                $this->errors[$key] = $key .' must be at least 11 characters.';
            }
        }
    }

    public function valid()
    {
        return $this->errorMessage->count() != 0;
    }

}
