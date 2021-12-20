<?php namespace App\Controllers;

use App\Controllers\Controller;
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
        if (!auth()->check()) {
            return redirect('/login');
        }
        return $this->render('dashboard/dashboard');

    }

}
