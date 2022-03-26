<?php
error_reporting(0);

$connect = mysqli_connect("localhost", "root", "", "test");
if($_POST["column_name"]=='sapid')
{
	echo 'Sorry, you are not allowed to edit SAP ID ...';
	exit();
}
if(isset($_POST["id"]))
{
 $value =  $_POST["value"];
 $query = "UPDATE router_details SET ".$_POST["column_name"]."='".$value."' WHERE sapid = '".$_POST["id"]."'";
// echo $query;
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>