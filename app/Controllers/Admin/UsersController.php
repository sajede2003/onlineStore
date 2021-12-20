<?php namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\Validation;
use App\Models\User;

class UsersController extends Controller
{

    protected User $user;
    protected Validation $validation;

    public function __construct()
    {
        $this->setLayout('Auth');
        $this->user = new User();
        $this->validation = new Validation();
    }

    /**
     * render users function
     * and show users page in dashboard
     *
     */
    public function index()
    {
        $allData = $this->user->get();
        $message = session()->get('message');
        return $this->render('dashboard/users/table', compact('allData', 'message'));
    }

    /**
     * edit users table function
     *
     */
    public function update()
    {
        // get inputs value
        $data = $_REQUEST;
        $userId = $data['id'];

        $_POST = array_map('trim', $data);
        $validation = $this->validation->make($_POST, [
            'full_name' => 'required|min:8',
            'phone_number' => 'required|phone|length:11',
            'email' => 'required',
        ]);
        if ($validation->valid()) {
            if ($this->user->where('id', $userId)->update($data)) {
                session()->flash('message', 'user successfully update !!');
                redirect("/dashboard/users");
            } else {
                session()->flash('message', 'something wrong!!');
                redirect("/dashboard/users/edit?id={$userId}");
            }
           
        }
        $errors = $this->validation->errors;
        $userData = $this->user->where('id', $userId)->get();
        return $this->render('dashboard/users/edit', compact('errors', 'userData'));

    }

    /**
     * edit users view page function
     *
     */
    public function edit()
    {
        $userId = $_GET['id'];
        $userData = $this->user->where('id', $userId)->get();
        return $this->render('dashboard/users/edit', compact('userData'));
    }

    /**
     * delete users button function
     *
     */
    public function delete()
    {
        $userId = $_GET['id'];

        $result = $this->user->where('id', $userId)->delete();
        if (!$result) {
            redirect("/dashboard/users");
            session()->flash('message', 'some thing wrong !!');
            return;
        }
        session()->flash('message', 'product delete successfully !!');
        redirect("/dashboard/users");
    }
}
