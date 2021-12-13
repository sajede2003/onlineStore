<?php namespace App\Controllers;

use App\Core\Controller;
use App\Helper\CreateUserSession;
use App\Helper\Data;

class MorePageController extends Controller
{

    public function more()
    {
        // get product id url
        $id = $_GET['id'];

        //get user id
        $userId = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        // get product for show in more page
        $product = Data::getOldData('products', $id, $userId);

        // reply or return function
        $comments = Data::groupCommentByParent($id);

        //  get all like for this product
        $likeCount = Data::getByProduct('likes', $id);

        // avg score
        $score = Data::avgScore('scores', $id);

        // is user book mark this product
        $isBookmark = Data::getUserAndProduct('bookmarks', $id , $userId);

        // params for send to view

        $params = [
            'product' => $product,
            'comment' => $comments,
            'likeCount' => $likeCount,
            'isBookmark' => $isBookmark,
            'score' => $score,
        ];

        return $this->render('more', $params);
    }

    public function addLike()
    {
        $data = $_REQUEST;

        // check login for login

        if (empty($_SESSION)) {
            CreateUserSession::validUserLogin();
        } else {
            // add user id to the data
            $data['user_id'] = $_SESSION['user'];

            // validate the value
            $userId = $data['user_id'];
            $productId = $data['product_id'];

            // is user like
            $isLike = Data::isUserLike('likes', $userId, $productId);

            // check for is user like the product
            if ($isLike == 0) {
                // like product
                $result = Data::addItem('likes', $data);
            } else {
                $result = Data::deleteByUser('likes', $userId, $productId);
            }

            if (!$result) {
                header("Location:/more?id={$productId}");
            }
            header("Location:/more?id={$productId}");

        }

    }

    public function addScore()
    {
        $data = $_REQUEST;

        if(empty($_SESSION)){
            CreateUserSession::validUserLogin();
        }else{
            $data['user_id'] = $_SESSION['user'];

            $result = Data::isUserScore('scores', $data);

    
            if ($result) {
                header("Location:/more?id={$data['product_id']}");
            }
    
            header("Location:/more?id={$data['product_id']}");
        }

    }

    public function addComment()
    {
        $data = $_REQUEST;

        if(empty($_SESSION)){
            CreateUserSession::validUserLogin();
        }else{

            $data['user_id'] = $_SESSION['user'];

            $result = Data::addItem('comments' , $data );

            if(!$result){
                header("Location:/more?id={$data['product_id']}");
            }

            header("Location:/more?id={$data['product_id']}");
        }
    }

    public function  addBookMark ()
    {
        $data = $_REQUEST;

        if(empty($_SESSION)){
            CreateUserSession::validUserLogin();
        }else{
            $data['user_id'] = $_SESSION['user'];
            $productId = $data['product_id'];


            $result = Data::isUserChecked('bookmarks' , $data);

            // dd($result);


            if(!$result){
                header("Location:/more?id={$productId}");
                // return;
            }

            header("Location:/more?id={$productId}");
        }
    }
    

}
