<?php
	include('db.php');
	$que="select * from visitor;";
	$res=mysqli_query($dbc,$que);
?>
<html>
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="src/css/font.css" rel="stylesheet">
    <link href="src/css/fabrica.css" rel="stylesheet">
	<link href="src/css/w3.css" rel="stylesheet">
   <title>Visited User</title>
</head>

<a href="sheet.php">Click Here to return to Document Page</a>
<body>
	<table align="center" border="10%" style="width:80%; line-height:130%;">
		<tr>
			<th colspan="10"><h2>Visitor's History</h2></th>
		</tr>
		<tr>
			<th> ID </th>
			<th> UserName</th>
			<th> Browser Name</th>
			<th> Browser Version</th>
			<th> Type</th>
			<th> OS</th>
			<th> Last Visited</th>
		</tr>
		<?php
			while($rows=mysqli_fetch_array($res))
			{
		?>
			<tr>
				<td><?php echo $rows['id']; ?></td>
				<td><?php echo $rows['uname']; ?></td>
				<td><?php echo $rows['browser_name']; ?></td>
				<td><?php echo $rows['browser_version']; ?></td>
				<td><?php echo $rows['type']; ?></td>
				<td><?php echo $rows['os']; ?></td>
				<td><?php echo $rows['added_on']; ?></td>
			</tr>

		<?php
		}
		?>
	</table>	
</body>

</html>
