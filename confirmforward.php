<?php
include("connection.php");

    $emp_id = $_SESSION["session_id"];
	$pid = $_GET['p_id'];
	$tid=$_GET['t_id'];
	$rempid=$_GET['remp_id'];
	$reason=$_GET['reason'];
	$date = date("Y-m-d");
	$flag =0;
	$sql2="select emp_id from work where p_id='$pid'";
	$result = $con->query($sql2);
	while( $row1 = $result->fetch_assoc())
	{
		if($row1["emp_id"] == $rempid){
			$flag =1;
		}
	}
	if($flag == 1){

		$sql = "insert into forworded_task (`p_id`, `t_id`, `femp_id`, `remp_id`, `reason`, `fdate`) values('$pid','$tid','$emp_id','$rempid','$reason','$date')";
		if($con->query($sql)===true){
			$sql1 ="UPDATE work SET emp_id= '$rempid' WHERE t_id = '$tid' and p_id='$pid'";
			$result = $con->query($sql1);
			echo "<form method='post'><div style='margin-left:450px;margin-top:300px; background:skyblue; width:600px;'>";
            echo "<center><p style='color:red'><b>Successfully Forwaded</b></p></center>";
            echo "<center><input type='submit' name='success' value='ok'/ ></center>";
            echo "</div></form>";   
		}
	}else{
		echo "<form method='post'><div style='margin-left:450px;margin-top:300px; background:skyblue; width:600px;'>";
        echo "<center><p style='color:red'><b>No Such Employee Works On Same Project</b></p></center>";
        echo "<center><input type='submit' name='gotit' value='got it'/ ></center>";
        echo "</div></form>";   
	}
	if(isset($_POST["gotit"]) || isset($_POST["success"]) ) 
           header("Location:forward.php");
	
?>
