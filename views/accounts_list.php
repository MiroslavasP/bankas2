<?php
require __DIR__ . '/../vendor/autoload.php';

require_once("header.php");

?>
<h1 class="sarasas">Saskaitu sarasas</h1>

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

    foreach ($accountsInfo as $client) : ?>

        <tr>

            <?php foreach ($client as $v) : ?>
                <td><?= $v ?></td>
            <?php endforeach ?>
            <td>
                <form method='post' action="<?= URL . 'delete/' . $client['id'] ?> ">

                    <a href="show_info/<?= $client['id'] ?>">Informacija</a> /
                    <a href="add_money/<?= $client['id'] ?>">Prideti lesu</a> /
                    <a href="minus_money/<?= $client['id'] ?>">Nurasyti lesas</a> /

                    <input type='submit' value='Istrinti' name="<?= $client['id'] ?>">
                </form>

            </td>
        </tr>

    <?php endforeach ?>
</table>
<?php

require_once("footer.php");

?>