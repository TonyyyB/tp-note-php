<?php
namespace Model\DataSources;
declare(strict_types=1);

$pdo = null;
try {
    $pdo = $pdo = new PDO('sqlite:db.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage() . "<br/>";
    die();
}

