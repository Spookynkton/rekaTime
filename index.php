<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TimeReka</title>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <link href="
    https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity=
    "sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <script src="
    https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity=
    "sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

</head>
<body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

<div class="container ">
  <div class="row p-1  justify-content-between">
    <div class="col-3 gy-2">
      <a href="index.php">
        <img src="img/Frame 1.png" class="img-fluid">
      </a>
    </div>

<!--фильтр-->
    <div class="col-6 gy-3">
      <form action="filterProject.php" method="get" class="row justify-content-end">
        <div class="col-5">
          <div class-"col-5">
            <select name="select" class="form-select"  aria-label="Default select example" onchange="document.getElementById('filterProject').value=value">
              <?php
              require_once "filterProject.php";
              filterProject();
              ?>
            </select>
            <input type="text" name="project" id="filterProject" value="" class="form-control" readonly hidden>
          </div>
        </div>
        <div class="col-3">
          <input class="btn btn-outline-success btn-sm p-2" type="submit" id="button-addon1" value="Отфильтровать">
        </div>
      </form>
    </div>

    <!--кнопка создания проекта. Вызывает поп-ап-->
    <div class="col-3 gy-3">
        <div class="d-grid gap-2">
          <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Создать проект
          </button>
        </div>
      </div>

<div class="container gy-3">
<div class="row ">
<div class="col gy-1">
<!-- Данные -->
<?php
$conn = new mysqli('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
if ($conn->connect_error){
  echo ("Ошибка".$conn->connect_error);
}
$sql = "SELECT * FROM projecttime";
if ($result = $conn->query($sql)) {
  echo "<div class='col '>";
  echo "<div class='row align-items-center justify-content-center'>";
  echo "<div class='col-1 border-bottom bg-light text-center'><h5>id</h5></div>
  <div class='col-1 border-bottom bg-light text-center'><h5>Асана</h5></div>
  <div class='col-5 border-bottom bg-light text-center'><h5>Название</h5></div>
  <div class='col-1 border-bottom bg-light text-center'><h5>Время</h5></div>
  <div class='col-2 border-bottom bg-light text-center'><h5>Проект</h5></div>
  <div class='col-1 '><h5></h5></div>";
  echo "</div>";
  foreach ($result as $row) {
    echo "<div class='row justify-content-center'>";
      echo "<div class='col-1  gy-2 align-self-center text-center'>" . $row["id"] . "</div>";
      echo "<div class='col-1  gy-2 align-self-center text-center d-grid gap-2'>" . "<a target='_blank' href=" . $row["asana"]. " class='btn btn-outline-danger btn-sm'>". "Асана" . "</a>" ."</div>";
      echo "<div class='col-5  gy-2 align-self-center'>" . $row["name"] . "</div>";
      echo "<div class='col-1  gy-2 align-self-center '>" . $row["time"] . "</div>";
      echo "<div class='col-2  gy-2 align-self-center'> <div class='border rounded text-center'>" . $row["project"] . " </div> </div>";
      echo "<div class='col-1  gy-2 align-self-center text-center d-grid gap-2'>" . "<a href='update.php?id=" . $row["id"] . "' class='btn btn-outline-warning btn-sm'>". "Изменить" . "</a>" ."</div>";
    echo "</div>";
  }
  echo "</div>";
  $result->free();
} else {
  echo "Ошибка: " . $conn->error;
}
$conn->close();
?>
</div>
<!-- Форма -->
<div class="col-3 gy-6">
<div class="p-3 border bg-light">
<form action="create.php" method="post" class="form-group"> <h5 class="d-flex justify-content-center">Завести время</h5>
  <div class="col">Асана:
    <input type="text" name="asana" class="form-control"></div>
  <div class="col">Проект:
    <input type="text" name="name" class="form-control"></div>
  <div class="col">Время:
    <input type="text" name="time" class="form-control"></div>
    <!-- Форма - Список проектов -->
<div class="col"> Выберете проект:

      <p><select name="select" class="form-select" aria-label="Default select example" onchange="document.getElementById('addProject').value=value">
        <?php
        require_once "openProject.php";
        openProject();
        ?>
      </select></p>
      <input type="text" name="project" id="addProject" value="" class="form-control" readonly hidden>
</div>
  <div class="col py-1 d-flex justify-content-around">
    <input class="btn btn btn-secondary p-2" type="reset" value="Очистить форму">
    <input class="btn btn-primary p-2" type="submit" value="Добавить">
  </div>
</form>

  </div>
</div>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Создать проект</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="createproject.php" method="post" class="form-group">
          <div>
            Название проекта:
            <input type="text" name="project" class="form-control">

          </div>
      </div>
      <div class="modal-footer">
        <input class="btn btn-primary p-1" type="submit" value="Добавить">
        <button type="button" class="btn btn-outline-secondary p-1" data-bs-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
