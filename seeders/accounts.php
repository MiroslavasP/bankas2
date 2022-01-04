<?php

require __DIR__ . '/../bootstrap.php';

$host = getSetting('host');
$db   = getSetting('db');
$user = getSetting('user');
$pass = getSetting('pass');
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES, false,
];

$pdo = new PDO($dsn, $user, $pass, $options);



$sql = "DROP TABLE IF EXISTS
accounts, bank_staff;
";
$pdo->query($sql);


$sql = "CREATE TABLE 
bank_staff (
    id       smallint PRIMARY KEY AUTO_INCREMENT,
    `login`	 varchar(70),
    `password`	 char(32)
);
";
$pdo->query($sql);



$sql = "CREATE TABLE 
accounts (
    id      bigint PRIMARY KEY,
    `name`	 varchar(20),
    lastname varchar(20),
    account_number   varchar(22),
    likutis decimal(8,2)
);
";
$pdo->query($sql);

$bankStaffs = [
    ['Miroslavas', '123'],
    ['Knysliukas', '1234'],
    ['Vasiliauskas', '12345']
];

foreach ($bankStaffs as $staff) {
    $u = $staff[0];
    $p = md5($staff[1]);
    $sql = "INSERT INTO
    bank_staff
    (`login`, `password`)
    VALUES ( '$u', '$p' )
    ";
    $pdo->query($sql);
}

$sql = "INSERT INTO
accounts
(id, `name`, lastname, account_number, likutis)
VALUES ( 30000000001, 'Einius', 'Pretkelis', 'LT111111111111111111', 0)
";
$pdo->query($sql);
