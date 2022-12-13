<style>
body
{

    background: linear-gradient(to bottom right, blue, pink);    
}

table{
    margin-top:5%;
    border-collapse: collapse;
    background: #dfd8d8;
    color: black;
    font-size: 30px;
}
th, td {
    border: 1px solid orange;
    padding: 10px;
    text-align: left;
  }

  #submit1
{
    background-color: blue;
    border: none;
    width:15%;
    height: 30px;
    border-radius: 10%;
    margin-left: 0%;
    color: white;
    font-size: 20px;
}
</style>
<center >
    <br>
    <h1>STAFF PAGE</h1>
<table border="">
 <tbody>
    <tr>
       <th>student_name</th>
       <th>Student_email</th>
       <th>Age</th>
       <th>BMI_value</th>
    </tr>
    
    <?php
    include 'config.php';
    $a=mysqli_query($conn,"SELECT * FROM user");
    foreach ($a as $b)
    {
    ?>
    <tr>
       <td><?= $b['username']; ?></td>
       <td><?= $b['email']; ?></td>
       <td><?= $b['age']; ?></td>
       <td><?= $b['bmi']; ?></td>
    </tr>  
    <?php } ?>                          
 </tbody>
</table>
<br>
<a href='home.html'><button id="submit1">HOME</button></a>
</center>
