<?php
session_start();

// Database Connection
$connection = mysqli_connect("127.0.0.1", "root", "Storm12345", "scribe");
// Check connection
if(mysqli_connect_errno()) {
  echo "Failed to connect to database" . mysqli_connect_errno();
}

// Variables
$fname = "";
$lname = "";
$email = "";
$email2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();

// Check if form submitted
if (isset($_POST['register_button'])) {

  // Registration form values

  // First name
  $fname = strip_tags($_POST['reg_fname']); // Remove HTML tags
  $fname = str_replace(' ', '', $fname); // Remove spaces
  $fname = ucfirst(strtolower($fname)); // Uppercase first letter
  $_SESSION['reg_fname'] = $fname;

  // Last name
  $lname = strip_tags($_POST['reg_lname']); // Remove HTML tags
  $lname = str_replace(' ', '', $lname); // Remove spaces
  $lname = ucfirst(strtolower($lname)); // Uppercase first letter
  $_SESSION['reg_lname'] = $lname;

  // Email
  $email = strip_tags($_POST['reg_email']); // Remove HTML tags
  $email = str_replace(' ', '', $email); // Remove spaces
  $email = ucfirst(strtolower($email)); // Uppercase first letter
  $_SESSION['reg_email'] = $email;

  // Email confirm
  $email2 = strip_tags($_POST['reg_email']); // Remove HTML tags
  $email2 = str_replace(' ', '', $email2); // Remove spaces
  $email2 = ucfirst(strtolower($email2)); // Uppercase first letter
  $_SESSION['reg_email2'] = $email2;

  // Passwords
  $password = strip_tags($_POST['reg_password']); // Remove HTML tags
  $password2 = strip_tags($_POST['reg_password2']); // Remove HTML tags

  $date = date("Y-m-d"); // Current date

  if($email == $email2) {
    // Check if email is in valid format
    if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $email = filter_var($email,FILTER_VALIDATE_EMAIL);

      // Check if email already in use
      $e_check = mysqli_query($connection, "SELECT email FROM users WHERE email='$email'");

      // Count number of rows returned
      $num_rows = mysqli_num_rows($e_check);
      // Check if email is matches any in database
      if($num_rows > 0) {
        array_push($error_array, "Email already in use<br>");
      }

    }
    else {
      array_push($error_array, "Invalid format<br>");
    }
  }
  else {
    array_push($error_array, "Emails Dont Match!<br>");
  }

  if(strlen($fname) > 25 || strlen($fname) < 2) {
    array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
  }

  if(strlen($lname) > 25 || strlen($lname) < 2) {
    array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
  }

  if($password != $password2) {
    array_push($error_array, "Your passwords do not match<br>");
  }
  else {
    if(preg_match('/[^A-Za-z0-9]/', $password)) {
      array_push($error_array, "Your password can only contain english characters or numbers<br>");
    }
  }

  if(strlen($password > 30 || strlen($password) < 5 )) {
    array_push($error_array, "Your password must be between 5 and 30 characters<br>");
  }
  // Check if the error array is empty
  if(empty($error_array)) {
		$password = md5($password); //Encrypt password before sending to database

		//Generate username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($connection, "SELECT username FROM users WHERE username='$username'");


		$i = 0;
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($connection, "SELECT username FROM users WHERE username='$username'");
		}

    // Insert details into database
    $query = mysqli_query($connection, "INSERT INTO users VALUES ('$i', '$email', '$fname', '$lname', '$password', '$username')");
  }

}
?>

<?php include "includes/header.php"; ?>

<!-- Showcase Section -->
<section>
  <div class="showcase">

    <div class="showcase-text">
      <h1 id="scribe-heading">Scribe</h1>
      <h2>An elegant application to get your thoughts & tasks down on digital parchment.</h2>
    </div>
  </div>
</section>
<!-- END Showcase -->

<!-- Login Form -->
<section>
  <div id="login-form" class="login">
    <form action="register.php" method="POST">

      <input type="text" name="login_aname" required>
      <br>
      <input type="password" name="login_passowrd" required>
      <br>
      <input id="login-btn" class="button-primary" type="submit" name="login_button" value="Login">
      <br>
      <input id="create-btn" type="button" value="Create Account">
    </form>

  </div>
</section>

<!-- Register Form -->
<section>
  <div id="register-form" class="register hide">
    <h2>Create Account</h2>

    <!-- Sign Up Form -->
    <form action="register.php" method="POST">
      <!-- First Name -->
      <input type="text" name="reg_fname" placeholder="First Name" value="<?php
      if(isset($_SESSION['reg_fname'])) {
        echo $_SESSION['reg_fname'];
      }
      ?>"required>

      <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>

      <!-- Last Name -->
      <input type="text" name="reg_lname" placeholder="Last Name" required>
      <br>
      <?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>
      <!-- Email -->
      <input type="email" name="reg_email" placeholder="Email" required>

      <!-- Email Confirm -->
      <input type="email" name="reg_email2" placeholder="Confirm Email" required>
      <br>
      <?php
        if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
        else if(in_array("Invalid format<br>", $error_array)) echo "Invalid format<br>";
        else if(in_array("Emails Dont Match!<br>", $error_array)) echo "Emails Dont Match!<br>";
      ?>

      <!-- Password -->
      <input type="password" name="reg_password" placeholder="Password" required>

      <!-- Password Confirm -->
      <input type="password" name="reg_password2" placeholder="Confirm Password" required>
      <br>
      <?php
        if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
        else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
        else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>";
      ?>
      <!-- Register Button -->
      <input id="register-btn" class="button-primary" type="submit" name="register_button" value="Register">
    </form>
    <!-- END Login -->

  </div>

  <!-- END Sign Up -->
</section>
<!-- END Register Section -->

<?php include "includes/footer.php"; ?>
