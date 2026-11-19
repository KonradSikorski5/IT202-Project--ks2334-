<?php
if (!isset($_SESSION['repId']))
{
    echo '<script>alert("Please log in first."); window.location = "project2.html";</script>';
    exit();
}
?>
<div class="nav">
    <a href="search.php">Search A Moving Company Representative's Account</a>
    <a href="verifyClient.php">Book a Client's Moving Event</a>
    <a href="cancel.php">Cancel A Client's Moving Event</a>
    <a href="instructions.php">Special Instructions for the Move</a>
    <a href="updateInstructions.php">Update Special Instructions for Move</a>
    <a href="createClient.php">Create A New Client Account</a>
</div>
<p class="loggedIn">Logged in as: <?php echo $_SESSION['repName']; ?></p>