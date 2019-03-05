<?php
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
$error_array = "";

// Check if form submitted
if (isset($_POST['register_button'])) {

  // Registration form values

  // First name
  $fname = strip_tags($_POST['reg_fname']); // Remove HTML tags
  $fname = str_replace(' ', '', $fname); // Remove spaces
  $fname = ucfirst(strtolower($fname)); // Uppercase first letter

  // Last name
  $lname = strip_tags($_POST['reg_lname']); // Remove HTML tags
  $lname = str_replace(' ', '', $lname); // Remove spaces
  $lname = ucfirst(strtolower($lname)); // Uppercase first letter

  // Email
  $email = strip_tags($_POST['reg_email']); // Remove HTML tags
  $email = str_replace(' ', '', $email); // Remove spaces
  $email = ucfirst(strtolower($email)); // Uppercase first letter

  // Email confirm
  $email2 = strip_tags($_POST['reg_email']); // Remove HTML tags
  $email2 = str_replace(' ', '', $email2); // Remove spaces
  $email2 = ucfirst(strtolower($email2)); // Uppercase first letter

  // Passwords
  $password = strip_tags($_POST['reg_password']); // Remove HTML tags
  $password2 = strip_tags($_POST['reg_password2']); // Remove HTML tags

  $date = date("Y-m-d"); // Current date
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

<!-- Register / Login Section -->
<section>
  <div class="register">
    <h2>Create Account</h2>

    <!-- Sign Up Form -->
    <form action="register.php" method="POST">
      <!-- First Name -->
      <input type="text" name="reg_fname" placeholder="First Name" required>
      <!-- Last Name -->
      <input type="text" name="reg_lname" placeholder="Last Name" required>
      <br>
      <!-- Email -->
      <input type="email" name="reg_email" placeholder="Email" required>
      <!-- Email Confirm -->
      <input type="email" name="reg_email2" placeholder="Confirm Email" required>
      <br>
      <!-- Password -->
      <input type="password" name="reg_password" placeholder="Password" required>
      <!-- Password Confirm -->
      <input type="password" name="reg_password2" placeholder="Confirm Password" required>
      <br>
      <!-- Register Button -->
      <input id="register-btn" class="button-primary" type="submit" name="register_button" value="Register">
    </form>
    <!-- END Login -->


  </div>
  <!-- END Sign Up -->
</section>
<!-- END Register Section -->

<?php include "includes/footer.php"; ?>
