<?php

require_once "init.php";
echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>";

// TODO: if (EST CONNECTE) {

// logs
$log = "Access to liste_menu_cantine page \n";
write_in_logs($log);

$menuDAO = new MenuDAO();
$allMenus = $menuDAO->findAllMenus();

$idMenuToDelete = isset($_GET['idMenuToDelete']) ? $_GET['idMenuToDelete'] : '';

if ($idMenuToDelete) {
    $menuDAO->delete($idMenuToDelete);

    // logs
    $log = "Menu of ID: " . $idMenuToDelete . " deleted \n";
    write_in_logs($log);

    header('Location: liste_menu_cantine.php');
}

// TODO: } else {
// TODO:   header('Location: index.php');
// TODO: }

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Site de la commune de Borrèze" />
    <meta name="author" content="Borrèze" />
    <title>Liste des menus - Borrèze</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
</head>


<!-- Page Content-->
<div class="container px-4 px-lg-5">

    <?php
    if ($allMenus != NULL) {
        echo "<div class='d-flex justify-content-center mb-3'>";
        echo "<p><strong>" . count($allMenus) . "</strong> menus.</p>";
        echo "</div>";

        echo "<div class=' my-1 d-flex justify-content-end'>";
        echo "<a href='ajouter_menu_cantine.php'>Ajouter un menu</a>";
        echo "</div>";

        echo "<table class='table table-striped' style='margin-bottom: 40vh;'>";
        echo "<tr class='table-primary'>";
        echo "<th scope='col'>ID</th>";
        echo "<th scope='col'>Dernière modification</th>";
        echo "<th scope='col'>A un jour férié ?</th>";
        echo "<th scope='col'>Premier jour de ce menu (lundi)</th>";
        echo "<th scope='col'>Repas de lundi</th>";
        echo "<th scope='col' colspan='3'>&nbsp;</th>";
        echo "</tr>";
        foreach ($allMenus as $menu) {
            echo "<tr>";
            echo "<td>" . $menu->get_idMenu() . "</td>";
            echo "<td>Le " . date("d/m/Y", strtotime($menu->get_lastModifDateTimeMenu())) . "</td>";
            if ($menu->get_isLundiFerie() == 1 || $menu->get_isMardiFerie() == 1 || $menu->get_isMercrediFerie() == 1 || $menu->get_isJeudiFerie() == 1 || $menu->get_isVendrediFerie() == 1) {
                echo "<td>Oui</td>";
            } else {
                echo "<td>Non</td>";
            }
            echo "<td>Le " . date("d/m/Y", strtotime($menu->get_lundiDate()))  . "</td>";
            if ($menu->get_lundiRepas()) {
                echo "<td>" . threeDotsString($menu->get_lundiRepas(), 10) . "</td>";
            } else {
                echo "<td><span style='color: #b5b5b5'>Aucun</span></td>";
            }
            // PDF Button
            echo "<td><a class='btn btn-blue' href='menu_cantine_pdf.php?idMenu=" . $menu->get_idMenu() . "' target='_blank'>
                <img src='assets/icons/file-earmark-pdf.svg' alt='PDF'>
            </a></td>";
            // MODIFIER Button
            echo "<td><a class='btn btn-warning' href='modifier_menu_cantine.php?idMenu=" . $menu->get_idMenu() . "'>
                <img src='assets/icons/pencil-fill.svg' alt='Modifier'>
            </a></td>";
            // SUPPRIMER Button
            echo "<td>
            <form action='" . $_SERVER['PHP_SELF'] . "' method='GET'>
            <input type='hidden' id='idMenuToDelete' name='idMenuToDelete' value='" . $menu->get_idMenu() . "' />
            <input class='btn btn-primary custom-delete-button pa-2' type='submit' name='submit' value=''>
                <img src='assets/icons/trash.svg' alt='Supprimer'>
            </input>
            </form>
            </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // Message no menu
        echo "<div class='d-flex justify-content-center' style='margin-bottom: 40vh; margin-top: 40vh;'>";
        echo "<div class='text-center' >";
        echo "<p><strong>Aucun</strong> menu trouvé.</p>";
        echo "<a class='link-primary' href='ajouter_menu_cantine.php'>Ajouter un menu</a>";
        echo "</div>";
        echo "</div>";
    }

    ?>


</div>

</body>

</html>

<style>
    .custom-delete-button {
        background-image: url('assets/icons/trash.svg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        height: 30px;
    }
</style>