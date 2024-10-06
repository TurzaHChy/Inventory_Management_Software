<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   
   if($select_user->rowCount() > 0){
      $message[] = 'email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password) VALUES(?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $cpass]);
         
         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);
         
         if($verify_user->rowCount() > 0){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:index.php');
         }
      }
   }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="css/matrix-login.css"/>
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
    <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message" style="color: white; text-align:center; font-size:20px;">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div id="loginbox">
    <form id="loginform" class="form-vertical" action="" method="post" enctype="multipart/form-data">
        <div class="control-group normal_text"><h3>Register Page</h3></div>
        
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span>
                    <input type="text" name="name" placeholder="enter your name" maxlength="50" required/>
                    <span class="add-on bg_lg"><i class="icon-envelope"> </i></span>
                    <input type="email" name="email" placeholder="enter your email" 
                    maxlength="255" required/>
                    
                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-lock"></i></span>
                    <input type="password" name="pass" placeholder="enter your password" maxlength="20" required/>
                    <span class="add-on bg_lg"><i class="icon-lock"></i></span>
                    <input type="password" name="cpass" placeholder="Confirm your password" maxlength="20" required/>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <span class="pull-left">
                <input type="submit" name="submit" value="Register" class="btn btn-success">
            </span>
            <span class="pull-right"><a href="login.php" class="flip-link btn btn-info" id="to-recover">Login</a></span>
        </div>
    </form>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/matrix.login.js"></script>
</body>

</html>
