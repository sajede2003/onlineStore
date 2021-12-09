<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\DashboardValid;
use App\Core\Validation;
use App\Helper\Data;

/**
 * render dashboard content class
 */
class AdminController extends Controller
{

    protected Validation $validation;

    public function __construct()
    {
        $this->setLayout('auth');
        DashboardValid::checkAdminUser();
        $this->validation = new Validation;
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

    /**
     * edit users table function
     *
     * @return void
     */
    public function usersEditPost()
    {
        // get inputs value
        $data = $_REQUEST;
        if (Data::editItem('users', $data)) {
            header("Location:/dashboard/users");
        } else {
            $userId = $data['id'];
            header("Location:/dashboard/users/edit?id={$userId}");
        }

    }

    /**
     * edit view function
     *
     * @return void
     */
    public function userEdit()
    {
        $userId = $_GET['id'];
        $userData = Data::getOldData('users', $userId);

        $params = [
            'data' => $userData,
        ];

        return $this->render('editUsers', $params);
    }

    /**
     * delete users button function
     *
     * @return void
     */
    public function userDelete()
    {
        $userId = $_GET['id'];

        $result = Data::deleteItem('users', $userId);

        if (!$result) {
            header("Location:/dashboard/users");
            return;
        }
        header("Location:/dashboard/users");
    }

    /**
     * render category function
     * and show category page in dashboard
     *
     */
    public function Category()
    {
        $allData = Data::getData('category');

        $params = [
            'allData' => $allData,
        ];

        return $this->render('category', $params);
    }

    public function addCategory()
    {

        return $this->render('addCategories');
    }
    public function addCategoryPost()
    {
        $data = $_REQUEST;
        $_POST = array_map('trim', $data);
        $validation = $this->validation->make($_POST, [
            'title' => 'required',
        ]);
        if ($validation->valid()) {
            if (Data::addItem('category', $data)) {
                header("Location:/dashboard/category");
                return;
            }
        }
        $params = [
            "error" => $this->validation->errors,
        ];

        return $this->render('addCategories', $params);

    }

    public function categoryEditPost()
    {
        // get inputs value
        $data = $_REQUEST;
        if (Data::editItem('category', $data)) {
            header("Location:/dashboard/category");
        } else {
            $userId = $data['id'];
            header("Location:/dashboard/category/edit?id={$userId}");
        }

    }

    /**
     * edit view function
     *
     * @return void
     */
    public function categoryEdit()
    {
        $userId = $_GET['id'];
        $userData = Data::getOldData('category', $userId);

        $params = [
            'data' => $userData,
        ];

        return $this->render('editCategory', $params);
    }

    /**
     * delete category button function
     *
     * @return void
     */
    public function categoryDelete()
    {
        $userId = $_GET['id'];

        $result = Data::deleteItem('category', $userId);

        if (!$result) {
            header("Location:/dashboard/category");
            return;
        }
        header("Location:/dashboard/category");
    }

    /**
     *
     * render product function
     * and show product page in dashboard
     *
     */

    public function product()
    {
        $allData = Data::getData('product');

        $params = [
            'allData' => $allData,
        ];

        return $this->render('product', $params);
    }

    public function addProduct()
    {
        $category = Data::getData('category');
        $params = [
            'category' => $category,
        ];

        return $this->render('addProduct', $params);
    }
    public function addProductPost()
    {
        $data = $_REQUEST;
        $pic = $_FILES['pic'];

        $imgPath = $this->imgUploader($pic);

        $data['pic'] = $imgPath;
        dd($data);

        if(Data::addItem('product' , $data)){
            header("Location:/dashboard/product");
            return;
        }

    }

    public function productEditPost()
    {
        // get inputs value
        $data = $_REQUEST;

        $pic = $_FILES['pic'];

        $imgPath = $this->imgUploader($pic);

        $data['pic'] = $imgPath;

        if (Data::editItem('product', $data)) {
            header("Location:/dashboard/product");
        } else {
            $userId = $data['id'];
            header("Location:/dashboard/product/edit?id={$userId}");
        }

    }

    /**
     * edit view function
     *
     * @return void
     */
    public function productEdit()
    {
        $userId = $_GET['id'];
        $userData = Data::getOldData('product', $userId);
        $category = Data::getData('category');

        $params = [
            'data' => $userData,
            'category' => $category
        ];

        return $this->render('editProduct', $params);
    }

    /**
     * delete product button function
     *
     * @return void
     */
    public function productDelete()
    {
        $userId = $_GET['id'];

        $result = Data::deleteItem('product', $userId);

        if (!$result) {
            header("Location:/dashboard/product");
            return;
        }
        header("Location:/dashboard/product");
    }

    // image uploader

    public function imgUploader($pic)
    {
        if (!file_exists($pic['tmp_name'])) {
            $this->validation->set('pic', 'no file founded');
            return;
        }

        // validation the img direction path
        if (!is_dir('/uploads'))
            mkdir('/uploads');

        // declare the img path
        $ImgUrl = './uploads/' . $pic['name'];

        // add img to the path
        $result = move_uploaded_file($pic['tmp_name'], $ImgUrl);

        // validate the upload result
        if ($result) {
            echo ($ImgUrl);
        } else {
            $this->validation->set('pic', 'there is no path for file');
            return;
        }

        return $ImgUrl;

    }

    public function DeleteFile($FilePath)
    {
        if (file_exists($FilePath))
            $result = unlink($FilePath);

        if (!$result) {
            $this->validation->set('pic', 'there is no file for delete');
            return;
        }
    }

}
