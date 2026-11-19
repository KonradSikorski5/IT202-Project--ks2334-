<?php
session_start();
include "db.php";

if (!isset($_SESSION['clientId']))
{
    echo '<script>alert("Please verify the client first."); window.location = "verifyClient.php";</script>';
    exit();
}

$clientId = $_SESSION['clientId'];
$result = mysqli_query($con, "SELECT * FROM Client WHERE ClientID = '$clientId'");
$client = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book a Client's Moving Event</title>
<link rel="stylesheet" href="project2.css">
<script src="project2.js"></script>
</head>
<body>
<?php include "nav.php"; ?>

<form id="bookForm" name="bookForm" action="book.php" method="POST" onsubmit="return validateBook();">
    <h1>Book a Moving Event</h1>

    <p class="loggedIn">Client: <?php echo $client['ClientFirstName'] . " " . $client['ClientLastName'] . " (ID " . $clientId . ")"; ?></p>

    <label for="streetNumber"><strong>Move To Street Number:</strong></label><br>
    <input type="text" id="streetNumber" name="streetNumber" placeholder="Example: 88">
    <span class="required">REQUIRED</span><br>

    <label for="streetName"><strong>Move To Street Name:</strong></label><br>
    <input type="text" id="streetName" name="streetName" placeholder="Example: Ocean Avenue">
    <span class="required">REQUIRED</span><br>

    <label for="city"><strong>Move To City:</strong></label><br>
    <input type="text" id="city" name="city" placeholder="Example: Long Branch">
    <span class="required">REQUIRED</span><br>

    <label for="state"><strong>Move To State:</strong></label><br>
    <input type="text" id="state" name="state" placeholder="Example: NJ">
    <span class="required">REQUIRED</span><br>

    <label for="zip"><strong>Move To Zip Code:</strong></label><br>
    <input type="text" id="zip" name="zip" placeholder="Example: 07740">
    <span class="required">REQUIRED</span><br>

    <label for="movingDate"><strong>Moving Date:</strong></label><br>
    <input type="text" id="movingDate" name="movingDate" placeholder="Example: 12/05/2026">
    <span class="required">REQUIRED</span><br>

    <label for="weight"><strong>Total Weight of Items to Move:</strong></label><br>
    <input type="text" id="weight" name="weight" placeholder="Example: 2500 lbs">
    <span class="required">REQUIRED</span><br>

    <label for="miles"><strong>Miles For Move:</strong></label><br>
    <input type="text" id="miles" name="miles" placeholder="Example: 35">
    <span class="required">REQUIRED</span><br>

    <label for="cost"><strong>Total Cost:</strong></label><br>
    <input type="text" id="cost" name="cost" placeholder="Example: $1250.00">
    <span class="required">REQUIRED</span><br><br>

    <input type="submit" id="submitButton" name="submitButton" value="Book Moving Event">
    <input type="reset" id="resetButton" name="resetButton" value="Reset">
</form>

<?php
if (isset($_POST['streetNumber']))
{
    $streetNumber = mysqli_real_escape_string($con, $_POST['streetNumber']);
    $streetName = mysqli_real_escape_string($con, $_POST['streetName']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = strtoupper(mysqli_real_escape_string($con, $_POST['state']));
    $zip = mysqli_real_escape_string($con, $_POST['zip']);
    $movingDate = mysqli_real_escape_string($con, $_POST['movingDate']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);
    $miles = mysqli_real_escape_string($con, $_POST['miles']);
    $cost = mysqli_real_escape_string($con, $_POST['cost']);
    $repId = $_SESSION['repId'];

    $movingId = rand(10000, 99999);
    $check = mysqli_query($con, "SELECT * FROM MovingEvent WHERE MovingID = '$movingId'");
    while (mysqli_num_rows($check) > 0)
    {
        $movingId = rand(10000, 99999);
        $check = mysqli_query($con, "SELECT * FROM MovingEvent WHERE MovingID = '$movingId'");
    }

    $query = "INSERT INTO MovingEvent (MovingID, RepID, ClientID, MoveToStreetNumber, MoveToStreetName, MoveToCity, MoveToState, MoveToZip, MovingDate, TotalWeight, MilesForMove, TotalCost)
    VALUES ('$movingId', '$repId', '$clientId', '$streetNumber', '$streetName', '$city', '$state', '$zip', '$movingDate', '$weight', '$miles', '$cost')";
    mysqli_query($con, $query);

    $check = mysqli_query($con, "SELECT * FROM RepClient WHERE RepID = '$repId' AND ClientID = '$clientId'");
    if (mysqli_num_rows($check) == 0)
    {
        mysqli_query($con, "INSERT INTO RepClient (RepID, ClientID) VALUES ('$repId', '$clientId')");
    }

    $_SESSION['movingId'] = $movingId;

    echo '<script>alert("The moving event has been booked. The Moving ID is ' . $movingId . '."); if (confirm("Does the client have any Special Instructions for the move?")) { window.location = "instructions.php"; } else { window.location = "book.php"; }</script>';
}

mysqli_close($con);
?>

</body>
</html>