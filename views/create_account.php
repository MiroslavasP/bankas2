<?php

namespace Bankas\Bankas2\Controllers;

use Bankas\Bankas2\Controllers\bankController;
use App\Bank\bankValidator;

require __DIR__ . '/../vendor/autoload.php';



require_once("header.php");

?>

<form method="post" action="<?= URL . 'create_account' ?>">
    <p>Vardas: <input type="text" name="name" value="<?php echo $_POST["name"] ?? "" ?>"> </p>
    <p>Pavarde: <input type="text" name="lastname" value="<?php echo $_POST["lastname"] ?? "" ?>"></p>
    <p>Saskaitos Nr.: <input type="text" name="account" value="<?php echo 'LT' . rand(100000000000000000, 999999999999999999) ?? "" ?>" readonly></p>
    <p>Asmens kodas: <input type="number" name="code" value="<?php echo $_POST["code"] ?? "" ?>"></p>
    <p><input type="submit" name="create_account" value="Sukurti saskaita"></p>

</form>

<?php

// bankController::create();



require_once("footer.php");

?>