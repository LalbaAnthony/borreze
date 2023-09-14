<?php

require_once "init.php";
echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>";

$dao = new PageDAO();
$page = $dao->findOnePageBySlug("salle-des-fetes");

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Site de la commune de Borrèze" />
    <meta name="author" content="Borrèze" />
    <title><?= $page->get_nomPage() ?> - Borrèze</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>

    <?php include "components/navbar.php"; ?>

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/about-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1> <?= $page->get_titrePage() ?></h1>
                        <span class="subheading"><?= $page->get_sousTitrePage() ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="mb-4">
                        <?= $page->get_contenuPage() ?>
                    </div>

                    <div class="mb-4">
                        <p>Tarifs des réservations: </p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2">&nbsp;</th>
                                    <th scope="col" rowspan="2">Caution salle</th>
                                    <th scope="col" rowspan="2">Caution ménage</th>
                                    <th scope="col" colspan="2">Tarifs Location</th>
                                </tr>
                                <tr>
                                    <th scope="col">Été ☀</th>
                                    <th scope="col">Hiver ❄</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Borrèziens</th>
                                    <td>500.00€</td>
                                    <td>160.00€</td>
                                    <td>150.00€</td>
                                    <td>200.00€</td>
                                </tr>
                                <tr>
                                    <th scope="row">Non Borrèziens</th>
                                    <td>500.00€</td>
                                    <td>160.00€</td>
                                    <td>350.00€</td>
                                    <td>400.00€</td>
                                </tr>
                                <tr>
                                    <th scope="row">Associtation</th>
                                    <td>500.00€</td>
                                    <td>160.00€</td>
                                    <td>Gratuit</td>
                                    <td>Gratuit</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </main>

    <?php include "components/footer.php"; ?>
</body>

</html>