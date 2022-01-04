<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URL ?>css/app.css">
    <title>Vilniaus_Bankas_prisijungimas</title>

</head>

<body>

    <?php if (!empty($messages)) : ?>
        <div class="container">
            <div class="row justify-content-md-center mt-5">
                <div class="col-7">
                    <?php foreach ($messages as $message) : ?>
                        <div class="alert alert-<?= $message['type'] ?>" role="alert">
                            <?= $message['msg'] ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php if ($appUser) : ?>
        <form action="<?= URL . 'log_out' ?>" method="post" class="m-3">
            <button class="btn btn-primary">Atsijungti <?= $appUser ?></button>
        </form>
    <?php endif ?>