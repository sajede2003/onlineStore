<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\DashboardValid;
use App\Core\Validation;
use App\Models\BookMark;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Product;
use App\Models\Score;
use App\Models\User;
use App\Helper\ImgUploader;

/**
 * render dashboard page class
 */
class AdminController extends Controller
{

    protected Validation $validation;
    protected User $user;
    protected Product $product;
    protected BookMark $bookmarks;
    protected Like $likes;
    protected Score $scores;
    protected Comment $comment;
    protected Category $category;
    protected ImgUploader $img;


    public function __construct()
    {
        $this->setLayout('Auth');
        DashboardValid::checkAdminUser();
        $this->validation = new Validation;
        $this->user = new User;
        $this->product = new Product;
        $this->bookmark = new BookMark;
        $this->like = new Like;
        $this->score = new Score;
        $this->comment = new Comment;
        $this->category = new Category;
        $this->img = new ImgUploader;
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
        $allData = $this->user->get();   

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

        $userId = $data['id'];
        if ($this->user->where('id' , $userId)->update($data)) {
            header("Location:/dashboard/users");
        } else {
            header("Location:/dashboard/users/edit?id={$userId}");
        }

    }

    /**
     * edit users view page function
     *
     * @return void
     */
    public function userEdit()
    {
        $userId = $_GET['id'];
        $userData = $this->user->where('id' , $userId)->get();
        return $this->render('dashboard/users/edit',compact('userData'));
    }

    /**
     * delete users button function
     *
     * @return void
     */
    public function userDelete()
    {
        $userId = $_GET['id'];

        $result = $this->user->where('id' , $userId)->delete();
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
        $allData =$this->category->get();
        return $this->render('dashboard/category/table', compact('allData'));
    }

    // add category page render
    public function addCategory()
    {
        return $this->render('dashboard/category/add');
    }

    // add category function
    public function addCategoryPost()
    {
        $data = $_REQUEST;
        $_POST = array_map('trim', $data);
        $validation = $this->validation->make($_POST, [
            'title' => 'required',
        ]);
        if ($validation->valid()) {
            if ($this->category->create($data)) {
                header("Location:/dashboard/category");
                return;
            }
        }
        $error = $this->validation->errors ;

        return $this->render('dashboard/category/add', compact('error'));
    }

    // category edit page
    public function categoryEditPost()
    {
        // get inputs value
        $data = $_REQUEST;
        $userId = $data['id'];
        if ($this->category->where('id' , $userId)->update($data)){
            header("Location:/dashboard/category");
        } else {
            $userId = $data['id'];
            header("Location:/dashboard/category/edit?id={$userId}");
        }

    }

    /**
     * category edit view function
     *
     * @return void
     */
    public function categoryEdit()
    {
        $userId = $_GET['id'];
        $userData =$this->category->where('id' , $userId);

        return $this->render('dashboard/category/edit', compact('userData'));
    }

    /**
     * delete category button function
     *
     * @return void
     */
    public function categoryDelete()
    {
        $userId = $_GET['id'];

        $result =$this->category->where('id' , $userId)->delete();

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
        $allData =$this->product->get();
        return $this->render('dashboard/product/table', compact('allData'));
    }
    // add product view render
    public function addProduct()
    {
        $category = $this->category->get();
        return $this->render('dashboard/product/add', compact('category'));
    }
    // add product function
    public function addProductPost()
    {
        $data = $_REQUEST;
        $pic = $_FILES['pic'];

        $imgPath = $this->img->imgUploader($pic);

        $data['pic'] = $imgPath;

        if($this->product->create($data)){
            header("Location:/dashboard/product");
            return;
        }

    }
    // edit product function
    public function productEditPost()
    {
        // get inputs value
        $data = $_REQUEST;
        $userId = $data['id'];

        $pic = $_FILES['pic'];
        $imgPath = $this->img->imgUploader($pic);
        $data['pic'] = $imgPath;
        if ($this->product->where('id' , $userId)->update($data)) {
            header("Location:/dashboard/product");
        } else {
            header("Location:/dashboard/product/edit?id={$userId}");
        }

    }

    /**
     *  edit product view function
     *
     * @return void
     */
    public function productEdit()
    {
        $userId = $_GET['id'];
        $userData = $this->product->where('id' , $userId)->get();
        $category = $this->category->get();

        return $this->render('dashboard/product/edit', compact('userData' , 'category'));
    }

    /**
     * delete product function
     *
     * @return void
     */
    public function productDelete()
    {
        $userId = $_GET['id'];
        $userData = $this->product->where('id' , $userId)->get();
        $result = $this->product->where('id' , $userId)->delete();

        if (!$result) {
            header("Location:/dashboard/product");
            return;
        }
        header("Location:/dashboard/product");
    }

  
}
