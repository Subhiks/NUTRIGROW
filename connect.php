<?php
$message = "";
$sqlQuery = "";
$modalState = "display:none";
$stockInfo = "";
$stockallinfo="";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "validation";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$lemail =$_POST['uname'];
$lpass =$_POST['upswd'];

$sql = "SELECT * FROM user WHERE email = '{$lemail}'";
$result = $conn->query($sql);

while($row = mysqli_fetch_array($result)) {
    $email1     = $row['email'];
    $password1      = $row['password'];
    $permision1  =$row['permision'];
}

$sql = "SELECT * FROM staff WHERE email = '{$lemail}'";
$result = $conn->query($sql);

while($row = mysqli_fetch_array($result)) {
    $email2     = $row['email'];
    $password2      = $row['password'];
    $permision2  =$row['permision'];
}



if($lpass === $password1|| $lpass === $password2 )
{
   if($permision1 === "student")
   {
    echo "<script>alert('login successsfully')</script>";
  	echo "<meta http-equiv=refresh content=\"0; url=bmi.html\">";
   }
   else if($permision2 == 'staff')
   {
    echo "<script>alert('login successsfully')</script>";
  	echo "<meta http-equiv=refresh content=\"0; url=staff.php\">";
   }
   else{
    echo "<script>alert('login successsfully')</script>";
  	echo "<meta http-equiv=refresh content=\"0; url=chirf.php\">";
   }
    
   
}else{
   
   echo "<script>alert('password incorrect')</script>";
   echo "<meta http-equiv=refresh content=\"0; url=login.html\">";
}

?>

