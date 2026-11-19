<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Verify Client</title>
<link rel="stylesheet" href="project2.css">
<script src="project2.js"></script>
</head>
<body>
<?php include "nav.php"; ?>

<form id="verifyForm" name="verifyForm" action="verifyClient.php" method="POST" onsubmit="return validateClient();">
    <h1>Verify Client</h1>

    <label for="clientFirstName"><strong>Client's First Name:</strong></label><br>
    <input type="text" id="clientFirstName" name="clientFirstName" placeholder="Example: Daniel">
    <span class="required">REQUIRED</span><br>

    <label for="clientLastName"><strong>Client's Last Name:</strong></label><br>
    <input type="text" id="clientLastName" name="clientLastName" placeholder="Example: Okoro">
    <span class="required">REQUIRED</span><br>

    <label for="clientId"><strong>Client ID #:</strong></label><br>
    <input type="text" id="clientId" name="clientId" placeholder="Example: 7001">
    <span class="required">REQUIRED</span><br><br>

    <input type="submit" id="submitButton" name="submitButton" value="Verify Client">
    <input type="reset" id="resetButton" name="resetButton" value="Reset">
</form>

<?php
if (isset($_POST['clientId']))
{
    $clientFirstName = mysqli_real_escape_string($con, $_POST['clientFirstName']);
    $clientLastName = mysqli_real_escape_string($con, $_POST['clientLastName']);
    $clientId = mysqli_real_escape_string($con, $_POST['clientId']);

    $query = "SELECT * FROM Client WHERE ClientID = '$clientId' AND ClientFirstName = '$clientFirstName' AND ClientLastName = '$clientLastName'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0)
    {
        $_SESSION['clientId'] = $clientId;
        echo '<script>alert("Client ' . $clientFirstName . ' ' . $clientLastName . ' has been verified. You can now book the moving event."); window.location = "book.php";</script>';
    }
    else
    {
        echo '<script>if (confirm("Client ' . $clientFirstName . ' ' . $clientLastName . ' (ID ' . $clientId . ') does not exist in the Client table. Click OK to re-enter the client information or Cancel to create an account for the client.")) { window.location = "verifyClient.php"; } else { window.location = "createClient.php"; }</script>';
    }
}

mysqli_close($con);
?>

</body>
</html>