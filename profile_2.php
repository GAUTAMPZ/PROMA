<?php
include("connection.php");

    $emp_id = $_SESSION["session_id"];
        if(isset($_POST["save"])){
            
            $editprofile ="UPDATE employee SET emp_fname='$_POST[fname]',emp_lname='$_POST[lname]', emp_email='$_POST[email]' where emp_id='$emp_id'";
              if($con->query($editprofile))
              {
                 echo "<form method='post' action='profile_.php'><div style='margin-left:450px;margin-top:300px; background:skyblue; width:600px;'>";
                    echo "<center><p style='color:Green '><b>Successfully Updated</b></p></center>";
                    echo "<center><input type='submit' name='success' value='Ok'/ ></center>";
                  echo "</div></form>";
              }
        }


        else if(isset($_POST["savepass"])){
          $id ="select password from employee where emp_id='$emp_id' ";
           if($result= $con->query($id)){
            while($row = $result->fetch_assoc())
                  $cur = $row["password"];
              if($cur == $_POST["cpass"]){
                 if($_POST["npass"]==$_POST["rpass"]){
                     $resetpass=" UPDATE employee SET password='$_POST[npass]' where emp_id='$emp_id'";
                     if($con->query($resetpass)){
                         echo "<form method='post'><div style='margin-left:450px;margin-top:300px; background:skyblue; width:600px;'>";
                         echo "<center><p style='color:Green '><b>Successfully Updated</b></p></center>";
                         echo "<center><input type='submit' name='success' value='Ok'/ ></center>";
                         echo "</div></form>";
                       }
                    }
                    else{
                        echo "<form method='post'><div style='margin-left:450px;margin-top:300px; background:skyblue; width:600px;'>";
                            echo "<center><p style='color:red'><b>New Password Not Matched With Re-entered Password</b></p></center>";
                            echo "<center><input type='submit' name='gotit' value='got it'/ ></center>";
                          echo "</div></form>";        
                   }
              }else{
                 echo "<form method='post'><div style='margin-left:450px;margin-top:300px; background:skyblue; width:600px;'>";
                            echo "<center><p style='color:red'><b>Wrong Current Password</b></p></center>";
                            echo "<center><input type='submit' name='gotit' value='got it'/ ></center>";
                          echo "</div></form>";    
              }
           }

           
        }

      if(isset($_POST["gotit"]) || isset($_POST["success"]) )  
                         Header('Location:profile_.php');
  ?>