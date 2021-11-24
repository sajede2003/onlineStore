<?php namespace models;

use Core\Model;

class RegisterModel extends Model
{
    


    // get input data
    public string $firstname;
    public string $lastname;
    public string $phoneNumber;
    public string $email;
    public string $password;
    public string $confirmPassword;




    public function register()
    {
        echo "creating new user";
    }

    public function rules(): array {

        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED , self::RULE_EMAIL],
            'phoneNumber' => [self::RULE_REQUIRED , [self::RULE_NUMBER , 'phoneNumber' => 11]],
            'password' => [self::RULE_REQUIRED ,
                [self::RULE_MIN , 'min' => 8] ,
                [self::RULE_MAX , 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED , 
                [self::RULE_MATCH , 'match' => 'password']],
        ];

    }



}