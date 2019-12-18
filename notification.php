<?php 
include("connection.php");

    $emp_id = $_SESSION["session_id"];
?>
<html lang="en">
<head>
  <title>PROMA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/notification1.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  
  <a class="navbar-brand" href="#">PROMA</a>

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="employee.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="todo.php">To Do</a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="forward.php">Task Forward</a>
    </li>
  </ul>
<ul class="navbar-nav" style="object-position: right;">
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <img src="">
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="profile.php">Profile</a>
        <a class="dropdown-item" href="index.php">Logout</a>
      </div>
    </li>
   </ul > 
</nav>
<div class="container1">
	<table class="table1">
		<tr>
			<th>Project ID</th>
			<th>Task ID</th>
			<th>Task Name</th>
			<th>Priority</th>
		</tr>
		<?php
	
		echo "<p style='color:red'>Due Date of Following tasks is within two days</p>";
		$sql = "SELECT a.p_id,a.t_id,a.t_name,a.due_date,a.t_priority FROM task a JOIN work b WHERE a.t_id = b.t_id and b.emp_id = '$emp_id' and  due_date >= (SELECT CURDATE()) AND due_date-2 <= (SELECT CURDATE()) ";
		$result = $con->query($sql);
		while($row = $result->fetch_assoc()) {				
        			echo "<tr>";?>
					<td><?php echo"". $row['p_id']."";?></td>  
					<td><?php echo"".$row["t_id"]." ";?></td>
					<td><?php echo"".$row["t_name"]."";?></td>
					<td><?php echo"".$row["t_priority"]."";?> </td>
					<?php echo"</tr>";
    			}
		?>
		</table>	
		<table class="table1" style="margin-top: 20px;">
		<tr>
			<th>Project ID</th>
			<th>Task ID</th>
			<th>Forwader Id</th>
			<th>Reason</th>
		</tr>
		<?php
		
		echo "<p style='color:green; margin:20px;'>Following tasks are Forwarded to you</p>";
		$sql = "SELECT a.p_id,a.t_id,a.femp_id,a.reason FROM forworded_task a join task b  WHERE a.remp_id = '$emp_id' and a.fdate = CURDATE() and a.t_id = b.t_id ";
		$result = $con->query($sql);
		while($row = $result->fetch_assoc()) {				
        			echo "<tr>";?>
					<td><?php echo"". $row['p_id']."";?></td>  
					<td><?php echo"".$row["t_id"]." ";?></td>
					<td><?php echo"".$row["femp_id"]."";?></td>
					<td><?php echo"".$row["reason"]."";?> </td>
					<?php echo"</tr>";
    			}
		?>
		</table>	
</div>  
</body>
</html>
