<?php
session_start(); 
require('function.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Define your database file (e.g., 'db.txt').
    define('DB', 'db.txt');

    if (file_exists(DB)) {
        $loadDB = file(DB, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $loggedIn = false;
        // Initialize a variable to store the user's role.
        $user_Name=''; 
        $userEmail=''; 
        $userRole = ''; 

        foreach ($loadDB as $line) {
            $data = explode('|', $line);
            $storedUserName = $data[1];
            $storedEmail = $data[2];
            $storedPassword = $data[3];
            $storedRole = $data[4];

            if ($email === $storedEmail && $password === $storedPassword) {
                $loggedIn = true;
                $user_Name=$storedUserName;
                $userEmail=$storedEmail;
                $userRole = $storedRole;
                break;
            }
        }

        if ($loggedIn) {
            // Successful login, redirect based on the user's role.
            if ($userRole === 'Admin') {
                $_SESSION['name']=$user_Name;
                $_SESSION['email']= $storedEmail;
                $_SESSION['role']= $userRole;
                header('Location: admin_dashboard.php');
                exit;
            } else {
                $_SESSION['name']=$user_Name;
                $_SESSION['email']= $storedEmail;
                $_SESSION['role']= $userRole;
                header('Location: user_dashboard.php');
                exit;
            }
        } else {
            // Invalid login, display an error message.
            $login_err= 'Invalid email or password. Please try again.';
        }
    } else {
        echo 'Database file does not exist.';
    }
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
                        <!-- <img src="https://cdn.ostad.app/public/upload/2022-11-27T06-52-05.802Z-logo%20ostad.png" alt="Centered Image" class="img-fluid"> -->
                    </div>
                    <!-- <h3 class="text-center">PHP & Laravel Batch 2- Assignment (Module-05)</h3> -->
                    <!-- <h3 class="text-center alert-info">Login form with fields: email and password</h3> -->
                    <div style="margin: 20px; padding: 10px; background-color: white; height:500px">
                    <div class="row">
                        <div class="col-md-8 mx-auto mt-2">
                        <main class="form-signin w-100 m-auto text-center">
                        <form action="#" method="POST">
                            <h2 class="h4 mb-3 fw-normal">Login Form</h2>
                            <?php
                                if (!empty($_SESSION['msg'])) {
                                    echo '<div class="error-message alert-danger"><h4>' . $_SESSION['msg']. '<h4></div>';
                                }
                            ?>
                            <div class="form-floating">
                            <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com" required>
                            <label for="floatingEmail">Email address</label>
                            </div> <br>
                            <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                            </div>
                            <?php
                                if (!empty($login_err)) {
                                    echo '<div class="error-message alert-danger"><h4>' . $login_err. '<h4></div>';
                                }
                            ?>
                            <button class="btn btn-primary btn-lg mt-3" name="submit" type="submit">Login</button> <br>
                            <small class="mt-5 mb-3 text-muted">Don’t Have and Account? <a href="register.php" target="">Register Here</a></small>
                            <h4>Admin: Email: saju@gmail.com & Password: 12345</h4>
                            <h4>User: Email: tanvir@gmail.com & Password: 12345</h4>
                        </form>
                        </main>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
    setTimeout(function() {
        var messageDiv = document.querySelector(".error-message");
        if (messageDiv) {
            messageDiv.style.display = "none";
        }
    }, 2000); // 2000 milliseconds = 2 seconds
</script>
</body>
</html>

