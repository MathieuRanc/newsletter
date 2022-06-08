<?php
//increment received field in stats table
require('../components/config.php');
$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = $conn->query("SELECT * FROM stats WHERE id='$id'");
$row = $query->fetch_assoc();
$received = $row['received'] + 1;
$query = $conn->query("UPDATE stats SET received = '$received' WHERE id='$id'");
