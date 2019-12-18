<?php
include("connection.php");

    $emp_id = $_SESSION["session_id"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Task Forward</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="css/forward.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="java/forward.js?v=<?php echo time(); ?>"  type="text/javascript" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> 
    <script type="text/javascript" src="java\forward.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body style="height:100%;">
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

	<div class="container">
		<form method="POST">
		<table id="show" class="show">
			<tr>
				<th>Project ID</th>
				<th>Task ID</th>
				<th>Task Name</th>
				<th>Description Of Task</th>
				<th>Due Date</th>
				<th>Forward To</th>
				<th></th>
			</tr>
			<?php
			
				$sql = "SELECT a.p_id,a.t_id,a.t_name,a.dsc,a.due_date FROM task a JOIN work b WHERE a.t_id = b.t_id and emp_id='$emp_id' and a.status!=1";
				$result = $con->query($sql);
		   				
	    		$i=0;
				while($row = $result->fetch_assoc()) 
				{	
	        			echo "<tr id= $i>"; 
	        				$i=$i+1;
						$var1="{$row['p_id']}";
						$var2="{$row['t_id']}";
						$sql1="SELECT emp_id FROM work WHERE p_id ='$var1' and emp_id != '$emp_id'";
						$result1= $con->query($sql1);
	        			?>
						<td id="p_id" name="p_id">
							<?php echo $row['p_id']; ?>
						</td>
						<td id="t_id" name="t_id">
							<?php echo $row["t_id"];?>
						</td>
						<td id="t_name" name="t_name">
							<?php echo $row["t_name"];?></td>
						<td id="dsc" name="dsc"><?php echo"".$row["dsc"]."";?> 
						</td>
						<td id="due_date">
							<?php echo $row["due_date"];?> 
						</td>
						<?php
							$sql1="select emp_id from work where p_id='$var1'";
							echo "<td>";
						?>	
						<select id="employee" name="employee">
							<?php
								while( $row1 = $result1->fetch_assoc())
								{
							?>
								<option  class="fbox"?> 
									<?php echo $row1["emp_id"];?> 

								</option>
						
							<?php
								}					
									echo"</select></td>";
								?>
						<td>
							 <input type="button" id="forward" name="forward" class="button btn" value="Forward" onclick="callHidden(<?php echo $i ?>)" />
						</td>
			<?php
						echo" </tr>";
				}  		
			?>
		</table>
		</form>	
		<div>
		<form  method="POST">	
			<table id="hidden" class="hidden" align="center"> 
				<tr>
					<span id="span" class="close" style="display: none;" >&times;</span>
				</tr>
				<tr>
					<td>Project ID</td>
					<td>Task ID</td>
					<td>Task Name</td>
					<td>Discription</td>
					<td>Forward To</td>
					<td>Reason</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><input type="text" id = "emp_id" name="emp_id"  placeholder="Enter employee id Here..."></td>
					<td><input type="text" id = "reason" name="reason"  placeholder="Enter Reason Here..."></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td colspan="2" align="center">
						<input type="button" id="finalforward" style="background-color: green;"name="finalforward"  class="button btn" value="Forward" onclick="confirmforward()">
					</td>
					<td></td>
					<td></td>
				</tr>
			</table>
		
		</form>
		</div>

	</div>

</body>
</html>
<script type="text/javascript">

	var tableRow;
	var tableRowHidden;
   	var p_id;
   	var t_id;
   	var remp_id;
	function callHidden(i) {
 				hidden.style.display="block";
		        span.style.display="block";
		       	tableRow = document.getElementById('show').rows[i];
		       	tableRowHidden = document.getElementById('hidden').rows[2];
		       	tableRowHidden.cells[0].innerHTML = tableRow.cells[0].innerHTML;
		       	tableRowHidden.cells[1].innerHTML = tableRow.cells[1].innerHTML;
		       	tableRowHidden.cells[2].innerHTML = tableRow.cells[2].innerHTML;
		       	tableRowHidden.cells[3].innerHTML = tableRow.cells[3].innerHTML;
		       	p_id = 	tableRowHidden.cells[0].innerHTML.trim();
		       	t_id = 	tableRowHidden.cells[1].innerHTML.trim();

$(document).ready(function(){
  $(document).on('click','#span',function(){
        hidden.style.display="none";
        span.style.display="none"
        
      })
});
		   
	}

	function confirmforward(){
		tableRowHidden = document.getElementById('hidden').rows[2];
		var desc = tableRowHidden.cells[3].innerHTML;
		var x = document.getElementById("employee").selectedIndex
		var y = document.getElementById("employee").options;
		var remp_id = document.getElementById("emp_id").value;
		var reason = document.getElementById("reason").value;

		$(document).ready(function(){
	 		 $(document).on('click','#span',function(){
			        hidden.style.display="none";
			        span.style.display="none"
        
    		  })
		});

	window.location.href='confirmforward.php?p_id=' + p_id+'&t_id='+t_id+ '&remp_id=' + remp_id + '&reason=' + reason;
	}
</script>

