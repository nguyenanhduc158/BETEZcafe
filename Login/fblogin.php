<?php
    session_start();
    
    $app_id = "536643483177466";
    $app_secret = "7078d44516ff407d08dde78934b20eb6";
    $redirect_uri = urlencode("http://localhost/test/fblogin.php");    
    
    // Get code value
    $code = $_GET['code'];
    
    // Get access token info
    $facebook_access_token_uri = "https://graph.facebook.com/v2.8/oauth/access_token?client_id=$app_id&redirect_uri=$redirect_uri&client_secret=$app_secret&code=$code";    
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $facebook_access_token_uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
        
    $response = curl_exec($ch); 
    curl_close($ch);
    // Get access token
    $aResponse = json_decode($response);
    $access_token = $aResponse->access_token;
    
    // Get user infomation
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?access_token=$access_token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
        
    $response = curl_exec($ch); 
    curl_close($ch);
    
    $user = json_decode($response);
    // Log user in
    $_SESSION['user_login'] = true;
    $_SESSION['user_name'] = $user->name;
    
    //demo in ra tên người đăng nhập
    echo "Welcome ". $user->name ."!";
    
    // điều hướng về trang chủ
    header('location: ../');
?>