<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create A New Client Account</title>
<link rel="stylesheet" href="project2.css">
<script src="project2.js"></script>
</head>
<body>
<?php include "nav.php"; ?>

<form id="createForm" name="createForm" action="createClient.php" method="POST" onsubmit="return validateClient();">
    <h1>Create A New Client Account</h1>

    <label for="clientFirstName"><strong>Client's First Name:</strong></label><br>
    <input type="text" id="clientFirstName" name="clientFirstName" placeholder="Example: Daniel">
    <span class="required">REQUIRED</span><br>

    <label for="clientLastName"><strong>Client's Last Name:</strong></label><br>
    <input type="text" id="clientLastName" name="clientLastName" placeholder="Example: Okoro">
    <span class="required">REQUIRED</span><br>

    <label for="clientId"><strong>Client ID #:</strong></label><br>
    <input type="text" id="clientId" name="clientId" placeholder="Example: 7001">
    <span class="required">REQUIRED</span><br><br>

    <input type="submit" id="submitButton" name="submitButton" value="Create Account">
    <input type="reset" id="resetButton" name="resetButton" value="Reset">
</form>

<?php
if (isset($_POST['clientId']))
{
    $clientFirstName = mysqli_real_escape_string($con, $_POST['clientFirstName']);
    $clientLastName = mysqli_real_escape_string($con, $_POST['clientLastName']);
    $clientId = mysqli_real_escape_string($con, $_POST['clientId']);
    $repId = $_SESSION['repId'];

    $result = mysqli_query($con, "SELECT * FROM Client WHERE ClientID = '$clientId'");

    if (mysqli_num_rows($result) > 0)
    {
        echo '<script>alert("An account already exists for Client ID ' . $clientId . '. Please choose a new option from the Navigation Bar."); window.location = "createClient.php";</script>';
    }
    else
    {
        mysqli_query($con, "INSERT INTO Client (ClientID, ClientFirstName, ClientLastName) VALUES ('$clientId', '$clientFirstName', '$clientLastName')");
        mysqli_query($con, "INSERT INTO RepClient (RepID, ClientID) VALUES ('$repId', '$clientId')");

        $_SESSION['clientId'] = $clientId;

        echo '<script>alert("An account was created for client ' . $clientFirstName . ' ' . $clientLastName . ' (ID ' . $clientId . '). Please enter the client information."); window.location = "clientInfo.php";</script>';
    }
}

mysqli_close($con);
?>

</body>
</html>