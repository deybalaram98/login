<?php
//logout.php

include('config.php');
//$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
//$google_client->setAccessToken($token['access_token']);
//$_SESSION['access_token'] = $token['access_token'];
$accesstoken=$_SESSION['access_token'];

//Reset OAuth access token
$google_client->revokeToken($accesstoken);

//Destroy entire session data.
session_destroy();

//redirect page to index.php
header('location:loginpage.php');
?>