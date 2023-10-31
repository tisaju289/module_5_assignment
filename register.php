<?php
require('function.php');

if (isset($_POST['submit'])) {
    define('DB', 'db.txt');
    
    $nama = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Initialize $loadDB
    $loadDB = array();

    // Check if the email already exists in the database.
    $emailExists = false;

    if (file_exists(DB)) {
        $loadDB = @file(DB, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($loadDB as $line) {
            $data = explode('|', $line);
            $storedEmail = $data[2];

            if ($email === $storedEmail) {
                $emailExists = true;
                break;
            }
        }
    }

    if ($emailExists) {
        // Email already exists, show an alert message.
        // echo '<script>alert("Email already exists. Please use a different email.");</script>';
         // Set the error message
         $error_message = "Email already exists. Please use a different email.";
    } else {
        // Email is not in the database, proceed to add the new record.
        if (!file_exists(DB)) {
            saveTxt(DB, "1|Abdur Rahim|rahim@gmail.com|12345|Admin|" . PHP_EOL, 'a');
        }

        $total = explode("|", $loadDB[count($loadDB) - 1]);

        $id = $total[0] + 1;
        $role = "User";

        saveTxt(DB, "$id|$nama|$email|$password|$role|" . PHP_EOL, 'a');

        header('location: login.php');
        exit;
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
                    
                    <h3 class="text-center alert-info">Registration form with fields: username, email, and password</h3>
                    <div style="margin: 20px; padding: 10px; background-color: white; height:500px">
                    <div class="row">
                        <div class="col-md-8 mx-auto mt-2">
                        <main class="form-signin w-100 m-auto text-center">
                        <form action="#" method="POST">
                            <h2 class="h4 mb-3 fw-normal">Registration Form</h2>
                            <?php
                                if (!empty($error_message)) {
                                    echo '<div class="error-message alert-danger"><h4>' . $error_message . '<h4></div>';
                                }
                            ?>
                            <!-- User Name -->
                            <div class="form-floating">
                            <input type="text" class="form-control" id="user" name="user_name" placeholder="Abdur Rahim">
                            <label for="user">Enter User Name</label>
                            </div> <br>
                            <!-- Emai -->
                            <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                            </div> <br>
                            <!-- Password -->
                            <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Enter Password">
                            <label for="floatingPassword">Password</label>
                            </div>

                            <button class="btn btn-primary btn-lg mt-3" name="submit" type="submit">Register Now</button> <br>
                            <small class="mt-5 mb-3 text-muted">If You have an account<a href="login.php" target="">Login Here</a></small>

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
    <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    setTimeout(function() {
        var messageDiv = document.querySelector(".error-message");
        if (messageDiv) {
            messageDiv.style.display = "none";
        }
    }, 3000); // 3000 milliseconds = 3 seconds
</script>
</body>
</html>