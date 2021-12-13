<?php

//stat session on web page
session_start();

//config.php

//include google client library for php autoload file
require_once 'vendor/autoload.php';

//make object of google API client for call google API
$google_client = new Google_Client();

//Set the oauth 2.0 cClient id
$google_client->setClientId('367595712223-n1k0ig6el7pt8a1vuknousa1micg5sf0.apps.googleusercontent.com');

//set the Oauth 2.0 client secret key
$google_client->setClientSecret('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');

//set redirect url
$google_client->setRedirectUri('http://localhost/LOGIN_PAGE/loginpage.php');

//to get the email and profile
$google_client->addScope('email');
$google_client->addScope('profile');

?>

