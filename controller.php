<?php
session_start();
include 'model.php';
//include 'view_mainpage.php';

  if(empty($_POST['page'])){
    include("landingpage.html");
    exit();
  }

  $page = $_POST['page'];
  if($page == 'LandingPage'){
    $command = $_POST['command'];
    switch($command){
        case 'SignUp':
            if(checkIfUserExists($_POST['username'], $conn)){
                echo "<script>alert('User already exists! Please sign in');</script>";
                include("recipenest.html");
              }
              else{
                insertIntoDatabase($_POST['username'], $_POST['password'],$email = $_POST['email'] , $conn);
                echo "<script>alert('Successful sign up! Welcome!');</script>";
                include("landingpage.html");
              } 
              exit();
        case 'LogIn':
            if(checkValidUsernameandPassword($_POST['username'], $_POST['password'], $conn)){
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $_POST['username'];
                if(isset($_SESSION['signedin'])){
                  echo "<script>alert('session started and set!');</script>";
                }
                echo 'Valid username and password <br>';
                include("recipenest.html");
              }
              else {
                  echo 'Invalid username and password for realllll <br>';
                  include("landingpage.html");
              }
             exit();
        default:
            echo 'Unknown command!<br>';
            exit();
    }
  }



?>