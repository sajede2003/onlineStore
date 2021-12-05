<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\DashboardValid;
use App\Helper\CreateUserSession;
use App\Helper\Data;

/**
 * render dashboard content class
 */
class AdminController extends Controller
{

    public function __construct()
    {
        $this->setLayout('auth');
        DashboardValid::checkAdminUser();
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
        $allData = Data::getData("contact_us");
        $params=[
            'fetch' =>  $allData ,
        ];
        return $this->render('users' , $params);
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