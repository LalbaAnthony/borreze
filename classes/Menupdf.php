<?php

/**
 * Classe héritant de fpdf
 * On s'en sert pour pouvoir ajouter une entête et un bas de page
 */
class Menupdf extends FPDF
{

    var $file_name = "menu_du_";
    var $nice_name_menu = "Menu du ";

    function Header()
    {
        // Titre
        $this->SetFont('Arial', 'B', 10); // Police Arial gras 10
        $this->SetX(105);
        $this->Cell(90, 8, iconv('UTF-8', 'windows-1252', "Menu de la cantine de Borrèze"), 'B', 0, 'C');

        // Saut de ligne
        $this->Ln(15);
    }
}
