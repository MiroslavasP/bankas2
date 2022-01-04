<?php

namespace Bankas\Bankas2\Controllers;

use Bankas\Bankas2\App;
use Bankas\Bankas2\Messages;



class LoginController
{

    static private function logIn()
    {
        $login = $_POST['login'];
        $pass = md5($_POST['password']);
        $sql = "SELECT 
        *
        FROM
        bank_staff
        WHERE `login` = '$login' AND `password` = '$pass'
        ";
        $stmt = App::$pdo->query($sql);
        $user = $stmt->fetch();

        if (false === $user) {
            return false;
        }

        $_SESSION['login'] = $user['login'];
        $_SESSION['logged'] = 1;

        return true;
    }

    static public function isLogged()
    {
        return isset($_SESSION['logged']) && $_SESSION['logged'] == 1;
    }


    public function showLoginPage()
    {
        App::view('loginPage');
    }

    public function register()
    {
        App::view('register');
    }

    public function doRegister()
    {
        $login = $_POST['newStaffLogin'];
        $pass = md5($_POST['newStaffPassword']);

        $sql = "SELECT `login`
        FROM
        bank_staff
        ";
        $stmt = App::$pdo->query($sql);
        $logins = $stmt->fetchAll();

        foreach ($logins as $log) {
            if ($login == $log['login']) {
                Messages::add('info', 'Toks loginas jau yra');
                App::redirect('register');
            }
        }
        $sql = "INSERT INTO
              bank_staff
               (`login`, `password`)
              VALUES ('$login', '$pass')
               ";
        App::$pdo->query($sql);
        Messages::add('success', 'Uzsiregistruota sekmingai');
        App::redirect('login');

        // App::redirect('register');

    }

    public function doLogin()
    {
        $ok = self::logIn();

        if (!$ok) {
            Messages::add('info', 'Neteisingi prisijungimo duomenys');
            App::redirect('loginPage');
        } else {
            Messages::add('success', 'Prisijungta sekmingai');
            App::redirect('accounts_list');
        }
    }

    public function doLogOut()
    {
        unset($_SESSION['login'], $_SESSION['logged']);
        App::redirect('login');
    }
}
