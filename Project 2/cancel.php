<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cancel A Client's Moving Event</title>
<link rel="stylesheet" href="project2.css">
<script src="project2.js"></script>
</head>
<body>
<?php include "nav.php"; ?>

<form id="cancelForm" name="cancelForm" action="cancel.php" method="POST" onsubmit="return validateCancel();">
    <h1>Cancel A Client's Moving Event</h1>

    <label for="clientId"><strong>Client ID #:</strong></label><br>
    <input type="text" id="clientId" name="clientId" placeholder="Example: 7001">
    <span class="required">REQUIRED</span><br>

    <label for="movingId"><strong>Moving ID #:</strong></label><br>
    <input type="text" id="movingId" name="movingId" placeholder="Example: 48213">
    <span class="required">REQUIRED</span><br><br>

    <input type="submit" id="submitButton" name="submitButton" value="Cancel Moving Event">
    <input type="reset" id="resetButton" name="resetButton" value="Reset">
</form>

<?php
if (isset($_POST['movingId']))
{
    $clientId = mysqli_real_escape_string($con, $_POST['clientId']);
    $movingId = mysqli_real_escape_string($con, $_POST['movingId']);

    $result = mysqli_query($con, "SELECT * FROM MovingEvent WHERE MovingID = '$movingId' AND ClientID = '$clientId'");

    if (mysqli_num_rows($result) == 0)
    {
        echo '<script>alert("A moving event booking with Moving ID ' . $movingId . ' for Client ID ' . $clientId . ' does not exist. Please check the information and re-enter valid data."); window.location = "cancel.php";</script>';
    }
    else
    {
        echo '<script>if (confirm("Are you sure you want to cancel the moving event booking with Moving ID ' . $movingId . '? If Special Instructions were given for this moving event they will also be deleted.")) { window.location = "cancel.php?confirm=yes&clientId=' . $clientId . '&movingId=' . $movingId . '"; } else { window.location = "cancel.php"; }</script>';
    }
}

if (isset($_GET['confirm']))
{
    $clientId = mysqli_real_escape_string($con, $_GET['clientId']);
    $movingId = mysqli_real_escape_string($con, $_GET['movingId']);

    $result = mysqli_query($con, "SELECT * FROM MovingEvent WHERE MovingID = '$movingId' AND ClientID = '$clientId'");
    $row = mysqli_fetch_array($result);

    if ($row)
    {
        $repId = $row['RepID'];

        mysqli_query($con, "DELETE FROM SpecialInstructions WHERE MovingID = '$movingId'");
        mysqli_query($con, "DELETE FROM MovingEvent WHERE MovingID = '$movingId'");

        echo '<script>alert("The moving event booking has been cancelled. Moving Representative ID: ' . $repId . ', Client ID: ' . $clientId . ', Moving ID: ' . $movingId . '."); window.location = "cancel.php";</script>';
    }
}

mysqli_close($con);
?>

</body>
</html>