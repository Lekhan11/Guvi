<?php
require __DIR__ . '/../vendor/autoload.php';
Predis\Autoloader::register();

$redis = new Predis\Client([
    "scheme" => "tcp",
    "host"   => "redis-10016.c257.us-east-1-3.ec2.cloud.redislabs.com",
    "port"   => 10016,
    'database' => 0,
    'username' => 'default',
    'password'=> 'ogYCkKsGdphMmCtaVad8wwiywkolEODv',
]);


$token = $_POST['token'];

$username = $redis->del("session:$token");

if($username) {
    echo json_encode(["valid" => true, "username" => $username]);
} else {
    echo json_encode(["valid" => false]);
}

?>