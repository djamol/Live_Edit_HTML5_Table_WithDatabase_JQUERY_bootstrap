<?php
error_reporting(0);
$connect = mysqli_connect("localhost", "root", "", "test");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM router_details WHERE sapid = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>

