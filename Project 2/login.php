<?php
session_start();
include "db.php";

$firstName = mysqli_real_escape_string($con, $_POST['firstName']);
$lastName = mysqli_real_escape_string($con, $_POST['lastName']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$repId = mysqli_real_escape_string($con, $_POST['repId']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$transaction = $_POST['transaction'];

$query = "SELECT * FROM MovingRep WHERE RepID = '$repId'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$found = false;

if ($row)
{
    if ($row['RepFirstName'] == $firstName && $row['RepLastName'] == $lastName && $row['RepPassword'] == $password)
    {
        if (!isset($_POST['emailConfirm']) || strtolower($row['RepEmail']) == strtolower($email))
        {
            $found = true;
        }
    }
}

if ($found == false)
{
    echo '<script>alert("Sorry, an account for ' . $firstName . ' ' . $lastName . ' cannot be found."); window.location = "project2.html";</script>';
}
else
{
    $_SESSION['repId'] = $repId;
    $_SESSION['repName'] = $firstName . " " . $lastName;

    if ($transaction == "search")
    {
        $page = "search.php";
    }
    else if ($transaction == "book")
    {
        $page = "verifyClient.php";
    }
    else if ($transaction == "cancel")
    {
        $page = "cancel.php";
    }
    else if ($transaction == "instructions")
    {
        $page = "instructions.php";
    }
    else if ($transaction == "update")
    {
        $page = "updateInstructions.php";
    }
    else
    {
        $page = "createClient.php";
    }

    echo '<script>alert("Welcome to Moving On Up, ' . $firstName . ' ' . $lastName . '!"); window.location = "' . $page . '";</script>';
}

mysqli_close($con);
?>