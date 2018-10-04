<?php
session_start();

// random password generator function
function randomPassword() {
    $alphabet = '!@#$%^&*()abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

// initializing variables
$username = "";
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('host', 'id', 'password', 'db');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $options = array("cost"=>4);
    $password = password_hash($password_1,PASSWORD_BCRYPT,$options);//encrypt the password before saving in the database

    $query = "INSERT INTO users (username, email, password)
          VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
    exit();
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM users WHERE username='$username'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $row = mysqli_fetch_assoc(mysqli_query($db, $query));
      if(password_verify($password, $row['password'])){
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
        exit();
      }
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

  use PHPMailer\PHPMailer\PHPMailer;

// FORGOT PASSWORD
if (isset($_POST['forgot_pswd'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);

  if (empty($username)) {array_push($errors, "Username is required");}
  if (empty($email)) { array_push($errors, "Email is required");}

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if (($user['username'] === $username) && ($user['email'] === $email)) {

        $Password = randomPassword();
        $options = array("cost"=>4);
        $newPassword = password_hash($Password,PASSWORD_BCRYPT,$options);

        $query = "UPDATE users SET password='$newPassword' WHERE email='$email'";
        $res = mysqli_query($db,$query);
            require 'PHPMailer/PHPMailer.php';

            $mail = new PHPMailer();
            $mail->addAddress($email);
            $mail->SetFrom("ayushpet@gmail.com","Ayush Registration System");
            $mail->Subject = "Your updated password";
            $mail->isHTML(true);
            $mail->Body = "
            Hi, <br><br>
            Your new password is <b> $Password </b><br>

            Sincerely, <br>
            Ayush
            ";

            if ($mail->send()){
                json_encode(array("status" => 1, "msg" => 'Please check your inbox!!'));
                header('location: index.html');
                exit();
            }
            else{
                exit(json_encode(array("status" => 0, "msg" => 'Something went wrong. Please try again')));
            }

    } else {
      array_push($errors, "User does not exists");
    }
  }
}

?>
