<?php
session_start();
include "db.php";

if (!isset($_SESSION['clientId']))
{
    echo '<script>alert("Please create the client account first."); window.location = "createClient.php";</script>';
    exit();
}

$clientId = $_SESSION['clientId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Client Information</title>
<link rel="stylesheet" href="project2.css">
<script src="project2.js"></script>
</head>
<body>
<?php include "nav.php"; ?>

<form id="infoForm" name="infoForm" action="clientInfo.php" method="POST" onsubmit="return validateClientInfo();">
    <h1>New Client Information</h1>

    <p class="loggedIn">Client ID: <?php echo $clientId; ?></p>

    <label for="streetNumber"><strong>Client's Street Number:</strong></label><br>
    <input type="text" id="streetNumber" name="streetNumber" placeholder="Example: 14">
    <span class="required">REQUIRED</span><br>

    <label for="streetName"><strong>Client's Street Name:</strong></label><br>
    <input type="text" id="streetName" name="streetName" placeholder="Example: Maple Avenue">
    <span class="required">REQUIRED</span><br>

    <label for="city"><strong>Client's City:</strong></label><br>
    <input type="text" id="city" name="city" placeholder="Example: Newark">
    <span class="required">REQUIRED</span><br>

    <label for="state"><strong>Client's State:</strong></label><br>
    <input type="text" id="state" name="state" placeholder="Example: NJ">
    <span class="required">REQUIRED</span><br>

    <label for="zip"><strong>Client's Zip Code:</strong></label><br>
    <input type="text" id="zip" name="zip" placeholder="Example: 07102">
    <span class="required">REQUIRED</span><br>

    <label for="clientPhone"><strong>Client's Phone Number:</strong></label><br>
    <input type="text" id="clientPhone" name="clientPhone" placeholder="Example: 973-555-0101">
    <span class="required">REQUIRED</span><br><br>

    <input type="submit" id="submitButton" name="submitButton" value="Save Client Information">
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
    $clientPhone = mysqli_real_escape_string($con, $_POST['clientPhone']);

    $result = mysqli_query($con, "SELECT * FROM ClientInfo WHERE ClientID = '$clientId'");

    if (mysqli_num_rows($result) > 0)
    {
        echo '<script>alert("A Client Information Record already exists for Client ID ' . $clientId . '."); window.location = "clientInfo.php";</script>';
    }
    else
    {
        mysqli_query($con, "INSERT INTO ClientInfo (ClientID, ClientStreetNumber, ClientStreetName, ClientCity, ClientState, ClientZip, ClientPhone) VALUES ('$clientId', '$streetNumber', '$streetName', '$city', '$state', '$zip', '$clientPhone')");

        echo '<script>alert("The Client Information Record was created for Client ID ' . $clientId . '."); window.location = "clientInfo.php";</script>';
    }
}

mysqli_close($con);
?>

</body>
</html>