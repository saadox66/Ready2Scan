<?php

    session_start();
    // Désactiver la mise en cache
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.
    if(!isset($_SESSION['login']) || !isset($_POST["fiche"])) //A COMPLETER pour tester aussi le rôle...
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

    $sql_fiche = "SELECT fic_etat FROM t_fiche_fic WHERE fic_num = '" . $_POST["fiche"] . "';";
    $result_fiche = $mysqli->query($sql_fiche);

    if ($result_fiche == false) {
        echo "<script>alert('Error: La requête a echoué');</script>";
        exit();
    }

    if($result_fiche->num_rows > 0){
        $fiche = $result_fiche->fetch_assoc();
        $etat_to_set = ($fiche["fic_etat"] == 'O') ? 'H' : 'O';
        $sql_fiche_update = "UPDATE t_fiche_fic SET fic_etat = '" . $etat_to_set . "' WHERE fic_num = '" . $_POST["fiche"] . "';";  
        $result_update = $mysqli->query($sql_fiche_update);
        if ($result_update == false) {
            echo "<script>alert('Error: La requête a echoué');</script>";
            exit();
        } 
    }
    $mysqli->close(); 
    header("Location: admin_sujets.php");
    exit();

?>