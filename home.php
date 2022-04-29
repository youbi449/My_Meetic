<?php
session_start();
if (empty($_SESSION)) {
    header('location:index.php');
}
include('classes/membre.class.php');
include('structureHtml/head.html');
$user = new Membre($_SESSION['log_mail']);
$result = $user->getInfo();
$resultQuery = '';
$searchQuery = "select * from users where 1";
$error = '<div class="alert alert-danger alert-dismissible fade show">
<strong>Error!</strong> Merci de choisir un filtre.
<button type="button" class="close" data-dismiss="alert">&times;</button>';

if (isset($_POST['recherche']) && $_POST['recherche'] == 'Rechercher') {

    if ($_POST['genre'] == "osef" && $_POST['age'] == "osef" && $_POST['ville'] == "osef" && $_POST['secondVille'] == "osef") {
        $searchQuery = "";
        $afficherResultat = "";
        $nombreDeResultat = "";
    }

    if ($_POST['genre'] != 'osef') {
        $searchQuery .= '&& sexe ="' . $_POST['genre'] . '" ';
    }
    if ($_POST['age'] != 'osef') {
        if ($_POST['age'] == "45+") {
            $searchQuery .= '&& TIMESTAMPDIFF(year,birthday,NOW()) > 45';
        } else {
            $searchQuery .= '&& TIMESTAMPDIFF(year,birthday,NOW()) between ' . $_POST['age'];
        }
    }
    if ($_POST['ville'] != "osef") {
        if ($_POST['secondVille'] != 'osef') {
            if ($_POST['secondVille'] != $_POST['ville']) {
                $searchQuery .= ' && ville in ("' . $_POST['ville'] . '","' . $_POST['secondVille'] . '")';
            } else {
                $user->error('Recherche invalide');
            }
        } else {
            $searchQuery .= ' && ville in ("' . $_POST['ville'] . '")';
        }
    }

    if ($searchQuery != "") {
        $rechercheQuery = $user->basicQuery($searchQuery);
        $afficherResultat = "";
        $nombreDeResultat = 0;
        if ($rechercheQuery->rowCount() >= 1) {
            while ($zboub = $rechercheQuery->fetch()) {
                $afficherResultat .= "<li>Nom: " . ucfirst($zboub['Nom']) . "<br>
         Prenom: " . ucfirst($zboub['prenom']) . "<br>
          Ville: " . ucfirst($zboub['ville']) . "</li>";
                $nombreDeResultat++;
            }
        } else {
            $afficherResultat = '<div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> Aucun résultat.
            <button type="button" class="close" data-dismiss="alert">&times;</button>';
        }
    } else {
        $afficherResultat = "";
    }
}
?>

<body>
    <header>
        <div class="mdr w3-container w3-red w3-topmiddle">
            <p>Bienvenue <?php echo ucfirst($result['Nom']) . " !"; ?></p>
        </div>
        <div class="dropdown w3-display-topright">
            <span class="btn">Menu</span>
            <div class="dropdown-content">
                <ul class="root">
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="settings.php">Parametres</a></li>
                    <li class="deco w3-red"><a href="deconnexion.php">Deconnexion</a></li>
                </ul>
            </div>
        </div>
    </header>
    <form class="rechercheZouk" action="" method="post" id="recherche">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Genre</label>
            </div>
            <select name="genre" class="custom-select" id="inputGroupSelect01">
                <option value="osef">Tout</option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="autre">Autre</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Age</label>
            </div>
            <select name="age" class="custom-select" id="inputGroupSelect01">
                <option value="osef">Tout</option>
                <option value="18 and 25">18-25</option>
                <option value="25 and 35">25-35</option>
                <option value="35 and 45">35-45</option>
                <option value="45+">45+</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Ville</label>
            </div>
            <select name="ville" class="custom-select" id="inputGroupSelect01">
                <option value="osef">Tout</option>
                <?php
                $selectVille = $user->basicQuery('select ville from users group by ville');
                foreach ($selectVille as $value) {
                    echo '<option value="' . $value['ville'] . '">' . $value['ville'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">2nd Ville</label>
            </div>
            <select name="secondVille" class="custom-select" id="inputGroupSelect01">
                <option value="osef">Tout</option>
                <?php
                $selectVille = $user->basicQuery('select ville from users group by ville');
                foreach ($selectVille as $value) {
                    echo '<option value="' . $value['ville'] . '">' . $value['ville'] . '</option>';
                }
                ?>
            </select>
        </div>
        <input type="submit" class="recherche" name="recherche" value="Rechercher">
    </form>


    <div class="slider">
        <?php
        if (isset($_POST['recherche']) && $_POST['recherche'] == 'Rechercher') {
            if ($_POST['genre'] == "osef" && $_POST['age'] == "osef" && $_POST['ville'] == "osef" && $_POST['secondVille'] == "osef") {
                echo $error;
            } else {
                echo '<p id="nombreResultat">' . $nombreDeResultat . ' zoukeuse trouver</p>';
            }
        }
        ?>
        <ul>
            <?php
            if (isset($_POST['recherche']) && $_POST['recherche'] == 'Rechercher')
                echo $afficherResultat;
            ?>
        </ul>
    </div>
    <span class="prev btn btn-outline-primary">Precedent</span> <span class="next btn btn-outline-primary">Suivant</span>'




</body>