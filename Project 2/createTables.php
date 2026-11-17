<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Create Tables</title>
</head>
<body>

<?php
include "db.php";

$query1 = "CREATE TABLE MovingRep (
    RepID VARCHAR(4) NOT NULL PRIMARY KEY,
    RepFirstName VARCHAR(30) NOT NULL,
    RepLastName VARCHAR(30) NOT NULL,
    RepPassword VARCHAR(7) NOT NULL,
    RepPhone VARCHAR(25) NOT NULL,
    RepEmail VARCHAR(50) NOT NULL
)";
$createtable = mysqli_query($con, $query1);

$query2 = "CREATE TABLE Client (
    ClientID VARCHAR(4) NOT NULL PRIMARY KEY,
    ClientFirstName VARCHAR(30) NOT NULL,
    ClientLastName VARCHAR(30) NOT NULL
)";
$createtable = mysqli_query($con, $query2);

$query3 = "CREATE TABLE RepClient (
    RepID VARCHAR(4) NOT NULL,
    ClientID VARCHAR(4) NOT NULL,
    PRIMARY KEY (RepID, ClientID)
)";
$createtable = mysqli_query($con, $query3);

$query4 = "CREATE TABLE ClientInfo (
    ClientID VARCHAR(4) NOT NULL PRIMARY KEY,
    ClientStreetNumber VARCHAR(6) NOT NULL,
    ClientStreetName VARCHAR(40) NOT NULL,
    ClientCity VARCHAR(30) NOT NULL,
    ClientState VARCHAR(2) NOT NULL,
    ClientZip VARCHAR(5) NOT NULL,
    ClientPhone VARCHAR(12) NOT NULL
)";
$createtable = mysqli_query($con, $query4);

$query5 = "CREATE TABLE MovingEvent (
    MovingID VARCHAR(5) NOT NULL PRIMARY KEY,
    RepID VARCHAR(4) NOT NULL,
    ClientID VARCHAR(4) NOT NULL,
    MoveToStreetNumber VARCHAR(6) NOT NULL,
    MoveToStreetName VARCHAR(40) NOT NULL,
    MoveToCity VARCHAR(30) NOT NULL,
    MoveToState VARCHAR(2) NOT NULL,
    MoveToZip VARCHAR(5) NOT NULL,
    MovingDate VARCHAR(20) NOT NULL,
    TotalWeight VARCHAR(15) NOT NULL,
    MilesForMove VARCHAR(10) NOT NULL,
    TotalCost VARCHAR(15) NOT NULL
)";
$createtable = mysqli_query($con, $query5);

$query6 = "CREATE TABLE SpecialInstructions (
    MovingID VARCHAR(5) NOT NULL PRIMARY KEY,
    PackingInstructions VARCHAR(500) NOT NULL
)";
$createtable = mysqli_query($con, $query6);

echo "<p>Finished. Open printTables.php to check your tables.</p>";

mysqli_close($con);
?>

</body>
</html>