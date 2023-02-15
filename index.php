<?php
require_once './includes/log.php';
session_start();

// On check les champs du form Inscription, si remplis on lance la fonction register qui ajoute l'utilisateur en BDD sous conditions.
if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['conf-password'])) {
  register();
  die();
}

// On check les champs du form Connexion, on lance la fonction signIn qui compare les informations données avec celles présentes en BDD sous conditions.
if (isset($_POST['login']) && isset($_POST['password'])) {
  signIn($_POST['login'], $_POST['password']);
  die();
};
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- LINK CSS -->
  <link rel="stylesheet" href="style.css">
  <title>Accueil</title>
</head>

<body>
  <?php require_once "./includes/header.php" ?>




  <div class="container" id="container">

  </div>


  <script src="./JS/main.js" type="module"></script>
</body>

</html>