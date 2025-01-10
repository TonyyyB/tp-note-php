<?php
declare(strict_types=1);
namespace Model\DataSources;
use PDO;
class DataBaseProvider{

    private PDO $pdo;

    public function __construct(){
        try {
            $this->pdo = new PDO('sqlite:db.sqlite');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->initTable();
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    public function ajouterJoueur(string $nom,string $prenom):void{
        $sql = $this->pdo->prepare("INSERT INTO JOUEUR(nom,prenom) VALUES (?, ?);");
        $sql-> execute($nom,$prenom);
    }
    
    public function ajouterScore(string $nom,string $prenom,int $score): void{
        $req = $this->pdo->prepare("INSERT INTO A(idJ,score) VALUES (?,?);");
        $idJ = $this-> getJoueur($nom,$prenom);
        $req-> execute($idJ,$score);
    }

    public function getJoueur(string $nom,string $prenom): int{
        $req = $this->pdo->prepare("select idJ from JOUEUR where nom = ? and prenom = ?");
        $req -> execute($nom,$prenom);
        $id = $req->fetch();
        if ($id === null){
            $this->ajouterJoueur($nom,$prenom);
            $req -> execute($nom,$prenom);
            return $req->fetch();
        }
        else{
            return $id;
        }
    }

    public function getScore(string $nom,string $prenom):int{
        $req = $this->pdo->prepare("select score from A natural join JOUEUR where nom = ? and prenom = ?");
        $req -> execute($nom,$prenom);
        if($req !== null){
            return $req->fetch();
        }
        return -1;
    }

    public function initTable():void{
        $sql = "CREATE TABLE JOUEUR IF NOT EXISTS posts (
        idj    INT NOT NULL PRIMARY KEY AUTOINCREMENT,
        nom    VARCHAR(42),
        prenom VARCHAR(42));";
        $this-> pdo->exec($sql);
        $sql = "CREATE TABLE RESULTAT (
        PRIMARY KEY (idj, score),
        idj  INT NOT NULL,
        score INT NOT NULL);
        ALTER TABLE RESULTAT ADD FOREIGN KEY (idj) REFERENCES JOUEUR (idj);";
        $this-> pdo->exec($sql);
    }
    
    
}
