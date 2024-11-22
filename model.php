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
function checkValidUsernameAndPassword($username, $password)
{
    global $conn;
    $sql = "SELECT * FROM WebsiteUsers WHERE Username = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function addRecipe($username, $recipename, $category, $description, $ingredients, $instructions)
{
    global $conn;
    $current_date = date('Ymd');
    $sql = "INSERT INTO Recipes(Username, RecipeName, Category, Description, Ingredients, Instructions, Date) VALUES
            ('$username', '$recipename', '$category', '$description', '$ingredients', '$instructions', $current_date)";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
        echo mysqli_errno($conn) . 'Error inserting into database<br>';
    }
}

function searchRecipe($recipename)
{
    global $conn;
    $array = [];
    $sql = "SELECT * FROM Recipes where RecipeName LIKE '%$recipename%'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }
    }

    return $array;
}
