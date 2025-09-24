<?php

include "config.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select = "SELECT * FROM admin WHERE username = '$username' AND password ='$password'";
    $query = mysqli_query($conn, $select);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        session_start();
        $_SESSION['userlogin'] = $username;
        
        echo "<script>
                document.addEventListener('DOMContentLoaded', function(){
                    document.getElementById('loaderOverlay').style.display = 'flex';
                    setTimeout(function(){
                        window.location.href = 'index.php';
                    }, 1000);
                });
              </script>";
    } else {
        echo "<script>alert('Incorrect username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="icon" type="../images/architect-logo.webp" href="../images/architect-logo.webp" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" />

  <style>
    body {
      background-image: url('../images/blogs-login.jpg');
      background-size: cover;
      background-position: center;
      height: 100vh;
    }

    .glass-card {
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.15);
      border-radius: 15px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      color: #fff;
    }

    .form-control::placeholder {
      color: #e5e5e5;
    }

  
    #loaderOverlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.7);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      display: none; 
    }

    .spinner-border {
      width: 4rem;
      height: 4rem;
      color: #fff;
    }
  </style>
</head>
<body>
  
  <div id="loaderOverlay">
    <div class="text-center">
      <div class="spinner-border" role="status"></div>
      <p class="mt-3 text-white fw-bold">Please wait, logging in...</p>
    </div>
  </div>

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4 p-4 glass-card">
      <h2 class="text-center mb-4">Admin Login</h2>
      <form method="POST" action="login.php" onsubmit="showLoader()">
        <div class="mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-light w-100 fw-bold">Login</button>
      </form>
    </div>
  </div>

  <script>
    
    function showLoader() {
      document.getElementById("loaderOverlay").style.display = "flex";
    }
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
