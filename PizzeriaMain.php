<?php 
session_start(); 
 
include "db.php";
$query = "SELECT * FROM Pizza";
$req = mysqli_query($connection, $query);
$data_from_db = [];

while ($result = mysqli_fetch_assoc($req)) 
{
 $data_from_db[] = $result;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
    <link rel="stylesheet" href="css/got.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/dropCSS.css">
    <script src="js/drop.js"></script>
    <title>Готовые пиццы</title>
</head>
<body onclick="myFunction1()">
<div class="overlay"></div>
<div class="grid">
  
  <div class="menu">
    <button onclick="myFunction()" class="dropbtn">Меню</button>
    <div id="myDropdown" class="dropdown-content">
      <button onclick="document.location='PizzeriaFirst.php'" class="buttonDropbox"><span class="menu1">Главное меню</span></button></br>
      <button onclick="document.location='PizzeriaSborka.php'" class="buttonDropbox"><span class="menu1">Собрать пиццу</span></button></br>
      <button onclick="document.location='login.php'" class="buttonDropbox"><span class="menu1">Войти в аккаунт</span></button></br>
      <button onclick="document.location='ContactInf.php'" class="buttonDropbox"><span class="menu1">Контактная информация</span></button></br>
      <?php if ( isset($_SESSION['login']) ) : ?>
      <button onclick="document.location='Admin.php'" class="buttonDropbox"><span class="menu1">Страница админа</span></button></br>	<?php endif; ?> 
       
    </div>
  </div>

  <?php if ( isset($_SESSION['login']) ) : ?>
  <div class="admin1">
      <p style="font-size: 150%;color: #9c5912  ;">Здравствуйте, Админ! <a  class="logout" href="logout.php" > Выход </a></p>
  </div><?php endif; 
   if ( isset($_SESSION['user']) ) : ?>
  <div class="admin1" >
      <p style="font-size: 150%;color: #9c5912  ;">Здравствуйте, Крутой пользователь! <a  class="logout" href="logout.php" > Выход </a></p>
  </div><?php endif;
  if ( isset($_SESSION['redactor']) ) : ?>
    <div class="admin1" >
        <p style="font-size: 150%;color: #9c5912  ;">Здравствуйте, Редактор! <a  class="logout" href="logout.php" > Выход </a></p>
    </div><?php endif; ?>

  <!-- <div id="cover" style="grid-area: 5/2/7/21;">
    <form method="GET" action="">
        <div class="tb">
            <div class="td"><input type="text" name="search_query" placeholder="Введите название пиццы" required autocomplete="off"></div>
            <div class="td" id="s-cover">
                <button type="submit" class="cov">
                    <div id="s-circle"></div>
                    <span class="search"></span>
                </button>
            </div>
         </div>
  </form>
</div> -->



  <div class="header" style="font-family: Oblako;"><h1>Готовые</h1> <h1>пиццы</h1></div>
  <div class="korzina"><button class="korzina" onclick="document.location='Korzina.php'">Корзина</button></div>
</div> 
<div class="container">

<?php if (isset($_SESSION['cart_list']))
{
 echo "<h3 style='font-size:200%;color: #9c5912  ;'>Корзина: " . count($_SESSION['cart_list']) ;
}?></h3>

<?php foreach($data_from_db as $cart_item): ?>
  <div class="listProduct">
    


    <?php echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
     echo "<img src='image/pizza/" . $cart_item["Image"] . "' height=100% width=100% alt=''"?></image>
    <h2 style="font-size: 110%;color: #723d25;">
      <span style="font-size: 200%;color: #b18a7d;-webkit-text-stroke: 1px;-webkit-text-stroke-color: #6b4f2e;"><?php echo $cart_item['Name']?></span></br></br>
      Состав:</br><?php echo $cart_item['composition']?>
  </h2>
      <div class='price' style='font-size: 230%;color: #723d25;'></br><?php echo $cart_item['Cost']?>руб.</div>
    <a  id='addCart' href="Korzina.php?idPizza=<?php echo $cart_item['idPizza']?>&quantity=1" class='addCart'style='background-color: #9c5912;color: #eabb94; height: 40%;
      width: 80%;border-color: #cf8845;border-radius: 10%;border-width: 10%;font-size: 200%; font-family:SofiaSans;text-decoration'>
      Добавить в корзину
    </a>

    <?php if ( isset($_SESSION['login']) ) : ?>
    &nbsp;<a href="edit.php?id=<?php echo $cart_item['idPizza']; ?>"
         style="border: solid #723d25;border-radius: 20px;width: 80%;background: #9c5912;color: wheat;font-size: 110%;text-decoration: none;" >
         Редактировать</a>&nbsp;&nbsp;
         <a href="#" onclick="confirmDeletion(<?php echo $cart_item['idPizza']; ?>)"
        style="border: solid #723d25;border-radius: 20px;width: 80%;background: #9c5912;color: wheat;font-size: 110%;text-decoration: none;"
        >Удалить</a></br>
      <p></p>
    <?php endif; ?>
    <?php if ( isset($_SESSION['redactor']) ) : ?>
    &nbsp;<a href="edit.php?id=<?php echo $cart_item['idPizza']; ?>"
         style="border: solid #723d25;border-radius: 20px;width: 80%;background: #9c5912;color: wheat;font-size: 110%;text-decoration: none;" >
         Редактировать</a>&nbsp;&nbsp;
         <a href="#" onclick="confirmDeletion(<?php echo $cart_item['idPizza']; ?>)"
        style="border: solid #723d25;border-radius: 20px;width: 80%;background: #9c5912;color: wheat;font-size: 110%;text-decoration: none;"
        >Удалить</a></br>
      <p></p>
    <?php endif; ?>
  </div><hr style="background-color: #9c5912;width: 100%;height: 1px;margin-left: 0%;">
<?php endforeach;?>

    </div>
<script>
  function confirmDeletion(idPizza) {
    if (confirm("Вы уверены, что хотите удалить этот элемент?")) {
        // Если пользователь нажимает "да", перенаправляем его на delete.php с необходимым идентификатором
        window.location.href = "delete.php?id=" + idPizza;
    }
}
</script>
</body>
</html>
