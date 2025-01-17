<?php
declare(strict_types=1);
require 'autoloader.php';
Autoloader::register();
use DateTime;
session_start();


$pdo = $dp->getPDO();
$query = $pdo->prepare("SELECT identifiantPe FROM PERSONNE WHERE identifiantPe = ?");
$query->execute([$_POST["identifiant"]]);
if (count($query->fetchAll()) < 1) {
    $_SESSION['inciden'] = True;
    header('Location: ./');
    exit();
}
$query = $pdo->prepare("SELECT idPe, nomPe, prenomPe FROM PERSONNE WHERE identifiantPe = ? AND passwordPe = ?");
$query->execute([$_POST["identifiant"], hash('sha256', $_POST["password"])]);
$result = $query->fetchAll();
if (count($result) < 1) {
    $_SESSION['incpass'] = True;
    header('Location: ./');
    exit();
}
$_SESSION["idPe"] = $result[0]["idPe"];
$_SESSION["nomPe"] = $result[0]["nomPe"];
$_SESSION["prenomPe"] = $result[0]["prenomPe"];
$_SESSION["connectionTime"] = time();
$query = $pdo->prepare("SELECT idLic FROM LICENCIE WHERE idLic = ?");
$query->execute([$_SESSION["idPe"]]);
$isLicencie = count($query->fetchAll()) > 0;
$url = "";
if ($isLicencie) {
    $url = "licencie";
} else {
    $query = $pdo->prepare("SELECT idMon FROM MONITEUR WHERE idMon = ?");
    $query->execute([$_SESSION["idPe"]]);
    $isMoniteur = count($query->fetchAll()) > 0;
    if ($isMoniteur) {
        $url = "moniteur";
    } else {
        $url = "secretariat";
    }
}
$_SESSION["userType"] = $url;
date_default_timezone_set('France/Paris');
$date = date('m-Y', time());
header("Location: " . $url . "?month=" . $date);
$pdo = null;
exit();
?>