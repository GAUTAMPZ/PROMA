<?php   
    session_start(); 
    $tlid = $_SESSION["session_id"];
    if (isset($_GET["mname0"])) {
    
    $url= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = urldecode($url);
    $url_array = explode('?',$url);
    $data = $url_array[1];
    $dataarray = explode('&',$data);
    $size = sizeof($dataarray);

    $conn = new mysqli("localhost","root","","proma1");
    for ($addmoduleloop=0; $addmoduleloop < ($size/3) ; $addmoduleloop++) { 
      
      $t_id = $_GET["mid".$addmoduleloop];
      $t_name = $_GET["mname".$addmoduleloop];
      $dsc =$_GET["moduledesc".$addmoduleloop];


      $sql = "select * from teamleader where lead_id = '$tlid'";
      $findproid = $conn->query($sql) or die($conn->connect_error);
      $p_id_array = $findproid->fetch_assoc();
      $p_id = $p_id_array['p_id'];
      echo $p_id;
      $sql = "insert into task (t_id, p_id, t_name, dsc,status) values ('$t_id', '$p_id', '$t_name','$dsc','0');";
      $logindatateamleaderobject = $conn->query($sql) or die($conn->error);

    }

    $conn->close();
    header('Location: teamleader_3.php');
  }
  if (isset($_GET["empid0"])) {
  
    $url= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = urldecode($url);
    $url_array = explode('?',$url);
    $data = $url_array[1];
    $dataarray = explode('&',$data);
    $size = sizeof($dataarray);

    $conn = new mysqli("localhost","root","","proma1");    
  
    $tlid = $_SESSION["session_id"];

    $sql = "select * from teamleader where lead_id = '$tlid'";
    $findproid = $conn->query($sql) or die($conn->error);
    $p_id_array = $findproid->fetch_assoc();
    $p_id = $p_id_array["p_id"];
    //$search = $url_array['5'];

    for ($allocatemoduleloop=0; $allocatemoduleloop < ($size/3) ; $allocatemoduleloop++) { 
      
      $mid = $_GET["mid".$allocatemoduleloop];
      $emp_id = $_GET["empid".$allocatemoduleloop];
      $due_date =$_GET["duedate".$allocatemoduleloop];
      $sql = "insert into work values('$emp_id', '$p_id', '$mid') ;";
      $sql1="update task set due_date='$due_date' where p_id='$p_id' and t_id='$mid';";
      // $sql = "insert into task (emp_id, due_date) values ('$emp_id','$due_date') where t_id = $mid;";
      $datatlobject = $conn->query($sql) or die($conn->error) ;
      $datatlobject1 = $conn->query($sql1) or die($conn->error) ;
    }

    $conn->close();
      header('Location: teamleader_3.php');
  }
