<?php
//delete project by id
require('../components/config.php');
$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = $conn->query("DELETE FROM projects WHERE id='$id'");
// redirect to specification page
header('Location: specifications.php');
