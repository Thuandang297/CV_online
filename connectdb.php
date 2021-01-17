<?php 
$conn=new mysqli("localhost","root","","users");
if($conn->connect_error)
{
    die ('Connect Impossible'.$conn->connect_error);
}
else{
    echo "Connect Succesfully";
}
?>