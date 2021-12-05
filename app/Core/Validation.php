<?php namespace App\Core;

use App\Core\ErrorMessage;
use App\Models\LoginModel;
use App\Models\RegisterModel;

class Validation extends ErrorMessage{
    
    public RegisterModel $registerModel;
    public LoginModel $loginModel;
    public $data;

    public function __construct() {
        $this->registerModel = new RegisterModel();
        $this->loginModel = new LoginModel();
    }
    /**
     * Performance rules
     * @param $inputData
     * @param array $rulesInputs
     * @return bool
     */
    public  function make($inputData , $rulesInputs = [])
    {
        $this->data = $inputData;

        foreach ($rulesInputs as $key => $ruleInput) {
            $this->explodeRules($ruleInput , $key);
        }

        return $this;
    }
    /**
     *execute rules
     * @param $ruleInput
     * @param $key
     */
    public function explodeRules($ruleInput , $key)
    {
        $listOfRules = explode("|", $ruleInput);

        foreach ($listOfRules as $rules) {

            $rule = explode(":", $rules);
            $this->rules($rule , $key);
        }

    }
    /**
     * Diagnosis rules and do validation rules
     * @param $rule
     * @param $key
     */
    public function rules($rule , $key)
    {
        $method = $rule[0];
        $value = isset($rule[1]) ? $rule[1] : null;

        $this->$method($key, $value);
    }

    // start validation functions

    /**
     * required validation
     * @param $key
     * @param null $value
     */
    public function required($key , $value = null)
    {       
        if(empty($this->data[$key]))
            $this->errors[$key][] = "please enter your {$key}" ;
    }
    /**
     * min length validation
     * @param $key
     * @param null $value
     */
    public function min($key , $value = null)
    {
        if(strlen($this->data[$key]) <= (int) $value)
            $this->errors[$key][] = "please enter more than {$value} character";
    }
    /**
     * phoneNumber length validation
     * @param $inputData
     */
    public function length($key , $value = null)
    {
        if(strlen($this->data[$key]) === (int) $value)
            $this->errors[$key][] = "{$key} must be {$value} characters.";
    }
    /**
     * validation phone number function
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    public function phone($key , $value = null)
    {
        $numberValidation = "/^09|011[0-9]*$/";
        if(!preg_match($numberValidation, $this->data[$key]))
            $this->errors[$key][] = "{$key} can only contain number";
    }
    /**
     * match pass and confirm pass function
     *
     * @return void
     */
    public function verify($key , $value = null)
    {
        if($this->data[$key] != $this->data[$value])
            $this->errors[$key][] = "{$key} do not match, please try again.";
    }
    /**
     * checked unique value function
     *
     * @return void
     */
    public function unique($key , $value = null ,$dbData =null)
    {

        $dbData = explode("," , $value);

        if(empty($dbData[1])){
            $dbData[1] = $key;
            if($this->registerModel->checkExists($dbData[0] , $dbData[1] , $this->data[$key])){
                $this->errors[$key][] = "{$key} is exist.";
            }
        }

        
        
    }


  

    



    // finish validation functions 
    /**
     * checked has error
     */
    public function valid()
    {
        if(count($this->errors) == 0){
            return true;
        }else
        return false;
    }

}
