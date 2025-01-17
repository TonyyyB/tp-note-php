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

    public function ajouterScore(string $nom, string $prenom, int|float $score): void
    {
        try {
            $req = $this->pdo->prepare("INSERT INTO RESULTAT(idJ,scoreRes,dateRes) VALUES (?,?,?);");
            $idJ = $this->getJoueur($nom, $prenom);
            $req->execute([$idJ, $score, date("Y-m-d H:i:s")]);
        } catch (PDOException $e) {
            // Le joueur à déjà eu ce score donc useless
            echo $e->getMessage();
        }
    }

    public function getJoueur(string $nom, string $prenom): int
    {
        $req = $this->pdo->prepare("select idj from JOUEUR where nom = ? and prenom = ?");
        $req->execute([$nom, $prenom]);
        $id = $req->fetch()['idj'];
        if ($id === null) {
            $this->ajouterJoueur($nom, $prenom);
            $req->execute([$nom, $prenom]);
            return $req->fetch()['idj'];
        } else {
            return $id;
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
              PRIMARY KEY (idj),
              idj TEXT  NOT NULL,
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

    public function verifConnexion():bool
    {
        $query = $this->pdo->prepare("SELECT idj, nom, prenom FROM PERSONNE WHERE idj = ? AND passwordJ = ?");
        $query->execute([$_POST["identifiant"], hash('sha256', $_POST["password"])]);
        $result = $query->fetchAll();
        return count($result) > 0;
    }



}
