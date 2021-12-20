<?php  namespace App\Helper;

class Errors {
    
    /**
     * input requirement error function
     *
     * @param [type] $InputName
     * @return string = error
     */
    public static function requireErrorMessages($inputName)
    {
       
        $error = null;
        if (isset($_SESSION[$inputName])) {
            $error = $_SESSION[$inputName];
            unset($_SESSION[$inputName]);
        }
        
        return $error;
    }
    

    /**
     * Make error message function
     *
     * @param [string] $message
     * @return void
     */
    public static function message( $message){
        $_SESSION['Message']= $message;
        
    }
}