?>
<!DOCTYPE html>
<html>
<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0%;
  }
  
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



  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #f1f1f1;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .dropdown:hover .dropbtn {
    background-color: #3e8e41;
  }




  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
  }

  .modal1 {

    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
  }

  /* Add Animation */
  @-webkit-keyframes animatetop {
    from {
      top: -300px;
      opacity: 0
    }

    to {
      top: 0;
      opacity: 1
    }
  }

  @keyframes animatetop {
    from {
      top: -300px;
      opacity: 0
    }

    to {
      top: 0;
      opacity: 1
    }
  }

  /* The Close Button */
  .close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close1 {
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

  .modal-body {
    padding: 2px 16px;
  }

  .modal-footer {
    padding: 2px 16px;
    height: 14px;
    background-color: #5cb85c;
    color: white;
  }

  * {
    box-sizing: border-box;
  }

  textarea {
    height: 100px;
  }

  input[type=text],
  select,
  textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }

  input[type=date],
  input[type=number],
  input[type=email] {
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
    background-color: #8f8f8f;
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

    .col-25,
    .col-75,
    input[type=submit] {
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
  height:8.6%; width:100%; display:block;   margin-bottom:1%;">
    <a style="color: #72fa34;
    padding-top:18px;
    font-size:1.25rem;
    font-family:ROBOTO;
    ">PROMA</a>
    <a href="http://localhost/proma/teamleader_3.php" style="padding-top:21px;">Home</a>
      <a class="dropbtn" id="myBtn1" style="padding-top:21px;"><i class="fa fa-fw fa-user"></i>Devide Modules</a>
      <a class="dropbtn" id="myBtn" style="padding-top:21px;"><i class="fa fa-fw fa-tasks"></i>Task Allocation</a>
      <a href="http://localhost/proma/forwarded_task.php" class="dropbtn" id="notification" style="padding-top:21px;"><i class="fa fa-fw fa-tasks"></i>Notification</a>
    <a href="http://localhost/proma/index.php" style="float: right; padding-top:21px;"><i class="fa fa-fw fa-sign-out"></i>Logout</a>
  </nav>
  
  <?php

      $conn = new mysqli("localhost", "root", "", "proma1") or die($conn->connect_error);
  
      if ($conn->connect_error) {
          die("Connection failed: ". $conn->connect_error);
      } 
      // $lid = $_SESSION["session_id"];
      $sql = "SELECT * FROM project where lead_id='$tlid'"; 
      $result = $conn->query($sql) or die ($conn->error);
      $pid=null;
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $pid=$row['p_id'];
            $sql1="SELECT COUNT(*) as n FROM task WHERE p_id='$pid'";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            $n=$row1['n'];
            
            $sql2="SELECT COUNT(*) as nn FROM task WHERE p_id='$pid' and status=1";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $nn=$row2['nn'];
            if($n!=0){
            $per=($nn/$n)*100;}
            else{
              $per=0;
            }
            $pid=$row['p_id'];
                
              echo "<div id='$pid' style='float: left;
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
              $row["p_name"] ."</p><p>Start Date : " . 
              $row["p_bdate"] ."</p><p>Due Date : " . 
              $row["p_cdate"] ."</p><p>Description : ".
              $row["dsc"]."</p><p>Project Status : ".
              $per."%</p><button id='deletebtn' style='background-color:rgba(0, 0, 0, 0.2); border-radius:16px; width:100px; height:50px;'></button></div>"; 
                            
          }
      } else {
        echo "<p style='margin-left:20px'>No Projects... take a rest</p>";
      }
      ?>

  


      <?php

        $conn = new mysqli("localhost", "root", "", "proma1") or die($conn->connect_error);
          
        if ($conn->connect_error) {
            die("Connection failed: ". $conn->connect_error);
        } 
        $sql10 = "SELECT p_id FROM teamleader where lead_id='$tlid'"; 
        $result10 = $conn->query($sql10);
        $row10 = $result10->fetch_assoc();


        $sql11="SELECT * from task where p_id='$pid'";
        $result11 = $conn->query($sql11);

        if ($result11->num_rows > 0) {
          while($row11 = $result11->fetch_assoc()) {
              $tid=$row11["t_id"];
              $sql22="SELECT due_date FROM task WHERE t_id='$tid' and p_id='$pid'";
              $result22 = $conn->query($sql22);
              $row22=$result22->fetch_assoc();
              if($row22!=null){
                $duedate=$row22['due_date'];
              }
              else{
                $duedate="Not Assisned";
              }


              $sql222="SELECT emp_id FROM work WHERE t_id='$tid' and p_id='$pid'";
              $result222 = $conn->query($sql222);
              $row222=$result222->fetch_assoc();
              if($row222!=null){
                $emp=$row222['emp_id'];
              }
              else{
                $emp="Not Assisned";
              }
              
              echo "<div id='$tid'  style='float: left;
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
              cursor:auto;'>"."<p>Task Id : ". $row11["t_id"] . "</p><p>Task Name : " 
              . $row11["t_name"] ."</p><p> Description : " 
              . $row11["dsc"] ."</p><p>Task Status : "
              . $row11["status"] ."</p><p>Due Date : " . $duedate ."</p><p>Employee : " . $emp ."</p></div>"; 
             
          }
      } 
      ?>

  



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
            <input type="text" name="mid0" placeholder="Enter Module Id">

            <input type="text" name="empid0" placeholder="Enter Employee Id">

            <input type="date" name="duedate0" placeholder="Enter Due Date">

            <input type="submit" id="submit" value="Submit" style="display:none;">
          </form>
          <br>
          <div class="row">
            <label for="submit" style="float: right;
                      font-size:13px;
                      height:39px;
                      background-color: #4CAF50;
                      color: white;
                      padding: 12px 20px;
                      border: none;
                      border-radius: 4px;
                      margin-right: 4px;
                      cursor: pointer;">Submit</label>
            <button onclick="nameFunction1()" style="float: right;
                      background-color: #4CAF50;
                      color: white;
                      padding: 12px 20px;
                      border: none;
                      border-radius: 4px;
                      margin-right: 4px;
                      cursor: pointer;" id="addEmployees">Add
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
        <h2>Project Modules Devision</h2>
      </div>
      <div class="modal-body">
        <div class="container">
          <form action="#" id="containss" class="containss">
            <input type="text" id="mname" name="mname0" placeholder="Enter Module Name">
            <input type="text" id="mid" value="mod1" name="mid0" placeholder="Enter Module Id" readonly>
            <textarea id="moduleDescription" name="moduledesc0" placeholder="Enter Module Description Here..."></textarea>
            <input type="submit" id="submit1" value="Submit" style="display:none;">
          </form>
          </form>
          <br>
          <div class="row">
            <label for="submit1" style="float: right;
                  font-size:13px;
                  height:39px;
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                margin-right: 4px;
                cursor: pointer;">Submit</label>
            <button onclick="nameFunction()" style="float: right;
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                margin-right: 4px;
                cursor: pointer;" id="addModule">Add Module
            </button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>

 

  <SCRIPT>


  // document.getElementById("deletebtn").onclick=function(){
  //   if(confirm("Are you sure you want to delete this row?")==true)
  //          window.location="teamleader_3.php?del="+"<?php echo $lid ?>";
  //   return false;
  // }

