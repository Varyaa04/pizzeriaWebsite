<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
    <link rel="stylesheet" href="../css/FirstCSS.css">
    <title>Пиццерия</title>
</head>
<body>
<div class="overlay"></div>
        <div class="btntxt">
            <button class="loginButton" onclick="document.location='login.php'">Войти</button>
            <div class="privet"><h1><center>Здравствуйте!</center></h1></div>
        </div>

        <div class="hi">
          <center>
             <div class="thank"><h2>Спасибо, что зашли на наш сайт "Пиццерия у Варюшки".</br>
                        Выберите, пожалуйста, какую вы хотите пиццу? </h2>
          </center>
        </div>

        <p>
            <div class="buttons">
                <div class="main-block"><a href="PizzeriaMain.php" class="floating-button"> Готовые пиццы</a> </div>
                <div class="main-block"><a href="PizzeriaSborka.php" class="floating-button"> Собрать свою</a> </div>
            </div>
        </p>

<script>
    function openRegisterForm() {
    document.getElementById("registerForm").classList.add("show");
}

function closeRegisterForm() {
    document.getElementById("registerForm").classList.remove("show");
}

document.getElementById('registratiomForm').checkVisibility=hideForms();
javascript
function showLogin() {
    document.getElementById("loginForm").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

function hideLogin() {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

function showRegistration() {
    document.getElementById("registrationForm").style.display = "block";
    document.getElementById("loginForm").style.display = "none";
}

function hideRegistration() {
    document.getElementById("registrationForm").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

function hideForms() {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("registrationForm").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

function togglePasswordVisibility() {
    var passwordInput = document.getElementById("passwordInput");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}


function showRegistration() {
     document.getElementById("register-form-container").style.display = "block";
     document.getElementById("loginForm").style.display = "none";
 }
 
 function hideRegistration() {
     document.getElementById("register-form-container").style.display = "none";
     document.getElementById("overlay").style.display = "none";
 }
   
 
function togglePasswordVisibility2() {
    var passwordInput = document.getElementById("registrationPassword");
    var passwordInput2 = document.getElementById("confirmPassword");
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordInput2.type = "text";
    } else {
        passwordInput.type = "password";
        passwordInput2.type = "password";
    }
}


function register() {
    var passwordInput = document.getElementById("registrationPassword");
    var confirmPasswordInput = document.getElementById("confirmPassword");
    var passwordError = document.getElementById("passwordError");

    if (passwordInput.value !== confirmPasswordInput.value) {
        passwordError.style.display = "block";
    } else {
        passwordError.style.display = "none";
        hideRegistration();
    }
}



</script>
<style>

</style>
</body>
</html>