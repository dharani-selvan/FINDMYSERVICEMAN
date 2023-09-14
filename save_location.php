<html>
<head>
</head>
<body>
<?php
$host = 'localhost';
$dbname = 'fms';
$username = 'root';
$password = '';

$firstname = $_POST['firstName'];
$secondname = $_POST['secondName'];
$phoneno = $_POST['phoneNo'];
$occupation = $_POST['occupation'];
$description = $_POST['description'];


try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("INSERT INTO user (firstName, secondName, phoneNo, occupation, description, latitude, longitude, address) VALUES (:firstname, :secondname, :phoneno, :occupation, :description, :lat, :lng, :address)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':secondname', $secondname);
    $stmt->bindParam(':phoneno', $phoneno);
    $stmt->bindParam(':occupation', $occupation);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':lat', $lat);
    $stmt->bindParam(':lng', $lng);
    $stmt->bindParam(':address', $address);
    $stmt->execute();
  }
} catch (PDOException $e) {
  die('Database connection failed: ' . $e->getMessage());
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
<h1 style="color:red;" id="sign">Complaint registered successfully</h1>
<center><img src=tick.png></center>
<a href="BDVJA.html" id="back">BACK</a>
</center>
</div>
</body>
</html>
