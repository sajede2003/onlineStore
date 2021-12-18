<?php namespace App\Controllers\Admin;

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

class CategoryController extends Controller{

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
        $userData =$this->category->where('id' , $userId)->get();

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

}
