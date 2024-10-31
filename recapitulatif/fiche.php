<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Cars</title>
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
	          <li class="nav-item active"><a href="../recapitulatif/recapitulatif.php" class="nav-link">Cars</a></li>
	          <li class="nav-item"><a href="../session/session.php" class="nav-link">Log in</a></li>
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
          	<p class="breadcrumbs"><span class="mr-2"><a href="../index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Fiche</h1>
          </div>
        </div>
      </div>
    </section>

    

    <section class="ftco-counter ftco-section img" id="section-counter" style="overflow: hidden;">
      <?php
            if(isset($_GET['code'])){
              $code_fiche = $_GET['code'];
              if(strlen($code_fiche) == 12){
                $servername = "localhost";
                $username = "e22207364sql";
                $password1 = "C3Z4D!n#";
                $dbname = "e22207364_db1";
                          
                $mysqli = new mysqli($servername, $username, $password1, $dbname);
                if ($mysqli->connect_error) {
                  die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
                }
                // Préparer la requête SQL pour récupérer les données de la fiche
                $sql = "SELECT *
                FROM t_sujet_sjt
                    INNER JOIN t_fiche_fic USING(sjt_num)
                    LEFT JOIN t_liee_lee USING(fic_num)
                    LEFT JOIN t_hyperlien_hyp USING(hyp_num)
                WHERE fic_code = '". $code_fiche ."';";

                // Exécuter la requête SQL
                $result = $mysqli->query($sql);

                // Vérifier s'il y a des résultats
                if($result->num_rows > 0) {
                // Récupérer les données de la fiche
                  $fiche = $result->fetch_assoc();

                  // Afficher les détails de la fiche
                  if($fiche['fic_etat'] === 'H'){
                    echo "<div class='row justify-content-center mb-5' style='padding: 0 100px;'>";
                    echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                    echo "ERROR : Can't show ' fiche ' : La fiche concernée est INDISPONIBLE !";
                    echo '</div>';
                    echo "</div>";
                  }else{
                    echo "<div class='container'>";
                    echo "<div class='row justify-content-center mb-5'>";
                    echo "<div class='col-md-8 text-center heading-section ftco-animate'>";
                    echo "<span class='subheading'>CARS</span>";
                    echo "<h2 class='mb-3'>" . $fiche['sjt_intitule'] . "</h2>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='row justify-content-center mb-5'>";
                    echo "<div class='col-md-8'>";
                    echo "<div class='card'>";
                    echo "<img class='card-img-top' src='../images/" . $fiche['fic_pathImage'] . "' alt='Card image cap'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title' style='color: #;'>" . $fiche['fic_label'] . "</h5>";
                    echo "<p class='card-text'>" . $fiche['fic_content'] . "</p>";
                    echo "<p class='card-text'><small class='text-muted'></small></p>";

                    echo "<h3> More details : </h3>";
                    echo "<div class='card' style=' margin: 25px; padding: 20px; border-radius: 10px;'>";
                    $requete_hyp = "SELECT hyp_nom , hyp_url
                    FROM t_fiche_fic 
                        INNER JOIN t_liee_lee USING(fic_num)
                        INNER JOIN t_hyperlien_hyp USING(hyp_num)
                    WHERE fic_code = '". $code_fiche ."';";

                    $result_hyp = $mysqli->query($requete_hyp);
                    if ($result_hyp == false) //Erreur lors de l’exécution de la requête
                    { // La requête a echoué
                      echo "Error: La requête a echoué \n";
                      echo "Errno: " . $mysqli->errno . "\n";
                      echo "Error: " . $mysqli->error . "\n";
                      exit();
                    }

                    if($result_hyp->num_rows == 0){
                      echo "<p class='card-text'>Aucun HYPERLIEN !</p>";
                    }else{
                      echo "<ul>";
                      while($hyp_row = $result_hyp->fetch_assoc()){
                        echo "<li><a href='" . $hyp_row['hyp_url'] . "' target='_blank'>" . $hyp_row['hyp_nom'] . "</a></li>";
                      }
                      echo "</ul>";
                      
                    }
                    echo "</div>";

                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                  } 
                }else {
                  echo "<div class='row justify-content-center mb-5' style='padding: 0 100px;'>";
                  echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                  echo "ERROR : Can't find ' fiche ' trouvée with this CODE !";
                  echo '</div>';
                  echo "</div>";
                }
                $mysqli->close();
              }else{
                echo "<div class='row justify-content-center mb-5' style='padding: 0 100px;'>";
                echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
                echo "ERROR : The code should contain 12 caracters  !";
                echo '</div>';
                echo "</div>";
              }


            }else{
              echo "<div class='row justify-content-center mb-5' style='padding: 0 100px;'>";
              echo '<div class="container-fluid alert alert-danger text-center" role="alert">';
              echo "Access DENIED  !";
              echo '</div>';
              echo '</div>';
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