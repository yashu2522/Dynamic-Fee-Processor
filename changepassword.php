<?php
session_start();
$conn=mysqli_connect("localhost","root","","fee");
$user_id = $_SESSION['name'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($conn, $_POST['name']);
   $update_email = mysqli_real_escape_string($conn, $_POST['email']);
   $update_codechefid=mysqli_real_escape_string($conn, $_POST['codechefid']);
   mysqli_query($conn, "UPDATE `userprofiles` SET name = '$update_name', email = '$update_email',codechefid=' $update_codechefid' WHERE regno = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE regno = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php require '_nav.php' ?>
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `userprofiles` WHERE regno = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">

      <div class="flex">
         <div class="inputBox">
            <span>name :</span>
            <input type="text" name="name" value="<?php echo $fetch['name']; ?>" class="box"><br>
            <span>your email :</span>
            <input type="email" name="email" value="<?php echo $fetch['email']; ?>" class="box"><br>
            <span>CodeChef ID:</span>
            <input type="text" name="codechefid" value="<?php echo $fetch['codechefid']; ?>" class="box"><br>
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="profile.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>