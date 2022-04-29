<?php
session_start();
if (empty($_SESSION)) {
    header('location:index.php');
}

include('classes/membre.class.php');
include('structureHtml/head.html');
$user = new Membre($_SESSION['log_mail']);
$result = $user->getInfo();

if (isset($_POST['editPassSubmit']) && $_POST['editPassSubmit'] == 'Modifier') {
    $user->editPassword($_POST['nouveau'], $_SESSION['log_mail']);
    echo '<div class="valide">Le(s) changement ont bien été prise en compte.</div>';
}
if (isset($_POST['editMailSubmit']) && $_POST['editMailSubmit'] == 'Modifier') {
    if ($user->checkEmail($_POST['newMail']) == true) {
        $user->editMail($_POST['newMail'], $_SESSION['log_mail']);
        $user->valide('Les changements on bien été prise en compte !');
    } else {
        $user->error('Mail déja existant');
    }
}



?>

<body>
    <div class="onglet">
        <ul>
            <li><a href="#editPassword">Modifier le mot de passe</a></li>
            <li><a href="#editMail">Modifier l'email</a></li>
        </ul>
        <div class="forms">
            <form action="" method="post" id="editPassword">
                Ancien mot de passe: <input type="password" name="ancien"> <br>
                Nouveau mot de passe: <input type="password" name="nouveau"> <br>
                <input type="submit" name="editPassSubmit" value="Modifier">
            </form>
            <form action="" method="post" id="editMail">
                Ancien mail: <?php echo $_SESSION['log_mail']; ?><br>
                Nouveau mail: <input type="mail" name="newMail"> <br>
                <input type="submit" name="editMailSubmit" value="Modifier">
            </form>
        </div>
    </div>
</body>