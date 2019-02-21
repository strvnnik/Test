<?php
$host = 'localhost';
$database = 'test';
$user = 'root';
$password = '';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Электро престиж</title>
    <link href="http://allfont.ru/allfont.css?fonts=pt-sans" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
    <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-12">
            <nav class="navigation-top">
              <ul>
                <li><a href="#">О компании</a></li>
                <li><a href="#">Доставка</a></li>
                <li><a href="#">Оплата</a></li>
                <li><a href="#">Сервис</a></li>
                <li><a href="#">Возврат</a></li>
                <li><a href="#">Статьи</a></li>
                <li><a href="#">Контакты</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-3">
            <div class="logo">
              <a href="#"><img src="images/logo.png" alt=""></a>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="search">
              <input class="search-icon" type="submit" name="" value="">
              <input type="search" name="" value="" placeholder="Поиск по товарам">
              <input class="search-button" type="submit" name="" value="">
            </div>
          </div>
          <div class="col-xl-2">
            <div class="contact-information">
              <p class="number">8 (800) 707-99-24</p>
              <p class="working-hours">9.00 - 20.00 ежедневно</p>
            </div>
          </div>
          <div class="col-xl-3">
            <div class="user-panel">
              <a href="#"><img src="images/stat.png" alt=""></a>
              <p class="stat">0</p>
              <a href="#"><img src="images/like.png" alt=""></a>
              <p class="like">6</p>
              <a href="#"><img src="images/cart.png" alt=""></a>
              <p class="cart">17</p>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12">
          <hr class="top">
          <div class="main-navigation">
            <nav>
              <ul>
                <li><a href="#"><span>Продукция</span></a></li>
                <li><a href="#">Стабилизаторы 220В</a></li>
                <li><a href="#">Стабилизаторы 380В</a></li>
                <li><a href="#">Генераторы 220В</a></li>
                <li><a href="#">Генераторы 380В</a></li>
                <li><a href="#">ИБП и батареи</a></li>
                <li><a href="#">Прочая техника</a></li>
                <li><a href="#">Услуги</a></li>
                <li><a href="#">Акции</a></li>
              </ul>
            </nav>
          </div>
          <hr class="bot">
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12">
          <div class="crumb">
            <ul>
              <li><a href="#">Главная</a></li>
              <li><a href="#">Статьи</a></li>
            </ul>
          </div>
          <hr>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12">
          <div class="headline">
            <span>Полезная информация</span>
          </div>
          <div class="number-page-top">
            <ul>
              <?php
                if(isset($_GET['page'])){
                  $page = $_GET['page'];
                } else{
                  $page = 1;
                }
                $numberPost = 4;
                $from = ($page - 1) * $numberPost;

                $link = mysqli_connect($host, $user, $password, $database)
                    or die("Ошибка " . mysqli_error($link));

                //Проверяем сколько записей в БД и считаем количество страниц
                $sql ="SELECT COUNT(*) as count FROM articles";
                $res = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
                $count = mysqli_fetch_array($res)['count'];
                $pageCount = ceil($count / $numberPost = 4);
                $class = "";
                for($i=1; $i<=$pageCount; $i++){
                  if($_GET['page']==$i){
                    $class = 'class="active"';
                  }else{
                    $class = "";
                  }
                  echo '
                  <li><a '.$class.' href="?page='.$i.'">'.$i.'</a></li>
                  ';
                }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12">
          <div class="article">
            <ul class="block-article">
              <?php
              //Запрос на вывод записей на страницу, помещаем записи в БД
              $query ="SELECT * FROM articles LIMIT $from,$numberPost";
              $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
              if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                do{
                  echo '
                  <li>
                    <div class="block-img">
                      <img src="'.$row["images"].'" alt="">
                    </div>
                    <h4>'.$row["title"].'</h4>
                    <div class="short-description">
                      <p>'.$row["short_description"].'</p>
                    </div>
                  </li>
                  ';
                }
                while ($row = mysqli_fetch_array($result));
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12">
          <div class="number-page-bottom">
            <ul>
            <?php
            $class = "";
            for($i=1; $i<=$pageCount; $i++){
              if($_GET['page']==$i){
                $class = 'class="active"';
              }else{
                $class = "";
              }
              echo '
              <li><a '.$class.' href="?page='.$i.'">'.$i.'</a></li>
              ';
            }
            ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-3">
            <div class="contact-info-footer">
              <p>121471, г.Москва ул. Рябиновая 55 стр. 28</p>
              <p>prestizh06@mail.ru</p>
              <p><b>8 (800) 707-99-24</b></p>
              <a href="#">контакты</a>
            </div>
          </div>
          <div class="col-xl-3">
            <div class="time-work-footer">
              <p>Режим работы:</p>
              <p>Пн-чт с 8.00 дл 19.00</p>
              <p>Пт с 8.00 до 17.00</p>
              <p>Сб с 10.00 до 15.00</p>
              <p>Вс (по предварительной договоренности)</p>
            </div>
          </div>
          <div class="col-xl-3">
            <div class="row">
              <div class="col-xl-6">
                <div class="nav-footer">
                  <ul>
                    <li><a href="#">О компании</a></li>
                    <li><a href="#">Акции</a></li>
                    <li><a href="#">Доставка</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="nav-footer">
                  <ul>
                    <li><a href="#">Оплата</a></li>
                    <li><a href="#">Сервис</a></li>
                    <li><a href="#">Возврат</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="nav-footer">
              <a href="#">Политика обработки персональных данных</a>
            </div>
          </div>
          <div class="col-xl-3">
            <div class="footer-logo">
              <img src="images/lolo-rocket.png" alt="">
              <p class="footer-p-1">Разработка</p>
              <p class="footer-p-2">и продвижение сайта</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
