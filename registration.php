<?php

include("header.php");
include('config.php');
    
$count=false;
$invalid=false;
if(isset($_POST["submit"])){
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $phone=mysqli_real_escape_string($conn,$_POST["phone"]);
    $password=mysqli_real_escape_string($conn,$_POST["password"]);
    $cpassword=mysqli_real_escape_string($conn,$_POST["repassword"]);
  
    // hasing password//================
    $pass=password_hash($password,PASSWORD_BCRYPT);
    $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

    // email query=======================

    $email_query="select * from signup where email='$email'";
    $result=mysqli_query($conn,$email_query);

    if($result){
      echo "query successfull";
    }else{
      echo "query failed ". mysqli_error($conn);
    }

    // checking email exists or not//============

    $emailCount=mysqli_num_rows($result);
    
    if(($emailCount)> 0){
      $count=true;
    }else{
        if($pass!==$cpass){
            $invalid=true;
        }else{
        $insert="INSERT INTO `signup`(`username`, `email`, `phone`, `password`, `cpassword`) VALUES ('$username','$email','$phone','$pass','$cpass')";
        $iquery=mysqli_query($conn,$insert);
        if($iquery){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Account has been created Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>error!</strong> some error in your information 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
        }
    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('link.php'); ?>
    <title>Registration</title>
</head>
<body>
<div class="container ">

<div class="row">
<div class="col-5 offset-3">

<h4 class="text-center mt-4">Create Account</h4>
<h5 class="text-center mb-2 mt-3">Get Started with your Free Account</h5>

<button type="button" name="btn" id="btn" class="btn btn-danger text-center mb-2 mt-2 btn-md btn-block">Google</button>
<button type="button" name="" id="" class="btn btn-primary btn-md btn-block">Facebook</button>


<!-- input start from here.///=========== -->

<form action="<?php $_SERVER['PHP_SELF']  ?>" method="POST">
  <div class="form-row align-items-center">
    
    <!-- username------------------------------------------ -->

      <label class="sr-only" for="username">Username</label>
      <div class="input-group mt-3">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-user"></i></div>
        </div>
        <input type="text" class="form-control" id="username" placeholder="Full Name" name="username"required>
      </div>
    

    <!-- email------------------------------------------ -->

    <label class="sr-only" for="email">Email</label>
      <div class="input-group mt-3">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-envelope"></i></div>
        </div>
        <input type="email" class="form-control" id="email" placeholder="Email Address" name="email"required> <br>
      
      </div>
      <?php
                if($count){
                  echo '<br>';
                    echo "<h6 class='text-danger'>email already exist</h6>";
                }
        ?>
    

    <!-- Phone------------------------------------------ -->

    <label class="sr-only" for="phone">Phone</label>
      <div class="input-group mt-3">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-phone"></i></i></div>
        </div>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number"required minlength="11" maxlength="11" >
      </div>
    

    <!-- Phone Number ------------------------------------------ -->

    <label class="sr-only" for="password">Password</label>
      <div class="input-group mt-3">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-unlock"></i></div>
        </div>
        <input type="password" class="form-control" id="password" placeholder="password" name="password"required>
      
      </div>
      <?php
                if($invalid){
                    echo "<small class='text-danger'>Password doesn't matched</small>";
                }
        ?>
    

    <!-- Repeat Password ----------------------------------------- -->

    <label class="sr-only" for="repassword">Repeat Password </label>
      <div class="input-group mt-3">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-unlock"></i></div>
        </div>
        <input type="password" class="form-control" id="repassword" placeholder="Repeat Password " name="repassword"required>
        
      </div>
    

      <button type="submit" name="submit" id="" class="btn btn-primary btn-md btn-block mt-3" name="submit">Create Account</button>

    <h5 class="text-center ml-5 mt-3" >Have an account already?<a href="">log in</a></h5>


  </div>
</form>
      </div>
    </div>



</div>
</div>
</div>
</body>
</html>