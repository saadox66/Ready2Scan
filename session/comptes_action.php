<?php

    session_start();
    // Désactiver la mise en cache
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.
    if(!isset($_SESSION['login']) || !isset($_POST["email"])) //A COMPLETER pour tester aussi le rôle...
    {
        header("Location: admin_accueil.php");
        exit();
    }
    $servername = "localhost";
    $username = "e22207364sql";
    $password1 = "C3Z4D!n#";
    $dbname = "e22207364_db1";
                 
    $mysqli = new mysqli($servername, $username, $password1, $dbname);
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }

    $sql_validite = "SELECT prf_validite FROM t_profil_prf WHERE cpt_email = '" . $_POST["email"] . "';";
    $result_validite = $mysqli->query($sql_validite);

    if ($result_validite == false) {
        echo "<script>alert('Error: La requête a echoué');</script>";
        exit();
    }

    if($result_validite->num_rows > 0){
        $validite = $result_validite->fetch_assoc();
        $validite_to_set = ($validite["prf_validite"] == 'A') ? 'D' : 'A';
        $sql_validite_update = "UPDATE t_profil_prf SET prf_validite = '" . $validite_to_set . "' WHERE cpt_email = '" . $_POST["email"] . "';";  
        $result_update = $mysqli->query($sql_validite_update);
        if ($result_update == false) {
            echo "<script>alert('Error: La requête a echoué');</script>";
            exit();
        } 
    }
    $mysqli->close(); 
    header("Location: admin_accueil.php#profil_table");
    exit();

?>