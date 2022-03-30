<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TimeReka</title>
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

</div>
<div class="container justify-content-around">
  <div class="row p-1">
    <div class="col">
      <h3>Reka Time for Client</h3>
    </div>
    <div class="col-3">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Создать проект
      </button>
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
  <div class='col-5 border-bottom bg-light'><h5>ASANA</h5></div>
  <div class='col-5 border-bottom bg-light'><h5>NAME</h5></div>
  <div class='col-1 border-bottom bg-light'><h5>TIME</h5></div>";
  echo "</div>";
  foreach ($result as $row) {
    echo "<div class='row'>";
      echo "<div class='col-1 bg-light'>" . $row["id"] . "</div>";
      echo "<div class='col-5 bg-light bg-light'>" . "<a target='_blank' href=" . $row["asana"]. ">". "Асана" . "</a>" ."</div>";
      echo "<div class='col-5 bg-light'>" . $row["name"] . "</div>";
      echo "<div class='col-1 bg-light'>" . $row["time"] . "</div>";
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
<form action="create.php" method="post" class="form-group">
  <div class="col">Асана:
    <input type="text" name="asana" class="form-control"></div>
  <div class="col">Проект:
    <input type="text" name="name" class="form-control"></div>
  <div class="col">Время:
    <input type="text" name="time" class="form-control"></div>
  <div class="col py-3">
    <input class="btn btn-outline-primary p-2" type="submit" value="Добавить">
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
            <input class="btn btn-outline-primary p-2" type="submit" value="Добавить">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>

      </div>
    </div>
  </div>
</div>

</body>
</html>
