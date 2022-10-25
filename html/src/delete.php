<?php
//delete project by id
require(dirname(__DIR__, 1) . '/components/config.php');
$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = $conn->query("DELETE FROM cdc WHERE id='$id'");
// redirect to specification page
header('Location: specifications.php');
