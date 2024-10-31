<!DOCTYPE html>
<?php
  /* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
  autorisé à un utilisateur connecté. */
    session_start();
    // Désactiver la mise en cache
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.
    if(!isset($_SESSION['login'])) //A COMPLETER pour tester aussi le rôle...
    {
      //Si la session n'est pas ouverte, redirection vers la page du formulaire
      header("Location: session.php");
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
    $sql="SELECT * FROM t_profil_prf WHERE
          cpt_email='" . $_SESSION['login'] . "'";
                  
                  
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
      $profil = $resultat->fetch_assoc();
      
?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="../images/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
      href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
      rel="stylesheet"
    />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap_admin.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="../css/style_admin.css" rel="stylesheet" />
  </head>

  <body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
      <!-- Spinner Start -->
      <div
        id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      
        <div
          class="spinner-border text-primary"
          style="width: 3rem; height: 3rem"
          role="status">
        
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <!-- Spinner End -->

      <!-- Sidebar Start -->
      <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
          <a href="./admin_accueil.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">
              <i class="fa fa-hashtag me-2"></i>SABOXCAR
            </h3>
          </a>
          <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
              <img
                class="rounded-circle"
                src="../images/profil.svg"
                alt=""
                style="width: 40px; height: 40px"
              />
              <div
                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"
              ></div>
            </div>
            <div class="ms-3">
              <h6 class="mb-0"><?php
                echo $profil["prf_prenom"];
                echo " ";
                echo $profil["prf_nom"];
              ?></h6>
              <span>
                <?php
                  if($profil["prf_statut"] == 'M'){
                    echo "Member";
                  }else{
                    echo "Admin";
                  }
                ?>
              </span>
            </div>
          </div>
          <div class="navbar-nav w-100">
            <a href="./admin_accueil.php" class="nav-item nav-link active"
              ><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a
            >
            
            
            <div class="nav-item">
              <a href="./admin_sujets.php" class="nav-link">
                <i class="fa fa-laptop me-2"></i>
                News && fiches
            </a>
              
            </div>
          </div>
        </nav>
      </div>
      <!-- Sidebar End -->

      <!-- Content Start -->
      <div class="content">
        <!-- Navbar Start -->
        <nav
          class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        
          <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
          </a>
          <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
          </a>
         
          
          <div class="navbar-nav align-items-center ms-auto">

          <div class="nav-item dropdown">
              <a
                href="./admin_sujets.php"
                class="nav-link"
              >

                <span class="d-none d-lg-inline-flex">News && fiches</span>
              </a>
              
            </div>
           
            <div class="nav-item dropdown">
              <a
                href="#"
                class="nav-link dropdown-toggle"
                data-bs-toggle="dropdown"
              >
                <img
                  class="rounded-circle me-lg-2"
                  src="../images/profil.svg"
                  alt=""
                  style="width: 40px; height: 40px"
                />
                <span class="d-none d-lg-inline-flex"><?php
                  echo $profil["prf_prenom"];
                  echo " ";
                  echo $profil["prf_nom"];
                ?>
                </span>
              </a>
              <div
                class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0"
              >
                <a href="./admin_accueil.php" class="dropdown-item">My Profile</a>
                
                <a href="./log_out.php" class="dropdown-item">Log Out</a>
              </div>
            </div>

          </div>
        </nav>
        <!-- Navbar End -->

        

        <!-- Sales Chart Start hna -->
        <div class="container-fluid pt-4 px-4">
          <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
              <div class="bg-light text-center rounded p-4">
                <div
                  class="d-flex align-items-center justify-content-between mb-4" >
               
                  <h6 class="mb-0">Profil Details</h6>
                  <a href="">Show All</a>
                </div>
              
                <div
                  class="d-flex justify-content-center"
                  style="margin-bottom: 30px"
                >
                  <img src="../images/profil.svg" alt="" style="width: 200px" />
                </div>
                <div class="container-fluid" style="flex-wrap: wrap">
                  <h3 style="margin-bottom:20px;">Welcome Back !</h3> 
                  <div class="d-flex" style="gap: 10px">
                    <h6>Your First Name :</h6>
                    <p><?php
                      echo $profil["prf_prenom"];
                    ?></p>
                  </div>

                  <div class="d-flex" style="gap: 10px">
                    <h6>Your Last Name :</h6>
                    <p><?php
                      echo $profil["prf_nom"];
                    ?></p>
                  </div>

                  <div class="d-flex" style="gap: 10px">
                    <h6>Your email :</h6>
                    <p><?php
                      echo $profil["cpt_email"];
                    ?></p>
                  </div>

                  <div class="d-flex" style="gap: 10px">
                    <h6>Your are :</h6>
                    <p><?php
                      if($profil["prf_statut"] == 'M'){
                        echo "Member";
                      }else{
                        echo "Admin";
                      }
                    ?></p>
                  </div>

                  <div class="d-flex" style="gap: 10px">
                    <h6>You Joined us in :</h6>
                    <p><?php
                      echo $profil['prf_dateCreation'];
                    }
                    ?></p>
                  </div>
                  
                </div>
              </div>
            </div>
            
            <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                          <h6 class="mb-4">Update Your Password</h6>
                            <form style="margin-top:60px;">
                                <div class="mb-3">
                                    <label for="exampleInputPassword0" class="form-label">Enter Your Old Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword0">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Enter a New Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword2" class="form-label">Confirm Your New Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword2">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>
                        </div>
                    </div>



          </div>
        </div>
        <!-- profil update End -->

        <?php
        if($_SESSION["role"] != $profil['prf_statut']){
          $_SESSION["role"] = $profil['prf_statut'];
        }
        if($_SESSION["role"] == 'G'){
          $sql="SELECT COUNT(cpt_email) AS num_cpt , COUNT(prf_nom) AS num_prf FROM t_compte_cpt LEFT JOIN t_profil_prf USING(cpt_email);";
                  
                  
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
            $num = $resultat->fetch_assoc();
        
        
        ?>



        <!-- Sale & Revenue Start hna -->
        <div class="container-fluid pt-4 px-4">
          <div class="row g-4 d-flex justify-content-center">
            <div class="col-sm-6 col-xl-3">
              <div
                class="bg-light rounded d-flex align-items-center justify-content-between p-4"
              >
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                  <p class="mb-2">Number of Acounts</p>
                  <h6 class="mb-0">
                    <?php
                      echo $num["num_cpt"];
                    ?>
                  </h6>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3">
              <div
                class="bg-light rounded d-flex align-items-center justify-content-between p-4"
              >
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                  <p class="mb-2">Number of<br> Profils</p>
                  <h6 class="mb-0">
                    <?php
                      echo $num["num_prf"];
                    }
                    ?>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Sale & Revenue End   -->






        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4" id="profil_table">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Profil list</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"># Email</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Creation Date</th>
                                    <th scope="col">Action</th>
                                    
                                </tr>
                            </thead>
                            
                              <!---   Table php   -->
                              <?php
                                
                                $sql="SELECT * FROM t_profil_prf;";
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
                                  if ($resultat->num_rows > 0) {
                                    echo "<tbody>";
                                    while($accounts = $resultat->fetch_assoc()) {
                                      if($accounts["cpt_email"] != $_SESSION["login"]){
                                        echo "<tr>";
                                        echo "<td>" . $accounts["cpt_email"] . "</td>";
                                        echo "<td>" . $accounts["prf_prenom"] . "</td>";
                                        echo "<td>" . $accounts["prf_nom"] . "</td>";
                                        echo "<td>" . (($accounts["prf_validite"] == 'A') ? "Enabled" : "Disabled") . "</td>";
                                        echo "<td>" . (($accounts["prf_statut"] == 'M') ? "Member" : "Admin") . "</td>";
                                        echo "<td>" . $accounts["prf_dateCreation"] . "</td>";

                                        // Button statut

                                        echo "<td><form action='statuts_action.php' method='POST'>";
                                        
                                        if($accounts["prf_statut"] == 'M'){
                                          echo "<button type='submit' class='btn btn-primary' name='email' value='" . htmlspecialchars($accounts['cpt_email']) . "'>Membre</button>";
                                        }else{
                                          echo "<button type='submit' class='btn btn-warning' name='email' value='" . htmlspecialchars($accounts['cpt_email']) . "'>Admin</button>";
                                        }

                                        echo "</form>";
                                        // Button Enable/Disable
                                        echo "<td><form action='comptes_action.php' method='POST'>";
                                        
                                        if($accounts["prf_validite"] == 'A'){
                                          echo "<button type='submit' class='btn btn-danger' name='email' value='" . htmlspecialchars($accounts['cpt_email']) . "'>Disable</button>";
                                        }else{
                                          echo "<button type='submit' class='btn btn-success' name='email' value='" . htmlspecialchars($accounts['cpt_email']) . "'>Enable</button>";
                                        }

                                        echo "</form></td>";
                                        echo "</tr>";
                                      }
                                    }
                                    echo "</tbody>";
                                }
                              }
                          }
                          //Fermeture de la communication avec la base MariaDB
                          $mysqli->close();  
                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->

        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
          <div class="bg-light rounded-top p-4">
            <div class="row">
              <div class="col-12 col-sm-6 text-center text-sm-start">
                &copy; <a href="#">SABOX CAR</a>, All Right Reserved.
              </div>
            </div>
          </div>
        </div>
        <!-- Footer End -->
      </div>
      <!-- Content End -->

      <!-- Back to Top -->
      <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
        ><i class="bi bi-arrow-up"></i
      ></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main_admin.js"></script>
  </body>
</html>
