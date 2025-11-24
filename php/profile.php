<?php
header("Content-Type: application/json");

require __DIR__ . '/../vendor/autoload.php';  // composer autoload

$client = new MongoDB\Client("mongodb://localhost:27017");

$db = $client->guviDetails;  
$users = $db->users;         
$user = $users->findOne(['username' => $_POST['username']]);

if ($user){
    $data = $user->getArrayCopy();
    if(isset($data['_id'])){
    $data['_id'] = (string)$data['_id'];
}
    echo json_encode($data);
} else {
    echo json_encode(["error" => "{$_POST['username']} User not found"]);
}

?>