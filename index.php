<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shorten Your URLs</title>
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
<main>
    <h1>Free Short URL Service</h1>
    <h2>Create Shorturls for Free</h2>
    <input name="normal" id="input-normal" type="text" placeholder="Normal URL">
    <input name="shorten" id="input-shorten" type="text" placeholder="Abbreviation">
    <div id="captcha" class="h-captcha" data-sitekey="af47fc96-46be-45e9-b7c3-bfcc9f14a85e" data-theme="dark"></div>
    <a id="submitURL">Submit Short URL</a>
    <p class="error">Captcha Error</p>
    <div>
        <h3 class="success">URL successfully Shortened!</h3>
        <a class="success" id="displayURL"></a>
    </div>
    <a class="success" id="urlCopy">Click to Copy URL</a>
</main>
</body>
</html>