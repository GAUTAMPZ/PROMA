<?php 
  if (isset($_GET["submit"])) {
    $conn = new mysqli("localhost","root","","proma1");
    
    $firstname = $_GET["firstname"];
    $lastname = $_GET["lastname"];
    $emilid = $_GET["emailid"];
    $empid = $_GET["empid"];
    $tmpass = $_GET["emppass"];
    session_start();
    $mid = $_SESSION["session_id"];

    // $sql="if(not exists(select * from employee where emp_id='$empid'))
    // insert into employee (emp_id, man_id, emp_fname, emp_lname, emp_email,  password) values ( '$empid', '$mid', '$firstname', '$lastname', '$emilid', '$tmpass'); ";
 
    $sql = "insert into employee (emp_id, man_id, emp_fname, emp_lname, emp_email,  password) values ( '$empid', '$mid', '$firstname', '$lastname', '$emilid', '$tmpass');";
    
    $logindataobject = $conn->query($sql); //or die($conn->error);
    $conn->close();
    header('Location: manager_3.php');
  }
 
  if (isset($_GET["submit1"])) {
    
    $conn = new mysqli("localhost","root","","proma1");

    $firstname = $_GET["firstname"];
    $lastname = $_GET["lastname"];
    $startdate = $_GET["startdate"];
    $enddate = $_GET["enddate"];
    $projectDescription = $_GET["projectDescription"];
    $projectleaderPassword = $_GET["projectleaderPass"];
    $projectleaderid = $_GET["projectleaderid"];
    //$projectleaderempid = $_GET["projectleaderPassword"];
    $projectleaderempid = $_GET["empAsProjectLeader"];

    $employee_array = array();    

    for ($employeecount=0; $employeecount < ($_GET["employeecount"]) ; $employeecount++) { 
      // $employee_array ["employee".$employeecount] = array("ename".$employeecount=>$_GET["ename".$employeecount],
      // "eid".$employeecount=>$_GET["eid".$employeecount]);
      // $employee_json = json_encode($employee_array);
      $temp=$_GET["eid".$employeecount];
      $sql = "insert into projectemployees (p_id,emp_id) values ('$lastname','$temp')";
    
      $logindataobject = $conn->query($sql) or die($conn->error);

    }
    $sql = "insert into projectemployees ( p_id,emp_id) values ('$lastname','$projectleaderempid')";
    
    $logindataobject = $conn->query($sql) or die($conn->error);
     session_start();
     $mid = $_SESSION["session_id"];

    // $sql = "select * from teamleader where lead_id = '$tlid'";
    // $findproid = $conn->query($sql) or die($conn->error);
    // $p_id_array = $findproid->fetch_assoc();
    // $p_id = $p_id_array["p_id"];
    

    $sql = "insert into project ( p_id, man_id, p_name, p_bdate, p_cdate, dsc, lead_id, status ) values ('$lastname','$mid', '$firstname',  '$startdate', '$enddate', '$projectDescription', '$projectleaderid', '0')";
    
    $logindataobject = $conn->query($sql) or die($conn->error);
    $sql = "insert into teamleader (lead_id, emp_id, p_id, password) values ('$projectleaderid','$projectleaderempid','$lastname', '$projectleaderPassword');";
    $logindataobject = $conn->query($sql) or die($conn->error);

    $conn->close();
    header('Location: manager_3.php');
  }
?>
<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif; margin: 0%;}

p{
    font-family: ROBOTO;
    color: #343a40;
    font-size: 22px;
    text-shadow: 0.5px 0.5px #343a40;
}

.navbar { 
    background-color: #555;
    overflow: hidden;
    align-content: center;
  }

  .navbar a {
    float: left;
    padding: 16px;
    color: #868c91;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font-size: 17px;
  }

  a:hover{
    color: #e9ecef;
  }

  @media screen and (max-width: 500px) {
    .navbar a {
      float: none;
    }
  }

@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}



.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}


