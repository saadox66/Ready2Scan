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
    $username = "";
    $password1 = "";
    $dbname = "";
                 
    $mysqli = new mysqli($servername, $username, $password1, $dbname);
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }             

    $sql_statut = "SELECT prf_statut FROM t_profil_prf WHERE cpt_email = '" . $_POST["email"] . "';";
    $result_statut = $mysqli->query($sql_statut);

    if ($result_statut == false) {
        echo "<script>alert('Error: La requête a echoué');</script>";
        exit();
    }

    if($result_statut->num_rows > 0){
        $statut = $result_statut->fetch_assoc();
        $statut_to_set = ($statut["prf_statut"] == 'M') ? 'G' : 'M';
        $sql_statut_update = "UPDATE t_profil_prf SET prf_statut = '" . $statut_to_set . "' WHERE cpt_email = '" . $_POST["email"] . "';";  
        $result_update = $mysqli->query($sql_statut_update);
        if ($result_update == false) {
            echo "<script>alert('Error: La requête a echoué');</script>";
            exit();
        }
    }

    $mysqli->close();  
    header("Location: admin_accueil.php#profil_table");
    exit();

?>
