<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Log in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">

    <link rel="stylesheet" href="../css/aos.css">

    <link rel="stylesheet" href="../css/ionicons.min.css">

    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/icomoon.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="../index.php">SABOX<span>CAR</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="../recapitulatif/recapitulatif.php" class="nav-link">Cars</a></li>
	          <li class="nav-item active"><a href="./session.php" class="nav-link">Log in</a></li>
	          <li class="nav-item"><a href="../inscription/inscription.php" class="nav-link">Register</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('../images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Log in <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Log in</h1>
          </div>
        </div>
      </div>
    </section>


    <!-- Section: Design Block -->
    <section class="text-center" style="margin-bottom : 60px; padding: 60px;">
      <?php
        //Ouverture d'une session
        session_start();
        /*Affectation dans des variables du pseudo/mot de passe s'ils existent,
        affichage d'un message sinon*/
        if(empty($_POST["email"])){
          echo "<div class='row justify-content-center mb-5' style='padding: 0 100px;'>";
          echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
          echo "ERROR : Please Fill EMAIL Input !";
          echo "<br /> <a href='../index.php' style='color:green;' class='alert-link'> Return to HOME page</a>";;
          echo '</div>';
          echo '</div>';
          exit();
        }

        if(empty($_POST["password"])){
          echo "<div class='row justify-content-center mb-5' style='padding: 0 100px;'>";
          echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
          echo "ERROR : Please Fill PASSWORD Input !";
          echo "<br /> <a href='../index.php' style='color:green;' class='alert-link'> Return to HOME page</a>";;
          echo '</div>';
          echo '</div>';
          exit();
        }

        if ($_POST["email"] && $_POST["password"]){
          $id = htmlspecialchars(addslashes($_POST["email"]));
          $motdepasse = htmlspecialchars(addslashes($_POST["password"]));
          // A COMPLETER...
          // Connexion à la base MariaDB
          $servername = "localhost";
          $username = "e22207364sql";
          $password1 = "C3Z4D!n#";
          $dbname = "e22207364_db1";
                          
          $mysqli = new mysqli($servername, $username, $password1, $dbname);
          if ($mysqli->connect_error) {
            die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
          }
          /* 1) Requête SQL n° 1) incomplète de recherche du compte utilisateur à partir
          des pseudo / mot de passe saisis */
          $sql="SELECT cpt_email , cpt_password , prf_validite , prf_statut FROM t_compte_cpt INNER JOIN t_profil_prf USING(cpt_email) WHERE
          cpt_email='" . $id . "' AND cpt_password = MD5('" . $motdepasse . "');";
          /* 1bis) A NOTER : on préparera plutôt une requête SQL n° 1bis) complète avec
          une jointure pour rechercher si un compte utilisateur valide ('A') existe dans
          la table des données des profils et récupérer aussi son rôle à partir des
          pseudo / mot de passe saisis */

          /* Exécution de la requête pour vérifier si le compte (=pseudo+mdp) existe !*/
          $resultat = $mysqli->query($sql);
          if ($resultat == false) {
            echo "<div class='row justify-content-center mb-5' style='padding: 0 100px;'>";
            echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
            echo "Error: La requête a echoué \n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            echo '</div>';
            echo '</div>';
            exit();
          }
          else {
            /* Dans le cas de la requête n° 1) non complétée ou n° 1bis), on teste si
            une ligne de résultat a été renvoyée, c'est à dire si le compte
            existe bien (n° 1)) et est activé (n° 1bis)) :
            */
            if($resultat->num_rows == 1) {
              $profil = $resultat->fetch_assoc();
              if($profil["prf_validite"] != 'A'){
                echo "<div class='row justify-content-center mb-5' style='padding: 0 100px;'>";
                echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                echo "ERROR : Your account is currently DISABLED. Please try again later !";
                echo "<br /> <a href='../index.php' style='color:green;' class='alert-link'> Return to HOME page</a>";;
                echo '</div>';
                echo '</div>';
                exit();
              }
              //Mise à jour des données de la session
              $_SESSION['login'] = $id;
              //affecter la valeur du rôle à $_SESSION['role']
              $_SESSION['role'] = $profil['prf_statut'];
              
              /* Redirection vers la page autorisée à cet utilisateur
                ATTENTION !! Ne pas mettre d'appel d'echo() / de balise HTML
                au-dessus de header() dans cette condition */
              header("Location:admin_accueil.php");
            }
            else{
                // aucune ligne retournée
                // => le compte n'existe pas.
                echo "<div class='row justify-content-center mb-5' style='padding: 0 100px;'>";
                echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                echo "ERROR : Email or password INCORRECT !";
                echo "<br /> <a href='./session.php' style='color:green;' class='alert-link'> Return to log in page</a>";
                echo '</div>';
                echo '</div>';
            }
            //Fermeture de la communication avec la base MariaDB
            $mysqli->close();
          }
        }
      ?>
  
    </section>
    <!-- Section: Design Block -->









    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><a href="#" class="logo">SABOX<span>CAR</span></a></h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Services</a></li>
                <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Customer Support</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">FAQ</a></li>
                <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                <li><a href="#" class="py-2 d-block">How it works</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/jquery.waypoints.min.js"></script>
  <script src="../js/jquery.stellar.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.magnific-popup.min.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/jquery.animateNumber.min.js"></script>
  <script src="../js/bootstrap-datepicker.js"></script>
  <script src="../js/jquery.timepicker.min.js"></script>
  <script src="../js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="../js/google-map.js"></script>
  <script src="../js/main.js"></script>
    
  </body>
</html>