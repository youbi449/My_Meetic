<?php
include('structureHtml/head.html');
include('classes/connexion.class.php');
session_start();
session_unset();
session_destroy();

if (isset($_POST['connect']) && $_POST['connect'] == 'Connexion') {
    $nouvelleConnexion = new login($_POST['log_mail'], $_POST['password']);
    if ($nouvelleConnexion->checkMail()){
        session_start();
        $_SESSION['log_mail'] = $_POST['log_mail'];
        header('location:home.php');
        exit();
    }
}

?>

<body>
    <header>
        <a href="index.php"><img src="my_meetic.png" alt="logodeouf"></a>
        <div class="mdr w3-container w3-blue">
            <p>D'autre zoukeuse vous attendent ! Connectez vous</p>
        </div>
    </header>


    <div class="login-form">
    <form action="" method="post">
        <h2 class="text-center">Connectez-vous</h2>       
        <div class="form-group">
            <input type="text" class="form-control" name="log_mail" placeholder="Mail" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="connect" value="Connexion" class="btn btn-primary btn-block">Log in</button>
        </div>
        
    </form>
    <p class="text-center"><a href="inscription.php">Creer un compte</a></p>
</div>
</body>