<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URL ?>css/app.css">
    <script src="https://kit.fontawesome.com/7f108364f4.js" crossorigin="anonymous"></script>

    <title>Vilniaus_Bankas</title>

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





    <div class="container-fluid">
        <div class="row p-3 fonas hat">
            <div class="col-1 offset-sm-0 offset-md-1 offset-lg-1 text-end p-1">
                <i class="fas fa-phone"></i>
            </div>
            <div class="col-11 col-sm-3 col-md-2 col-lg-2 p-1">+370(000)00000</div>
            <div class="col-1 text-end p-1">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="col-11 col-sm-5 col-md-3 col-lg-3 p-1"> miroslavas@vilniausbankas.lt</div>
            <div class="col-12 col-sm-4 col-md-3 col-lg-2 text-start texst-sm-center text-md-center text-lg-center p-1">
                facebook
            </div>

        </div>
        <nav class="navbar navbar-expand-lg navbar-light  mb-5">
            <div class="container">
                <a class="navbar-brand text-secondary fw-bold" href="#">Vilniaus Bankas</a>
                <div class="collapse navbar-collapse offset-lg-1" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= URL . 'create_account' ?>">Sukurti saskaita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= URL . 'accounts_list' ?>">Saskaitu sarasas</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="<?= URL . 'add_money' ?>">Prideti lesas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= URL . 'minus_money' ?>">Lesu nurasymas</a>
                        </li>
                        <li class="nav-item">
                            <a id="logOut" class="nav-link active exit" href="<?= URL . 'log_out' ?>"><span class="exit">Atsijungti x</span></a>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>


    </div>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script> -->