<?php

//   if($_GET['del'])
//   {
//   update($lid);
//   } 

//   function update($lid){
//     $conn = new mysqli("localhost", "root", "", "proma1") or die($conn->connect_error);

//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     } 
//     $sql = "DELETE FROM teamleader WHERE lead_id='$lid'";
    
//     $result = $conn->query($sql);
//     $conn->close();
// }
      
?>

</SCRIPT>

  <SCRIPT language="javascript">
    var uniqueID = (function() {
      var id = 1;
      return function() {
        return id++;
      };
    })();
    var uniqueID1 = (function() {
      var id = 1;
      return function() {
        return id++;
      };
    })();


    function nameFunction() {

      var i = uniqueID();
      var hrr = document.createElement("hr");
      document.getElementById("containss").appendChild(hrr);

      var modulenameField = document.createElement("input");
      modulenameField.setAttribute("type", "text");
      modulenameField.setAttribute("name", "mname" + i);
      modulenameField.setAttribute("placeholder", "Enter Module Name");

      document.getElementById("containss").appendChild(modulenameField);

      var moduleid = document.createElement("input");
      moduleid.setAttribute("type", "text");
      moduleid.setAttribute("name", "mid" + i);
      moduleid.setAttribute("placeholder", "Enter Module Id");
      moduleid.value="mod"+(i+1);
      moduleid.readOnly=true;

      document.getElementById("containss").appendChild(moduleid);

      var moduleDescription = document.createElement("textarea");
      moduleDescription.setAttribute("name", "moduledesc" + i);
      moduleDescription.setAttribute("placeholder", "Enter Module Description Here...");

      document.getElementById("containss").appendChild(moduleDescription);

    }

    function nameFunction1() {

      var i = uniqueID1();

      var hrr = document.createElement("hr");
      document.getElementById("contains").appendChild(hrr);

      var moduleIdField = document.createElement("input");
      moduleIdField.setAttribute("type", "text");
      moduleIdField.setAttribute("name", "mid" + i);
      moduleIdField.setAttribute("placeholder", "Enter Module Id");

      document.getElementById("contains").appendChild(moduleIdField);

      var moduleIdField = document.createElement("input");
      moduleIdField.setAttribute("type", "text");
      moduleIdField.setAttribute("name", "empid" + i);
      moduleIdField.setAttribute("placeholder", "Enter Employee Id");

      document.getElementById("contains").appendChild(moduleIdField);

      var moduleDueDateField = document.createElement("input");
      moduleDueDateField.setAttribute("type", "date");
      moduleDueDateField.setAttribute("name", "duedate" + i);
      moduleDueDateField.setAttribute("placeholder", "Enter Due Date");

      document.getElementById("contains").appendChild(moduleDueDateField);
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
  btn1.onclick = function() {
    modal1.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
  span1.onclick = function() {
    modal1.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal1 || event.target == modal) {
      modal.style.display = "none";
      modal1.style.display = "none";
    }
  }
</script>

</html>