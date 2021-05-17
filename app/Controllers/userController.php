<?php
namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Session;
use app\Models\User; 

class UserController extends Controller{

    public function __construct(){
        $this->session = Session::getInstance();
    }

    public function index(Request $request) {
        if($request->isMethod('get')){
            $user = $this->session->get('user');

            if(!isset($user)){
                $this->redirect('user');
            } else{
                $UserModel = new User;
                $Users = $UserModel-> getAll();

                $content = ['Users' => $Users];
                $this->view('user', $content);
            }
            
        }
    }

    public function modify(Request $request){
        if($request->isMethod('get')){
            $id = $request->get(); 

            $userModel = new User();
            $User = $userModel->findBy($id);

            $this->view('account', ['User' => $User]);
        } else{
            $id = $request->get(); 
            $data = $request->post(); 
            $userModel = new User(); 
            $User = $userModel->update($data, ['id_User' => $id]);

            $this->redirect('/user');
        }
    }

    public function except(Request $request){ 
        $UserId = $request->get();

        if($UserId != null){
            $UserModel = new User(); 
            $Users = $UserModel->delete($UserId);
        } 

        $this->redirect('/user');
    }
}