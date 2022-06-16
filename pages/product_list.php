<?php
include '../connection/database.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../js/ajax.js"></script>
</head>
<body>
<div class="container">
<p id="success"></p>
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Product <b>List</b></h2>
					<a href="#addEmployeeModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons"></i> <span>Add New User</span></a>
					<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a>						
				</div>
				<div class="col-sm-6">
					
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
			
					<th>
						<span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label>
						</span>
					</th>
					<th> </th>
					<th>Item No</th>
					<th>Product name</th>
					<th>Unit</th>
					<th>Price</th>
                    <th>Date of <br> Expiry</th>
                    <th>Available
                        <br>Inventory</th>
					<th>Available
                        <br>Inventory Cost</th>
                    <th>Image</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			$result = mysqli_query($conn,"SELECT * FROM item ORDER BY id ASC");
				$i=1;
				while($row = mysqli_fetch_array($result)) {
					$price = $row["price"];
					$available_in = $row["available_inventory"];
					$availble_cost = $price * $available_in;
			?>
			<tr id="<?php echo $row["id"]; ?>">
			<td>
						<span class="custom-checkbox">
							<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
							<label for="checkbox2"></label>
						</span>
					</td>
					<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update" data-toggle="tooltip" 
                        data-id="<?php echo $row["id"]; ?>"
						data-product="<?php echo $row["product_name"]; ?>"
						data-unit="<?php echo $row["unit"]; ?>"
                        data-price="<?php echo $row["price"]; ?>"
						data-date="<?php echo $row["date_of_expiry"]; ?>"
                        data-avail="<?php echo $row["available_inventory"]; ?>"
						data-image="<?php echo $row["image"]; ?>
                       
                        
						title="Edit">edit</i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						title="Delete"></i></a>
				</td>
				<td><?php echo $i; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
				<td><?php echo $row["unit"]; ?></td>
				<td><?php echo $row["price"]; ?></td>
				<td><?php echo $row["date_of_expiry"]; ?></td>
                <td><?php echo $row["available_inventory"]; ?></td>
				<td><?php echo number_format($availble_cost, 2); ?></td>
                <td  class="gallery"><?php echo '<img src="../backend/'.$row["image"].'">'; ?></td>
			
			</tr>
			<?php
			$i++;
			}
			?>
			</tbody>
		</table>
		
	</div>
</div>

<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
	
			<form id="user_form"  enctype="multipart/form-data">
				<div class="modal-header">						
					<h4 class="modal-title">Add Product</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Product</label>
						<input type="text" id="product" name="product" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Unit</label>
						<input type="text" id="unit" name="unit" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Price</label>
						<input type="number" id="price" name="price" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>Date of Expiry</label>
						<input type="date" id="date" name="date" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>Available Inventory</label>
						<input type="number" id="available_inv" name="available_inv" class="form-control" required>
					</div>

                   <div class="form-group">
						<label>Image</label>
						<input id="image" type="file"  name="image" class="form-control" required>
					
						<div class="gallery">
						<!-- <img src="../backend/Upload/coke.jpg" id="preImg"> -->
						</div>
					</div>
					
		
				</div>
				<div class="modal-footer">
					<input type="hidden" value="1" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="submit" class="btn btn-primary" id="btn-add">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="update_form" enctype="multipart/form-data">
				<div class="modal-header">						
					<h4 class="modal-title">Edit Product</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_u" name="id" class="form-control" required>					
				
                    <div class="form-group">
						<label>Product</label>
						<input type="text" id="product_u" name="product" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Unit</label>
						<input type="text" id="unit_u" name="unit" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Price</label>
						<input type="text" id="price_u" name="price" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>Date of Expiry</label>
						<input type="date" id="date_u" name="date" class="form-control" required>
					</div>
                    <div class="form-group">
						<label>Available Inventory</label>
						<input type="text" id="available_inv_u" name="available_inv" class="form-control" required>
					</div>	
					<div class="form-group">
						
						<label>Image</label>
						<input id="image_u" type="file"  name="image" class="form-control" required>
						
					</div>	
				</div>
				<div class="modal-footer">
				<input type="hidden" value="2" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="submit" class="btn btn-info" id="update">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Product</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_d" name="id" class="form-control">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-danger" id="delete">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>

</body>
</html>    