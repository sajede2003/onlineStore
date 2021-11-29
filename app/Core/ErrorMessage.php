<?php namespace App\Core;

class ErrorMessage{

    public $errors = [];

    public function set($name , $error)
    {
        $this->errors[$name][]=$error;
    }

    public function has($name)
    {
        return isset($this->errors[$name]);
    }

    public function count()
    {
        return count($this->errors);
    }

    public function get($name)
    {
        if($this->has($name)){
            return $this->errors[$name][0];
        }return null;
    }

}