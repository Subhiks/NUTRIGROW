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


if ($conn === false) {
    die("Connection failed: ". mysqli_connect_error());
}



if(isset($_POST['submit'])){
    $username =$_POST['uname1'];
    $mail =$_POST['email'];
    $password =$_POST['upswd1'];
    $conformpassword =$_POST['upswd2'];
    $age =$_POST['age'];
    $favourite =$_POST['food1'];
    $perferable =$_POST['meal'];
    $per =$_POST['per'];
if($per=='student')
{
    $sql = "SELECT * FROM user WHERE email = '{$mail}'";
    $result = $conn->query($sql);
    
    if($password == $conformpassword)
    {
        while($row = mysqli_fetch_array($result)) {
            $c            = $row['username'];
            $email     = $row['email'];
            $password      = $row['password'];
            $age         = $row['age'];
            $favouritefood   = $row['favouritefood'];
            $perferablemeals     = $row['perferablemeals'];
            $permision       =$row['permision'];
        
    }
        
            if($email == $mail)
            {
                echo "<script>alert('this mailid is already in the database')</script>";
                echo "<meta http-equiv=refresh content=\"0; url=register.html\">";
            } else{
                $sqlQuery = "INSERT INTO user (username, email, password, age, favouritefood, perferablemeals,permision) VALUES ('$username', '$mail', '$password', $age, '$favourite', '$perferable','$per')";
            }
        
        
            if(mysqli_query($conn, $sqlQuery)){
                echo "<script>alert('register successsfully')</script>";
                  echo "<meta http-equiv=refresh content=\"0; url=login.html\">";
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
            $modalState = "display:flex";
    }
    else
    {
        echo "<script>alert('the password and conformpssword must be same')</script>";
          echo "<meta http-equiv=refresh content=\"0; url=register.html\">";
    }
}
    
else{

    $sql = "SELECT * FROM staff WHERE email = '{$mail}'";
    $result = $conn->query($sql);
    
    if($password == $conformpassword)
    {
        while($row = mysqli_fetch_array($result)) {
            $c            = $row['username'];
            $email     = $row['email'];
            $password      = $row['password'];
            $age         = $row['age'];
            $favouritefood   = $row['favouritefood'];
            $perferablemeals     = $row['perferablemeals'];
            $permision       =$row['permision'];
        
    }
        
            if($email == $mail)
            {
                echo "<script>alert('this mailid is already in the database')</script>";
                echo "<meta http-equiv=refresh content=\"0; url=register.html\">";
            } else{
                $sqlQuery = "INSERT INTO staff (username, email, password, age, favouritefood, perferablemeals,permision) VALUES ('$username', '$mail', '$password', $age, '$favourite', '$perferable','$per')";
            }
        
        
            if(mysqli_query($conn, $sqlQuery)){
                echo "<script>alert('register successsfully')</script>";
                  echo "<meta http-equiv=refresh content=\"0; url=login.html\">";
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
            $modalState = "display:flex";
    }
    else
    {
        echo "<script>alert('the password and conformpssword must be same')</script>";
          echo "<meta http-equiv=refresh content=\"0; url=register.html\">";
    }
}


}

$conn->close();
?>