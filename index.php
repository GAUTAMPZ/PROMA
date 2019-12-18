<?php 


  if(isset($_POST['submit'])) {
    $conn = new mysqli("localhost","root", "", "proma1") or die($conn->connect_error);
    $email = $_POST['email'];
    $checkbox = $_POST['category'];
    if ($checkbox=="Manager") {
      $sql = "select * from manager where man_id='$email';";
      $result = $conn->query($sql) or die("query not run");     
    }
    else if ($checkbox=="Team Leader") {
      $sql = "select * from teamleader where lead_id='$email';";
      $result = $conn->query($sql) or die("query not run");     
    }
    else if ($checkbox=="Developer") {
      $sql = "select * from employee where emp_id='$email';";
      $result = $conn->query($sql) or die("query not run");     
    }

    if ($result->num_rows==1) {
      $login_data = $result->fetch_assoc();
      if ($login_data['password']==$_POST['psw']) {

        session_start();
        if ($checkbox=="Manager") {
          $_SESSION['session_id'] = $login_data['man_id']; 
          if ($_SESSION['session_id']) {  
            header('Location: manager_3.php');
          }
        }
        else if ($checkbox=="Team Leader") {
          $_SESSION['session_id'] = $login_data['lead_id']; 
          if ($_SESSION['session_id']) {  
            header('Location:teamleader_3.php');
          }
        }
        else if ($checkbox=="Developer") {
          $_SESSION['session_id'] = $login_data['emp_id'];
          if ($_SESSION['session_id']) {  
            header('Location: employee.php');
          }
        }
      }
      else{
      //  echo "<script>  document.getElementById('display').style.display = 'block'; document.getElementById('text_for_warning').style.backgroundColor = 'red'; document.getElementById('text_for_warning_p').innerHTML = 'Password is wrong'; </script>";
          // echo "<script> document.getElementById('InCreP').style.display='block';</script>";
          //echo "<script>document.getElementById('InCreP').value='harsh';</script>";
          echo"<style>
            #InCreP {
              display:block;
            }
          </style>";
      }
    }
    else{
      // echo "<script>  document.getElementById('display').style.display = 'block'; document.getElementById('text_for_warning').style.backgroundColor = 'yellow'; document.getElementById('text_for_warning_p').innerHTML = 'This email is not registered please signed up'; </script>";
          // echo "<script> document.getElementById('InCreP').style.display='block';</script>";
         // echo "<script>document.getElementById('InCreP').value='harsh';</script>";
         echo"<style>
         #InCreP {
           display:block;
         }
       </style>";
    }
    $conn->close();
  }
?>  
 <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #45a049;
  text-align: center;
}

* {
  box-sizing: border-box;
}

form {
    display: inline-block;
}

.container {
  padding: 16px;
  background-color: white;
  border-radius: 16px;
  border: 5px solid darkgray;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #d6d6d6;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}
.show_warning{
    position: fixed;
    width: 100%;
    top: 0;
    text-align: center;
    z-index: 100000;
}

#display{
    display: block;
    background-color: transparent;  
}

#text_for_warning{
    display: inline-block;
    padding:10px 100px 10px 100px;
    color: black;
    max-width: 50%;
}

</style>
</head>
<body>

<form method="post" >
    <!-- <div  class="show_warning" id="display">
      <div id="text_for_warning">
        <p id="text_for_warning_p"></p>
      </div>
    </div> -->
  <div class="container">
    <h1>Login</h1>
    <hr style="color: darkgray">
    <label for="empid"><b>Employee Id</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="radiobtn"><b>Category</b></label><br>
    <input type="radio" placeholder="Manager" value="Manager" name="category" required>Manager
    <input type="radio" placeholder="Team Leader" value="Team Leader" name="category" required>Team Leader
    <input type="radio" placeholder="Developer" value="Developer" name="category" required>Employee
    <hr>
    <button type="submit" class="registerbtn" name= "submit" value="true" >Login</button>
  </div>
  
</form>
<!-- <script>
  var empid=document.getElementById("empid");
  var password=document.getElementById("")
</script> -->
<p id="InCreP" style="display:none;">Incorrect Credentials</p>
</body>
</html>