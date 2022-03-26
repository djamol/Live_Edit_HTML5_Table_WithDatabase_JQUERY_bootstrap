
<?php
error_reporting(0);

$connect = mysqli_connect("localhost", "root", "", "test");
if(isset($_POST["hostname"], $_POST["mac_address"]))
{
 $hostname =  $_POST["hostname"];
 $mac_address = $_POST["mac_address"];
 $loopback = $_POST["loopback"];
 $query = "INSERT INTO router_details(hostname, mac_address,loopback) VALUES('$hostname', '$mac_address','$loopback')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
