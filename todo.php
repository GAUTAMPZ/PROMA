<?php
include("connection.php");

    $emp_id = $_SESSION["session_id"];

?>
<html lang="en">
<head>
  <title>PROMA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/todo.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  
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
      <a class="nav-link" href="forward.php">Task Forward</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="notification.php">Notification</a>
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
			<th>Description Of Task</th>
			<th>Due Date</th>
			<th>Priority</th>
			<th>Status</th>
			<th>Change status</th>
		</tr>
		<form method="post">
		<?php

		$sql = "SELECT a.p_id,a.t_id,a.t_name,a.dsc,a.due_date,a.t_priority,a.status FROM task a JOIN work b WHERE a.t_id = b.t_id and b.emp_id = '$emp_id' and a.status != 1";
		$result = $con->query($sql);
		
		while($row = $result->fetch_assoc()) {				
        			echo "<tr>
					<td>". $row['p_id']."</td>
					<td>".$row["t_id"]."</td>
					<td>".$row["t_name"]."</td>
					<td>".$row["dsc"]." </td>
					<td>".$row["due_date"]." </td>
          <td>".$row["t_priority"]. " </td>
          <td>".$row["status"]. " </td>
          <td>
          	<a href='todo_f.php?tid=".$row['t_id']."&pid=".$row['p_id']."'>Compleate</a>
          </td>
          </tr>";
	}
?>		
	
	


</form>
		</table>
</div>  
</body>
</html>
