<?php
require __DIR__ . '/../vendor/autoload.php';

$server = 'localhost';
$user = 'root';
$pass = 'lekhan2005';
$db = 'guvi';

$redis = new Predis\Client([
    "scheme" => "tcp",
    "host"   => "redis-10016.c257.us-east-1-3.ec2.cloud.redislabs.com",
    "port"   => 10016,
    'database' => 0,
    'username' => 'default',
    'password'=> 'ogYCkKsGdphMmCtaVad8wwiywkolEODv',
]);

$conn = mysqli_connect($server, $user, $pass, $db);
$stmt = $conn->prepare("SELECT * FROM userdetails WHERE username = ? AND pass = ?");
$stmt->bind_param("ss", $_REQUEST['username'], $_REQUEST['password']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $token = bin2hex(random_bytes(32));
    $redis->set("session:$token", json_encode([
        "username" => $_REQUEST['username'],
        "login_time" => time()
    ]));
    $redis->expire("session:$token", 3600); // Session expires in 1 hour
    echo json_encode(["token" => $token, "status" => "success", "username" => $_REQUEST['username']]);
} else {
    echo json_encode(["status" => "error"]);
}
?>