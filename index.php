<?php
session_start();
require __DIR__.'/vendor/autoload.php';

$fbobj = new Facebook\Facebook([
    'app_id'=>'311030422587134',
    'app_secret'=>'bdcfacfcb93b8676672b6a560746f9a3',
    'default_graph_version'=>'v2.5'
]);
$access_token = $_GET['token'];

$fbobj->setDefaultAccessToken($access_token);
$respose = $fbobj->get('/me?fields=email,name,gender,birthday');

$userNode = $respose->getGraphUser();

echo "Welcome !<br><br>";
echo 'Name: ' . $userNode->getName().'<br>';
echo 'Gender: ' . $userNode->getGender().'<br>';
//echo 'Gender: ' . $userNode->birthday().'<br>';
echo 'User ID: ' . $userNode->getId().'<br>';
echo 'Email: ' . $userNode->getProperty('email').'<br><br>';
$image = 'https://graph.facebook.com/'.$userNode->getId().'/picture?width=200';
echo "Picture<br>";
echo "<img src='$image' /><br><br>";