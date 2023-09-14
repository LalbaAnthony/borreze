<?php

$idMenu = isset($_GET['idMenu']) ? $_GET['idMenu'] : '';

if (!$idMenu) header('Location: liste_menu_cantine.php');

require_once "init.php";
require_once "fpdf/fpdf.php";
require_once "classes/Menupdf.php";

// logs
$log = "Création du PDF pour le menu d'ID \n";
write_in_logs($log);

$menuDAO = new MenuDAO();
$menu = $menuDAO->findOneMenuById($idMenu);

// Instanciation de l'objet dérivé
$pdf = new Menupdf();

// Metadonnées
$pdf->SetTitle("Menu du " . date("d/m/Y", strtotime($menu->get_lundiDate())), true);
$pdf->SetSubject("Menu du " . date("d/m/Y", strtotime($menu->get_lundiDate())), true);
$pdf->SetCreator('Mairie de Borrèze', true);
$pdf->SetAuthor('Mairie de Borrèze', true);

$pdf->file_name = "menu_du_" . date("d_m_Y", strtotime($menu->get_lundiDate())) . ".pdf";
$pdf->nice_name_menu = "Menu du " . date("d/m/Y", strtotime($menu->get_lundiDate()));

// Création d'une page
$pdf->addPage('L');

// Titre
$pdf->SetFont('', 'B', 16);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 7, $pdf->nice_name_menu, false, 0, 'C');
$pdf->Ln(15);

// Entête
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(10);
$pdf->SetFillColor(255, 255, 255);
foreach (array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi') as $dayLabel) {
    $methode = 'get_is' . ucfirst($dayLabel) . "Ferie";
    if (method_exists($menu, $methode)) {
        // Si le jour est férié ou si on est mercredi, on met le fond en gris
        if ($menu->$methode($valeur) === 1 || $dayLabel === "mercredi") {
            $pdf->SetFillColor(181, 181, 181);
        } else {
            // sinon on met le fond en blanc
            $pdf->SetFillColor(255, 255, 255);
        }
    }

    $monthsToMois = array(
        'January'   => 'Janvier',
        'February'  => 'Février',
        'March'     => 'Mars',
        'April'     => 'Avril',
        'May'       => 'Mai',
        'June'      => 'Juin',
        'July'      => 'Juillet',
        'August'    => 'Août',
        'September' => 'Septembre',
        'October'   => 'Octobre',
        'November'  => 'Novembre',
        'December'  => 'Décembre',
    );

    $currentDateTime = new DateTime($menu->get_lundiDate());

    switch ($dayLabel) {
        case "lundi":
            break;
        case "mardi":
            $currentDateTime->modify("+1 day");
            break;
        case "mercredi":
            $currentDateTime->modify("+2 day");
            break;
        case "jeudi":
            $currentDateTime->modify("+3 day");
            break;
        case "vendredi":
            $currentDateTime->modify("+4 day");
            break;
    }
    $jour = $currentDateTime->format("j");
    $mois = $monthsToMois[$currentDateTime->format("F")];
    $pdf->Cell(55, 10, ucfirst($dayLabel) . " " . $jour . " " . iconv('UTF-8', 'windows-1252', $mois), 1, 0, "C", true);
}

$pdf->Ln(10);

// Content 
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);

$linesLundi = explode("\n", $menu->get_lundiRepas());
$linesMardi = explode("\n", $menu->get_mardiRepas());
$linesMercredi = explode("\n", $menu->get_mercrediRepas());
$linesJeudi = explode("\n", $menu->get_jeudiRepas());
$linesVendredi = explode("\n", $menu->get_vendrediRepas());

$maxLen = max(count($linesLundi), count($linesMardi), count($linesMercredi), count($linesJeudi), count($linesVendredi));

// Lundi
$pdf->SetY(50);
$pdf->SetX(10);
if ($menu->get_isLundiFerie() === 1) {
    $pdf->SetFillColor(181, 181, 181);
    for ($i = 0; $i < $maxLen; $i++) {
        $pdf->Cell(55, 20, ' ', 0, 2, "C", true);
    }
} else {
    $pdf->SetFillColor(255, 255, 255);
    foreach ($linesLundi as $line) {
        $pdf->Cell(55, 20, iconv('UTF-8', 'windows-1252', $line), 0, 2, "C", true);
    }
}

// Mardi
$pdf->SetY(50);
$pdf->SetX(65);
if ($menu->get_isMardiFerie() === 1) {
    $pdf->SetFillColor(181, 181, 181);
    for ($i = 0; $i < $maxLen; $i++) {
        $pdf->Cell(55, 20, ' ', 0, 2, "C", true);
    }
} else {
    $pdf->SetFillColor(255, 255, 255);
    foreach ($linesMardi as $line) {
        $pdf->Cell(55, 20, iconv('UTF-8', 'windows-1252', $line), 0, 2, "C", true);
    }
}

// Mercredi
$pdf->SetY(50);
$pdf->SetX(120);
$pdf->SetFillColor(181, 181, 181);
for ($i = 0; $i < $maxLen; $i++) {
    $pdf->Cell(55, 20, ' ', 0, 2, "C", true);
}

// Jeudi
$pdf->SetY(50);
$pdf->SetX(175);
if ($menu->get_isJeudiFerie() === 1) {
    $pdf->SetFillColor(181, 181, 181);
    for ($i = 0; $i < $maxLen; $i++) {
        $pdf->Cell(55, 20, ' ', 0, 2, "C", true);
    }
} else {
    $pdf->SetFillColor(255, 255, 255);
    foreach ($linesJeudi as $line) {
        $pdf->Cell(55, 20, iconv('UTF-8', 'windows-1252', $line), 0, 2, "C", true);
    }
}

// Vendredi
$pdf->SetY(50);
$pdf->SetX(230);
if ($menu->get_isVendrediFerie() === 1) {
    $pdf->SetFillColor(181, 181, 181);
    for ($i = 0; $i < $maxLen; $i++) {
        $pdf->Cell(55, 20, ' ', 0, 2, "C", true);
    }
} else {
    $pdf->SetFillColor(255, 255, 255);
    foreach ($linesVendredi as $line) {
        $pdf->Cell(55, 20, iconv('UTF-8', 'windows-1252', $line), 0, 2, "C", true);
    }
}

// $pdf->SetY(50);
// $pdf->SetX(10);
// $pdf->MultiCell(55, 20, iconv('UTF-8', 'windows-1252', $menu->get_lundiRepas()), 1, "C", true);
// $pdf->SetY(50);
// $pdf->SetX(65);
// $pdf->MultiCell(55, 20, iconv('UTF-8', 'windows-1252', $menu->get_mardiRepas()), 1, "C", true);
// $pdf->SetY(50);
// $pdf->SetX(120);
// $pdf->MultiCell(55, 20, iconv('UTF-8', 'windows-1252', $menu->get_mercrediRepas()), 1, "C", true);
// $pdf->SetY(50);
// $pdf->SetX(175);
// $pdf->MultiCell(55, 20, iconv('UTF-8', 'windows-1252', $menu->get_jeudiRepas()), 1, "C", true);
// $pdf->SetY(50);
// $pdf->SetX(230);
// $pdf->MultiCell(55, 20, iconv('UTF-8', 'windows-1252', $menu->get_vendrediRepas()), 1, "C", true);

// Génération du document PDF
unlink('outfiles/' . $pdf->file_name); // suppr fichier
$pdf->Output('f', 'outfiles/' . $pdf->file_name);
header('Location: outfiles/' . $pdf->file_name); // redirection vers le fichier dans le dossier outfiles
