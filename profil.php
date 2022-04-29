<?php
session_start();
if (empty($_SESSION)) {
    header('location:index.php');
}
include('classes/membre.class.php');
include('structureHtml/head.html');
$user = new Membre($_SESSION['log_mail']);
$result = $user->getInfo();
?>

<body>
    <a href="home.php"><img src="my_meetic.png" alt="logodeouf"></a>
    <div class="info w3-container w3-blue">
        <p>Nom: <?php echo ucfirst($result['prenom']); ?></p>
        <p>Prenom: <?php echo ucfirst($result['Nom']); ?></p>
        <p>Date de naissance: <?php echo $result['birthday']; ?></p>
        <p>Age: <?php echo date("Y") - substr($result['birthday'], 0, 4); ?></p>
    </div>


    <div class="dropdown w3-display-topright">
        <span class="btn">Menu</span>
        <div class="dropdown-content">
            <ul class="root">
                <li><a href="home.php">Rechercher</a></li>
                <li><a href="settings.php">Parametres</a></li>
                <li class="deco w3-red"><a  href="deconnexion.php">Deconnexion</a></li>
            </ul>
        </div>
    </div>

    <a class="confirm w3-btn w3-red" href="delete.php" title="Mais non">Supprimer le compte</a>

</body>