<?php
include('connexionbdd.class.php');

class login extends Connexion
{
    private $login;
    private $password;
    protected $connexion;
    protected $bdd;

    public function __construct($newLogin, $newPassword)
    {
        $this->login = $newLogin;
        $this->password = $newPassword;
        $this->connexion = new Connexion(); 
        $this->bdd = $this->connexion->getDB();
    }

    public function checkMail()
    {
        $query = $this->bdd->prepare('select * from users where email =? && password =md5(?) && actif=1');
        $query->execute(array($this->login, $this->password));

        if ($query->rowCount() >= 1) {
            return true;
        } else {
            echo "<div class='erreur'>Adresse mail ou mot de passe incorrecte</div>";
            return false;
        }
    }
}
