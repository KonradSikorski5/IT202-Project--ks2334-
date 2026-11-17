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

$query10 = "INSERT INTO ClientInfo (ClientID, ClientStreetNumber, ClientStreetName, ClientCity, ClientState, ClientZip, ClientPhone) VALUES
('7001', '14', 'Maple Avenue', 'Newark', 'NJ', '07102', '973-555-0101'),
('7002', '220', 'Oak Street', 'Jersey City', 'NJ', '07302', '201-555-0102'),
('7003', '9', 'Elm Court', 'Hoboken', 'NJ', '07030', '201 555 0103'),
('7004', '310', 'Pine Road', 'Montclair', 'NJ', '07042', '973-555-0104'),
('7005', '57', 'Cedar Lane', 'Paterson', 'NJ', '07501', '973 555 0105'),
('7006', '1200', 'River Drive', 'Clifton', 'NJ', '07013', '973-555-0106'),
('7007', '45', 'Park Place', 'Morristown', 'NJ', '07960', '862-555-0107'),
('7008', '8', 'Spruce Street', 'Princeton', 'NJ', '08540', '609-555-0108'),
('7009', '76', 'Main Street', 'Trenton', 'NJ', '08608', '609 555 0109'),
('7010', '501', 'Broad Street', 'Elizabeth', 'NJ', '07201', '908-555-0110'),
('7011', '33', 'Hill Road', 'Edison', 'NJ', '08817', '732-555-0111'),
('7012', '19', 'Lake Drive', 'Wayne', 'NJ', '07470', '973-555-0112')
";
$insertdata = mysqli_query($con, $query10);

$query11 = "INSERT INTO MovingEvent (MovingID, RepID, ClientID, MoveToStreetNumber, MoveToStreetName, MoveToCity, MoveToState, MoveToZip, MovingDate, TotalWeight, MilesForMove, TotalCost) VALUES
('48213', '1234', '7001', '88', 'Ocean Avenue', 'Long Branch', 'NJ', '07740', '12/05/2026', '2500 lbs', '35', '$1250.00'),
('51907', '2345', '7001', '5', 'Harbor Way', 'Asbury Park', 'NJ', '07712', '01/10/2027', '800 lbs', '40', '$600.00'),
('60342', '1234', '7002', '410', 'Sunset Boulevard', 'Cherry Hill', 'NJ', '08002', '12/12/2026', '3200 lbs', '90', '$2100.00'),
('72815', '2345', '7003', '27', 'Willow Way', 'Summit', 'NJ', '07901', '12/19/2026', '1500 lbs', '20', '$850.00'),
('39466', '3456', '7004', '602', 'Bay Street', 'Toms River', 'NJ', '08753', '01/03/2027', '4100 lbs', '75', '$2600.00'),
('84150', '4567', '7005', '15', 'Garden Court', 'Fort Lee', 'NJ', '07024', '01/09/2027', '1800 lbs', '15', '$900.00'),
('25683', '4567', '7006', '300', 'Valley Road', 'Wayne', 'NJ', '07470', '01/16/2027', '2700 lbs', '10', '$1100.00'),
('93071', '5678', '7007', '72', 'Ridge Road', 'Parsippany', 'NJ', '07054', '01/23/2027', '2200 lbs', '12', '$1000.00'),
('16529', '6789', '7008', '140', 'College Avenue', 'New Brunswick', 'NJ', '08901', '02/06/2027', '1200 lbs', '18', '$750.00'),
('57348', '7890', '7009', '11', 'Shore Road', 'Ocean City', 'NJ', '08226', '02/13/2027', '3600 lbs', '95', '$2400.00'),
('68204', '8901', '7010', '230', 'North Avenue', 'Westfield', 'NJ', '07090', '02/20/2027', '2000 lbs', '8', '$950.00'),
('41976', '9012', '7011', '64', 'Church Street', 'Flemington', 'NJ', '08822', '02/27/2027', '2900 lbs', '30', '$1500.00'),
('30815', '1357', '7012', '502', 'Highland Avenue', 'Bloomfield', 'NJ', '07003', '03/06/2027', '1600 lbs', '14', '$800.00')
";
$insertdata = mysqli_query($con, $query11);

echo "<p>Finished. Open printTables.php to check your tables.</p>";

mysqli_close($con);
?>

</body>
</html>