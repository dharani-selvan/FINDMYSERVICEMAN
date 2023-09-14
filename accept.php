<!DOCTYPE html>
<html>
<head>
    <title>Second Page</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAX-rWenGyj1xw4Fw5UMdnCK6K1SoQVUBQ&callback=initMap"></script>
    <script>
        function initMap() {
            var startLatLng = new google.maps.LatLng(10.9325951, 78.7338391);
            var mapProp = {
                center: startLatLng,
                zoom: 13,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var directionsService = new google.maps.DirectionsService();
            var directionsDisplay = new google.maps.DirectionsRenderer();
            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById('directionsPanel'));

            document.getElementById('getDirectionsBtn').addEventListener('click', function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            });

            calculateAndDisplayRoute(directionsService, directionsDisplay); // Automatically calculate and display route on page load
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            var startLatLng = new google.maps.LatLng(10.9325951, 78.7338391);
            var end = document.getElementById('end').value;

            directionsService.route({
                origin: startLatLng,
                destination: end,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>
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

    $job_id = isset($_GET['job_id']) ? $_GET['job_id'] : null;

    if ($job_id) {
        $sql = "SELECT * FROM user WHERE id='$job_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<table>";
            echo "<tr><th>First Name</th><th>Second Name</th><th>Phone Number</th><th>Occupation</th><th>Description</th><th>Address</th></tr>";
            echo "<tr>";
            echo "<td>" . $row['firstName'] . "</td>";
            echo "<td>" . $row['secondName'] . "</td>";
            echo "<td>" . $row['phoneNo'] . "</td>";
            echo "<td>" . $row['occupation'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo
"<td id='start'>" . $row['address'] . "</td>";
echo "</tr>";
echo "</table>";
echo "<h1>Go to the address:</h1><br>" . $row['address'];
} else {
echo "No job found with ID: $job_id";
}
} else {
echo "No job ID provided.";
}mysqli_close($conn);
?>

<div id="googleMap" style="width: 100%; height: 400px;"></div>
<div>
    <label for="end">Destination is:</label>
    <input type="text" id="end" value="<?php echo $row['address']; ?>" readonly>
    <button id="getDirectionsBtn">Get Directions</button>
</div>
<div id="directionsPanel"></div>

<script>
    initMap();
</script>
</body>
</html>