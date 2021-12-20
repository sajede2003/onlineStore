<?php namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\Validation;
use App\Helper\ImgUploader;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{

    protected Product $product;
    protected ImgUploader $img;
    protected Category $category;
    protected Validation $validation;

    public function __construct()
    {
        $this->setLayout('Auth');
        $this->product = new Product;
        $this->img = new ImgUploader;
        $this->category = new Category;
        $this->validation = new Validation();

    }

    /**
     *
     * render product function
     * and show product page in dashboard
     *
     */
    public function index()
    {
        $allData = $this->product->get();
        $message = session()->get('message');

        return $this->render('dashboard/product/table', compact('allData', 'message'));
    }
    // add product view render
    public function add()
    {
        $category = $this->category->get();
        return $this->render('dashboard/product/add', compact('category'));
    }
    // add product function
    public function store()
    {
        $data = $_REQUEST;
        $pic = $_FILES['pic'];
        $imgPath = $this->img->imgUploader($pic);
        $data['pic'] = $imgPath;

        $_POST = array_map('trim', $data);
        $validation = $this->validation->make($_POST, [
            'title' => 'required|min:4',
            'description' => 'required|min:15',
            'price' => 'required',
            'count' => 'required',
            'pic' => 'required',
        ]);

        if ($validation->valid()) {
            if ($this->product->create($data)) {
                session()->flash('message', 'product added successFully!!');
                redirect("/dashboard/product");
                return;
            }
            session()->flash('message', 'something wrong!!');
        }
        $category = $this->category->get();
        $errors = $this->validation->errors;
// dd($errors);

        return $this->render('dashboard/product/add', compact('errors', 'category'));
    }
    // edit product function
    public function update()
    {
        // get inputs value
        $data = $_REQUEST;
        $userId = $data['id'];
        $pic = $_FILES['pic'];
        $imgPath = $this->img->imgUploader($pic);
        $data['pic'] = $imgPath;

        $_POST = array_map('trim', $data);
        $validation = $this->validation->make($_POST, [
            'title' => 'required|min:4',
            'description' => 'required|min:15',
            'price' => 'required',
            'count' => 'required',
            'pic' => 'required',
        ]);

        if ($validation->valid()) {
            if ($this->product->where('id', $userId)->update($data)) {
                session()->flash('message', 'product successfully update !!');
                redirect("/dashboard/product");
            } else {
                session()->flash('message', 'something wrong!!');
                redirect("/dashboard/product/edit?id={$userId}");
            }
        }
        $userData = $this->product->where('id', $userId)->get();
        $category = $this->category->get();
        $errors = $this->validation->errors;

        return $this->render('dashboard/product/edit' , compact('userData' , 'category' , 'errors'));

    }

    /**
     *  edit product view function
     *
     * @return void
     */
    public function edit()
    {
        $userId = $_GET['id'];
        $userData = $this->product->where('id', $userId)->get();
        $category = $this->category->get();

        return $this->render('dashboard/product/edit', compact('userData', 'category'));
    }

    /**
     * delete product function
     *
     * @return void
     */
    public function delete()
    {
        $userId = $_GET['id'];
        $result = $this->product->where('id', $userId)->delete();

        if (!$result) {
            redirect("/dashboard/product");
            session()->flash('message', 'something wrong !!');
            return;
        }
        session()->flash('message', 'product delete successfully !!');
        redirect("/dashboard/product");
    }

}
