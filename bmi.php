<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "validation");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_POST['submit'])){
    $mail =$_POST['email'];
    $height =$_POST['height'];
    $weight =$_POST['weight'];
    $height=($height/100);
    $bmi=($weight/($height*$height));

// Attempt update query execution
$sql = "UPDATE user SET bmi='$bmi' WHERE email='$mail'";
if(mysqli_query($link, $sql)){
    if($bmi  > 0 && $bmi < 18.7)
    {
        echo "<script>
        alert('BMI VALUE:  $bmi  ||||  UNDER WEIGHT  ||||')
        </script>";
    echo "<meta http-equiv=refresh content=\"0; url=home.html\">";
    }
    else if($bmi > 18.6 && $bmi < 25)
    {
        echo "<script>
        alert('BMI VALUE:  $bmi  ||||  NORMAL WEIGHT  ||||')
        </script>";
        echo "<meta http-equiv=refresh content=\"0; url=home.html\">";
    }
    else{
        echo "<script>
        alert('BMI VALUE:  $bmi  ||||  OVER WEIGHT  ||||')
        </script>";
        echo "<meta http-equiv=refresh content=\"0; url=home.html\">";
    }
    
} else {
    echo "<script>alert('ENTER CORRECT MAIL ID')</script>";
    echo "<meta http-equiv=refresh content=\"0; url=bmi.html\">";
}

}

if(isset($_POST['submitfeedback'])){
    $fmail=$_POST['fmail'];
    $command =$_POST['studentcommand'];

    $sql = "UPDATE user SET feedback='$command' WHERE email='$fmail'";
    if(mysqli_query($link, $sql)){
        echo "<script>alert('FEED BACK UDDATED SUCCESSFULLY')</script>";
        echo "<meta http-equiv=refresh content=\"0; url=home.html\">";
} else {
    echo "<script>alert('ENTER CORRECT MAIL ID ')</script>";
    echo "<meta http-equiv=refresh content=\"0; url=bmi.html\">";
}

}

// Close connection
mysqli_close($link);
?>