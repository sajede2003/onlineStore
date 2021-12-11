<?php namespace App\Controllers;

use App\Core\Controller;
use App\Helper\Data;

class MorePageController extends Controller
{

    public function more()
    {
        // get product id url
        $id = $_GET['id'];

        //get user id
        $userId = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        // dd($userId);
        // get product for show in more page
        $product = Data::getOldData('products', $id, $userId);

        // dd($product);

        // reply or return function
        // $comments = Data::groupCommentByParent($id);
        // dd($comments);

        //  get all like for this product
        // dd($id);
        $likeCount = Data::getByProduct('likes', $id);

        // avg score
        // $score = Data::avgScore('scores' , $id);

        // is user book mark this product
        // $isBookmark = Data::getUserAndProduct('bookmarks' , $userId , $id);

        // params for send to view
        $params = [
            'product' => $product,
            // 'comment' => $comments,
            'likeCount' => $likeCount,
            // 'isBookmark' => $isBookmark,
            // 'score' => $score
        ];

        return $this->render('more', $params);
    }

    public function addLike()
    {
        $data = $_REQUEST;

        // check login for login
        if (!isset($_SESSION['user'])) {
            header("Location:/login");
        }

        // add user id to the data
        $data['user_id'] = $_SESSION['user'];


        // validate the value
        $userId = $data['user_id'];
        $productId = $data['product_id'];
        // dd($data);

        // is user like
        $isLike = Data::isUserLike('likes' , $userId , $productId);


        // check for is user like the product
        if($isLike == 0){
            // like product
                $result = Data::addItem('likes' , $data);
        }else
            $result = Data::deleteByUser('likes' , $userId , $productId);
            // dd($result);
        

        if(!$result){
            header("Location:/more?id={$productId}");
        }
        header("Location:/more?id={$productId}");

    }

}