.dropdown-content a:hover {background-color: #f1f1f1;}
.dropdown:hover .dropdown-content {display: block;}
.dropdown:hover .dropbtn {background-color: #3e8e41;}




.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal1{
  
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal2{
  
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close1{
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close1:hover,
.close1:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.close2{
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close2:hover,
.close2:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-body1 {padding: 2px 16px;}
.modal-footer {
  padding: 2px 16px;
  height: 14px;
  background-color: #5cb85c;
  color: white;
}

* {
  box-sizing: border-box;
}

textarea{
    height: 100px;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
input[type=date],input[type=number],input[type=email]{
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color:#8f8f8f;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

::-webkit-scrollbar {
    width: 0px;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
}


</style>
<body id="body">
<nav class="navbar" style="background-color: #343a40; 
  height:8.6%; width:100%; display:block;  margin-bottom:1%;">
    <a style="color: #72fa34;
    padding-top:18px;
    font-size:1.25rem;
    font-family:ROBOTO;
    ">PROMA</a>
    <a href="http://localhost/proma/manager_3.php" style="padding-top:21px;">Home</a>
      <a class="dropbtn" id="myBtn1" style="padding-top:21px;"><i class="fa fa-fw fa-user"></i>Add Employee</a>
      <a class="dropbtn" id="myBtn" style="padding-top:21px;"><i class="fa fa-fw fa-tasks"></i>New Project</a>
      <a href="http://localhost/proma/profile_.php" class="dropbtn" id="profile" style="padding-top:21px;"><i class="fa fa-fw fa-tasks"></i>Profile</a>
      <a href="http://localhost/proma/index.php" style="float: right; padding-top:21px;"><i class="fa fa-fw fa-sign-out"></i>Logout</a>
  </nav>
            <?php

           
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dbname = "myDB";

            $conn = new mysqli("localhost", "root", "", "proma1") or die($conn->connect_error);
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $i=0;
            $sql = "SELECT * FROM project where status=$i";
            $i=1; 
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc() ) {

            $pid=$row['p_id'];
            $sql1="SELECT COUNT(*) as n FROM task WHERE p_id='$pid'";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc() or die($conn->error);
            $n=$row1['n'];
            
            $sql2="SELECT COUNT(*) as nn FROM task WHERE p_id='$pid' and status=1";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $nn=$row2['nn'];
            if(isset($n)){
              $per = 0;
            }
            else{
              $per=($nn/$n)*100;
            }
            $i=$pid;
                
              echo "<div id='$i' onclick='projectDetail(this.id)' style='float: left;
              box-shadow:5px 10px #343a40;
              overflow: auto;
              background-color: #5cb85c;
              margin: 3%;
              margin-top: 0%;
              margin-left: 1%;
              margin-right:0%;
              width:32%;
              height: 305px;
              padding: 5px;
              padding-left:20px;
              border-radius: 16px;
              //border: 3px solid #343a40;
              cursor:auto;'>"."<p>Project Id : ".
              $row["p_id"] . "</p><p>Project Name : " .
              $row["p_name"] ."</p><p>Project Leader Id : " .
              $row["lead_id"] ."</p><p>Start Date : " . 
              $row["p_bdate"] ."</p><p>Due Date : " . 
              $row["p_cdate"] ."</p><p>Description : ".
              $row["dsc"]."</p><p>Status : ".
              $per."%</p></div>";
          }
      } else {
          echo "<p style='margin-left:20px'>No Projects... take a rest</p>";
      }
      $conn->close();
      ?>
  <script>

    
    function projectDetail(iD){
            //window.location="manager_3.php?pid="+iD;


            <?php

              
                modalcontent($_GET['pid']);
                function modalcontent($p_id){

                    

                }
            
                
            ?>
                            
  

            var id=iD;

            var container=document.getElementById("container");
            container.innerHTML="";
            var row=document.createElement("div");
            row.className="row";

            var column25=document.createElement("div");
            column25.className="col-25";
            var lable=document.createElement("label");
            lable.innerHTML="Project Name";
            column25.appendChild(lable);
            
            var column75=document.createElement("div");
            column75.className="col-75";
            var lable=document.createElement("label");

            column75.appendChild(lable);


            
            row.appendChild(column25);
            row.appendChild(column75);

            container.appendChild(row);

            var modal2 = document.getElementById("myModal2");
            var span2 = document.getElementsByClassName("close2")[0];
            modal2.style.display="block";

            span2.onclick = function() {
              modal2.style.display = "none";
            }

            window.onclick = function(event) {
              if (event.target == modal1 || event.target == modal || event.target == modal2) {
                modal.style.display = "none";
                modal1.style.display="none";
                modal2.style.display="none";
              }
            }
    }
  </script>






  
 

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Project Details Entry Form</h2>
    </div>
    <div class="modal-body">
        <div class="container">
            <form action="#" id="contains" class="contains">
            <div class="row">
              <div class="col-25">
                <label for="fname">Project Name</label>
              </div>
              <div class="col-75">
                <input type="text" id="fname" name="firstname" placeholder="Enter Project Name">
              </div>
            </div>
          
            <?php
              $conn = new mysqli("localhost","root","","proma1");
              $s="select count('p_id') as num from project";
              $count = $conn->query($s); //or die($conn->error);
              $row=mysqli_fetch_assoc($count);
              $nummm=$row['num'];
              $conn->close();
              $vall="p".($nummm+1);
            ?>

            <div class="row">
              <div class="col-25">
                <label for="lname">Project Id</label>
              </div>
              <div class="col-75">
                <input type="text" id="lname" name="lastname" value="<?php echo $vall ?>" placeholder="Enter Project Id" readonly>
              </div>
            </div>
          
            <div class="row">
              <div class="col-25">
                <label for="startDate">Start Date</label>
              </div>
              <div class="col-75">
                <input type="date" id="startDate" name="startdate" placeholder="Choose Project Start Date">
              </div>
            </div>
          
            <div class="row">
              <div class="col-25">
                <label for="endDate">End Date</label>
              </div>
              <div class="col-75">
                  <input type="date" id="endDate" name="enddate" placeholder="Choose Project End Date">
              </div>
            </div>
          
            <div class="row">
              <div class="col-25">
                <label for="projectDescription">Project Description</label>
              </div>
              <div class="col-75">
                  <textarea id="projectDescription" name="projectDescription" class="projectDescription" placeholder="Write Project Description Here..."></textarea>
              </div>
            </div>
          
            <?php
              $conn = new mysqli("localhost","root","","proma1");
              $s="select count('p_id') as num from project";
              $count = $conn->query($s); //or die($conn->error);
              $row=mysqli_fetch_assoc($count);
              $nummm=$row['num'];
              $conn->close();
              $valll="l".($nummm+1);
            ?>

            <div class="row">
              <div class="col-25">
                <label for="projectLeaderId">Project Leader Id</label>
              </div>
              <div class="col-75">
                  <input type="text" name="projectleaderid" id="projectLeaderId" value="<?php echo $valll ?>" class="projectLeaderId" placeholder="Enter Id For Project Leader" readonly>
              </div>
            </div>

            <div class="row">
              <div class="col-25">
                <label for="projectLeaderPass">Project Leader Password</label>
              </div>
              <div class="col-75">
                  <input type="text" name="projectleaderPass" id="projectLeaderPass" class="projectLeaderPass" placeholder="Enter Password For Project Leader">
              </div>
            </div>

            
            <div class="row">
              <div class="col-25">
                <label for="empAsProjectLeader">Employee Id</label>
              </div>
              <div class="col-75">
                  <input type="text" name="empAsProjectLeader" id="empAsProjectLeader" class="empAsProjectLeader" placeholder="Enter ID Of Employee To Assign As Leader">
              </div>
            </div>
          
            <div class="row">
              <div class="col-25">
                <label for="employeeCount">No. Of Employees</label>
              </div>
              <div class="col-75">
                  <input type="number" name="employeecount" id="employeeCount" class="employeeCount" placeholder="Enter No. Of Employee For This Project"></textarea> 
              </div>
            </div>
            <div class="row">
              <input type="submit" value="Submit" name="submit1">
            </div>
            
            </form>
            <br>
            <div class="row">
                  <button onclick="nameFunction()" 
                      style="float: right;
                      background-color: #4CAF50;
                      color: white;
                      padding: 12px 20px;
                      border: none;
                      border-radius: 4px;
                      margin-right: 4px;
                      cursor: pointer;"
                      id="addEmployees">Add Employees
                  </button>
            </div>
          </div>
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>

<div id="myModal1" class="modal1">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close1">&times;</span>
      <h2>Employee Details Entry Form</h2>
    </div>
    <div class="modal-body">
      <div class="container">
        <form action="#" id="contains" class="contains">
        <div class="row">
          <div class="col-25">
            <label for="fname">First Name</label>
          </div>
          <div class="col-75">
            <input type="text" id="fname" name="firstname" placeholder="Enter First Name">
          </div>
        </div>
      
        <div class="row">
          <div class="col-25">
            <label for="lname">Last Name</label>
          </div>
          <div class="col-75">
            <input type="text" id="lname" name="lastname" placeholder="Enter Last Name">
          </div>
        </div>
      
        
      
        <div class="row">
          <div class="col-25">
            <label for="emailId">Email Id</label>
          </div>
          <div class="col-75">
              <input type="email" id="email" name="emailid" class="email" placeholder="Enter Email Id"></textarea>
          </div>
        </div>
        <?php
          $conn = new mysqli("localhost","root","","proma1");
          $s="select count('emp_id') as num from employee";
          $count = $conn->query($s); //or die($conn->error);
          $row=mysqli_fetch_assoc($count);
          $nummm=$row['num'];
          $conn->close();
          $val="e".($nummm+1);
        ?>
        <div class="row">
          <div class="col-25">
            <label for="empId">Employee Id</label>
          </div>
          <div class="col-75">
              <input type="text" id="empId" name="empid" class="empId" value="<?php echo $val ?>" placeholder="Enter Employee Id" readonly></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="emppass">Password</label>
          </div>
          <div class="col-75">
              <input type="text" id="emppass" name="emppass" class="emppass" placeholder="Enter Employee Password"></textarea>
          </div>
        </div>
        <div class="row">
          <input type="submit" value="Submit" name="submit">
        </div>
        </form>
        <br>
        
        
      
      </div>
      
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>


<SCRIPT language="javascript">
    function nameFunction(){
        var num=document.getElementById("employeeCount").value;
        var lbl=document.createElement("label");
        lbl.innerHTML="Enter Employee Name and Id Below :";
        lbl.style.marginTop="4px";
        lbl.style.marginBottom="4px";
        lbl.style.display="block";
        document.getElementById("contains").appendChild(lbl);
        
        for(var i=0;i<num;i++){
            empname="ename"+i;
            var textField = document.createElement("INPUT");
            textField.setAttribute("name",empname);
            textField.setAttribute("type", "text");
            textField.setAttribute("placeholder", "Enter Name "+(i+1));
            textField.style.marginTop="4px";
            textField.style.marginBottom="4px";
            textField.style.width="70%";
            textField.style.marginRight="5%"
            textField.style.cssFloat="left";

            empid="eid"+i;
            var idField=document.createElement("input");
            idField.setAttribute("type", "text");
            idField.setAttribute("name",empid);
            idField.setAttribute("placeholder", "Enter ID "+(i+1));
            idField.style.marginTop="4px";
            idField.style.marginBottom="4px";
            idField.style.width="25%";
            idField.style.cssFloat="left";

            document.getElementById("contains").appendChild(textField);
            document.getElementById("contains").appendChild(idField);
        }
        document.getElementById("addEmployees").style.display="none";
    }
</SCRIPT>
  
</body>
<script>
// Get the modal
  var modal = document.getElementById("myModal");
  var modal1 = document.getElementById("myModal1");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");
  var btn1 = document.getElementById("myBtn1");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  var span1 = document.getElementsByClassName("close1")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }
  btn1.onclick=function(){
    modal1.style.display="block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
  span1.onclick=function(){
    modal1.style.display="none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal1 || event.target == modal) {
      modal.style.display = "none";
      modal1.style.display="none";
    }
  }
</script>
</html> 