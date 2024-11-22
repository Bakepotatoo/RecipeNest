<?php


$conn = mysqli_connect('localhost', 'w3jadebayo', 'w3jadebayo136', 'C354_w3jadebayo');

if (!$conn) {
    die('Failed to connect: ' . mysqli_connect_error());
} else {
}

function registerUser($username, $email, $password)
{
    global $conn;
    $date = date("Ymd");
    if (!checkifUserExists($username)) {
        $sql = "INSERT INTO WebsiteUsers(Username, Email, Password, Date) VALUES('$username', '$email', '$password', $date)";
        $result = mysqli_query($conn, $sql);
    }

    if (!($result)) {
        echo "sql errors: " . mysqli_error($conn);
        return false;
    }
}

function checkifUserExists($username)
{
    global $conn;
    $sql = "SELECT * FROM WebsiteUsers WHERE Username = '$username' ";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        return true;
        echo 'Username is in use<br>';
    } else {
        return false;
    }
}

//function to check if a given username and password are valid
function checkValidUsernameandPassword($username, $password)
{
    global $conn;
    $sql = "SELECT * FROM WebsiteUsers WHERE Username = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
