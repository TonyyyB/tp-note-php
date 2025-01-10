<?php
namespace Model\DataSources;
declare(strict_types=1);
class DataBaseProvider{

    private PDO $pdo;

    public function __construct(){
        $this->pdo = null;
        try {
            $this->pdo = new PDO('sqlite:db.sqlite');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    public function ajouterJoueur(string $nom,string $prenom):void{
        $sql = $this->pdo->prepare("INSERT INTO JOUEUR(nom,prenom) VALUES (?, ?);");
        $sql-> execute($nom,$prenom);
    }
    
    public function ajouterScore(string $idJ,int $score): void{
        $req = $this->pdo->prepare("INSERT INTO A(idJ,score) VALUES (?,?);");
        $req-> execute($idJ,$score);
    }

    public function getJoueur(string $nom,string $prenom): string{
        $req = $this->pdo->prepare("select idJ from JOUEUR Where nom = ? and prenom = ?");
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
    
    
}
