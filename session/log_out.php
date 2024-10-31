<?php
    /* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
    autorisé à un utilisateur connecté. */
    session_start();
    // Désactiver la mise en cache
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.
    if (!isset($_SESSION['login'])) {
        // Si la session n'est pas ouverte ou si le rôle n'est pas défini, redirection vers la page du formulaire
        header("Location: session.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    }

    // Détruisez toutes les variables de session
    $_SESSION = array();
    unset($_SESSION['login']);
    unset($_SESSION['role']);
    // Détruisez la session
    session_destroy();

    // Redirigez l'utilisateur vers la page de connexion
    header("Location: session.php");
    exit(); // Assurez-vous de terminer le script après la redirection
?>