<?php


$servername="localhost";
$username="root";
$password="";
$database="regis";

$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> We are sorry for this problem.Try Again!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}




?>