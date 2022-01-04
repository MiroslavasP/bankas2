<?php

namespace Bankas\Bankas2\Controllers;


require __DIR__ . '/../vendor/autoload.php';

require_once("header2.php");
?>

<p></p>
<h3>Norite tapti Vilniaus Banko darbuotojais?<br> Tai padaryti labai paprasta.<br> Užsiregistruokite ir VUALIA,<br> Jūs jau banko darbuotojai:</h3>
<hr>
<P></P>
<P></P>

<form method="post" action="<?= URL . 'staffRegister' ?>">
    <p>Insert login: <input type="text" name="newStaffLogin" value=""> </p>
    <p>Insert password: <input type="password" name="newStaffPassword" value=""></p>

    <p><input type="submit" value="Tapti banko darbuotoju" name="register"></p>

</form>

<?php

require_once("footer.php");

?>