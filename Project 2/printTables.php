<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Print Tables</title>
</head>
<body>

<?php
include "db.php";

echo "<h2>MovingRep</h2>";
$printdata = mysqli_query($con, "SELECT * FROM MovingRep");
echo "<table border='1'>
<tr><th>RepID</th><th>First Name</th><th>Last Name</th><th>Password</th><th>Phone</th><th>Email</th></tr>";
while ($row = mysqli_fetch_array($printdata))
{
    echo "<tr>";
    echo "<td>" . $row['RepID'] . "</td>";
    echo "<td>" . $row['RepFirstName'] . "</td>";
    echo "<td>" . $row['RepLastName'] . "</td>";
    echo "<td>" . $row['RepPassword'] . "</td>";
    echo "<td>" . $row['RepPhone'] . "</td>";
    echo "<td>" . $row['RepEmail'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>Client</h2>";
$printdata = mysqli_query($con, "SELECT * FROM Client");
echo "<table border='1'>
<tr><th>ClientID</th><th>First Name</th><th>Last Name</th></tr>";
while ($row = mysqli_fetch_array($printdata))
{
    echo "<tr>";
    echo "<td>" . $row['ClientID'] . "</td>";
    echo "<td>" . $row['ClientFirstName'] . "</td>";
    echo "<td>" . $row['ClientLastName'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>RepClient</h2>";
$printdata = mysqli_query($con, "SELECT * FROM RepClient");
echo "<table border='1'>
<tr><th>RepID</th><th>ClientID</th></tr>";
while ($row = mysqli_fetch_array($printdata))
{
    echo "<tr>";
    echo "<td>" . $row['RepID'] . "</td>";
    echo "<td>" . $row['ClientID'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>ClientInfo</h2>";
$printdata = mysqli_query($con, "SELECT * FROM ClientInfo");
echo "<table border='1'>
<tr><th>ClientID</th><th>Street Number</th><th>Street Name</th><th>City</th><th>State</th><th>Zip</th><th>Phone</th></tr>";
while ($row = mysqli_fetch_array($printdata))
{
    echo "<tr>";
    echo "<td>" . $row['ClientID'] . "</td>";
    echo "<td>" . $row['ClientStreetNumber'] . "</td>";
    echo "<td>" . $row['ClientStreetName'] . "</td>";
    echo "<td>" . $row['ClientCity'] . "</td>";
    echo "<td>" . $row['ClientState'] . "</td>";
    echo "<td>" . $row['ClientZip'] . "</td>";
    echo "<td>" . $row['ClientPhone'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>MovingEvent</h2>";
$printdata = mysqli_query($con, "SELECT * FROM MovingEvent");
echo "<table border='1'>
<tr><th>MovingID</th><th>RepID</th><th>ClientID</th><th>Street Number</th><th>Street Name</th><th>City</th><th>State</th><th>Zip</th><th>Moving Date</th><th>Weight</th><th>Miles</th><th>Cost</th></tr>";
while ($row = mysqli_fetch_array($printdata))
{
    echo "<tr>";
    echo "<td>" . $row['MovingID'] . "</td>";
    echo "<td>" . $row['RepID'] . "</td>";
    echo "<td>" . $row['ClientID'] . "</td>";
    echo "<td>" . $row['MoveToStreetNumber'] . "</td>";
    echo "<td>" . $row['MoveToStreetName'] . "</td>";
    echo "<td>" . $row['MoveToCity'] . "</td>";
    echo "<td>" . $row['MoveToState'] . "</td>";
    echo "<td>" . $row['MoveToZip'] . "</td>";
    echo "<td>" . $row['MovingDate'] . "</td>";
    echo "<td>" . $row['TotalWeight'] . "</td>";
    echo "<td>" . $row['MilesForMove'] . "</td>";
    echo "<td>" . $row['TotalCost'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>SpecialInstructions</h2>";
$printdata = mysqli_query($con, "SELECT * FROM SpecialInstructions");
echo "<table border='1'>
<tr><th>MovingID</th><th>Packing Instructions</th></tr>";
while ($row = mysqli_fetch_array($printdata))
{
    echo "<tr>";
    echo "<td>" . $row['MovingID'] . "</td>";
    echo "<td>" . $row['PackingInstructions'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>

</body>
</html>