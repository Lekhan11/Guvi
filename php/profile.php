<?php
header("Content-Type: application/json");

require __DIR__ . '/../vendor/autoload.php';  // composer autoload

$client = new MongoDB\Client("mongodb://localhost:27017");

$db = $client->guviDetails;  // database
$users = $db->users;          // collection
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


// $server="localhost";
// $username="root";
// $password="lekhan2005";
// $database="guvi";
// $conn=mysqli_connect($server,$username,$password,$database);
// if(!$conn){
//     die("Error".mysqli_connect_error());
// }
// $stmt = $conn->prepare("SELECT * FROM userdetails WHERE id = ?");
// $stmt->bind_param("s", $_SESSION['user_id']);
// $stmt->execute();
// $result = $stmt->get_result();
// echo json_encode($result->fetch_assoc());

?>