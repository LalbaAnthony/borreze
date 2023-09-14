<?php

/**
 *
 * @author Anthony
 */

class MenuDAO extends DAO
{

  /**
   * Constructeur
   */
  function __construct()
  {
    parent::__construct();
    $log = "Menu initialized\n";
    write_in_logs($log);
  }

  function insert(Menu $menu)
  {
    $sql = "INSERT INTO menu (lundiDate";

    if ($menu->get_lundiRepas()) $sql .= ", lundiRepas";
    if ($menu->get_mardiRepas()) $sql .= ", mardiRepas";
    if ($menu->get_mercrediRepas()) $sql .= ", mercrediRepas";
    if ($menu->get_jeudiRepas()) $sql .= ", jeudiRepas";
    if ($menu->get_vendrediRepas()) $sql .= ", vendrediRepas";
    if ($menu->get_isLundiFerie()) $sql .= ", isLundiFerie";
    if ($menu->get_isMardiFerie()) $sql .= ", isMardiFerie";
    if ($menu->get_isMercrediFerie()) $sql .= ", isMercrediFerie";
    if ($menu->get_isJeudiFerie()) $sql .= ", isJeudiFerie";
    if ($menu->get_isVendrediFerie()) $sql .= ", isVendrediFerie";

    $sql .= ") VALUES ('" . $menu->get_lundiDate() . "'";

    if ($menu->get_lundiRepas()) $sql .= ", '" . $menu->get_lundiRepas() . "'";
    if ($menu->get_mardiRepas()) $sql .= ", '" . $menu->get_mardiRepas() . "'";
    if ($menu->get_mercrediRepas()) $sql .= ", '" . $menu->get_mercrediRepas() . "'";
    if ($menu->get_jeudiRepas()) $sql .= ", '" . $menu->get_jeudiRepas() . "'";
    if ($menu->get_vendrediRepas()) $sql .= ", '" . $menu->get_vendrediRepas() . "'";
    if ($menu->get_isLundiFerie()) $sql .= ", '" . $menu->get_isLundiFerie() . "'";
    if ($menu->get_isMardiFerie()) $sql .= ", '" . $menu->get_isMardiFerie() . "'";
    if ($menu->get_isMercrediFerie()) $sql .= ", '" . $menu->get_isMercrediFerie() . "'";
    if ($menu->get_isJeudiFerie()) $sql .= ", '" . $menu->get_isJeudiFerie() . "'";
    if ($menu->get_isVendrediFerie()) $sql .= ", '" . $menu->get_isVendrediFerie() . "'";

    $sql .= ")";

    $sth = $this->executer($sql);
    $nb = $sth->rowcount();
    return $nb;
  }

  function delete($idMenu)
  {
    $sql = "DELETE FROM menu
    WHERE idMenu = :idMenu";

    $params = array(
      ":idMenu" => $idMenu,
    );
    $sth = $this->executer($sql, $params);
    $nb = $sth->rowcount();
    return $nb;
  }

  function update(Menu $menu)
  {
    $sql = "UPDATE menu SET ";

    if ($menu->get_lundiRepas()) $sql .= "lundiDate = '" . $menu->get_lundiDate() . "'";

    foreach (array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi') as $dayLabel) {
      if (method_exists($menu, 'get_' . $dayLabel . 'Repas')) {
        if ($menu->{'get_' . $dayLabel . 'Repas'}()) {
          $sql .= ", " . $dayLabel . "Repas = '" . $menu->{'get_' . $dayLabel . 'Repas'}() . "'";
        } else {
          $sql .= ", " . $dayLabel . "Repas = NULL";
        }
      }
    }

    foreach (array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi') as $dayLabel) {
      if (method_exists($menu, 'get_is' . ucfirst($dayLabel) . 'Ferie')) {
        if ($menu->{'get_is' . ucfirst($dayLabel) . 'Ferie'}() == 1) {
          $sql .= ", is" . ucfirst($dayLabel) . "Ferie = 1";
        } else {
          $sql .= ", is" . ucfirst($dayLabel) . "Ferie = 0";
        }
      }
    }

    $sql .= " WHERE idMenu = " . $menu->get_idMenu();

    $sth = $this->executer($sql);
    $nb = $sth->rowcount();
    return $nb;
  }

  function findOneMenuById($id)
  {
    $sql = "SELECT *
    FROM menu
    WHERE idMenu = :id";
    try {
      $params = array(":id" => $id);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $menu = null;
    if ($row) {
      $menu = new Menu($row);
    }
    return $menu;
  }

  function findAllMenus()
  {
    $sql = "SELECT *
    FROM menu
    ORDER BY lundiDate DESC";
    try {
      $sth = $this->executer($sql);
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }

    if ($rows) {
      foreach ($rows as $row) {
        $menus[] = new Menu($row);
      }
      return $menus;
    }

    return false;
  }

  function doesAMenuExistWithThisDate(string $date)
  {
    $sql = "SELECT COUNT(*) as nbrMenu
    FROM menu
    WHERE lundiDate = :date";
    try {
      $params = array(":date" => $date);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    if ($row["nbrMenu"] > 0) return true;
    return false;
  }
}
