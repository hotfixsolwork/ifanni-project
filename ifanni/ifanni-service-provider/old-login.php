<?php
include("assets/inc/initDb.php");
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'auzziech_ifanni');
define('DB_PASSWORD', 'ifanni1234567890!');
define('DB_DATABASE', 'auzziech_ifanni');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
$error = "";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $email = mysqli_real_escape_string($db,$_POST['service_provider_email']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);

    $sql = "SELECT * FROM service_provider WHERE email = '$email' and password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {
        $_SESSION['login_user'] = $email;

        header("location: index.php");
    }else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Login | Orphanage</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

    </head>

<body>

    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Welcome Back !</h5>
                                <p class="text-white-50">Sign in to continue to Serivce Provider Management Panel.</p>
                                <a href="index.html" class="logo logo-admin">
                                    <img src="assets/images/logo-sm.png" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">
                                <form class="mt-4" action = ""  method="post">

                                    <div class="mb-3">
                                        <label class="form-label" for="username">Email</label>
                                        <input type="text" class="form-control" name = "email" id="email" placeholder="Enter username">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" name = "password" id="password" placeholder="Enter password">
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">

                                        </div>
                                        <div class="col-sm-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </div>

                                    <div class="mt-2 mb-0 row">
<!--                                        <div class="col-12 mt-4">-->
<!--                                            <a href="pages-recoverpw.html"><i class="mdi mdi-lock"></i> Forgot your password?</a>-->
<!--                                        </div>-->
                                    </div>

                                </form>
                                <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
<!--                        <p>Don't have an account ? <a href="pages-register.html" class="fw-medium text-primary"> Signup now </a> </p>-->
                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Orphanage Management Panel</p>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>