<?php
session_start();
include 'model.php';
//include 'view_mainpage.php';

if (empty($_POST['page'])) {
  include("landingpage.php");
  exit();
}

$page = $_POST['page'];
if ($page === 'LandingPage') {
  $command = $_POST['command'];
  switch ($command) {
    case 'SignUp':
      if (checkIfUserExists($_POST['username'])) {
        echo "<script>alert('User already exists! Please sign in');</script>";
        include("landingpage.php");
      } else {
        registerUser($_POST['username'], $_POST['email'], $_POST['password']);
        echo "<script>alert('Successful sign up! Welcome!');</script>";
        include("landingpage.php");
        $display_modal = 'login';
      }
      exit();
    case 'LogIn':
      if (checkValidUsernameandPassword($_POST['username'], $_POST['password'])) {
        $_SESSION['signedin'] = 'YES';
        $_SESSION['username'] = $_POST['username'];
        if (isset($_SESSION['signedin'])) {
          echo "<script>alert('session started and set!');</script>";
        }
        echo "<script>alert('Welcome to RecipeNest!');</script";
        include("recipenest.php");
      } else {
        echo "<script>alert('Please enter valid username and password!')</script>";
        include("landingpage.php");
      }
      exit();
    default:
      echo 'Unknown command!<br>';
      exit();
  }
}
