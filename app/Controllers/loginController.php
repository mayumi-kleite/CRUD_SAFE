<?php
namespace app\Controllers;

use Core\Controller;
use Core\Request;
use Core\Session;
use App\Models\User; 

class LoginController extends Controller{

    private $session;

    public function __construct(){
        $this->session = Session::getInstance();
    }

    public function index(Request $request){ // acessar login
        if($request->isMethod('get')){
            $user = $this->session->get('user');

            if(isset($user)){
                $userModel = new User;

                $this->redirect('home');
            } else {
                $this->view('login');
            }
        } else{
            $userModel = new User;
            $user = $userModel->login($request->post('Email'), $request->post('Password')); 
    
            if(isset($user)){
                $this->session->set('user', $user);
                $this->redirect('home');
            } 

            $this->view('login', ['email' => $request->post('Email'), 'msg' => 'E-mail ou senha inválido.']); 
        }
    }

    public function account(Request $request){ // amarzenar usuários
        if($request->isMethod('get')){
            $user = $this->session->get('user');
            
            if(isset($user)){
                $userModel = new User;
                $this->redirect('/home');
            } else {
                $this->view('account');
            }

        } else{
            $userModel = new User;
            $user = $userModel->accept($request->post());
    
            if($user){
                $this->session->set('user', $user);
                $this->redirect('/home');
            } else {
                $this->view('account', ['user' => $request->post()]);
            }
        }
    }

    public function logout(){
        $this->session->destroy();
        $this->redirect('/login');
    }

}