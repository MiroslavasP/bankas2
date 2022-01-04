<?php

namespace Bankas\Bankas2;

use Bankas\Bankas2\Controllers\BankController;
use Bankas\Bankas2\Controllers\LoginController;
use Bankas\Bankas2\Messages;
use Bankas\Bankas2\bankValidator;
use PDO;
use Rubu\Parduotuve\Controllers\LoginController as ControllersLoginController;

class App
{

    static $pdo;

    public static function start()
    {
        self::db();
        return self::route();
    }

    public static function route()
    {
        $userUri = $_SERVER['REQUEST_URI'];
        $userUri = str_replace(INSTALL_DIR, '', $userUri);
        $userUri = preg_replace('/\?.*$/', '', $userUri);
        $userUri = explode('/', $userUri);


        if (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'login' == $userUri[0] &&
            count($userUri) == 1
        ) {
            return (new LoginController)->showLoginPage();
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            'staffLogin' == $userUri[0] &&
            count($userUri) == 1
        ) {
            return (new LoginController)->doLogin();
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'register' == $userUri[0] &&
            count($userUri) == 1
        ) {
            if (LoginController::isLogged()) {
                Messages::add('success', 'Prisijungete sekmingai');
                self::redirect('accounts_list');
            }
            return (new LoginController)->register();
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            'staffRegister' == $userUri[0] &&
            count($userUri) == 1
        ) {
            if (LoginController::isLogged()) {
                self::redirect('accounts_list');
            }
            return (new LoginController)->doRegister();
        }

        if (!LoginController::isLogged()) {
            self::redirect('login');
        }

        if (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'accounts_list' == $userUri[0]  &&
            count($userUri) == 1
        ) {
            $accountsList = new BankController;
            $accountsInfo = $accountsList->showAll();
            self::view('accounts_list', [
                'accountsInfo' => $accountsInfo,
            ]);
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'create_account' == $userUri[0]  &&
            count($userUri) == 1
        ) {
            self::view('create_account');
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            'create_account' == $userUri[0]  &&
            count($userUri) == 1
        ) {

            $error = (new bankValidator)->Validation();

            if ($error > 0) {
                self::redirect('create_account');
            } else {
                $userData['name'] = $_POST['name'];
                $userData['lastname'] = $_POST['lastname'];
                $userData['account'] = $_POST['account'];
                $userData['code'] = $_POST['code'];

                (new BankController)->create($userData);
                self::redirect('accounts_list');
            }
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'show_info' == $userUri[0]  &&
            count($userUri) == 2
        ) {
            $personInfo = BankController::personInfo($userUri[1]);

            self::view(
                'show_info',
                $personInfo


                // [
                //     'code' => $personInfo['id'],
                //     'name' => $personInfo['name'],
                //     'lastname' => $personInfo['lastname'],
                //     'account_number' => $personInfo['account_number'],
                //     'likutis' => $personInfo['likutis'],

                // ]

            );
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'add_money' == $userUri[0]  &&
            count($userUri) == 1
        ) {
            self::view('add_money');
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'add_money' == $userUri[0]  &&
            count($userUri) == 2
        ) {
            $personInfo = BankController::personInfo($userUri[1]);

            self::view('add_money', [
                'code' => $personInfo['id'],
                'name' => $personInfo['name'],
                'lastname' => $personInfo['lastname'],
                'account_number' => $personInfo['account_number'],

            ]);
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'minus_money' == $userUri[0]  &&
            count($userUri) == 1
        ) {
            self::view('minus_money');
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'minus_money' == $userUri[0]  &&
            count($userUri) == 2
        ) {
            $personInfo = BankController::personInfo($userUri[1]);

            self::view('minus_money', [
                'code' => $personInfo['id'],
                'name' => $personInfo['name'],
                'lastname' => $personInfo['lastname'],
                'account_number' => $personInfo['account_number'],

            ]);
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            'add_money' == $userUri[0]  &&
            count($userUri) == 1
        ) {
            (new BankController)->addMoney();
            self::redirect('accounts_list');
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            'minus_money' == $userUri[0]  &&
            count($userUri) == 1
        ) {
            (new BankController)->minusMoney();
            self::redirect('accounts_list');
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            'delete' == $userUri[0]  &&
            count($userUri) == 2
        ) {
            (new BankController)->delete($userUri[1]);
            self::redirect('accounts_list');
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'GET' &&
            'log_out' == $userUri[0] &&
            count($userUri) == 1
        ) {
            return (new LoginController)->doLogOut();
        } elseif (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            'log_out' == $userUri[0] &&
            count($userUri) == 1
        ) {
            return (new LoginController)->doLogOut();
        } else {
            echo '<h1>404 Page Not Found</h1>';
        }
    }

    public static function redirect($where)
    {
        header('Location: ' . URL . $where);
        die;
    }

    public static function db()
    {
        $host = getSetting('host');

        $db   = getSetting('db');

        $user = getSetting('user');

        $pass = getSetting('pass');

        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        self::$pdo = new PDO($dsn, $user, $pass, $options);
    }


    public static function view($temp, $data = [])
    {
        extract($data);
        $appUser = $_SESSION['login'] ?? '';
        $messages = Messages::get();
        require DIR . 'views/' . $temp . '.php';
    }
}
