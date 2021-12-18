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

class ProductController extends Controller{

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
        // $this->product->where('id' , $userId)->get();
        $result = $this->product->where('id' , $userId)->delete();

        if (!$result) {
            header("Location:/dashboard/product");
            return;
        }
        header("Location:/dashboard/product");
    }

}