<?php

ob_start(); // Start output buffering

include '../components/connect.php';

if(isset($_POST['submit'])){

   // Sanitize name input (but do not sanitize the password itself)
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS); 

   // Hash the password using password_hash() for better security
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING); // Optional, but avoid sanitizing password too much

   // Prepare and execute the query to fetch the user by name and password
   $select_admins = $conn->prepare("SELECT * FROM `admins` WHERE name = ? LIMIT 1");
   $select_admins->execute([$name]);
   $row = $select_admins->fetch(PDO::FETCH_ASSOC);

   if($select_admins->rowCount() > 0){
      // Verify the password using password_verify()
      if(password_verify($pass, $row['password'])){
         // Set the admin_id cookie if login is successful
         setcookie('admin_id', $row['id'], time() + 60*60*24*30, '/');
         header('location:dashboard.php');
         exit(); // Ensure no further code is executed after redirect
      } else {
         $warning_msg[] = 'Incorrect username or password!';
      }
   } else {
      $warning_msg[] = 'Incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<!-- login section starts  -->

<section class="form-container" style="min-height: 100vh;">

   <form action="" method="POST">
      <h3>welcome back!</h3>
      <p>default name = <span>admin</span> & password = <span>111</span></p>
      <input type="text" name="name" placeholder="enter username" maxlength="20" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" placeholder="enter password" maxlength="20" class="box" required oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>

<!-- login section ends -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include '../components/message.php'; ?>

</body>
</html>

<?php ob_end_flush(); // End output buffering ?>
