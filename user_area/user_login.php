<?php
session_start();
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Treasure Products</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-white sticky-top navbar-light p-3 shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="../home.php"><i class="fa-solid fa-shop me-2"></i> <strong>TREASURE PRODUCTS</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" collapse navbar-collapse" id="navbarNavDropdown">
          <div class="ms-auto d-none d-lg-block">
            <div class="input-group">
            </div>
          </div>
          <ul class="navbar-nav ms-auto ">
            <li class="nav-item">
              <a class="nav-link mx-2 text-uppercase active" aria-current="page" href="../home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2 text-uppercase" href="../allproducts.php">All Products</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto ">
            <li class="nav-item">
              <a class="nav-link mx-2 text-uppercase" href="user_registration.php"><i class="fa-solid fa-circle-user me-1"></i>Sign Up</a>
            </li>
            <li class="nav-item">
            <a href="../cart.php">
            <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php cart_item();?></span>
                        </button>
                        </a>
            </li>
            <?php
            if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link mx-2 text-uppercase' href=''><i class='fa-solid fa-circle-user me-1'></i></a>
          </li>";
            }
            else{
              echo "<li class='nav-item'>
              <a class='nav-link mx-2 text-uppercase' href='logout.php'><i class='fa-solid fa-circle-user me-1'></i>Logout</a>
            </li>";
          }
          ?>
          </ul>
        </div>
      </div>
    </nav>
        <!-- Header-->
        
        <!-- Section-->
        <!-- Section: Design Block -->
        <section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
              <form action="" method="post" enctype="multipart/form-data">
              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="text" id="username" class="form-control form-control-lg" name="user_username"/>
                <label class="form-label" for="username">Username</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" class="form-control form-control-lg" name="user_password"/>
                <label class="form-label" for="typePasswordX">Password</label>
              </div>
              <div>
              <label class="form-label">Sample Username: user</label>
              </div>
              <div>
              <label class="form-label">Sample User Password: 1234</label>
              </div>
              <div>
              <label class="form-label">Or please sign up for an account</label>
              </div>
              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

              <button class="btn btn-outline-light btn-lg px-5" type="submit" name="user_login">Login</button>

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="user_registration.php" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];



    $select_query="Select * from `user_table` where username='$user_username'";
    $result=mysqli_query($con, $select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();
    

    $select_query_cart="Select * from `cart_details` where ip_address='$user_ip'";
    $select_cart=mysqli_query($con, $select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);

    
    if($row_count>0){
        $_SESSION['username']=$user_username;
        if(password_verify($user_password,$row_data['user_password'])){
            //echo "<script>alert('Login Successful')</script>";
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
                
            }
            else{
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            }
            
        }
        else{
            echo "<script>alert('Invalid Credentials')</script>";
        }
    }
    else{
        echo "<script>alert('Invalid Credentials')</script>";
    }
}


?>