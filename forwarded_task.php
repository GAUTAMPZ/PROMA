<?php

      $conn = new mysqli("localhost", "root", "", "proma1") or die($conn->connect_error);
  
      if ($conn->connect_error) {
          die("Connection failed: ". $conn->connect_error);
      } 

      session_start();
      $lead_idg = $_SESSION['session_id'];
      $sql = "SELECT * FROM teamleader where lead_id = '$lead_idg'"; 
      $result = $conn->query($sql) or die ($conn->error);
      $pidarray = $result->fetch_assoc();
      $pid = $pidarray['p_id'];
      $sql = "SELECT * FROM forworded_task where p_id = '$pid'"; 
      $result = $conn->query($sql) or die ($conn->error);   

      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            
            $tid=$row['t_id'];
                
              echo "<div id='$pid' style='float: left;box-shadow:5px 10px #343a40;overflow: auto;background-color: #5cb85c;margin: 1%;width:100%;height: 150px;padding: 5px;padding-left:20px;border-radius: 16px;cursor:auto;'>"
              ."</p><p>Project id : ".$row["p_id"]
              ."<p>Task Id : ".$row["t_id"] 
              . "</p><p>forwarded emp : " .$row["femp_id"] 
              ."</p><p>receiver emp : " . $row["remp_id"] 
              ."</p><p>reason : " . $row["reason"] 
              ."</p><p>forwarded date : ".$row["fdate"]
              ."</div>";             
          }
      } else {
          echo "No forwarded task";
      }
      
?>