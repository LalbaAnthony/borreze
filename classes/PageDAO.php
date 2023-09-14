<?php

/**
 *
 * @author Anthony
 */

class PageDAO extends DAO
{

  /**
   * Constructeur
   */
  function __construct()
  {
    parent::__construct();
    $log = "Page initialized\n";
    write_in_logs($log);
  }

  function findOnePageBySlug(string $slug)
  {
    $sql = "SELECT *
    FROM page
    WHERE slugPage = :slug";
    try {
      $params = array(":slug" => $slug);
      $sth = $this->executer($sql, $params);
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $page = null;
    if ($row) {
      $page = new Page($row);
    }
    return $page;
  }

  function findAllPages()
  {
    $sql = "SELECT *
    FROM page
    ORDER BY idPage ASC";
    try {
      $sth = $this->executer($sql);
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }

    if ($rows) {
      foreach ($rows as $row) {
        $pages[] = new Page($row);
      }
      return $pages;
    }

    return false;
  }

  function findAllNavbarPages()
  {
    $sql = "SELECT *
    FROM page
    WHERE navBarPosPage IS NOT NULL AND navBarPosPage <> 0
    ORDER BY navBarPosPage ASC";
    try {
      $sth = $this->executer($sql);
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Erreur lors de la requête SQL : " . $e->getMessage());
    }

    if ($rows) {
      foreach ($rows as $row) {
        $pages[] = new Page($row);
      }
      return $pages;
    }

    return false;
  }
}
