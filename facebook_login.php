<?php
session_start();
require __DIR__.'/vendor/autoload.php';

$fbobj = new Facebook\Facebook([
'app_id'=>'311030422587134',
    'app_secret'=>'bdcfacfcb93b8676672b6a560746f9a3',
    'default_graph_version'=>'v2.5'
]);
$redirect = 'http://localhost/facebook_sdk/facebook_login.php';

$helper = $fbobj->getRedirectLoginHelper();

try{

    $access_token = $helper->getAccessToken();

}catch (Facebook\Exception\FacebookResponseException $ex){

    echo 'error'.$ex->getMessage(); exit;
}catch (Facebook\Exception\FacebookSDKException  $ex){
    echo 'SDK error'.$ex->getMessage(); exit;
}

if(!isset($access_token)){

    $permission = ['user_birthday'];
    $loginUrl =$helper->getLoginUrl($redirect,$permission);
echo '<a href="'.$loginUrl.'">Login With Facebook</a>';
}else{

    if(!empty($access_token)){ header('location:http://localhost/facebook_sdk/index.php?token='.$access_token);}
}