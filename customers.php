<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/table.css">
	<title>Golden Horizon Bank</title>
</head>

<body>
<header class="container">
<nav class="navbar">
	<div class="logo">
		<i class="fa fa-bank" style="font-size:36px;margin:13px;color:darkgreen"></i>
		<p>Golden Horizon Bank</p>
	</div>
	<ul>
		<li><a href="home.html">Home</a></li>
	</ul>
</nav>
</header>

<?php
include 'connection.php';
	$sql="select * from customers";
	$result=mysqli_query($con,$sql);
?>
<div class="container"><br>
<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Email</th>
			<th>Operation</th>
       </tr>
	</thead>
<tbody>
<?php 
while($rows=mysqli_fetch_assoc($result))
{
?>
	<tr>
		<td><?php echo $rows['SrNo'] ?></td>
		<td><?php echo $rows['Name']?></td>
		<td><?php echo $rows['Email']?></td>
		<td><a href="userdetail.php?SrNo=<?php echo $rows['SrNo'] ;?>"><button type="button">View Details</button></a></td> 
	</tr>
<?php
}
?>
</tbody>
</table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</body>
</html>
