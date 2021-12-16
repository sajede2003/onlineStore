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
        $this->setLayout('Auth');
        DashboardValid::checkAdminUser();
        $this->validation = new Validation;
    }

    /**
     * render dashboard function
     * and show index page (dashboard)
     */
    public function dashboard()
    {
        return $this->render('dashboard/dashboard');
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
        // $users = User::get();
   
        return $this->render('dashboard/users/table', compact('allData'));
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

        // User::update($data);

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


        //$user = User::find(20);
        $params = [
            'data' => $userData,
        ];

        return $this->render('dashboard/users/edit', $params);
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

        // $result = User::delete($userId)

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
        $allData = Data::getData('categories');

        $params = [
            'allData' => $allData,
        ];

        return $this->render('dashboard/category/table', $params);
    }

    public function addCategory()
    {

        return $this->render('dashboard/category/add');
    }

    public function addCategoryPost()
    {
        $data = $_REQUEST;
        $_POST = array_map('trim', $data);
        $validation = $this->validation->make($_POST, [
            'title' => 'required',
        ]);
        if ($validation->valid()) {
            if (Data::addItem('categories', $data)) {
                header("Location:/dashboard/category");
                return;
            }
        }
        $params = [
            "error" => $this->validation->errors,
        ];

        return $this->render('dashboard/category/add', $params);

    }

    public function categoryEditPost()
    {
        // get inputs value
        $data = $_REQUEST;
        if (Data::editItem('categories', $data)) {
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
        $userData = Data::getOldData('categories', $userId);

        $params = [
            'data' => $userData,
        ];

        return $this->render('dashboard/category/edit', $params);
    }

    /**
     * delete category button function
     *
     * @return void
     */
    public function categoryDelete()
    {
        $userId = $_GET['id'];

        $result = Data::deleteItem('categories', $userId);

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
        $allData = Data::getData('products');

        $params = [
            'allData' => $allData,
        ];

        return $this->render('dashboard/product/table', $params);
    }

    public function addProduct()
    {
        $category = Data::getData('categories');
        $params = [
            'category' => $category,
        ];

        return $this->render('dashboard/product/add', $params);
    }
    public function addProductPost()
    {
        $data = $_REQUEST;
        $pic = $_FILES['pic'];

        $imgPath = $this->imgUploader($pic);

        $data['pic'] = $imgPath;

        if(Data::addItem('products' , $data)){
            header("Location:/dashboard/product");
            return;
        }

    }

    public function productEditPost()
    {
        // get inputs value
        $data = $_REQUEST;

        $pic = $_FILES['pic'];

        // $imagePath = Image::update($_file , )
        $imgPath = $this->imgUploader($pic);

        $data['pic'] = $imgPath;

        if (Data::editItem('products', $data)) {
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
        $userData = Data::getOldData('products', $userId);
        $category = Data::getData('categories');

        $params = [
            'data' => $userData,
            'category' => $category
        ];

        return $this->render('dashboard/product/edit', $params);
    }

    /**
     * delete product button function
     *
     * @return void
     */
    public function productDelete()
    {
        $userId = $_GET['id'];
        // dd($userId);
        $userData = Data::getOldData('products', $userId);
        // dd($userData);
        $result = Data::deleteItem('products', $userId);

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
