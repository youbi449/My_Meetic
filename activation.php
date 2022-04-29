<?php
$login = $_GET['log'];
$cle = $_GET['cle'];

include('classes/membre.class.php');
$user = new Membre($login);
$result = $user->getInfo();

$query = $user->basicQuery('select cle_activation,complet from users where email='.$login);
$rowQuery = $query->fetch();
$clebdd = $rowQuery['cle_activation'];
$complet = $rowQuery['complet'];

if($complet == 1){
    $t
}
