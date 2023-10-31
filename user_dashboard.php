<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: logout.php');
  }
  ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container bg-info">
        <div class="row">
            <div class="col-md-10 mx-auto mt-5">
                <div>
                    <div class="text-center"> 
                        <img src="https://cdn.ostad.app/public/upload/2022-11-27T06-52-05.802Z-logo%20ostad.png" alt="Centered Image" class="img-fluid">
                    </div>
                    <h3 class="text-center">PHP & Laravel Batch 2- Assignment (Module-05)</h3>
                    <h3 class="text-center alert-info">User Dashboard</h3>
                    <div style="margin: 20px; padding: 10px; background-color: white; height:500px">
                    <div class="row">
                        <div class="col-md-12 mx-auto mt-2">
                        <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between" >
                                  <h2 class="text-left alert-success">Your Name is: <?php echo $_SESSION['name'];?>(<?php echo $_SESSION['role'];?>)</h2>
                                    <div class="small text-white">
                                    <button type="button" class="btn bg-danger btn-sm text-white" onClick="performLogout()">Logout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="row">
                        <div class="col-md-12">
                           <h2 class="text-center"><?php echo $_SESSION['role'];?>  Dashboard</h2> 
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        function performLogout() {
            // Redirect to the logout page
            window.location.href = 'logout.php';
        }
    </script>
</body>
</html>

