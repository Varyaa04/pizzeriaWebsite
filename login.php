<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Авторизация</title>
  <link rel="Website Icon" type="png" href="image/pizza/icon.PNG">

  <link rel="stylesheet" href="css/login.css">
</head>
<body>

<?php 
  session_start();

  if ( isset($_SESSION['login']) ) {
    unset($_SESSION['login']);
    header("Location: login.php");
  }
  if ( isset($_SESSION['user']) ) {
    unset($_SESSION['user']);
    header("Location: login.php");
  }
  if ( isset($_SESSION['redactor']) ) {
    unset($_SESSION['redactor']);
    header("Location: login.php");
  }


$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "pizzeria"; 
 
$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 

if (isset($_POST['submit'])) {
  $username1 = $_POST["username"];
  $password1 = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];
  $email1 = $_POST['email'];
  $login1 =$_POST['login'];
  
 if ($password1 !== $confirmPassword) {
  ?> <script>alert('Пароли не совпадают')</script> <?php
} 
  else{
    $connection = mysqli_connect('localhost', 'root', '', 'pizzeria');
    
    if (!$connection) {
      die("Ошибка подключения: " . mysqli_connect_error());
    }
    
    $username = mysqli_real_escape_string($connection, $username1);
    $password = mysqli_real_escape_string($connection, $password1);
    $email = mysqli_real_escape_string($connection, $email1);
    $login = mysqli_real_escape_string($connection, $login1);
    
    $query = "INSERT INTO users (username,Login, Password, Email, Role) VALUES ('$username', '$login','$password', '$email', 2)";
    
    if (mysqli_query($connection, $query)) {
    ?> <script>alert('Вы успешно зарегистрировались!')</script> <?php
      header("Location: login.php");
    } else {
      die("Ошибка при регистрации: " . mysqli_error($connection));
    }
    
    mysqli_close($connection);
  }
}


if(isset($_POST['submitl'])){ 
  $usernamel = $_POST['loginl']; 
  $passwordl = $_POST['passwordl']; 
  $select = "SELECT * from users where Login = '$usernamel' and Password = '$passwordl'"; 
  $result = $conn->query($select); 
  if($result->num_rows > 0){ 
      while($row = $result->fetch_assoc()){ 
          if ($row['Role'] == 1) {
              session_start(); 
              $_SESSION['login'] = $row['username'];
              $_SESSION['role'] = $row['Role']; 
              header('Location: PizzeriaMain.php'); // Перенаправление на страницу для роли 1
              exit;
          } elseif ($row['Role'] == 2) {
              session_start(); 
              $_SESSION['user'] = $row['username'];
              $_SESSION['role'] = $row['Role']; 
              header('Location: PizzeriaMain.php'); // Перенаправление на страницу для роли 2
              exit;
          } elseif ($row['Role'] == 3) {
            session_start(); 
            $_SESSION['redactor'] = $row['username'];
            $_SESSION['role'] = $row['Role']; 
            header('Location: PizzeriaMain.php'); // Перенаправление на страницу для роли 3
            exit;
        }else {
              ?><script>alert("Пользователь не существует!")</script><?php
          }
      } 
  } 
  else{ 
    ?><script>alert("Пользователь не существует!")</script><?php
  } 
} 
// Закрытие соединения с базой данных 
$conn->close(); 


?>

<button  onclick="document.location='PizzeriaFirst.php'" 
style=" border-radius: 15px;
background: -webkit-linear-gradient(left,  #b37c4c, #9c5e35,  #c89054,  #d8b789);cursor: pointer;font-size: 150%;color: #ebd2af;">Главное меню</button>
<div class="wrapper">
  <div class="title-text">
    <div class="title login">Вход</div>
    <div class="title signup">Регистрация</div>
  </div>
  <div class="form-container">
    <div class="slide-controls">
      <input type="radio" name="slide" id="login" checked>
      <input type="radio" name="slide" id="signup">
      <label for="login" class="slide login">Вход</label>
      <label for="signup" class="slide signup">Регистрация</label>
      <div class="slider-tab"></div>
    </div>
    <div class="form-inner">
      <form class="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="field">
          <input type="text" placeholder="Логин"  name="loginl" autocomplete="off"  required>
        </div>
        <div class="field">
          <input type="password" placeholder="Пароль" name="passwordl" id = "passwordInput" autocomplete="off" required>
        </div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="Войти" name="submitl">
        </div>
      </form>
      <form action="" class="signup" method="post">
        <div class="field">
          <input type="text" placeholder="Ваше имя" name="username" autocomplete="off" required >
        </div>
        <div class="field">
          <input type="text" placeholder="Придумайте логин"  name="login" autocomplete="off" required >
        </div>
        <div class="field">
          <input type="email" placeholder="Email" name="email"  autocomplete="off" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Пароль" name="password" id ="passwordInput" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Повторите пароль" name="passwordrepeat" id ="passwordInput2" required>
        </div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="Зарегистрироваться" name="submit" >
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = () => {
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
};
loginBtn.onclick = () => {
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
};
signupLink.onclick = () => {
  signupBtn.click();
  return false;
};

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

</body>
</html>
