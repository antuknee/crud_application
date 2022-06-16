<?php

include '../connection/database.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$product=$_POST['product'];
		$unit=$_POST['unit'];
		$price=$_POST['price'];
		$date=$_POST['date'];
        $available_inv=$_POST['available_inv'];
		$image = $_FILES['image'];
		$imagefilename= $image['name'];
		$imagefiletemp= $image['tmp_name'];

		$filename_separator = explode('.', $imagefilename);
		$file_extension = strtolower(end($filename_separator));

		$extension = array('jpeg','jpg', 'png');

			if(in_array($file_extension,$extension)){
				$upload_image = 'Upload/'.$imagefilename;
				move_uploaded_file($imagefiletemp,$upload_image);
			}



	$sql = "INSERT INTO `item`( `product_name`, `unit`,`price`,`date_of_expiry`, `available_inventory`,`image`) 
	VALUES ('$product','$unit','$price','$date', '$available_inv','$upload_image')";

		if (mysqli_query($conn, $sql)) {
			//
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	 }
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$product=$_POST['product'];
		$unit=$_POST['unit'];
		$price=$_POST['price'];
		$date=$_POST['date'];
		$available_inv=$_POST['available_inv'];

		$image = $_FILES['image'];
		$imagefilename= $image['name'];
		$imagefiletemp= $image['tmp_name'];

		//echo $image;

		echo '<pre>';
		print_r($_POST);
		echo '<pre>';
		$filename_separator = explode('.', $imagefilename);
		$file_extension = strtolower(end($filename_separator));

		$extension = array('jpeg','jpg', 'png');

			if(in_array($file_extension,$extension)){
				$upload_image = 'Upload/'.$imagefilename;
				move_uploaded_file($imagefiletemp,$upload_image);
			}


		$sql = "UPDATE `item` SET `product_name`='".$product."',`unit`='".$unit."',`price`='".$price."',`date_of_expiry`='".$date."',
		`available_inventory`='".$available_inv."',	`image` = '".$upload_image."' WHERE id=$id";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `item` WHERE id=$id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM item WHERE id in ($id)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>