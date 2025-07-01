<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   // Hanya semak dalam table admin
   $admin_check = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email' AND password = '$pass'");

   if (mysqli_num_rows($admin_check) > 0) {
      $admin = mysqli_fetch_array($admin_check);
      $_SESSION['admin_name'] = $admin['name'];
      header('<location:admin_page.php');
      exit;
   } else {
      $error[] = 'Incorrect admin email or password!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>
   <link rel="stylesheet" href="css/stylelogin.css">
</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Admin Login</h3>
      <?php
      if(isset($error)){
         foreach($error as $err){
            echo '<span class="error-msg">'.$err.'</span>';
         }
      }
      ?>
      <input type="email" name="email" required placeholder="enter your admin email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <!-- Tiada link untuk daftar -->
   </form>

</div>

</body>
</html>
