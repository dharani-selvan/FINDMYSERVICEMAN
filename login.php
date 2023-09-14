<html>
<head>
<style>
table {
  border-collapse: collapse; 
  width: 100%; 
  text-align: center;
}
td, th {
  border: 1px solid black;
  padding: 8px;
}
th {
  background-color: #ddd;
}
#back{
  outline: none;
  border: none;
  cursor: pointer;
  display: inline-block;
  margin: 0 auto;
  padding: 0.3rem 0.5rem;
  text-align: left;
 text-decoration:none;

  background-color: #47AB11;
  color: #fff;
  border-radius: 4px;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
  font-size: 17px;
}


</style>
</head>
<body>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fms";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$email = $_POST['email'];
$sql = "SELECT occupation FROM workers WHERE emailid='$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$occupation = $row['occupation'];

$sql = "SELECT * FROM user WHERE occupation='$occupation'";
$result = mysqli_query($conn, $sql);

echo "<table>";
echo "<tr><th>First Name</th><th>Second Name</th><th>Phone Number</th><th>Occupation</th><th>Description</th><th>Address</th><th>Action</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['secondName'] . "</td>";
    echo "<td>" . $row['phoneNo'] . "</td>";
    echo "<td>" . $row['occupation'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
echo "<td>";
echo "<a href='accept.php?job_id=" . $row['id'] . " 'style='text-decoration:none;' id=back>accept</a>";
echo "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br>";
echo"<center><a href='BDVJA.html' id='back'>BACK</a></center>";

mysqli_close($conn);
?>
</body>
</html>
