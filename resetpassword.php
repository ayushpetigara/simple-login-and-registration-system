<?php
include 'server.php';
//UPDATE PASSWORD
    
     
    $email = $_GET['email'];
    $token = $_GET['token'];
    
    $userid = "SELECT id FROM users WHERE email='$email' AND token='$token' AND tokenExpire > NOW()";
    $res = mysqli_query($db,$userid);
    $user = mysqli_fetch_assoc($res);
    $id = $user['id'];

        if(isset($_POST['update_password'])){
            $password = mysqli_real_escape_string($db, $_POST['password']);
            $password1 = mysqli_real_escape_string($db, $_POST['password1']);
            if ($password == $password1) {
                $options = array("cost"=>4);
                $pass = password_hash($password1,PASSWORD_BCRYPT,$options);
                $query = "UPDATE users SET pass='$pass' WHERE id='$id'";
                
                $update = mysqli_query($db,$query);
                if($update){
                    echo "The password was updated successfully!";
                    session_destroy();
                    header('location: index.html');
                    exit();   
                }
                else{
                    echo "Something went wrong!!";
                }
             }
             else{
                 echo json_encode("Two passwords does not match");
             }
        }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Ayush Petigara">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
    <title>Reset Password</title>
  </head>
  <body>
    <div class="pt-5"></div>
    <div class="container">
        <a href="index.html" class="float-right btn btn-info">Home</a>
      <div class="mx-auto w-50 px-3 bg-light text-dark text-center mainbox mt-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
        <div class="panel panel-heading">
          <h5>UPDATE PASSWORD</h5>
        </div>
        <div class="pt-3 panel-body">
          <form method="post" action="resetpassword.php">
          	<?php include('errors.php'); ?>
          	
          	<div class="form-group col-sm-12 mx-auto">
          		<label>Password</label>
          		<input class="form-control  " type="password" name="password" required>
          	</div>
          	<div class="form-group col-sm-12 mx-auto">
          		<label>Confrim-Password</label>
          		<input class="form-control  " type="password" name="password1" required>
          	</div>
          	<div class="form-group col-sm-12 mx-auto">
          		<button type="submit" class="btn btn-info" name="update_password">Update</button>
           	</div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
