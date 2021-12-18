<?php namespace App\Core;
namespace App\Core;

use App\Core\ErrorMessage;
use App\Models\Model;
use App\Models\User;

class Validation extends ErrorMessage{
    
    public User $users;
    public $data;

    public function __construct() {
        $this->users = new User();
    }
    /**
     * Performance rules
     * @param $inputData
     * @param array $rulesInputs
     * @return Validation
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
        
        if(strlen($this->data[$key]) != (int) $value)
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
        $model =new Model();
        
        $dbData = explode("," , $value);
        $model->setTable($dbData[0]);


        if(empty($dbData[1])){
            $dbData[1] = $key;
        }
        
       
        $item = $model->where($dbData[1] , $this->data[$key])->first();
      
        if($item){
            $this->errors[$key][] = "{$key} is exist.";
        }
        
    }

    //   /**
    //  * Find user by email. Email is passed in by the controller function
    //  *
    //  * @param [type] $table
    //  * @param [type] $field
    //  * @param [type] $col
    //  * @return array
    //  */
    // public function checkExists($table, $field, $col)
    // {
    //     $item = $->where( $col ,$field)
    //     ->get();
    //     // dd($item);
    //     return count($item);
    // }

    // finish validation functions 
    /**
     * checked has error?
     */
    public function valid()
    {
        if(count($this->errors) == 0){
            return true;
        }else
        return false;
    }

}
