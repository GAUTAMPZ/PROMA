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
 <link href="css/profile.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,600,600i,700" rel="stylesheet">
  <script src="js/main.js"></script>

    <link rel="stylesheet" href="css/style.css"/>
  
</head>
<body>
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        
        <a class="navbar-brand" href="#">PROMA</a>

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="manager.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Logout</a>
          </li>
        </ul>
      </nav>


<!--Php section for value of employee -->
<?php 
   $sql="Select * from employee where emp_id='$emp_id'";
    $result=$con->query($sql);
    while($row = $result->fetch_assoc()){
      $e_id=$row['emp_id'];
      $fname=$row['emp_fname'];
      $lname=$row['emp_lname'];
      $email=$row['emp_email'];

    }
  ?>

  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>  
  <!-- Header section start -->
  <div class="container1">
    <section class="hero-section spad" style="padding-top:50px padding-bottom:0px;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-10 offset-xl-1">
          <div class="row">
            <div class="col-lg-6">
              <div class="hero-info">
                <div class="hero-text">
                <h2 style="margin-bottom: 0px; font-size: 90px;"><?php echo $fname; ?> </h2>
                <h2 style="margin-top: 0px; margin-bottom: 0px; font-size: 90px;"><?php echo $lname ?></h2>
                
              </div>
                <h2>General Info</h2>
                <ul>
                  <li><span>Employee ID </span><?php echo $e_id; ?></li>
                  <li><span>First Name </span><?php echo $fname; ?></li>
                  <li><span>Last Name </span><?php echo $lname; ?></li>
                  <li><span>Email </span><?php echo $email ?></li>
                  <li><input type="button" name="Edit" value="Edit" style="float: right; margin-right: 35%;" onclick="edit()" > </li>
                </ul>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>

    <form method="POST" action="profile_2.php">
               
              <table id="hidden1" class="hidden" style="display: none">
               <tr>
                 <td colspan="2">
               <span id="span" class="close" style="display: none;">&times;</span>
                 </td >
                </tr>
                <tr>
                 <td id="one" >First Name</td>
              <td id="second"><input type="text" name="fname" value=<?php echo $fname; ?>></td> 
                </tr>
                <tr>
                 <td id="one">Last Name</td> 
              <td id="second"><input type="text" name="lname" value=<?php echo $lname; ?>></td>
                </tr>
                <tr>
              <td id="one"style="width: 50px;">Email</td> 
                <td id="second"><input type="email" name="email" value=<?php echo $email; ?>></td>
                </tr>
                 <tr>
                   <td >
                    <center><input type="button" name="editpass" id ="editpass" style="margin-left: 15px; margin-top: 0px;" value="Reset Password"  style="display: none" > </center>
                  </td>
                  <td >
                    <input type="submit" style="margin: 5px;"  name="save" id ="save" value="Save" style="display: none"> 
                  </td>
                </tr>

            </table>
     </form>
             <form method="post" action="profile_2.php">
               
              <table id="hidden2" class="hidden" style="display: none">
               <tr>
                 <td colspan="2">
               <span id="span1" class="close" style="display: none;">&times;</span>
                 </td >
                </tr>
                <tr>

              <td id="second"><input type="Password" name="cpass" placeholder="Enter Current Password "></td> 
                </tr>
                <tr>

              <td id="second"><input type="Password" name="npass" placeholder="Enter New Password"></td>
                </tr>
               <tr>
               
              <td id="second"><input type="Password" name="rpass" placeholder="ReEnter New Password"></td>
                </tr>
                 <tr>
                  
                  <td >
                    <center><input type="submit" name="savepass" id ="savepass" value="Save" style="display: none"> </center>
                  </td>
                </tr>

            </table>
            </form>
            


  </section>
      
</div>     
</body>

</html>
<script type="text/javascript">
 function edit(){
 
  $(document).ready(function(){
      $("#hidden1 ").slideDown(function(){
          hidden1.style.display="block";
        span.style.display="block"
        save.style.display="block"
        editpass.style.display="block"
       
      });

     
 });

  $(document).ready(function(){
   $("#span").click(function(){
          hidden1.style.display="none";
        span.style.display="none"
        save.style.display="none"
        editpass.style.display="none"
       
      });
     });

   $(document).ready(function(){
   $("#editpass").click(function(){
      hidden1.style.display="none";

         hidden2.style.display="block";
        savepass.style.display="block";
        span1.style.display="block";
      });
     });

   $(document).ready(function(){
   $("#span1").click(function(){
        hidden2.style.display="none";
        span1.style.display="none"
        savepass.style.display="none"
      });
     });

}




</script>

