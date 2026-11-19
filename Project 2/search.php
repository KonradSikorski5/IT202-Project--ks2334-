<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Search A Moving Company Representative's Account</title>
<link rel="stylesheet" href="project2.css">
</head>
<body>
<?php include "nav.php"; ?>

<h1>Moving Company Representative's Account</h1>

<?php
$repId = $_SESSION['repId'];

$query = "SELECT MovingRep.RepFirstName, MovingRep.RepLastName, MovingRep.RepID, MovingRep.RepPhone, MovingRep.RepEmail,
Client.ClientFirstName, Client.ClientLastName, Client.ClientID,
ClientInfo.ClientStreetNumber, ClientInfo.ClientStreetName, ClientInfo.ClientCity, ClientInfo.ClientState, ClientInfo.ClientZip, ClientInfo.ClientPhone,
MovingEvent.MovingID, MovingEvent.MoveToStreetNumber, MovingEvent.MoveToStreetName, MovingEvent.MoveToCity, MovingEvent.MoveToState, MovingEvent.MoveToZip,
MovingEvent.MovingDate, MovingEvent.TotalWeight, MovingEvent.TotalCost,
SpecialInstructions.PackingInstructions
FROM MovingRep
INNER JOIN RepClient ON MovingRep.RepID = RepClient.RepID
INNER JOIN Client ON RepClient.ClientID = Client.ClientID
LEFT JOIN ClientInfo ON Client.ClientID = ClientInfo.ClientID
LEFT JOIN MovingEvent ON Client.ClientID = MovingEvent.ClientID AND MovingRep.RepID = MovingEvent.RepID
LEFT JOIN SpecialInstructions ON MovingEvent.MovingID = SpecialInstructions.MovingID
WHERE MovingRep.RepID = '$repId'";

$result = mysqli_query($con, $query);

echo "<table>
<tr>
<th>Rep Name</th><th>Rep ID</th><th>Rep Phone</th><th>Rep Email</th>
<th>Client Name</th><th>Client ID</th>
<th>Street Number</th><th>Street Name</th><th>City</th><th>State</th><th>Zip</th><th>Client Phone</th>
<th>Moving ID</th><th>New Street Number</th><th>New Street Name</th><th>New City</th><th>New State</th><th>New Zip</th>
<th>Moving Date</th><th>Weight</th><th>Cost</th><th>Special Instructions</th>
</tr>";

while ($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['RepFirstName'] . " " . $row['RepLastName'] . "</td>";
    echo "<td>" . $row['RepID'] . "</td>";
    echo "<td>" . $row['RepPhone'] . "</td>";
    echo "<td>" . $row['RepEmail'] . "</td>";
    echo "<td>" . $row['ClientFirstName'] . " " . $row['ClientLastName'] . "</td>";
    echo "<td>" . $row['ClientID'] . "</td>";
    echo "<td>" . $row['ClientStreetNumber'] . "</td>";
    echo "<td>" . $row['ClientStreetName'] . "</td>";
    echo "<td>" . $row['ClientCity'] . "</td>";
    echo "<td>" . $row['ClientState'] . "</td>";
    echo "<td>" . $row['ClientZip'] . "</td>";
    echo "<td>" . $row['ClientPhone'] . "</td>";
    echo "<td>" . $row['MovingID'] . "</td>";
    echo "<td>" . $row['MoveToStreetNumber'] . "</td>";
    echo "<td>" . $row['MoveToStreetName'] . "</td>";
    echo "<td>" . $row['MoveToCity'] . "</td>";
    echo "<td>" . $row['MoveToState'] . "</td>";
    echo "<td>" . $row['MoveToZip'] . "</td>";
    echo "<td>" . $row['MovingDate'] . "</td>";
    echo "<td>" . $row['TotalWeight'] . "</td>";
    echo "<td>" . $row['TotalCost'] . "</td>";
    echo "<td>" . $row['PackingInstructions'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>

</body>
</html>