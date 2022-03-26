
<?php
error_reporting(0);

//fetch.php
$connect = mysqli_connect("localhost", "root", "", "test");
$columns = array( 'hostname','loopback','mac_address');

$query = "SELECT * FROM router_details ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE hostname LIKE "%'.$_POST["search"]["value"].'%" 
 OR mac_address LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY sapid DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["sapid"].'" data-column="sapid">' . $row["sapid"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["sapid"].'" data-column="hostname">' . $row["hostname"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["sapid"].'" data-column="loopback">' . $row["loopback"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["sapid"].'" data-column="mac_address">' . $row["mac_address"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["sapid"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM router_details";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
