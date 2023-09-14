<?php

require_once "init.php";
echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>";

$dao = new PageDAO();
$page = $dao->findOnePageBySlug("mentions-legales");

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
                    <?= $page->get_contenuPage() ?>
                </div>
            </div>
        </div>
    </main>

    <?php include "components/footer.php"; ?>
</body>

</html>