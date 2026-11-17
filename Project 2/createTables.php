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

$query7 = "INSERT INTO MovingRep (RepID, RepFirstName, RepLastName, RepPassword, RepPhone, RepEmail) VALUES
('1234', 'John', 'Doe', '!Abc@12', '555-555-5555 ext 555', 'john@ll.com'),
('2345', 'Jane', 'Smith', '#Mov!7', '201-555-1111 ext 101', 'jane@mou.com'),
('3456', 'Barry', 'Box', '@Box#99', '973-555-2222 ext 22', 'barry@mou.com'),
('4567', 'Maria', 'Lopez', '!Van&5', '732-555-3333 ext 3', 'maria@mou.org'),
('5678', 'Tom', 'Brown', '%Truk&1', '908-555-4444 ext 404', 'tom@mou.net'),
('6789', 'Linda', 'Green', '&Lift*2', '856-555-5555 ext 55', 'linda@mou.com'),
('7890', 'Kevin', 'White', '*Pack^3', '609-555-6666 ext 6', 'kevin@mou.info'),
('8901', 'Sara', 'Black', '^Load!4', '551-555-7777 ext 707', 'sara@mou.com'),
('9012', 'Mike', 'Gray', '%Haul@8', '862-555-8888 ext 88', 'mike@mou.com'),
('1357', 'Anna', 'Reed', '#Ship@6', '848-555-9999 ext 9', 'anna@mou.com')
";
$insertdata = mysqli_query($con, $query7);

$query8 = "INSERT INTO Client (ClientID, ClientFirstName, ClientLastName) VALUES
('7001', 'Daniel', 'Okoro'),
('7002', 'Priya', 'Shah'),
('7003', 'Marcus', 'Bell'),
('7004', 'Elena', 'Rossi'),
('7005', 'Owen', 'Hart'),
('7006', 'Grace', 'Kim'),
('7007', 'Luis', 'Ortega'),
('7008', 'Hannah', 'Weiss'),
('7009', 'Samuel', 'Grant'),
('7010', 'Nina', 'Patel'),
('7011', 'Victor', 'Chen'),
('7012', 'Rachel', 'Moore')
";
$insertdata = mysqli_query($con, $query8);

$query9 = "INSERT INTO RepClient (RepID, ClientID) VALUES
('1234', '7001'),
('1234', '7002'),
('2345', '7001'),
('2345', '7003'),
('3456', '7004'),
('4567', '7005'),
('4567', '7006'),
('5678', '7007'),
('6789', '7008'),
('7890', '7009'),
('8901', '7010'),
('9012', '7011'),
('1357', '7012')
";
$insertdata = mysqli_query($con, $query9);

echo "<p>Finished. Open printTables.php to check your tables.</p>";

mysqli_close($con);
?>

</body>
</html>