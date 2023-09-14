<?php

function threeDotsString(string $txt, int $max)
{
    if (strlen($txt) > $max) return substr($txt, 0, $max) . ' ...';
    return $txt;
}

function db_connect()
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    try {
        $dbh = new PDO($dsn, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        die("Erreur lors de la connexion SQL : " . $ex->getMessage());
    }
    return $dbh;
}

function getAllSubstancesToArray()
{
    $dbh = db_connect();
    $sql = "SELECT * FROM substance ORDER BY idSubstance ASC;";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $substance = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }

    return $substance;
}

function getAllLieuxToArray()
{
    $dbh = db_connect();
    $sql = "SELECT * FROM lieu;";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $lieux = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }

    return $lieux;
}

function getAllAuteursToArray()
{
    $dbh = db_connect();
    $sql = "SELECT * FROM auteur WHERE prenomAuteur NOT LIKE '%raf%' ORDER BY prenomAuteur ASC;";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $auteurs = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }

    return $auteurs;
}

function getScoreboard()
{
    $dbh = db_connect();
    $sql = "SELECT nomAuteur, dateNaissanceAuteur, prenomAuteur, couleurAuteur, COUNT(citation.idCitation) as nbrCitation
    FROM citation, auteur
    WHERE citation.idAuteur = auteur.idAuteur
    AND isDisplayed = 1 AND isVerified = 1
    GROUP BY auteur.idAuteur
    ORDER BY nbrCitation DESC";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $scoreboard = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }

    return $scoreboard;
}
