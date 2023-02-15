<?php

//TODO =====> Renommer tout

try {
    $DB_DSN = 'mysql:host=localhost; dbname=livreor-js';
    $DB_USER = 'root';
    $DB_PASS = 'root';
    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);
    /*  // echo 'Connexion établie'; */
    // return TRUE;
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

function register()
{
    global $PDO;
    // Si les variables existent et qu'elles ne sont pas vides

    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $confPassword = htmlspecialchars($_POST['conf-password']);

    // On vérifie si l'utilisateur existe
    $check = $PDO->prepare('SELECT login, password FROM utilisateurs WHERE login = ?');
    $check->execute(array($login));
    $data = $check->fetch();
    $row = $check->rowCount();

    //s'il n'existe pas, que le mail est au bon format, que les pwd matchent, on créé l'user en DB
    if ($row === 0) {
        if ($password === $confPassword) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $insert = $PDO->prepare('INSERT INTO utilisateurs(login, password) VALUES(:login, :password)');
            $insert->execute(array(
                'login' => $login,
                'password' => $password,
            ));
            // et on affiche le message d'inscription
            echo json_encode(['response' => 'is_ok', 'messageInscription' => 'Inscription réussie']);
        }
    }
}


function signIn($login, $password)
{
    global $PDO;
    // On vérifie si l'utilisateur existe
    $check = $PDO->prepare('SELECT login, password FROM utilisateurs WHERE login = ?');
    $check->execute(array($login));
    $data = $check->fetch();
    $row = $check->rowCount();

    // s'il existe, on retransforme son pwd et on fait afficher le message de succès de connexion
    if ($row === 1) {
        $hashedPassword = $data['password'];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['login'] = $login;
            echo json_encode(['response' => 'ok_connexion', 'messageConnexion' => 'Connexion réussie']);
        }
    }
}
