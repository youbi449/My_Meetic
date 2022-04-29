<?php
include('connexionbdd.class.php');

class Membre extends Connexion
{

    protected $login;
    protected $connexion;
    protected $bdd;

    public function __construct($sessionLogin)
    {
        $this->login = $sessionLogin;
        $this->connexion = new Connexion();
        $this->bdd = $this->connexion->getDB();
    }

    public function getInfo()
    {
        $info = $this->bdd->prepare('select * from users where email = ?');
        $info->execute(array($this->login));
        return $info->fetch();
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

    public function deleteAccount()
    {
        $delete = $this->bdd->prepare('update users set actif = 0 where email=?');
        $delete->execute(array($this->login));
    }

    public function editPassword($newPass, $mailGuys)
    {
        $edit = $this->bdd->prepare('update users set password = md5(?) where email=?');
        $edit->execute(array($newPass, $mailGuys));
    }

    public function editMail($newMail, $mailOfUser)
    {
        $editMail = $this->bdd->prepare('update users set email = ? where email=?');
        $editMail->execute(array($newMail, $mailOfUser));
    }

    public function basicQuery($newQuery)
    {
        return $this->bdd->query($newQuery);
    }

    public function error($msg)
    {
        echo '<div class="alert alert-danger alert-dismissible fade show">
        <strong>Error!</strong>' . $msg . '</div>';
    }

    public function valide($confirm)
    {
        echo '<div class="alert alert-success" role="alert">
        <strong>Félicitation</strong> ' . $confirm . '.
      </div>';
    }
}
