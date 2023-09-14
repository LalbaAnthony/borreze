<?php

/**
 *
 * @author Anthony
 */

class Menu
{

    // Attributs on menu table
    private $idMenu;
    private $lastModifDateTimeMenu;
    private $lundiDate;
    private $lundiRepas;
    private $mardiRepas;
    private $mercrediRepas;
    private $jeudiRepas;
    private $vendrediRepas;
    private $isLundiFerie;
    private $isMardiFerie;
    private $isMercrediFerie;
    private $isJeudiFerie;
    private $isVendrediFerie;

    // Constructeur

    public function __construct(array $tableau = null)
    {
        if ($tableau != null) {
            $this->fill($tableau);
        }
    }

    // Getter et setter

    public function get_idMenu()
    {
        return $this->idMenu;
    }

    public function set_idMenu($idMenu)
    {
        $this->idMenu = $idMenu;
    }

    public function get_lastModifDateTimeMenu()
    {
        return $this->lastModifDateTimeMenu;
    }

    public function set_lastModifDateTimeMenu($lastModifDateTimeMenu)
    {
        $this->lastModifDateTimeMenu = $lastModifDateTimeMenu;
    }

    public function get_lundiDate()
    {
        return $this->lundiDate;
    }

    public function set_lundiDate($lundiDate)
    {
        $this->lundiDate = $lundiDate;
    }

    public function get_lundiRepas()
    {
        return $this->lundiRepas;
    }

    public function set_lundiRepas($lundiRepas)
    {
        $this->lundiRepas = $lundiRepas;
    }

    public function get_mardiRepas()
    {
        return $this->mardiRepas;
    }

    public function set_mardiRepas($mardiRepas)
    {
        $this->mardiRepas = $mardiRepas;
    }

    public function get_mercrediRepas()
    {
        return $this->mercrediRepas;
    }

    public function set_mercrediRepas($mercrediRepas)
    {
        $this->mercrediRepas = $mercrediRepas;
    }

    public function get_jeudiRepas()
    {
        return $this->jeudiRepas;
    }

    public function set_jeudiRepas($jeudiRepas)
    {
        $this->jeudiRepas = $jeudiRepas;
    }

    public function get_vendrediRepas()
    {
        return $this->vendrediRepas;
    }

    public function set_vendrediRepas($vendrediRepas)
    {
        $this->vendrediRepas = $vendrediRepas;
    }

    public function get_isLundiFerie()
    {
        return $this->isLundiFerie;
    }

    public function set_isLundiFerie($isLundiFerie)
    {
        $this->isLundiFerie = $isLundiFerie;
    }

    public function get_isMardiFerie()
    {
        return $this->isMardiFerie;
    }

    public function set_isMardiFerie($isMardiFerie)
    {
        $this->isMardiFerie = $isMardiFerie;
    }

    public function get_isMercrediFerie()
    {
        return $this->isMercrediFerie;
    }

    public function set_isMercrediFerie($isMercrediFerie)
    {
        $this->isMercrediFerie = $isMercrediFerie;
    }

    public function get_isJeudiFerie()
    {
        return $this->isJeudiFerie;
    }

    public function set_isJeudiFerie($isJeudiFerie)
    {
        $this->isJeudiFerie = $isJeudiFerie;
    }

    public function set_isVendrediFerie($isVendrediFerie)
    {
        $this->isVendrediFerie = $isVendrediFerie;
    }

    public function get_isVendrediFerie()
    {
        return $this->isVendrediFerie;
    }

    /**
     * Hydrateur
     * Alimente les propriétés à partir d'un tableau
     * @param array $tableau
     */
    public function fill(array $tableau)
    {
        foreach ($tableau as $cle => $valeur) {
            $methode = 'set_' . $cle;
            if (method_exists($this, $methode)) {
                $this->$methode($valeur);
            }
        }
    }

    /**
     * Retourne un tableau du contenu de l'objet
     *
     * @return array
     */
    public function dump()
    {
        return get_object_vars($this);
    }

    /**
     * Affiche la liste des propriétés de l'objet courant
     *
     * @return string les propriétés sous la forme d'une liste à puce HTML
     */
    public function afficher()
    {
        $tableau = $this->dump();
        $html = '<ul>';
        foreach ($tableau as $cle => $valeur) {
            $html .= '<li>' . $cle . ' = ' . $valeur . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}

// Classe Page
