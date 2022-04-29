<?php
include('classes/inscription.class.php');

if (isset($_POST['inscription']) && $_POST['inscription'] == "S'inscrire") {
    $nouvelleInscription = new Inscription($_POST['nom'], $_POST['prenom'], $_POST['birthday'], $_POST['sexe'], $_POST['ville'], $_POST['email'], $_POST['mdp']);


    if ($nouvelleInscription->checkEmail($_POST['email'])) {
        if ($nouvelleInscription->checkAge() >= 18) {
            $nouvelleInscription->insert();
            echo '<div class="alert alert-success alert-dismissible fade show">
             <strong>Success!</strong> Votre inscription à bien été validé.
             <button type="button" class="close" data-dismiss="alert">&times;</button>';
        } else {
            $nouvelleInscription->error('Tu est trop petit pour pouvoir zouker zouker');
        }
    } else {
        $nouvelleInscription->error('Mail déja existant');
    }
}

include('structureHtml/head.html');

?>

<body>
    <header>
        <a href="index.php"><img src="my_meetic.png" alt="logo"></a>
        <div class="mdr w3-display-topmiddle w3-teal w3-padding w3-margin-top">
            
        </div>
    </header>

    <body>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Toi aussi tu veux rencontrer l'amour de ta vie ?</h1>
                <p>Inscrit toi des maintenant !</p>
                <p class="lead">Le site est interdit au mineurs. Merci de bien vouloir saisir une vrai adresse mail !</p>
            </div>
        </div>
        <div class="subform">
            <form class="inscription" action="" method="post">
                <label for="prenom">Prenom : </label> <input type="text" name="prenom" id="prenom" required><br>
                <label for="nom">Nom : </label><input type="text" name="nom" id="nom" required><br>
                <label for="birthday">Date de naissance : </label><input type="date" name="birthday" id="birthday" required><br>
                Sexe :<br><input type="radio" name="sexe" value="homme" id="sexe" required>Homme
                <input type="radio" name="sexe" value="femme" id="sexe" required>Femme
                <input type="radio" name="sexe" value="autre" id="sexe" required>Autre <br>
                <label for="ville">Ville : </label><input type="text" name="ville" id="ville" required><br>
                <label for="email">Adresse mail : </label><input type="mail" name="email" id="email" required><br>
                <label for="mdp">Mot de passe : </label><input type="password" name="mdp" id="mdp" required> <br>
                <input type="submit" value="S'inscrire" id="inscription" name="inscription">
            </form>
        </div>
    </body>
</body>

</html>
