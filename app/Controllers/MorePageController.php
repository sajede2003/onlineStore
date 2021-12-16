<?php namespace App\Controllers;

use App\Core\Controller;
use App\Helper\CreateUserSession;
use App\Helper\Data;
use App\Models\BookMarks;
use App\Models\Likes;
use App\Models\Products;
use App\Models\Scores;

class MorePageController extends Controller
{
    protected Products $products;
    protected BookMarks $bookmarks;
    protected Likes $likes;
    protected Scores $scores;

    public function __construct()
    {
        $this->products = new Products;
        $this->bookmarks = new BookMarks;
        $this->likes = new Likes;
        $this->scores = new Scores;
    }

    public function more()
    {
        // get product id url
        $id = $_GET['id'];

        //get user id
        $userId = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        // get product for show in more page
        $product = $this->products->where('id', $id)->first();

        // reply or return function
        $comment = Data::groupCommentByParent($id);

        //  get all like for this product
        $likeCount = $this->likes->getUserLiked($userId, $id);

        // avg score
        $score = Data::avgScore('scores', $id);

        // is user book mark this product
        $isBookmark = $this->bookmarks->getUserBookmark($id , $userId);

        // params for send to view

        $params = [
            'product' => $product,
            'comment' => $comment,
            'likeCount' => $likeCount,
            'isBookmark' => $isBookmark,
            'score' => $score,
        ];

        return $this->render('product/single/singlePage', compact('product', 'comment', 'likeCount', 'isBookmark', 'score'));
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

            $result = $this->likes->like($data, $userId, $productId);

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

            $result = $this->bookmarks->bookmark($data , $userId , $productId);

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
            $userId = $data['user_id'] ;
            $productId = $data['product_id'] ;

            $result = $this->scores->score($data, $userId , $productId);

            if ($result) {
                header("Location:/more?id={$data['product_id']}");
            }

            header("Location:/more?id={$data['product_id']}");
        }

    }

    // public function addComment()
    // {
    //     $data = $_REQUEST;

    //     if (empty($_SESSION)) {
    //         CreateUserSession::validUserLogin();
    //     } else {

    //         $data['user_id'] = $_SESSION['user'];

    //         $result = Data::addItem('comments', $data);

    //         if (!$result) {
    //             header("Location:/more?id={$data['product_id']}");
    //         }

    //         header("Location:/more?id={$data['product_id']}");
    //     }
    // }



}
