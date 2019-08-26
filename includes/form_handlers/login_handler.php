<?php
// Start login handler if submit is pressed
if(isset($_POST['login_button'])) {
  // Sanitize Email
  $email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);
  // Store email into session variable
  $_SESSION['log_email'] = $email;
  // Get password
  $password = md5($_POST['login_password']);
  // Make database query to find matching login information
  $check_database_query = mysqli_query($connection, "SELECT * FROM users WHERE email='$email' AND password='$password'");
  // Check number of rows returned from query
  $check_login_query = mysqli_num_rows($check_database_query);

  // Check if user logged in sucessfully
  if($check_login_query == 1) {
    // Store reseults from query in row variable
    $row = mysqli_fetch_array($check_database_query);
    // Set username variable from query
    $username = $row['username'];
    // Set session variable for username
    $_SESSION['username'] = $username;
    // Redirecet page to index
    header("Location: index.php");
    // Exit script
    exit();
  }
  else {
    array_push($error_array, "Email or Password is incorrect!");
  }
}
?>
