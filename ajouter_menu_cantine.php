<?php

require_once "init.php";
echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>";

// TODO: if ( EST CONNECTE) {

// logs
$log = "Access to ajouter_menu_cantine page \n";
write_in_logs($log);

$lundiDate = isset($_GET['lundiDate']) ? $_GET['lundiDate'] : '';

$lundiRepas = isset($_GET['lundiRepas']) ? $_GET['lundiRepas'] : '';
$mardiRepas = isset($_GET['mardiRepas']) ? $_GET['mardiRepas'] : '';
$mercrediRepas = isset($_GET['mercrediRepas']) ? $_GET['mercrediRepas'] : '';
$jeudiRepas = isset($_GET['jeudiRepas']) ? $_GET['jeudiRepas'] : '';
$vendrediRepas = isset($_GET['vendrediRepas']) ? $_GET['vendrediRepas'] : '';

$isLundiFerie = isset($_GET['isLundiFerie']) ? $_GET['isLundiFerie'] : '';
$isMardiFerie = isset($_GET['isMardiFerie']) ? $_GET['isMardiFerie'] : '';
$isMercrediFerie = isset($_GET['isMercrediFerie']) ? $_GET['isMercrediFerie'] : '';
$isJeudiFerie = isset($_GET['isJeudiFerie']) ? $_GET['isJeudiFerie'] : '';
$isVendrediFerie = isset($_GET['isVendrediFerie']) ? $_GET['isVendrediFerie'] : '';

strval($isLundiFerie) == "on" ? $isLundiFerie = 1 : $isLundiFerie = 0;
strval($isMardiFerie) == "on" ? $isMardiFerie = 1 : $isMardiFerie = 0;
strval($isMercrediFerie) == "on" ? $isMercrediFerie = 1 : $isMercrediFerie = 0;
strval($isJeudiFerie) == "on" ? $isJeudiFerie = 1 : $isJeudiFerie = 0;
strval($isVendrediFerie) == "on" ? $isVendrediFerie = 1 : $isVendrediFerie = 0;

$ajouter = isset($_GET['ajouter']);

if ($ajouter) {

    $menuDAO = new MenuDAO();

    // Verif que au moins un jour n'est pas férié
    if (isset($_GET['isLundiFerie']) && isset($_GET['isMardiFerie']) && isset($_GET['isJeudiFerie']) && isset($_GET['isVendrediFerie'])) {
        $errorMessage = "Tout les jours ne peuivent pas être férié";
    }

    // Cohérence des férié / repas
    foreach (array('lundi', 'mardi', 'jeudi', 'vendredi') as $dayLabel) {
        if (isset($_GET[$dayLabel . 'Repas'])) {
            if (isset($_GET['is' . ucfirst($dayLabel) . 'Ferie']) && strlen($_GET[$dayLabel . 'Repas'])) {
                $errorMessage = ucfirst($dayLabel) . " ne peut être férié ET avoir un repas.";
            }
            if (!isset($_GET['is' . ucfirst($dayLabel) . 'Ferie']) && !strlen($_GET[$dayLabel . 'Repas'])) {
                $errorMessage = ucfirst($dayLabel) . " doit être férié OU avoir un repas.";
            }
        }
    }

    // Check si un menu exists déjà à cette date
    if (isset($_GET['lundiDate'])) {
        if ($menuDAO->doesAMenuExistWithThisDate($_GET['lundiDate'])) {
            $errorMessage = "Un menu exists déjà à cette date.";
        }
    }

    // Si pas d'ereur, on ajout
    if (!isset($errorMessage)) {
        // Création de l'objet
        $menu = new Menu(array(
            'lundiDate' => $lundiDate,
            'lundiRepas' => $lundiRepas,
            'mardiRepas' => $mardiRepas,
            'mercrediRepas' => $mercrediRepas,
            'jeudiRepas' => $jeudiRepas,
            'vendrediRepas' => $vendrediRepas,
            'isLundiFerie' => $isLundiFerie,
            'isMardiFerie' => $isMardiFerie,
            'isMercrediFerie' => $isMercrediFerie,
            'isJeudiFerie' => $isJeudiFerie,
            'isVendrediFerie' => $isVendrediFerie
        ));

        // Ajout dans la base avec insert en utilisant l'objet
        if ($menuDAO->insert($menu) === False) die("Erreur : les contenus ne font pas la bonne longeur, t'aurais pas essayé de bidouiller le formulaire ?");

        // logs
        $log = "Menu of " . $lundiDate . " added \n";
        write_in_logs($log);

        header('Location: liste_menu_cantine.php');
    }
}
// } else {
//   header('Location: index.php');
// }

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Site de la commune de Borrèze" />
    <meta name="author" content="Borrèze" />
    <title>Ajouter un menu - Borrèze</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
</head>


<!-- Page Content-->
<div class="container px-4 px-lg-5">

    <a class='' href='liste_menu_cantine.php'>
        <img src='assets/icons/arrow-left.svg' alt='Retour'>
    </a>

    <?php
    if (isset($errorMessage)) {
        echo "<div class='my-2'>";
        echo "<span style='color: red;'>Erreur: " . $errorMessage . "</span>";
        echo "</div>";
    }
    ?>

    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="GET">
        <div class="my-2 w-25">
            <div class="d-flex justify-content-start">
                <label for="lundiDate">Date au lundi:</label>
                <input class="form-control" type="date" name="lundiDate" value="<?= isset($_GET['lundiDate']) ? $_GET['lundiDate'] : '' ?>" required />
            </div>
        </div>
        <table class='table table-striped'>
            <tr class='table-primary'>
                <?php
                foreach (array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi') as $dayLabel) {
                    echo "<th class='text-center'>" . ucfirst($dayLabel) . "</th>";
                }
                ?>
            </tr>
            <tr>
                <?php
                foreach (array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi') as $dayLabel) {
                    if ($dayLabel != "mercredi") {
                        echo "<td>";
                        if (isset($_GET[$dayLabel . 'Repas'])) {
                            echo "<textarea minlength='10' maxlength='100' placeholder='Menu du " . $dayLabel . "' name='" . $dayLabel . "Repas' id='" . $dayLabel . "' cols='30' rows='10' class='form-control'>" . $_GET[$dayLabel . 'Repas'] . "</textarea>";
                        } else {
                            echo "<textarea minlength='10' maxlength='100' placeholder='Menu du " . $dayLabel . "' name='" . $dayLabel . "Repas' id='" . $dayLabel . "' cols='30' rows='10' class='form-control'></textarea>";
                        }
                        echo "<label class='mx-1' for='is" . ucfirst($dayLabel) . "Ferie'>Jour férié ?</label>";
                        if (isset($_GET["is" . ucfirst($dayLabel) . "Ferie"]) && $_GET["is" . ucfirst($dayLabel) . "Ferie"] === 'on') {
                            echo "<input type='checkbox' id='is" . ucfirst($dayLabel) . "Ferie' name='is" . ucfirst($dayLabel) . "Ferie' checked>";
                        } else {
                            echo "<input type='checkbox' id='is" . ucfirst($dayLabel) . "Ferie' name='is" . ucfirst($dayLabel) . "Ferie'>";
                        }
                        echo "</td>";
                    } else {
                        echo "<td style='background-color: #d1d1d1'></td>";
                    }
                }
                ?>
            <tr>
        </table>
        <div class="d-flex justify-content-end">
            <input class="btn btn-primary" type="submit" name="ajouter" value="Ajouter" />
        </div>
    </form>
</div>

</body>

</html>