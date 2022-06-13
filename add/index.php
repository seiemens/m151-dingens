<?php
include "../includes/functions.php";
include "../includes/functions.php";
if (isset($_POST['normal']) and isset($_POST['shorten'])) {
    $long = $_POST["normal"];
    if(filter_var($long, FILTER_VALIDATE_URL) === false){
        echo json_encode(array("status" => "url-not-valid"));
        die();
    }

    $checkRes = inputCheck($_POST['shorten'], $long);
    if ($checkRes[0]) {
        $res = hcaptchaCheck($_POST['captcha']);
        if (!$res['success']) {
            echo json_encode(array("status" => "captcha-failure"));
            die();
        }

        $conn = new mysqli($DB_HOST, $DB_USER, $DB_PW, $DB_DB);
        if ($conn->connect_error) {
            echo json_encode(array("status" => "sql-connect-failure"));
            die();
        }

        $long_url = mysqli_escape_string($conn, $long);
        $short_string = mysqli_escape_string($conn, $checkRes[1]);
        $ip = $_SERVER['REMOTE_ADDR'];

        $query = "INSERT INTO schohol.shorturls(url_short,url_long) VALUES ('$short_string','$long_url')";
        if ($conn->query($query) === TRUE) {
            echo json_encode(array("status" => "success", "shortLink" => $WEB_URL.$short_string));
        } else {
            echo json_encode(array("status" => "sql-failure"));
        }
        $conn->close();
    } else {
        echo json_encode(array("status" => "input-wrong"));
    }
} else {
    echo json_encode(array("status" => "input-not-there"));
}
die();