<?php

namespace Bankas\Bankas2\Controllers;

use Bankas\Bankas2\App;
use Bankas\Bankas2\Messages;
use Bankas\Bankas2\Bank2Interface;


class bankController implements Bank2Interface

{


    function create(array $userData): void
    {


        $code = $userData['code'];
        $name = $userData['name'];
        $lastName = $userData['lastname'];
        $accountNum = $userData['account'];
        $likutis = 0;

        $sql = "INSERT INTO
                    accounts
                    (id, `name`, lastname, account_number, likutis)
                    VALUES ( $code, '$name', '$lastName', '$accountNum', $likutis )
                    ORDER BY `name`
                    ";
        App::$pdo->query($sql);
    }



    function showAll(): array
    {
        $sql = "SELECT *
              FROM accounts
        ";
        $stmt = App::$pdo->query($sql);
        $accountsInfo = $stmt->fetchAll();
        return $accountsInfo;
    }

    function show(int $userId): array
    {
        $sql = "SELECT *
              FROM accounts
              WHERE 
              id = $userId
        ";
        $stmt = App::$pdo->query($sql);
        $clientInfo = $stmt->fetch();
        return $clientInfo;
    }


    public static function allCodes(): array
    {
        $sql = "SELECT id
              FROM accounts
        ";
        $stmt = App::$pdo->query($sql);
        $personCodes = $stmt->fetchAll();

        return $personCodes ?? [];
    }

    public static function personInfo(int $code): array
    {
        $sql = "SELECT *
        FROM accounts
        WHERE 
        id = $code
  ";
        $stmt = App::$pdo->query($sql);
        $personInfo = $stmt->fetch();

        return $personInfo ?? [];
    }



    public static function addMoney(): void
    {
        $personData = self::personInfo($_POST['code']) ?? [];
        if (!empty($personData)) {
            $personData['likutis'] += $_POST['sumplus'];

            (new bankController)->update($personData['id'], $personData);

            Messages::add('success', 'Pinigai iskaityti sekmingai');
        } else {

            Messages::add('info', 'Tokio kliento nerasta');
        }
    }

    public static function minusMoney(): void
    {
        $personData = self::personInfo($_POST['code']) ?? [];
        if (!empty($personData) && $personData['likutis'] >= $_POST['summinus']) {
            $personData['likutis'] -= $_POST['summinus'];

            (new bankController)->update($personData['id'], $personData);
            Messages::add('success', 'Pinigai nurasyti sekmingai');
        } elseif (!empty($personData) && $personData['likutis'] < $_POST['summinus']) {

            Messages::add('info', 'Nepakanka lesu');
        } else {
            Messages::add('info', 'Tokio kliento nerasta');
        }
    }

    function update(int $userId, array $userData): void
    {
        $likutis = $userData['likutis'];
        $sql = " UPDATE
         accounts
         SET 
         likutis = $likutis
        WHERE id = $userId
";
        App::$pdo->query($sql);
    }

    function delete(int $userId): void
    {
        $personData = self::personInfo($userId) ?? [];


        if ($personData['likutis'] == 0) {

            $sql = " DELETE 
             FROM
             accounts
              WHERE id = $userId
    ";
            App::$pdo->query($sql);
        } else {
            Messages::add('info', 'Trinti negalima, saskaitoje yra lesu');
        }
    }
}
