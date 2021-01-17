<?php

$email=trim($_POST['email']);
$subject=trim($_POST['subject']);
$message=trim($_POST['message']);
$headers="Thuandang";
mail($email, $subject, $message, $headers); 
?>