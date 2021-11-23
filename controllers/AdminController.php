<?php namespace Controllers;

use Core\Controller;

/**
 * render dashboard content class
 */
class AdminController extends Controller
{

    public function __construct()
    {
        $this->setLayout('auth');
    }

    /**
     * render dashboard function
     * and show index page (dashboard)
     */
    public function dashboard()
    {
        return $this->render('dashboard');
    }

    /**
     * render users function
     * and show users page in dashboard
     *
     * @return void
     */

    public function users()
    {
        
        return $this->render('users');
    }

    /**
     * render category function
     * and show category page in dashboard
     *
     */
    public function category()
    {
        return $this->render('category');
    }

    /**
     *
     * render product function
     * and show product page in dashboard
     *
     */
    public function product()
    {
        return $this->render('product');
    }

}
