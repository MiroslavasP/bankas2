<?php
require __DIR__ . '/../vendor/autoload.php';

require_once("header.php");

?>
<h1 class="sarasas">Kliento informacija</h1>

<table>
    <thead>
        <tr>
            <td>Asmens kodas</td>
            <td>Vardas</td>
            <td>Pavarde</td>
            <td>Saskaitos Nr.</td>
            <td>Lesu likutis</td>
            <td>Redaguoti</td>

        </tr>
    </thead>


    <?php

    echo "<tr>";
    foreach ($data as $value) {
        echo "<td>$value</td>";
    }
    echo "<td> 
        <form method ='post' action='" . URL . "delete_account" . "'>

       
        <a href='add_money/" . $data['id'] . "'>Prideti lesu</a> /
        <a href='minus_money/" . $data['id'] . "'>Nurasyti lesas</a> /
        
       

         <input type='submit' value='Istrinti saskaita' name='delete_accounts/" . $data['id'] . "'>
         </form>

          </td></tr> ";

    ?>
</table>
<?php

require_once("footer.php");

?>