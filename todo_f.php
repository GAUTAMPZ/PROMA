<?php
include("connection.php");


$tid=$_GET['tid'];
$pid=$_GET['pid'];
$after = "update task set status = 1 where t_id ='$tid' and p_id='$pid' ";
		if($con->query($after)){
			 echo "<form method='post'><div style='margin-left:450px;margin-top:300px; background:skyblue; width:600px;'>";
                    echo "<center><p style='color:Green '><b> Status Updated</b></p></center>";
                    echo "<center><input type='submit' name='success' value='Ok'/ ></center>";
                  echo "</div></form>";
			
		}

      if( isset($_POST["success"]) )  
                         Header('Location:todo.php');
?>