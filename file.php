<h1>Inserting Data From CSV to Database</h1>
<?php 

$connection=mysqli_connect("localhost","root","","notes");
if (!$connection) {
	
	echo "Error in connection";
}

	if (isset($_POST['import'])) {

		$file_name=$_FILES['file']['tmp_name'];

		if ($_FILES['file']['size'] > 0) {
			 
			$file= fopen($file_name, "r");

			while (($coulmn=fgetcsv($file,1000,","))!== FALSE) {
				
			$query="INSERT INTO csv (name,fname) VALUES('".$coulmn[0]."','".$coulmn[1]."')";
			$result=mysqli_query($connection,$query);


			}

			if ($result) {
				echo "Data Inserted Sucessfully";
			}
			else{
				echo "Data is not Inserted";
			}
		}
		
	}


 ?>



 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Document</title>
 </head>
 <body>
 	
 			<form  action="" method="POST" enctype="multipart/form-data">
				<input type="file" name="file" accept="csv"> 
				<input type="submit" name="import">				
 			</form>
 </body>
 </html>




 		<h1> Show data here</h1>
 		<table border="2px">
 			<tr >
 				<td>ID</td>
 				<td>Name</td>
 				<td colspan="2">Fathers Name</td>
 			</tr>
 			<?php
				$select = "SELECT * FROM csv";
				$result = mysqli_query($connection, $select);

				if ($result) {
				    if (mysqli_num_rows($result) > 0) {
				        while ($data = mysqli_fetch_assoc($result)) {
				            ?>
				            <tr>

				                <td><?php echo $data['id'] ?></td>
				                <td colspan="1"><?php echo $data['name']; ?></td>
				                <td><?php echo $data['fname']; ?></td>
				            </tr>
				            <?php
				        }
				    } else {
				        echo "No rows found.";
				    }
				} else {
				    echo "Query failed: " . mysqli_error($connection);
				}

				?>


 		</table>
