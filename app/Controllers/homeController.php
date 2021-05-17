<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request; 
use Core\Session;
use App\Models\User;

class HomeController extends Controller{

    private $session;

    public function __construct() {
        $this->session = Session::getInstance();
    }
    
    public function index(Request $request) {
        if($request->isMethod('get')){
            $user = $this->session->get('user');

            if(!isset($user)){
                $userModel = new User;
                $this->redirect('login');
            } else {
                $this->view('home');
            }
        }
    }

}