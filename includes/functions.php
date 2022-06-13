<?php
function validateHcaptcha($res)
{
    include "config.php";
    $data = array(
        'secret' => $HCAPTCHA_SECRET,
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

function inputCheck($short, $long, $sqlCon = null)
{
    $row = null;
    if ($short == "") {
        $short = generateRandomLetters(6);
    }
    if (preg_match("/^[a-zA-Z0-9]*$/", $short)) {
        if ($long != "") {
            if (filter_var($long, FILTER_VALIDATE_URL)) {
                if ($sqlCon != null) {
                    $query = "SELECT * FROM shorturl.links WHERE url_key = '$short'";
                    $result = mysqli_query($sqlCon, $query);
                    $row = mysqli_fetch_row($result);
                    $sqlCon->close();
                }
                if ($row == null) {
                    return array(true, $short);
                }
            }
        }
    }
    return array(false, "");
}

function generateRandomLetters($len)
{
    include "config.php";
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $query = "SELECT url_short FROM schohol.shorturls";
    $result = mysqli_query($conn, $query);
    $keysTaken = mysqli_fetch_array($result);
    $conn->close();
    do {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    } while (in_array($randomString, $keysTaken));
    return $randomString;
}