<?php

    session_start();
    // Désactiver la mise en cache
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.
    if(!isset($_SESSION['login']) || (!isset($_POST["sujet_num"])  && !isset($_POST["sujet_intitule"]))) //A COMPLETER pour tester aussi le rôle...
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


    if(isset($_POST["sujet_num"])){
        $sql = "DELETE FROM t_liee_lee
        WHERE fic_num IN(
            SELECT fic_num
            FROM t_sujet_sjt
                INNER JOIN t_fiche_fic USING(sjt_num)
                INNER JOIN t_liee_lee USING(fic_num)
            WHERE sjt_num = " . $_POST['sujet_num'] . "
        );";

        $result = $mysqli->query($sql);

        if ($result == false) {
            echo "<script>alert('Error: La requête a echoué 1');</script>";
            exit();
        }
        
        $sql = "DELETE FROM t_fiche_fic
        WHERE sjt_num = " . $_POST['sujet_num'] . ";";
        
        $result = $mysqli->query($sql);

        if ($result == false) {
            echo "<script>alert('Error: La requête a echoué');</script>";
            exit();
        }


        $sql = "DELETE FROM t_sujet_sjt
        WHERE sjt_num = " . $_POST['sujet_num'] . ";";

        $result = $mysqli->query($sql);

        if ($result == false) {
            echo "<script>alert('Error: La requête a echoué');</script>";
            exit();
        }
    }else{
        $sql = "INSERT INTO t_sujet_sjt VALUES(NULL , '" . htmlspecialchars(addslashes($_POST['sujet_intitule'])) . "', CURDATE() , '" . htmlspecialchars(addslashes($_SESSION['login'])) . "' );";
        $result = $mysqli->query($sql);
        if ($result == false) {
            echo "<script>alert('Error: La requête a echoué');</script>";
            exit();
        }
    }

    $mysqli->close(); 
    header("Location: admin_sujets.php");
    exit();

?>