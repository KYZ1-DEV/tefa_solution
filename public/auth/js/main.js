(function ($) {
    "use strict";

    var fullHeight = function () {
        $(".js-fullheight").css("height", $(window).height());
        $(window).resize(function () {
            $(".js-fullheight").css("height", $(window).height());
        });
    };
    fullHeight();

    $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    $(".toggle-password1").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    // $("#passwordForm").submit(function (event) {
    //     var password = $("#password-field").val();
    //     var confirmPassword = $("#password-confirm-field").val();

    //     if (password !== confirmPassword) {
    //         alert("Passwords do not match. Please try again.");
    //         event.preventDefault(); // Prevent form submission
    //         window.location.href = "registrasi";
    //     }
    // });

})(jQuery);
let captchaCode;

function generateCaptcha() {
    const canvas = document.getElementById("captchaCanvas");
    const ctx = canvas.getContext("2d");

    // Tetapkan ukuran canvas yang lebih kecil
    canvas.width = 90; // Lebar
    canvas.height = 40; // Tinggi

    const chars =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let captchaCode = "";

    for (let i = 0; i < 5; i++) {
        captchaCode += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.font = "25px Arial";
    ctx.fillStyle = "#5e4633"; // Warna teks
    ctx.fillText(captchaCode, 10, 30); // Posisi teks
}

function validateCaptcha() {
    const inputCaptcha = document.getElementById("captchaInput").value;
    const errorElement = document.getElementById("captchaError");

    if (inputCaptcha === captchaCode) {
        errorElement.style.display = "none";
        alert("Login successful!");
        return true;
    } else {
        errorElement.innerText = "Incorrect CAPTCHA. Please try again.";
        errorElement.style.display = "block";
        return false;
    }
   
}

window.onload = generateCaptcha;
