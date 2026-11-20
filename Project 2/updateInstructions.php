<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Special Instructions for Move</title>
<link rel="stylesheet" href="project2.css">
<script src="project2.js"></script>
</head>
<body>
<?php include "nav.php"; ?>

<form id="updateForm" name="updateForm" action="updateInstructions.php" method="POST" onsubmit="return validateUpdate();">
    <h1>Update Special Instructions for Move</h1>

    <label for="clientId"><strong>Client ID #:</strong></label><br>
    <input type="text" id="clientId" name="clientId" placeholder="Example: 7001" value="<?php if (isset($_SESSION['clientId'])) { echo $_SESSION['clientId']; } ?>">
    <span class="required">REQUIRED</span><br>

    <label for="movingId"><strong>Moving ID #:</strong></label><br>
    <input type="text" id="movingId" name="movingId" placeholder="Example: 48213" value="<?php if (isset($_SESSION['movingId'])) { echo $_SESSION['movingId']; } ?>">
    <span class="required">REQUIRED</span><br>

    <label for="instructions"><strong>Additional Special Instructions:</strong></label><br>
    <textarea id="instructions" name="instructions" rows="5" cols="60" placeholder="Example: Also bring extra moving blankets for the piano."></textarea>
    <span class="required">REQUIRED</span><br><br>

    <input type="submit" id="submitButton" name="submitButton" value="Update Special Instructions">
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
        echo '<script>alert("The client could not be found. A moving event booking with Moving ID ' . $movingId . ' for Client ID ' . $clientId . ' does not exist. Please re-enter the data."); window.location = "updateInstructions.php";</script>';
    }
    else
    {
        $result = mysqli_query($con, "SELECT * FROM SpecialInstructions WHERE MovingID = '$movingId'");
        $row = mysqli_fetch_array($result);

        if (!$row)
        {
            echo '<script>alert("No Special Instructions exist yet for Moving ID ' . $movingId . '. You will be taken to the Special Instructions page."); window.location = "instructions.php";</script>';
        }
        else
        {
            $newInstructions = $row['PackingInstructions'] . " " . $_POST['instructions'];

            if (strlen($newInstructions) > 500)
            {
                echo '<script>alert("The Special Instructions would be longer than 500 characters. Please enter shorter additional instructions."); window.location = "updateInstructions.php";</script>';
            }
            else
            {
                $newInstructions = mysqli_real_escape_string($con, $newInstructions);
                mysqli_query($con, "UPDATE SpecialInstructions SET PackingInstructions = '$newInstructions' WHERE MovingID = '$movingId'");

                $_SESSION['clientId'] = $clientId;
                $_SESSION['movingId'] = $movingId;

                echo '<script>alert("The Special Instructions were updated for Moving ID ' . $movingId . '."); window.location = "updateInstructions.php";</script>';
            }
        }
    }
}

mysqli_close($con);
?>

</body>
</html>