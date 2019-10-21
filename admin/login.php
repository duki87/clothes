<?php
  require_once $_SERVER['DOCUMENT_ROOT']. '/clothes/core/init.php';
  include 'includes/head.php';

  $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
  $email = trim($email);
  $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
  $password = trim($password);
  $errors = array();
  ?>
<style>
  body {
    background-image: url("/clothes/img/headerlogo/background.png");
    background-size: 100vw 100vh;
    background-attachment: fixed;
  }
</style>
<div id="login-form">
  <div>
    <?php
      if($_POST) {
        //Form validation
        if(empty($_POST['email']) || empty($_POST['password'])) {
          $errors[] = 'You must provide e-mail and password.';
        }

        //Validate email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors[] = 'You must enter a valid e-mail';
        }

        //Password is more than 6 characters
        if(strlen($password)<6) {
          $errors[] = 'Password must be at least 6 characters.';
        }

        //Check if email exists in db
        $query = $db->query("SELECT * FROM users WHERE email = '$email'");
        $user = mysqli_fetch_assoc($query);
        $userCount = mysqli_num_rows($query);
        if($userCount < 1) {
          $errors[] = 'That email doesn\'t exist in database.';
        }

        if(!password_verify($password, $user['password'])) {
          $errors[] = 'The password doesn\'t match with email. Please try again.';
        }

        //Check for errors
        if(!empty($errors)) {
          echo display_errors($errors);
        } else {
          //Log user in
            $user_id = $user['id'];
            login($user_id);
        }
      }
    ?>
  </div>
  <h2 class="text-center">Login</h2><hr>
  <form class="" action="login.php" method="post">
    <div class="form-group">
      <label for="email">E-mail:</label>
      <input type="text" name="email" value="<?=$email; ?>" id="email" class="form-control">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" value="<?=$password; ?>" id="password" class="form-control">
    </div>
    <div class="form-group">
      <input type="submit" name="" value="Login" class="btn btn-primary">
    </div>
  </form>
  <p class="text-right"><a href="/clothes/index.php" alt="home">Visit Site</a></p>
</div>

<?php include 'includes/footer.php'; ?>
