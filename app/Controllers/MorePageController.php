<?php namespace App\Controllers;

use App\Core\Controller;
use App\Helper\CreateUserSession;
use App\Models\BookMark;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Product;
use App\Models\Score;
use App\Models\User;

class MorePageController extends Controller
{
    protected Product $products;
    protected BookMark $bookmarks;
    protected Like $likes;
    protected Score $scores;
    protected Comment $comment;
    protected User $users;

    public function __construct()
    {
        $this->product = new Product;
        $this->bookmark = new BookMark;
        $this->like = new Like;
        $this->score = new Score;
        $this->comment = new Comment;
        $this->user = new User;

    }

    public function more()
    {
        // get product id url
        $id = $_GET['id'];

        //get user id
        $userId = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        // get product for show in more page
        $product = $this->product->where('id', $id)->first();

        // reply or return function
        $comment = $this->user->groupCommentByParent($id);

        //  get all like for this product
        $likeCount = $this->like->getUserLiked($userId, $id);

        // avg score
        // $score = Data::avgScore('scores', $id);

        // is user book mark this product
        $isBookmark = $this->bookmark->getUserBookmark($id, $userId);

        // params for send to view

        return $this->render('product/single/singlePage', compact('product', 'comment', 'likeCount', 'isBookmark'));
    }

    public function addLike()
    {
        $data = $_REQUEST;

        // check login for login

        if (!isset($_SESSION['user'])) {
            CreateUserSession::validUserLogin();
        } else {
            $data = $_REQUEST;
            // add user id to the data
            $data['user_id'] = $_SESSION['user'];

            // validate the value
            $userId = $data['user_id'];
            $productId = $data['product_id'];

            $result = $this->like->like($data, $userId, $productId);

            if (!$result) {
                header("Location:/more?id={$productId}");
            }
            header("Location:/more?id={$productId}");
        }

    }

    public function addBookMark()
    {
        $data = $_REQUEST;

        if (!isset($_SESSION['user'])) {
            CreateUserSession::validUserLogin();
        } else {
            $data['user_id'] = $_SESSION['user'];
            $userId = $data['user_id'];
            $productId = $data['product_id'];

            $result = $this->bookmark->bookmark($data, $userId, $productId);

            if (!$result) {
                header("Location:/more?id={$productId}");
            }

            header("Location:/more?id={$productId}");
        }
    }

    public function addScore()
    {
        $data = $_REQUEST;

        if (!isset($_SESSION['user'])) {
            CreateUserSession::validUserLogin();
        } else {
            $data['user_id'] = $_SESSION['user'];
            $userId = $data['user_id'];
            $productId = $data['product_id'];

            $result = $this->score->score($data, $userId, $productId);

            if ($result) {
                header("Location:/more?id={$data['product_id']}");
            }

            header("Location:/more?id={$data['product_id']}");
        }

    }

    public function addComment()
    {
        $data = $_REQUEST;

        if (!isset($_SESSION['user'])) {
            CreateUserSession::validUserLogin();
        } else {

            $data['user_id'] = $_SESSION['user'];

            $result = $this->comment->create($data);

            if (!$result) {
                header("Location:/more?id={$data['product_id']}");
            }

            header("Location:/more?id={$data['product_id']}");
        }
    }

}
