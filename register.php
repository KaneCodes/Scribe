<?php
// Requirements
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
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

      <input type="email" name="login_email" required>
      <br>
      <input type="password" name="login_password" required>
      <br>
      <input id="login-btn" class="button-primary" type="submit" name="login_button" value="Login">
      <br>
      <input id="create-btn" type="button" value="Create Account">

      <?php if(in_array("Email or Password is incorrect!", $error_array)) echo "<br>Email or Password is incorrect!"; ?>
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
      <input type="text" name="reg_fname" placeholder="First Name" required>

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
      <br>
      <?php if(in_array("<span>Sign up succussful!</span><br>", $error_array)) echo "<span>Sign up succussful!</span><br>"; ?>
    </form>
    <!-- END Login -->

  </div>

  <!-- END Sign Up -->
</section>
<!-- END Register Section -->

<?php include "includes/footer.php"; ?>
