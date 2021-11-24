<?php namespace Core;


abstract class Model
{

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_NUMBER = 'phoneNumber';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';


    public function loadData($data)
    {

        foreach($data as $key => $value){

            if(property_exists($this , $key)){
                $this -> {$key} = $value;
            }
        }
    }



    abstract public function rules():array;

    public array $errors = [];

    public function validation()
    {

        foreach($this->rules() as $attribute => $rules){
            $value = $this->{$attribute};
            foreach($rules as $rule){

                $ruleName = $rule;
                if(!is_string($ruleName)){
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value){
                    $this->addError($attribute , self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value , FILTER_VALIDATE_EMAIL)){
                    $this->addError($attribute , self::RULE_EMAIL);
                }
            }
        }

        return empty($this->errors);
    }
    public function addError(string $attribute , string $rule)
    {
        $massage = $this->errorMassages()[$rule]??'';
        $this->errors[$attribute][]= $massage ;
    }

    public function errorMassages()
    {
        return [
            self::RULE_REQUIRED => 'this field is required',
            self::RULE_EMAIL => 'this field must be valid email address',
            self::RULE_NUMBER => 'this field must be valid phone number',
            self::RULE_MIN => 'min length of this field must be {min}',
            self::RULE_MAX => 'max length of this field must be {max}',
            self::RULE_MATCH => 'this field must be the same as {match}',
        ];
    }

}