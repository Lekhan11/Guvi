<?php
require __DIR__ . '/../vendor/autoload.php';

$servername = 'localhost';
$username = 'root';
$password = 'lekhan2005';
$dbname = "guvi";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql);


$conn->select_db($dbname);

$createTable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    pass VARCHAR(255),
    email VARCHAR(255),
    name VARCHAR(255),
    password VARCHAR(255)
)";
$conn->query($createTable);

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$confirm_password = $_REQUEST['confirm_password'];
$email = $_REQUEST['mail'];
$name = $_REQUEST['name'];

//   check email if exists !
$mailchk = $conn->prepare("SELECT * FROM userdetails WHERE email = ?");
$mailchk->bind_param("s", $email);
$mailchk->execute();
$result = $mailchk->get_result();

if ($result->num_rows > 0) {
    echo "Email already exists. Please use a different email.";
    exit();
}

// check username if exists !
$usernamechk = $conn->prepare("SELECT * FROM userdetails WHERE username = ?");
$usernamechk->bind_param("s", $username);
$usernamechk->execute();
$result = $usernamechk->get_result();

if ($result->num_rows > 0) {
    echo "Username already exists. Please choose a different username.";
    exit();
}



if ($password == $confirm_password) {

    // Prepared Statement
    $stmt = $conn->prepare("INSERT INTO userdetails (username, pass, email, name) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("ssss", $username, $password, $email, $name);

    // Execute
    if ($stmt->execute()) {
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $db = $client->guviDetails;  
        $users = $db->users;          
        $insertResult = $users->insertOne([
            'username' => $username,
            'email' => $email,
            'name' => $name
]);

        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
else {
    echo "Password and Confirm Password do not match.";
}

$conn->close();



?>
