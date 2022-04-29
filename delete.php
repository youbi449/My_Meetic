<?php
include('classes/membre.class.php');

session_start();
$disable = new Membre($_SESSION['log_mail']);
$disable->deleteAccount();
session_unset();
session_destroy();
header('Location: index.php');
exit();
