<?php
include('connexionbdd.class.php');

class Inscription
{

    protected $nom;
    protected $prenom;
    protected $dateDeNaissance;
    protected $sexe;
    protected $ville;
    protected $mail;
    protected $actif;
    protected $motDePass;
    protected $connexion;
    protected $bdd;

    public function __construct($newNom, $newPrenom, $newDN, $newSex, $newVille, $newMail, $newMDP)
    {
        $this->nom = $newNom;
        $this->prenom = $newPrenom;
        $this->dateDeNaissance = $newDN;
        $this->sexe = $newSex;
        $this->ville = $newVille;
        $this->mail = $newMail;
        $this->motDePass = $newMDP;
        $this->connexion = new Connexion();
        $this->bdd = $this->connexion->getDB();
    }

    public function insert()
    {
        $query = $this->bdd->prepare('INSERT INTO users (Nom, prenom, email, birthday, sexe, ville, password) VALUES (?,?,?,?,?,?,?)');
        $query->execute(
            array(
                $this->nom,
                $this->prenom,
                $this->mail,
                $this->dateDeNaissance,
                $this->sexe,
                $this->ville,
                md5($this->motDePass)
            )
        );
    }
    public function checkEmail($email)
    {
        $check = $this->bdd->prepare('select email from users where email=?');
        $check->execute(array($email));

        if ($check->rowCount() >= 1) {
            return false;
        } else {
            return true;
        }
    }
   
    public function checkAge()
    {
        return date("Y") - substr($this->dateDeNaissance, 0, 4);
    }

    public function error($msg)
    {
        echo '<div class="alert alert-danger alert-dismissible fade show">
        <strong>Error!</strong>'.$msg.'</div>';
    }

    public function valide()
    {
        echo "<div class='valide'>Votre inscription à bien été validée</div>";
    }
}
