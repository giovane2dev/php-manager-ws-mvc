<?php

namespace App\Controllers;

use \App\Models\LoginModel;

class LoginController
{
    // create login
    // create login page
    public function createLogin() {
        \App\View::make('Login/Login');
    }
    
    // create login
    // create login page -> process
    public function readCreateLogin() {
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
                
        $user = LoginModel::read(null, $email, md5($password), true);

        if (count($user) > 0) {
            session_start();
            
            $_SESSION['LOGIN'] = true;
            $_SESSION['USER_NAME'] = $user[0]['name'];
            $_SESSION['LAST_LOGIN'] = $user[0]['lastlogin'];
            
            echo "<script>window.location = 'news/all';</script>";
        } else {
            \App\message('E-mail ou senha inválido(a)!', true);
            exit;
        }
    }
    
    public function exitLogin() {
        session_start();
        
        session_destroy();
        
        header('Location: /');
        exit;
    }
}