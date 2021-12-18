<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\DashboardValid;
/**
 * render dashboard page class
 */
class AdminController extends Controller
{

    public function __construct()
    {
        $this->setLayout('Auth');
        DashboardValid::checkAdminUser();
    }

    /**
     * render dashboard function
     * and show index page (dashboard)
     */
    public function dashboard()
    {
        return $this->render('dashboard/dashboard');
    }


  
}
