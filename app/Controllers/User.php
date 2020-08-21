<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\User_model;
use CodeIgniter\I18n\Time;

class User extends Controller
{
    use ResponseTrait;
    function __construct()
    {
        $this->user_model = new User_model();
        $this->time_now_utc = Time::now('UTC')->toDateTimeString();
    }

    public function index()
    {
        $model = $this->request->getPost();
        return $this->respond($this->user_model->findData($model));
    }

    public function create()
    {
        $password_hash = password_hash($this->request->getPost('password'),PASSWORD_BCRYPT);
        $data = array(
            'username'=>$this->request->getPost('username'),
            'password'=>$password_hash,
            'first_name'=>$this->request->getPost('first_name'),
            'last_name'=>$this->request->getPost('last_name'),
            'email'=>$this->request->getPost('email'),
            'mobile'=>$this->request->getPost('mobile'),
            'created_at'=>$this->time_now_utc,
            'updated_at'=>$this->time_now_utc
        );
        $user_id = $this->user_model->create($data);
        return $this->show($user_id);

    }

    public function show(&$id)
    {
        return $this->respond($this->user_model->read($id));
    }

    public function update($id)
    {
        return $this->respond($this->request->getRawInput());
    }

    public function delete($id)
    {
        if($this->user_model->remove($id)===true){
            return $this->respondDeleted([
                'status' => 200,
                'msg' => 'The user delete'
            ]);
        }
    }
}