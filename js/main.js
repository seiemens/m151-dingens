let submitButton = null;
document.addEventListener('DOMContentLoaded', function () {
    submitButton = $("#submitURL");
    submitButton.on("click", function () {
        addUrlToDB();
    });
});

function addUrlToDB() {
    let long = $("#input-normal");
    let short = $("#input-shorten");
    $.ajax({
        url: "../add/index.php",
        type: "post",
        dataType: 'json',
        data: {short: short.val(), long: long.val(), captcha: hcaptcha.getResponse()},
        success: function (result) {
            console.log(result.status)
            if (result.status === "success") {
                short.val("");
                long.val("");
                $(".error").css("display", "none");
                $("#displayURL").attr("href", result.shortLink);
                $("#displayURL").text(result.shortLink);
                $("#urlCopy").on("click", function () {
                    copy(result.shortLink)
                });
                $(".success").css("display", "block");

            } else if (result.status === "captcha-failure") {
                setError("Captcha is not valid!");
            } else if (result.status === "sql-failure") {
                setError("Internal Error: Database Failure!");
            } else if (result.status === "input-wrong") {
                setError("Please enter a valid URL!");
            } else if (result.status === "sql-connect-failure") {
                setError("Internal Error: Database Failure!");
            }
        },
        error: function (result) {
            console.log("error: ")
            console.log(result);
        }
    });
}

function copy(text) {
    let input = document.createElement('textarea');
    input.innerHTML = text;
    document.body.appendChild(input);
    input.select();
    let result = document.execCommand('copy');
    document.body.removeChild(input);
    return result;
}

function setError(err){
    $(".success").css("display", "none");
    $(".error").text(err)
    $(".error").css("display", "block");
}