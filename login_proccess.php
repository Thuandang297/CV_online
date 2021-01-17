<?php
   include("connectdb.php");
   session_start();
// Check for an email address:
    $email = trim($_POST['email']);
if (empty($email)) {
    $errors[] = 'You forgot to enter your email address.';
}
$password=trim($_POST['password']);
if(empty($password))
{
    $errors[]='You forgot to enter password';
}
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      // tên_người_dùng và mật_khẩu được gửi từ form 
      
      $email=mysqli_real_escape_string($conn,$_POST['email']);
      $password=mysqli_real_escape_string($conn,$_POST['password']); 
     echo $password;
      
      $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
      $result=mysqli_query($conn,$sql);
      $row = $result -> fetch_assoc();
      $count=mysqli_num_rows($result);
      echo $count;
      
      // nếu kết quả là so khớp với $myusername và $mypassword, sẽ có
      // một hàng kết quả
		
      if($count==1)
      {
         $_SESSION['email']=$email;
         
         header("location: index.html");
      }
      else 
      {
         $error="Tên đăng nhập và mật khẩu không hợp lệ";
      }
   }
?>