<!DOCTYPE html>
<?php

//index.php

//include configuration File 
include('config.php');

$login_button = '';

if(isset($_GET["code"]))
{

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


    if(!isset($token['error']))
    {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if(!empty($data['given_name']))
        {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if(!empty($data['family_name']))
        {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if(!empty($data['email']))
        {
            $_SESSION['user_email'] = $data['email'];
        }

        if(!empty($data['gender']))
        {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if(!empty($data['picture']))
        {
            $_SESSION['user_picture'] = $data['picture'];
        }
    }
}


if(!isset($_SESSION['access_token']))
{

    $login_button = '<a href="'.$google_client->createAuthUrl().'"
    style="background: #dd4b39; border-radius: 5px; color: white;
    display:block; font-weight: bold; padding:10px; text-align: center;
     text-decoration: npne; weidth: 200px;" > Login With Gmail</a>';

     $login_button2 = '<a href="'.$google_client->createAuthUrl().'"
    style="background: #dd4b39; border-radius: 5px; color: white;
    display:block; font-weight: bold; padding:10px; text-align: center;
     text-decoration: npne; weidth: 200px;" > Login With Facebook</a>';
}

?>





<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> PHP Log IN Using Gmail Account </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/
        css?family=Muli|Source+Sans+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <style type="text/css">*{ font-family: 'Muli', sans-serif; }</style>
    </head>    

<body>
  <div class="container">
   <br />
   <h2 align="center"> Login Using Gmail</h2>
   <br />
    <div>
      <div class="col-lg-4 offset">
      <div class="card ">

       <?php
         if($login_button == '')
         {
           echo '<div class="card-header"> Wellcome User </div> <div class="card-body" >';
           echo '<img src="'.$_SESSION["user_picture"].'" class="img-fluid
            img-thumbnail" width="300" height="300" /> ';
           echo '<br> <p><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</p>';
           echo '<p><b>Email :</b> '.$_SESSION['user_email']. '</p>';
           echo '<p><a href="logout.php" >Logout</p></div>';
         }
         else
         {
             echo '<div align="center" >'.$login_button. '</div>';
         }
        ?>
      </div>
        </div>
      </div>
  </div>

</body>
</html>