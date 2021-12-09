<?php namespace App\Controllers;

use App\Core\Controller;
use App\Helper\CreateUserSession;
use App\Helper\Data;

class CartController extends Controller{


    public function cart()
    {
        $cartData = $_SESSION['cart'];

        $params = [
            'cartData' => $cartData
        ];

        return $this->render('cart' , $params);
    }

    public function addToCart()
    {
        // set product id
        $productId = $_GET['product_id'];
        
        // get ols=d data of product by product id 
        $product = Data::getOldData('product' , $productId);

        // add product to session 
        self::addDataInCartSession($product);

        // success redirect
        header('Location:/cart');

    }

    public function removeFromCart()
    {
        $productId = $_GET['product_id'];

        $product = Data::getOldData('product' , $productId);

        self::removeDataInSession($product);

        header('Location:/cart');
    }

    
    /**
     * add product to cart function
     *
     * @param [type] $product
     * @return void
     */
    public static function addDataInCartSession($product)
    {
        $result = false;
        foreach ($product as $key => $value) {
           // product id
            $productId = $value->id;
        }
        
        
        // set the cart session
        $cart = CreateUserSession::cartSession();
        // cart page action
        if(isset($cart[$productId])){
            $_SESSION['cart'][$productId]['count'] +=1;
            $_SESSION['cart'][$productId]['sum'] = $_SESSION['cart'][$productId]['count'] * $product[0]->price;
        }else{
            $_SESSION['cart'][$productId] = [
                'product_id' => $productId,
                'name' => $product[0]->title,
                'price' => $product[0]->price,
                'count' => 1,
                'sum' => $product[0]->price
            ];
        }
    }


    public static function removeDataInSession($product)
    {
        foreach ($product as $key => $value) {
            $productId = $value->id;
        }

        $_SESSION['cart'][$productId]['count'] -=1;
        $_SESSION['cart'][$productId]['sum'] = $_SESSION['cart'][$productId]['count'] * $product[0]->price;

        if($_SESSION['cart'][$productId]['count']<=0)
            unset($_SESSION['cart'][$productId]);
    }







}