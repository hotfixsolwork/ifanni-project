<?php
// Include database connection file (adjust the path accordingly)
include("assets/inc/initDb.php");

// Define database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'auzziech_ifanni');
define('DB_PASSWORD', 'ifanni1234567890!');
define('DB_DATABASE', 'auzziech_ifanni');

// Initialize a database connection
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check if the connection was successful
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the error message
$error = "";

// Start a session
session_start();

// Check if the login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs to prevent SQL injection
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Define the SQL query to retrieve user data
    $sql = "SELECT * FROM moderator WHERE email = '$email' AND password = '$password'";

    // Execute the query
    $result = mysqli_query($db, $sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($db));
    }

    // Get the number of rows in the result set
    $count = mysqli_num_rows($result);

    // If a user with matching credentials is found
    if ($count == 1) {

      $row = mysqli_fetch_assoc($result);

      // Store the email and id in the session
      $_SESSION['moderator-id'] = $row['id'];
        // Store the email in the session to indicate a logged-in user
        $_SESSION['login_user'] = $email;

        // Redirect to the desired page (e.g., index.php)
        header("location: index.php");
    } else {
        // Display an error message if login fails
        $error = "Your Login Name or Password is invalid";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta
      name="description"
      content="Responsive HTML Admin Dashboard Template based on Bootstrap 5"
    />
    <meta name="author" content="NobleUI" />
    <meta
      name="keywords"
      content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"
    />

    <title>Moderator Panel | Ifaani.sa</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="assets/vendors/core/core.css" />
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css" />
    <link
      rel="stylesheet"
      href="assets/vendors/flag-icon-css/css/flag-icon.min.css"
    />
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo1/style.css" />
    <!-- End layout styles -->

    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="main-wrapper">
      <div class="page-wrapper full-page">
        <div
          class="page-content d-flex align-items-center justify-content-center"
        >
          <div class="row w-100 mx-0 auth-page">
            <div class="col-md-4 col-xl-4 mx-auto">
              <div class="card">
                <div class="row">
                  <!--<div class="col-md-4 pe-md-0">
                    <div class="auth-side-wrapper"></div>
                  </div>-->
                  <div class="col-md-10 mx-auto ps-md-0">
                    <div class="auth-form-wrapper px-4 py-5">
                      <a href="#" class="noble-ui-logo d-block mb-2"
                        >ifanni<span>.sa</span></a
                      >
                        <h3 class="text-muted fw-normal mb-4">
                            <b>Moderator Panel</b>
                        </h3>
                      <h5 class="text-muted fw-normal mb-4">
                        Welcome back! Moderator Log in to your account.
                      </h5>
                      <form class="forms-sample" method="post">
                        <div class="mb-3">
                          <label for="userEmail" class="form-label"
                            >Email address</label
                          >
                          <input
                            id="email"
                            name="email"
                            type="email"
                            class="form-control"
                            placeholder="Email"
                          />
                        </div>
                        <div class="mb-3">
                          <label for="userPassword" class="form-label"
                            >Password</label
                          >
                          <input
                            id="password"
                            name="password"
                            type="password"
                            class="form-control"
                           
                            autocomplete="current-password"
                            placeholder="Password"
                          />
                        </div>
                        
                         <button class="btn btn-primary" type="submit">Log In</button>
                          
                          
                      </form>
                      <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>
