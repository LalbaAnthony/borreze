<?php

/**
 *
 * @author Anthony
 */

class Page
{

    // Attributs on page table
    private $idPage;
    private $slugPage;
    private $titrePage;
    private $sousTitrePage;
    private $contenuPage;
    private $pathPage;
    private $nomPage;
    private $navBarPosPage;

    // Constructeur

    public function __construct(array $tableau = null)
    {
        if ($tableau != null) {
            $this->fill($tableau);
        }
    }

    // Getter et setter

    public function get_idPage()
    {
        return $this->idPage;
    }

    public function set_idPage($idPage)
    {
        $this->idPage = $idPage;
    }

    public function get_slugPage()
    {
        return $this->slugPage;
    }

    public function set_slugPage($slugPage)
    {
        $this->slugPage = $slugPage;
    }

    public function get_titrePage()
    {
        return $this->titrePage;
    }

    public function set_titrePage($titrePage)
    {
        $this->titrePage = $titrePage;
    }

    public function get_sousTitrePage()
    {
        return $this->sousTitrePage;
    }

    public function set_sousTitrePage($sousTitrePage)
    {
        $this->sousTitrePage = $sousTitrePage;
    }

    public function get_contenuPage()
    {
        return $this->contenuPage;
    }

    public function set_contenuPage($contenuPage)
    {
        $this->contenuPage = $contenuPage;
    }

    public function get_pathPage()
    {
        return $this->pathPage;
    }

    public function set_pathPage($pathPage)
    {
        $this->pathPage = $pathPage;
    }
    public function get_nomPage()
    {
        return $this->nomPage;
    }

    public function set_nomPage($nomPage)
    {
        $this->nomPage = $nomPage;
    }

    public function get_navBarPosPage()
    {
        return $this->navBarPosPage;
    }

    public function set_navBarPosPage($navBarPosPage)
    {
        $this->navBarPosPage = $navBarPosPage;
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
