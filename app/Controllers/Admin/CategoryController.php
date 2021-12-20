<?php namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\Validation;
use App\Models\Category;

class CategoryController extends Controller
{

    protected Category $category;
    protected Validation $validation;

    public function __construct()
    {
        $this->setLayout('Auth');
        $this->category = new Category();
        $this->validation = new Validation();
    }

    /**
     * render category function
     * and show category page in dashboard
     *
     */
    public function index()
    {
        $allData = $this->category->get();
        $message = session()->get('message');
        return $this->render('dashboard/category/table', compact('allData', 'message'));
    }

    // add category page render
    public function add()
    {
        return $this->render('dashboard/category/add');
    }

    // add category function
    public function store()
    {
        $data = $_REQUEST;
        $_POST = array_map('trim', $data);
        $validation = $this->validation->make($_POST, [
            'title' => 'required',
        ]);
        if ($validation->valid()) {
            if ($this->category->create($data)) {
                session()->flash('message', 'Add category is success Fully!!');
                redirect("/dashboard/category");
                return;
            }
        }
        $error = $this->validation->errors;

        return $this->render('dashboard/category/add', compact('error'));
    }

    // category edit page
    public function update()
    {
        // get inputs value
        $data = $_REQUEST;
        $userId = $data['id'];
        $_POST = array_map('trim', $data);
        $validation = $this->validation->make($_POST, [
            'title' => 'required',
        ]);

        if ($validation->valid()) {
            if ($this->category->where('id', $userId)->update($data)) {
                session()->flash('message', 'Edit category is successfully !!');
                redirect("/dashboard/category");
            } else {
                redirect("/dashboard/category/edit?id={$userId}");
                session()->flash('wrong', 'something is wrong!!');
            }
        }
        $userData = $this->category->where('id', $userId)->get();
        $errors = $this->validation->errors;

        return $this->render('dashboard/category/edit' , compact('errors' , 'userData'));

    }

    /**
     * category edit view function
     *
     * @return void
     */
    public function edit()
    {
        $userId = $_GET['id'];
        $userData = $this->category->where('id', $userId)->get();

        return $this->render('dashboard/category/edit', compact('userData'));
    }

    /**
     * delete category button function
     *
     */
    public function delete()
    {
        $userId = $_GET['id'];

        $result = $this->category->where('id', $userId)->delete();

        if (!$result) {
            redirect("/dashboard/category");
            session()->flash('message', 'something wrong!!');
            return;
        }
        session()->flash('message', 'category delete is successFully!!');
        redirect("/dashboard/category");
    }

}
