<?php
require __DIR__ . '/../vendor/autoload.php';  
header("Content-Type: application/json");

$client = new MongoDB\Client("mongodb://localhost:27017");
$db = $client->guviDetails;  
$users = $db->users;          

$users->updateOne(
    ['username' => $_POST['editUsername']],
    [
        '$set' => [
            'name' => $_POST['editName'],
            'email' => $_POST['editEmail'],
            'age' => $_POST['editAge'],
            'phone' => $_POST['editPhone'],
            'dob' => $_POST['editDob'],
            'gender' => $_POST['editGender']
        ]
    ]
);

echo json_encode(["success" => "Profile updated successfully"]);

?>