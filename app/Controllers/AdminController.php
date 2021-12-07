<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\DashboardValid;
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
        $allData = Data::getData("users");
        $params = [
            'allData' => $allData,
        ];
        return $this->render('users', $params);
    }

    public function edit()
    {
        $userId = $_GET['id'];
        $userData = Data::getOldData('users', $userId);
        $params = [
            'data' => $userData,
        ];

        return $this->render('editUsers', $params);
    }

    public function editPost()
    {
        $data = $_REQUEST;

        $result = Data::editItem('users', $data);

        $userId = $data['id'];
        
        if ($result) {
            header("Location:/dashboard/users");
        } else {
            header("Location:/dashboard/users/edit?id={$userId}");
        }


    }

    /**
     * delete button function
     */
    public function delete()
    {
        $userId = $_GET['id'];

        $result = Data::deleteItem('users', $userId);

        if (!$result) {
            header("Location:/dashboard/users");
            // var_dump('some thing  wrong!!');
            return;
        }
        header("Location:/dashboard/users");
        // var_dump('user delete successfully');

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
