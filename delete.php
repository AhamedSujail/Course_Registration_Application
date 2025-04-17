<?php
include ("dbconnection.php");
$dltLecID=$_GET['LecID'];
$sql = "DELETE FROM `Lecturer` where `LecID`='$dltLecID'";
$result = $conn->query($sql);

if ($result) {
  header("Location: dashboard.php?msg=Data deleted successfully");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>