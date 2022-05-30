<?php
function validateHcaptcha($res)
{
    include "config.php";
    $data = array(
        'secret' => $hcaptcha_secret,
        'response' => $res
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    return json_decode($response, true);
}