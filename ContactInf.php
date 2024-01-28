<?php   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["yourname"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message = $_POST["text"];
  //пароль Varyaa_04
  $to = "pizzeriavarya04@gmail.com";
  $subject = "Сообщение с сайта";
  $headers = "From: $email";
  $body = "От: $email\nИмя: $name \nТелефон: $phone\nСообщение: $message";
  if (mail($to, $subject, $body, $headers)) {
    http_response_code(200);
  } else {
    http_response_code(500);
    echo json_encode(array('message' => 'При отправке сообщения произошла ошибка'));
  }
} else {
  http_response_code(403);
}
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
    <link rel="stylesheet" href="/css/contCSS.css"/>
    <link rel="stylesheet" href="css/dropCSS.css">
    <script src="js/drop.js"></script>

    <title>Контактная информация</title>
  </head>
  <body onclick="myFunction1()">
  <div class="overlay"></div>
<div class="grid">

  <div class="menu">
    <button onclick="myFunction()" class="dropbtn">Меню</button>
    <div id="myDropdown" class="dropdown-content">
      <button onclick="document.location='login.php'" class="buttonDropbox"><span class="menu1">Войти в аккаунт</span></button></br>
      <button onclick="document.location='PizzeriaFirst.php'" class="buttonDropbox"><span class="menu1">Главное меню</span></button></br>
      <button onclick="document.location='PizzeriaSborka.php'" class="buttonDropbox"><span class="menu1">Собрать пиццу</span></button>
      <button onclick="document.location='PizzeriaMain.php'" class="buttonDropbox"><span class="menu1">Готовые пиццы</span></button>
      <?php if ( isset($_SESSION['login']) ) : ?>
      <button onclick="document.location='Admin.php'" class="buttonDropbox"><span class="menu1">Страница админа</span></button>	<?php endif; ?>  
     </div>
  </div>
  
 
     <div class="header" style="font-family: Oblako;"><h1>Контактная </h1> <h1>информация</h1></div>

     <div class="korzina"><button class="korzina" onclick="document.location='Korzina.php'">Корзина</button></div>
    <div class="container">
      <div class="content">
        <div class="left-side">
          <div class="address details">
            <div class="topic">Адрес</div>
            <div class="text-one">г. Санкт-Петербург</div>
            <div class="text-two">Балтийская ул., 35</div>
          </div>
          <div class="phone details">
            <i class="fas fa-phone-alt"></i>
            <div class="topic">Телефон</div>
            <div class="text-one">8-911-707-87-44</div>
          </div>
          <div class="email details">
            <i class="fas fa-envelope"></i>
            <div class="topic">Email</div>
            <div class="text-one">pizzeriavarya04@gmail.com</div>
          </div>
        </div>
      
        <div class="right-side">
          <div class="topic-text">Отправьте нам сообщение</div>
          <p>
            Если у вас есть какие-то вопросы - заполните форму ниже
          </p>
          <form class="form" id="form" name="form" id="contact-form" method="post" action="ContactInf.php"> 
            <div class="input-box">
              <input type="text" class="form-field" placeholder="Ваше имя" id="yourname" name="yourname" autocomplete="off" />
            </div>
            <div class="input-box">
              <input type="email" class="form-field" placeholder="Введите email" id="email" name="email" autocomplete="off"/>
            </div>
            <div class="input-box">
              <input type="text" class="form-field" placeholder="Введите телефон" name="phone" id="phone" autocomplete="off"/>
            </div>
            <div class="input-box message-box">
              <textarea class="form-field" placeholder="Сообщение" id="text" name="text"></textarea>
            </div>
            <div class="button">
            <button type="submit" class="submit" onclick="clearInput()"><span class="text-button">Отправить</span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="https://kit.fontawesome.com/fce9a50d02.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="plugins/jquery.maskedinput.js"></script>
    <script>
    $(function($){
      $('[name="phone"]').mask("+7(999) 999-9999");
    });


    document.getElementById("form").addEventListener("submit", function(event){
  event.preventDefault();
  var yourname = document.getElementById("yourname").value;
  var email = document.getElementById("email").value;
  var phone = document.getElementById("phone").value;
  var text = document.getElementById("text").value;

  if (yourname === "" || email === "" || phone === "" || text === "") {
    alert("Пожалуйста, заполните все поля");
  } else {
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ContactInf.php", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          alert("Сообщение отправлено! Спасибо за обратную связь!!!");
          function clearInput() {
            document.getElementById("email").value = ""; 
            document.getElementById("yourname").value = ""; 
            document.getElementById("phone").value = ""; 
            document.getElementById("text").value = ""; 
          };
          clearInput();
        } else {
          alert("Ошибка!! Сообщение не отправилось :(");
        }
      }
    };
    xhr.send(formData);
  }
});
</script>
  </body>
</html>