<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register</title>
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
	          <li class="nav-item"><a href="../session/session.php" class="nav-link">Log in</a></li>
	          <li class="nav-item active"><a href="../inscription/inscription.php" class="nav-link">Register</a></li>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="../index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Fiche</h1>
          </div>
        </div>
      </div>
    </section>

    

    <section class="ftco-counter ftco-section img" id="section-counter" style="padding : 100px;">
    <?php
                           $nom_error='';
                           $prenom_error='';
                           $email_error='';
                           $password_error='';
                           $password_confirm_error='';
                          
                          // Vérification si le formulaire a été soumis
                          if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (empty($_POST['prenom']) && empty($_POST['nom']) && empty($_POST['email']) &&  empty($_POST['password'])){
                              echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                              echo "Inputs are EMPTY !";
                              echo " <a href='./inscription.php' style='color:green;' class='alert-link'> Return to the FORUM</a>";
                              echo '</div>';
                              exit();
                            }else{  
                              if (empty($_POST['prenom'])) {
                                $prenom_error = "First Name Input is REQUIERED";
                                echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                                echo "First Name Input is REQUIERED  !";
                                echo " <a href='./inscription.php' style='color:green;' class='alert-link'> Return to the FORUM</a>";
                                echo '</div>';
                                exit();
                              }

                              if (empty($_POST['nom'])) {
                                  $nom_error = "Last Name Input is REQUIERED";
                                  echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                                  echo "Last Name Input is REQUIERED  !";
                                  echo " <a href='./inscription.php' style='color:green;' class='alert-link'> Return to the FORUM</a>";
                                  echo '</div>';  
                                  exit();
                                }
                          
                              
                          
                              // Validation du champ email
                              if (empty($_POST['email'])) {
                                  $email_error = "Email Input is REQUIERED";
                                  echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                                  echo "Email Input is REQUIERED  !";
                                  echo " <a href='./inscription.php' style='color:green;' class='alert-link'> Return to the FORUM</a>";
                                  echo '</div>';   
                                  exit();
                                }
                          
                              // Validation du champ de mot de passe
                              if (empty($_POST['password'])) {
                                  $password_error = "Password Input is REQUIERED";
                                  echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                                  echo "Password Input is REQUIERED  !";
                                  echo " <a href='./inscription.php' style='color:green;' class='alert-link'> Return to the FORUM</a>";
                                  echo '</div>'; 
                                  exit();
                                }
                          
                              // Validation du champ de confirmation du mot de passe
                              if (empty($_POST['password_confirm'])) {
                                  $password_confirm_error = "Confirm Your Password";
                                  echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                                  echo "Password Confirmation Input is REQUIERED  !";
                                  echo " <a href='./inscription.php' style='color:green;' class='alert-link'> Return to the FORUM</a>";
                                  echo '</div>'; 
                                  exit();
                                }
                              
                              if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                                echo '<div class="container-fluid alert alert-danger text-center" role="alert">';                            
                                echo "Mail Adress INVALIDE ! ";
                                echo " <a href='./inscription.php' style='color:green;' class='alert-link'> Return to the FORUM</a>";
                                echo '</div>'; 
                                exit();
                              }
                              
                              // Vérification que les mots de passe correspondent
                              if ($_POST['password'] !== $_POST['password_confirm']) {
                                  $password_confirm_error = "Passwords Don't Match";
                                  echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                                  echo "Passwords Don't Match is REQUIERED  !";
                                  echo " <a href='./inscription.php' style='color:green;' class='alert-link'> Return to the FORUM</a>";
                                  echo '</div>';
                                  exit();
                                }

                              if(preg_match("/[0-9]/" , $_POST['nom']) || preg_match("/[0-9]/" , $_POST['prenom'])){
                                echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                                echo "FIRST name and LAST name can't contain NUMBERS ! ";
                                echo " <a href='./inscription.php' style='color:green;' class='alert-link'> Return to the FORUM</a>";
                                echo '</div>'; 
                                exit();
                              }
                            }
                              
                              // Si une erreur est détectée, ré-afficher le formulaire avec les messages d'erreur
                              if ($nom_error || $prenom_error ||$email_error || $password_error || $password_confirm_error) {
                                include './inscription.php'; // Inclure le fichier du formulaire avec les messages d'erreur
                              
                              } else {
                                  // Récupération des données du formulaire
                                  $nom = htmlspecialchars(addslashes($_POST['nom']));
                                  $prenom = htmlspecialchars(addslashes($_POST['prenom']));
                                  $email = htmlspecialchars(addslashes($_POST['email']));
                                  $password = md5(htmlspecialchars(addslashes($_POST['password'])));
                                  $password_confirm = md5(htmlspecialchars(addslashes($_POST['password_confirm'])));
                          
                                  // Connexion à la base de données
                                  $servername = "localhost";
                                  $username = "e22207364sql";
                                  $password1 = "C3Z4D!n#";
                                  $dbname = "e22207364_db1";
                          
                                  $mysqli = new mysqli($servername, $username, $password1, $dbname);
                          
                                  // Vérification de la connexion
                                  if ($mysqli->connect_error) {
                                      die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
                                  }
                                  // Requête d'insertion du compte utilisateur
                                  $requete_compte = "INSERT INTO t_compte_cpt (cpt_email, cpt_password) VALUES ('$email','$password')";
                                  


                                  // Exécution de la requête pour le compte utilisateur
                                  if ($mysqli->query($requete_compte) === TRUE) {
                                      // Récupération de la clé étrangère (pseudo) pour créer le profil associé
                                      $pseudo = $mysqli->insert_id;
                          
                                      // Requête d'insertion du profil utilisateur
                                      $requete_profil = "INSERT INTO t_profil_prf (prf_nom, prf_prenom, prf_validite, prf_statut, prf_dateCreation, cpt_email) VALUES ('$nom', '$prenom', 'D', 'M', NOW(), '$email')";
                          
                                      // Exécution de la requête pour le profil utilisateur
                                      if ($mysqli->query($requete_profil) === TRUE) {
                                          echo '<div class="alert alert-success text-center" role="alert">';
                                          echo "Registration Succed !";
                                          echo '</div>';            
                                      } else {
                                          // Suppression du compte utilisateur en cas d'échec d'insertion du profil
                                          $mysqli->query("DELETE FROM t_compte_cpt WHERE cpt_email='$email'");
                          
                                           // Si la requête n'est pas de type POST, afficher un message d'erreur
                                           echo '<div class="alert alert-danger text-center" role="alert">';
                                           echo "Erreur lors de l'insertion du the USER ACCOUNT : ". $mysqli->error;
                                           echo '</div>';
                          
                                      }
                                  } else {
                                      echo '<div class="alert alert-danger text-center" role="alert">';
                                      echo "ERROR while insertion of  compte utilisateur: " . $mysqli->error;
                                      echo '</div>';
                                  }
                          
                                  // Fermeture de la connexion avec la base de données
                                  $mysqli->close();
                              }
                          } else {
                              echo "Access DENIED";
                          }
      ?>
    </section>	

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