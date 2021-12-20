<?php namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Product;
class CartController extends Controller
{
    protected Product $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function cart()
    {

        if (!auth()->check()) {
            return redirect('/login');
        } else {
            $cartData = (session()->get('cart'))?session()->get('cart'):[] ;
            $message = session()->get('message');
            return $this->render('product/cart', compact('cartData' , 'message'));
        }
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            return redirect('/login');

        } else {
            // set product id
            $productId = $_GET['product_id'];

            // get data in product by product id
            $product = $this->product->where('id' , $productId)->get();

            // add product to session
            self::addDataInCartSession($product);

            // success redirect
            redirect("/cart");

        }

    }
    // remove product from cart
    public function removeFromCart()
    {
        $productId = $_GET['product_id'];

        $product = $this->product->where('id' , $productId)->get();

        self::removeDataInSession($product);

        redirect('/cart');

    }

    /**
     * add product to cart function
     *
     * @param [type] $product
     * @return void
     */
    public static function addDataInCartSession($product)
    {
        foreach ($product as $key => $product) {
            // product id
            $product_id = $product['id'];
        }


        // set the cart session
        $cart = $_SESSION['cart'] ?? []; 

   
        // cart page action
        if (isset($cart[$product_id])) {
            $_SESSION['cart'][$product_id]['count'] += 1;
            $_SESSION['cart'][$product_id]['sum'] =   $_SESSION['cart'][$product_id]['count'] * $product['price'];
        } else {
            $_SESSION['cart'][$product_id] = [
                'product_id' => $product_id,
                'name' => $product['title'],
                'price' => $product['price'],
                'count' => 1,
                'sum' => $product['price'],
            ];
        }
    }

public static function removeDataInSession($products)
{
    foreach ($products as $key => $product) {
        $product_id = $product['id'];
    }

    $_SESSION['cart'][$product_id]['count'] -= 1;
    $_SESSION['cart'][$product_id]['sum'] = $_SESSION['cart'][$product_id]['count'] * $product['price'];

    if ($_SESSION['cart'][$product_id]['count'] <= 0) {
        unset($_SESSION['cart'][$product_id]);
    }

}

}
