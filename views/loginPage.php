<?php

namespace Bankas\Bankas2\Controllers;


require __DIR__ . '/../vendor/autoload.php';

require_once("header2.php");

?>


<p></p>
<h3>Darbuotoju prisijungimo puslapis</h3>
<P></P>

<form method="post" action="<?= URL . 'staffLogin' ?>">
    <p>Login: <input type="text" name="login" value=""> </p>
    <p>Password: <input type="password" name="password" value=""></p>

    <p><input type="submit" value="Prisijungti" name="identify"></p>

</form>

<?php

require_once("footer.php");

?>