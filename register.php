<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Ayush Petigara">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Ayush Petigara</title>
  </head>
  <body>
    <div class="pt-5"></div>
    <div class="container">
        <a href="index.html" class="float-right btn btn-info">Home</a> 
        <div class="mx-auto w-50 px-3 bg-light text-dark text-center mainbox mt-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <div class="panel panel-info">
          <div class="panel panel-heading">
            <h5>REGISTER</h5>
          </div>
          <div class="pt-3 panel-body">
            <form method="post" action="register.php">
      	     <?php include('errors.php'); ?>
            	<div class="form-group col-sm-12 mx-auto">
            	  <label>Username</label>
            	  <input class="form-control" type="text" name="username" value="<?php echo $username; ?>" required>
            	</div>
            	<div class="form-group col-sm-12 mx-auto">
            	  <label>Email</label>
            	  <input class="form-control" type="email" name="email" value="<?php echo $email; ?>" required>
            	</div>
            	<div class="form-group col-sm-12 mx-auto">
            	  <label>Password</label>
            	  <input class="form-control" type="password" name="password_1" required>
            	</div>
            	<div class="form-group col-sm-12 mx-auto">
            	  <label>Confirm password</label>
            	  <input class="form-control" type="password" name="password_2" required>
            	</div>
            	<div class="form-group col-sm-12 mx-auto">
            	  <button type="submit" class="btn btn-success" name="reg_user">Register</button>
            	</div>
            	<p class="mx-auto">
            		Already a member? <a href="login.php">Log in</a>
            	</p>
            </form>
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