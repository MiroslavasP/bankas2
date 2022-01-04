<?php

require __DIR__ . '/../vendor/autoload.php';

require_once("header.php");

?>

<form method="post" action="<?= URL . 'minus_money' ?>">

    <p>Asmens kodas: <input type="number" name="code" value="<?= $code ?? "" ?>"></p>
    <p>Vardas: <input type="text" name="name" value="<?= $name ?? "" ?>"> </p>
    <p>Pavarde: <input type="text" name="lastname" value="<?= $lastname ?? "" ?>"></p>
    <p>Saskaitos Nr.: <input type="text" name="account" value="<?= $account_number ?? "" ?>"></p>
    <p>Nurasyti nuo saskaitos: <input type="number" name="summinus" value=""></p>

    <p><input type="submit" name="minus" value="Nurasyti nuo saskaitos"></p>

</form>

<?php

require_once("footer.php");

?>