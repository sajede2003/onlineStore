<?php namespace App\Controllers;

use App\Core\Controller;
use App\Helper\CreateUserSession;
use App\Helper\Data;

class CartController extends Controller
{

    public function cart()
    {
        if (empty($_SESSION)) {
            CreateUserSession::validUserLogin();
        } else {
            $cartData = $_SESSION['cart'];

            $params = [
                'cartData' => $cartData,
            ];

            return $this->render('cart', $params);
        }
    }

    public function addToCart()
    {
        if (empty($_SESSION)) {
            CreateUserSession::validUserLogin();
        } else {
            // set product id
            $productId = $_GET['product_id'];

            // get ols=d data of product by product id
            $product = Data::getOldData('products', $productId);

            // add product to session
            self::addDataInCartSession($product);

            // success redirect
            header('Location:/cart');
        }

    }

    public function removeFromCart()
    {
        $productId = $_GET['product_id'];

        $product = Data::getOldData('products', $productId);

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
            $product_id = $value->id;
        }

        // set the cart session
        $cart = CreateUserSession::cartSession();
        // cart page action
        if (isset($cart[$product_id])) {
            $_SESSION['cart'][$product_id]['count'] += 1;
            $_SESSION['cart'][$product_id]['sum'] = $_SESSION['cart'][$product_id]['count'] * $product[0]->price;
        } else {
            $_SESSION['cart'][$product_id] = [
                'product_id' => $product_id,
                'name' => $product[0]->title,
                'price' => $product[0]->price,
                'count' => 1,
                'sum' => $product[0]->price,
            ];
        }
    }

    public static function removeDataInSession($product)
    {
        foreach ($product as $key => $value) {
            $product_id = $value->id;
        }

        $_SESSION['cart'][$product_id]['count'] -= 1;
        $_SESSION['cart'][$product_id]['sum'] = $_SESSION['cart'][$product_id]['count'] * $product[0]->price;

        if ($_SESSION['cart'][$product_id]['count'] <= 0) {
            unset($_SESSION['cart'][$product_id]);
        }

    }

}
