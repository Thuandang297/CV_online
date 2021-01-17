<?php 
include('connectdb.php');
include('error.php');
$errors = array(); // Initialize an error array. #2


	// Check for a  username:
		$username = trim($_POST['username']);
	if (empty($username)) {
		$errors[] = 'You forgot to enter your username.';
	}
	// Check for an email address:
		$email = trim($_POST['email']);
	if (empty($email)) {
		$errors[] = 'You forgot to enter your email address.';
    }
    $sql1="select * from users where email='$email'";
    $result=mysqli_query($conn,$sql1);
    $count=mysqli_num_rows($result);
    if($count>0){
        $errors[] = 'Your email address already used.';
    }
	// Check for a password and match against the confirmed password:
			$password1 = trim($_POST['password1']);
			$password2 = trim($_POST['password2']);
	if (!empty($password1)) {
		if ($password1 !== $password2) { //#4
			$errors[] = 'Your two password did not match.';
		} 
	} else {
		$errors[] = 'You forgot to enter your password.';
    }
    
    if (empty($errors)) {
    //hashing the password
    $hash= password_hash($password1, PASSWORD_DEFAULT); #hash work ok
    //generate randomstrin

    //execute query
    $sql="insert into users(username, email, password)
    VALUES ('$username','$email', '$hash')";
    mysqli_set_charset($conn,'UTF8');
     if(mysqli_query($conn,$sql)){
        $sql1="select id from users where email='$email'";
        $result=mysqli_query($conn,$sql1);
        if(mysqli_num_rows($result)>0){
            $id=mysqli_fetch_assoc($result);
        }   

     $random=mt_srand(6);   

        $to      = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject 
        $message = '
          
        Thanks for signing up!
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
          
        Please click this link to activate your account:
        http://localhost/CVonline/activation.php?email='.$email.'&verified='.$random.'
        ';
        $headers = 'From:Thuandang729@gmail.com' . "\r\n"; 
        mail($to, $subject, $message, $headers); 
        if(mail($to, $subject, $message, $headers)) {  
        echo 'Message has been sent';  
        } else {  
        echo 'Message could not be sent';  
        }  
        header("Location:register-thank.php");
     }
     else{
         $e= mysqli_error($conn);
        header("Location:error.php?error=$e");
     }
    }else { // Report the errors.                                            #13
		$errorstring = "Error! <br /> The following error(s) occurred:<br>";
		foreach ($errors as $msg) { // Print each error.
			$errorstring .= " - $msg<br>";
		}
		$errorstring .= "Please try again.<br>";
        header("Location:error.php?error=$errorstring");
		}// End of if (empty($errors)) IF.






?>