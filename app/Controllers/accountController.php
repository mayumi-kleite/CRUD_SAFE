<?php
namespace app\Controllers;

use Core\Controller;
use Core\Request;
use app\Models\User; 

class AccountController extends Controller{

    public function index(){
        $this->view('account');

    }

}