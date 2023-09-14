<html>
<head>
</head>
<body>

<?php

$firstname=$_POST['firstName'];
$secondname=$_POST['secondName'];
$phoneno=$_POST['phoneNo'];
$occupation=$_POST['occupation'];
$emailid=$_POST['email'];
$pass=$_POST['password'];
$gender=$_POST['Gender'];

$con=new mysqli('localhost','root','','fms');
if(!$con)
{
die('connection error'.mysqli_error());
}
else
{
$stmt=$con->prepare("insert into  workers(firstname,secondname,phoneno,occupation,emailid,pass,gender) values(?,?,?,?,?,?,?)");
$stmt->bind_param("ssissss",$firstname,$secondname,$phoneno,$occupation,$emailid,$pass,$gender);
$stmt->execute();
$stmt->close();
$con->close();
}
?>
<style>
#sign{
top:50%;
left:25%;
}
#back{
  outline: none;
  border: none;
  cursor: pointer;
  display: inline-block;
  margin: 0 auto;
  padding: 0.9rem 2.5rem;
  text-align: left;
 text-decoration:none;

  background-color: #47AB11;
  color: #fff;
  border-radius: 4px;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
  font-size: 17px;
}
</style>
<div style="margin-top: 200px;">
<center>
<h1 style="color:red;" id="sign">signed in successfully</h1>
<center><img src=tick.png></center>
<a href="BDVJA.html" id="back">BACK</a>
</center>
</div>
</body>
</html>