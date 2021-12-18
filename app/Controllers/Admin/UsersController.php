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

class UsersController extends Controller{

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
     * render users function
     * and show users page in dashboard
     *
     */
    public function users()
    {
        $allData = $this->user->get();   

        return $this->render('dashboard/users/table', compact('allData'));
    }

    /**
     * edit users table function
     *
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
}