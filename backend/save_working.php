<?php
include '../connection/database.php';
if(count($_POST)>0){
	if($_POST['type']==1){
		$product=$_POST['product'];
		$unit=$_POST['unit'];
		$price=$_POST['price'];
		$date=$_POST['date'];
        $available_inv=$_POST['available_inv'];
		//$image=$_POST['my_image'];
	// Insert into Database
	$sql = "INSERT INTO `item`( `product_name`, `unit`,`price`,`date_of_expiry`, `available_inventory`) 
	VALUES ('$product','$unit','$price','$date', '$available_inv')";

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
	if($_POST['type']==2){
		$id=$_POST['id'];
		$product=$_POST['product'];
		$unit=$_POST['unit'];
		$price=$_POST['price'];
		$date=$_POST['date'];
		$available_inv=$_POST['available_inv'];
		$sql = "UPDATE `item` SET `product_name`='".$product."',`unit`='".$unit."',`price`='".$price."',`date_of_expiry`='".$date."',
		`available_inventory`='".$available_inv."' WHERE id=$id";
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