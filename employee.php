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
  <link rel="stylesheet" type="text/css" href="css/employee.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="js/main.js?v=<?php echo time(); ?>"  type="text/javascript" />
  
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
 <div id="preloder">
    <div class="loader"></div>
  </div>

<?php

$sql = "SELECT a.p_id,a.p_name  from project a INNER JOIN work b WHERE b.emp_id = '$emp_id' and a.p_id = b.p_id"; 
      $result = $con->query($sql);
    
      $i=0;
          while($row1 = $result->fetch_assoc()) {
             echo "<div class='$i' id='$i' style='float: left;
              background-color: #4CAF50 ;
              margin: 3%;
              margin-top:15px;
              margin-left: 2%;
              width: 20%;
              height: auto;
              border-radius: 16px;
              border: 2px;
              text-align: center;
              border: 5px solid darkgray ;
              cursor:auto;'>"."<h3>Project Id : ". $row1["p_id"] . "</h3><h3>Project Name : " . $row1["p_name"] ."</h3></div>"; 
              $i=$i+1;
          
          }
?>

</body>
</html>
