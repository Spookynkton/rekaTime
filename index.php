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

<div class="container justify-content-around">
  <div class="row p-1">
    <div class="col">
      <h3>Reka Time for Client</h3>
    </div>
    <div class="col-3 gy-1">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Создать проект
      </button>
    </div>
  </div>
</div>
<div class="container">
<div class="row">
<!-- Данные -->
<?php
$conn = new mysqli('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
if ($conn->connect_error){
  echo ("Ошибка".$conn->connect_error);
}
$sql = "SELECT * FROM projecttime";
if ($result = $conn->query($sql)) {
  $rowsCount = $result->num_rows;
  echo "<p>Получено объектов: $rowsCount</p>";
  echo "<div class='col'>";
  echo "<div class='row'>";
  echo "<div class='col-1 border-bottom bg-light'><h5>ID</h5></div>
  <div class='col-2 border-bottom bg-light'><h5>ASANA</h5></div>
  <div class='col-5 border-bottom bg-light'><h5>NAME</h5></div>
  <div class='col-1 border-bottom bg-light'><h5>TIME</h5></div>
  <div class='col-2 border-bottom bg-light'><h5>PROJECT</h5></div>";
  echo "</div>";
  foreach ($result as $row) {
    echo "<div class='row'>";
      echo "<div class='col-1 bg-light'>" . $row["id"] . "</div>";
      echo "<div class='col-2 bg-light bg-light'>" . "<a target='_blank' href=" . $row["asana"]. ">". "Асана" . "</a>" ."</div>";
      echo "<div class='col-5 bg-light'>" . $row["name"] . "</div>";
      echo "<div class='col-1 bg-light'>" . $row["time"] . "</div>";
      echo "<div class='col-2 bg-light'> <div class='border rounded text-center'>" . $row["project"] . " </div> </div>";
    echo "</div>";
  }
  echo "</div>";
  $result->free();
} else {
  echo "Ошибка: " . $conn->error;
}
$conn->close();
?>


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
        $connDrop = new mysqli('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
        if ($connDrop->connect_error){
          echo ("Ошибка".$connDrop->connect_error);
        }
          $sqlDrop = "SELECT * FROM projectreka";
          if ($resultDrop = $connDrop->query($sqlDrop)){
            $rowsCountDrop = $resultDrop->num_rows;
            echo "<option selected>Выберете проект</option>";
            foreach ($resultDrop as $rowDrop){
            echo "<option name='project' value='" . $rowDrop["project"] . "' >" . $rowDrop["project"] . "</option>";
          }
          $resultDrop->free();
        } else {
          echo "Ошибка: " . $conn->error;
        }
        $connDrop->close();
        ?>
      </select>
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
