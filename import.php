<?php
    $fileName = $_FILES["file"]["tmp_name"];
	$type =($_FILES["file"]["type"]);
	if($type == 'application/vnd.ms-excel'){
    if ($_FILES["file"]["size"] > 0) {
        $connect = mysqli_connect("localhost", "root", "", "test");

        $file = fopen($fileName, "r");
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
		$hostname = $column[0];
		$loopback = $column[1];
		$mac_address = $column[2];
		$array =array();$i=0;
	$status=1;
		$query = mysqli_query($connect, "SELECT * FROM `router_details` WHERE hostname='".$hostname."' OR mac_address='".$mac_address."' OR loopback='".$loopback."'");
		if (!$query)
		{die('Error: ' . mysqli_error($connect));}
		if(mysqli_num_rows($query) > 0){
			array_push($array, "HOST:$hostname/MAC:$mac_address/LOOP: $loopback already exist");
		}else{			
		 $query = "INSERT INTO router_details(hostname, mac_address,loopback) VALUES('$hostname', '$mac_address','$loopback')";
			 if(mysqli_query($connect, $query))
			 {
			array_push($array,  "HOST:$hostname/MAC:$mac_address/LOOP: $loopback Added");
			 }else{
			array_push($array, "HOST:$hostname/MAC:$mac_address/LOOP: $loopback failed");
			 }
		}
			
		}
	$data =$array;	
		//var_dump($data);
	}else{
	$data ="Empty File";$status=0;
	}
	}else{
	$data= "Only CSV File Allowed";$status=0;	
	}
	echo json_encode(array("data"=>$data,"status"=>$status));