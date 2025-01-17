<?php
declare(strict_types=1);
namespace Model\DataSources;
use PDO;
use PDOException;
class DataBaseProvider
{

    private PDO $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("sqlite:" . $_SERVER['DOCUMENT_ROOT'] . "/../data/db.sqlite");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->initTable();
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function ajouterJoueur(string $nom, string $prenom): void
    {
        try {
            $sql = $this->pdo->prepare("INSERT INTO JOUEUR(nom,prenom) VALUES (?, ?);");
            $sql->execute([$nom, $prenom]);
        } catch (PDOException $e) {
            // Le joueur à déjà eu ce score donc useless
            echo $e->getMessage();
        }
    }

    public function ajouterScore(string $identifiant, int|float $score): void
    {
        try {
            $req = $this->pdo->prepare("INSERT INTO RESULTAT(idJ,scoreRes,dateRes) VALUES (?,?,?);");
            $req->execute([$identifiant, $score, date("Y-m-d H:i:s")]);
        } catch (PDOException $e) {
            // Le joueur à déjà eu ce score donc useless
            echo $e->getMessage();
        }
    }

    public function getScore(string $nom, string $prenom): int
    {
        $req = $this->pdo->prepare("select score from RESULTAT natural join JOUEUR where nom = ? and prenom = ?");
        $req->execute([$nom, $prenom]);
        $res = $req->fetch();
        return $res === false ? 0 : $res['score'];
    }

    public function initTable(): void
    {
        // Création de la table JOUEUR
        $sql = "CREATE TABLE IF NOT EXISTS JOUEUR (
              idj TEXT PRIMARY KEY,
              nom VARCHAR(42),
              prenom VARCHAR(42),
              passwordJ TEXT
            );";
        $this->pdo->exec($sql);

        // Création de la table RESULTAT avec clé primaire composite
        $sql = "CREATE TABLE IF NOT EXISTS RESULTAT (
          idj TEXT NOT NULL,
          scoreRes INT NOT NULL,
          dateRes DATE NOT NULL,
          PRIMARY KEY (idj, scoreRes, dateRes),
          FOREIGN KEY (idj) REFERENCES JOUEUR (idj)
        );";
        $this->pdo->exec($sql);
    }

    public function verifConnexion(string $identifiant, string $password): bool
    {
        $query = $this->pdo->prepare("SELECT idj, nom, prenom FROM JOUEUR WHERE idj = ? AND passwordJ = ?");
        $query->execute([$identifiant, hash('sha256', $password)]);
        $result = $query->fetchAll();
        return count($result) > 0;
    }

    public function inscription(string $identifiant, string $prenom, string $nom, string $password): bool
    {
        $query = $this->pdo->prepare("INSERT INTO JOUEUR (idj, nom, prenom, passwordJ) VALUES (?,?,?,?)");
        $query->execute([$identifiant, $nom, $prenom, hash('sha256', $password)]);
        return $query->rowCount() > 0;
    }
}
