<html><head><title>Forget Password</title></head>
<link rel="stylesheet" href="mystyle.css">
<body>  <center>
<div align="center" style="background-color:#003366;color: white">
 <p style="margin: 0px; font-size: 35px">Forget Password</h1></p></div><br><br><br><br>
<?php
$connection=new mysqli("localhost","root","","debug");
if($_POST)
{
   $username =$_POST['username'];
   $selectquery=mysqli_query($connection,"select * from admins where username='{$username}'") or die(mysqli_error($connection));
   $count =mysqli_num_rows($selectquery);
   $row =mysqli_fetch_array($selectquery);
   if($count>0)
   { ?>
<h2 style="color:white;">Your Password :<?php echo $row['password']; ?></h2></br>
<?php 
}else{ ?>
<h2 style="color:white;"><?php echo "Please Enter Valid Username!!!!"; ?> </h2></br>
<?php 
} 
}
?>

<form method="post">
<input type="text" name="username" placeholder="Enter Your Username">
<br/></br>
<input type="submit" value="Submit">
<center><br><br><a style="color:blue" href="login.php">Go Back</a></center>
</form>
</body> 
</html>