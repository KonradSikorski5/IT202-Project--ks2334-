<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Special Instructions for the Move</title>
<link rel="stylesheet" href="project2.css">
<script src="project2.js"></script>
</head>
<body>
<?php include "nav.php"; ?>

<form id="instructionsForm" name="instructionsForm" action="instructions.php" method="POST" onsubmit="return validateInstructions();">
    <h1>Special Instructions for the Move</h1>

    <label for="clientId"><strong>Client ID #:</strong></label><br>
    <input type="text" id="clientId" name="clientId" placeholder="Example: 7001" value="<?php if (isset($_SESSION['clientId'])) { echo $_SESSION['clientId']; } ?>">
    <span class="required">REQUIRED</span><br>

    <label for="movingId"><strong>Moving ID #:</strong></label><br>
    <input type="text" id="movingId" name="movingId" placeholder="Example: 48213" value="<?php if (isset($_SESSION['movingId'])) { echo $_SESSION['movingId']; } ?>">
    <span class="required">REQUIRED</span><br>

    <label for="instructions"><strong>Packing Specifications and Special Requests:</strong></label><br>
    <textarea id="instructions" name="instructions" rows="5" cols="60" placeholder="Example: Wrap the glass table in bubble wrap and place it in the dining room."></textarea>
    <span class="required">REQUIRED</span><br><br>

    <input type="submit" id="submitButton" name="submitButton" value="Request Special Instructions">
    <input type="reset" id="resetButton" name="resetButton" value="Reset">
</form>

<?php
if (isset($_POST['movingId']))
{
    $clientId = mysqli_real_escape_string($con, $_POST['clientId']);
    $movingId = mysqli_real_escape_string($con, $_POST['movingId']);
    $instructions = mysqli_real_escape_string($con, $_POST['instructions']);

    $result = mysqli_query($con, "SELECT * FROM MovingEvent WHERE MovingID = '$movingId' AND ClientID = '$clientId'");

    if (mysqli_num_rows($result) == 0)
    {
        echo '<script>alert("A moving event booking with Moving ID ' . $movingId . ' for Client ID ' . $clientId . ' does not exist. Please check the information and re-enter valid data."); window.location = "instructions.php";</script>';
    }
    else
    {
        $result = mysqli_query($con, "SELECT * FROM SpecialInstructions WHERE MovingID = '$movingId'");

        $_SESSION['clientId'] = $clientId;
        $_SESSION['movingId'] = $movingId;

        if (mysqli_num_rows($result) > 0)
        {
            echo '<script>alert("Special Instructions for the Move already exist for Moving ID ' . $movingId . '. You will be taken to the Update Special Instructions page."); window.location = "updateInstructions.php";</script>';
        }
        else
        {
            mysqli_query($con, "INSERT INTO SpecialInstructions (MovingID, PackingInstructions) VALUES ('$movingId', '$instructions')");

            echo '<script>alert("The Special Instructions were added to the moving event booking for Moving ID ' . $movingId . '."); window.location = "instructions.php";</script>';
        }
    }
}

mysqli_close($con);
?>

</body>
</html>