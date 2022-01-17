<?php

$username = $_POST['username'];
$email  = $_POST['email'];
$tel = $_POST['tel'];
$password = $_POST['password'];
$retype-password = $_POST['retype-password'];
if (!empty($username) || !empty($email) || !empty($tel) || !empty($password) || !empty($retype-password))
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "web master 3";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (username , email ,tel, password ,retype-password )values(?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssiss", $username,$email,$tel,$password,$retype-password);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>