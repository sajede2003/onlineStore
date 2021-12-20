<?php namespace App\Helper;

class Session
{

    public function add($key, $value = null)
    {
        $_SESSION[$key] = $value;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);

    }

    public function get($key)
    {
        if($this->has($flashKey = "flash.$key")) {
            $message = $this->get($flashKey);
            $this->delete($flashKey);
            return $message;
        }

        return $this->has($key) ? $_SESSION[$key] : null ;
    }
    

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function flush()
    {
        session_destroy();
    }

    public function flash($key , $value)
    {
        $this->add("flash.$key" , $value);
    }

}
