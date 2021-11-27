<?php namespace App\Models;

use App\Core\Validation;

class RegisterModel extends Validation
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
        // insert data to db
        echo "creating new user";
    }

    // public function rules(): array {

    //     return [
    //         'firstname' => [self::RULE_REQUIRED],
    //         'lastname' => [self::RULE_REQUIRED],
    //         'email' => [self::RULE_REQUIRED , self::RULE_EMAIL],
    //         'phoneNumber' => [self::RULE_REQUIRED ,
    //             [self::RULE_EQUAL , 'phoneNumber' => 11]],
    //         'password' => [self::RULE_REQUIRED ,
    //             [self::RULE_MIN , 'min' => 8] ,
    //             [self::RULE_MAX , 'max' => 24]],
    //         'confirmPassword' => [self::RULE_REQUIRED , 
    //             [self::RULE_MATCH , 'match' => 'password']],
    //     ];

    // }



}