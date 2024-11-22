<?php
session_start();
include 'model.php';
//include 'view_mainpage.php';

if (empty($_POST['page'])) {
  include("landingpage2.php");
  exit();
}

$page = $_POST['page'];
if ($page === 'LandingPage') {
  $command = $_POST['command'];
  switch ($command) {
    case 'SignIn':
      if (checkValidUsernameAndPassword($_POST['username'], $_POST['password'])) {
        $_SESSION['signedin'] = 'YES';
        $_SESSION['username'] = $_POST['username'];
        include("recipenest.php"); // Load the main page
      } else {
        echo "<script>alert('Invalid username or password!')</script>";
        include("landingpage2.php"); // Reload the login page with an error
      }
      exit();
    case 'SignUp':
      if (checkIfUserExists($_POST['username'])) {
        echo "<script>alert('User already exists! Please sign in');</script>";
        include("landingpage2.php");
      } else {
        registerUser($_POST['username'], $_POST['email'], $_POST['password']);
        $display_modal_window = "signin";
        include("landingpage2.php");
      }
      exit();
    default:
      echo 'Unknown command!<br>';
      exit();
  }
} else if ($page === 'MainPage') {

  if (!isset($_SESSION['signedin'])) {
    echo "<script>alert('Session variables not set yet');</script>";
    include("landingpage.php");
    exit();
  }

  $recipenestuser = $_SESSION['username'];
  $recipename = $_POST['recipename'];
  $category = $_POST['category'];
  $command = $_POST['command'];
  switch ($command) {
    case 'AddRecipe':
      addRecipe($recipenestuser, $_POST['recipename'], $_POST['category'], $_POST['recipedescription'], $_POST['ingredients'], $_POST['instructions']);
      exit();
    case 'SearchRecipe':
      $result = searchRecipe($recipename);
      echo json_encode($result);
      exit();
    default:
      echo 'Unknown command<br>';
      exit();
  }
}
