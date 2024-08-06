<?php


include '/../../includes/connection.php';

$message="";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $stmt = $conn->prepare("SELECT * FROM admin WHERE BINARY username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the hashed password using password_verify
            if (password_verify($password, $row['password'])) {
                // Successful login
                $_SESSION['username'] = $username;

                // Regenerate session ID for security
                session_regenerate_id(true);

                // Redirect to student dashboard
                header("Location: admin/dashboard");
                exit();
            } else {
                $message = "Invalid password.";
            }
        } else {
            $message = "No user found with that username.";
        }
    } else {
        $message = "Username and password are required.";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>MicroHub</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="views/public\assets\images\apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="views/\assets\images\android-chrome-512x512.png">
    <link rel="icon" type="image/png" sizes="16x16" href="views/\assets\images\android-chrome-192x192.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="views/public\assets\styles\core.css">
    <link rel="stylesheet" type="text/css" href="views/public\assets/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="views/public/assets/styles/style.css">
    <style>
        h5 {
            color: blue;
        }
    </style>

</head>

<body class="login-page">
<div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Just an image -->
        <nav class="navbar navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <h2 style="font-family: cursive;">MicroHub</h2>
                    <h5>Experimental Elective Portal</h5>
                </a>
            </div>
        </nav>
    </div>
</div>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
                <img src="views/public/assets/images/login-page-img.png" alt="">
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="login-box bg-light box-shadow border-radius-12">
                    <div class="login-title">
                        <h2 class="text-center text-primary" style="font-family: cursive;">Admin Login</h2>
                    </div>
                    <form id="loginForm" action="" method="POST">

                        <div class="input-group custom">
                            <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" id="username">
                        </div>
                        <div class="input-group custom">
                            <input type="password" class="form-control form-control-lg" placeholder="**********" name="password" id="password">
                        </div><br>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <input class="btn btn-primary btn-lg btn-block" name="login" id="login" type="submit" value="Sign In">
                                </div>
                                <div class="col-6 mt-3 float-right">
                                    <div class="forgot-password"><a href="forgot_password.html" style="color: blue;">Forgot Password?</a></div>
                                </div>

                            </div>
                            <div style="color: red;">
                                <?php
                                echo $message;
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><br>
    </div>
</div>
<div style="bottom:0; background-color: #ffffff; color: #7b09df; text-align: center; padding: 10px 0; font-size: 0.8em;">
    <p>Developed and maintained by <br> <a href="about.html">KARE OSS Software Development Team</a></p>
</div>

<!-- js -->
<script src="views/public/assets/scripts/core.js"></script>
<script src="views/public/assets/scripts/script.min.js"></script>
<script src="views/public/assets/scripts/process.js"></script>
<script src="views/public/ssets/scripts/layout-settings.js"></script>
</body>

</html>