<?php
include 'database.php';
$id = $_GET['id'];
$conn->query("DELETE FROM gallery WHERE id=$id");
header("Location: dashboard.php");
?>
