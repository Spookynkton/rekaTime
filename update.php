<?php
$connUp = mysqli_connect('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
if (!$connUp){
  die("Ошибка" . $connUp->connect_error);
}
?>

<!DOCTYPE>
<html>
<head>
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
  <?php
  if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])){
    $projectid = $connUp->real_escape_string($_GET["id"]);
    $sqlUp = "SELECT * FROM projecttime WHERE id = '$projectid'";
    if($resultUp = $connUp->query($sqlUp)){
      if($resultUp->num_rows > 0){
        foreach ($resultUp as $row) {
          $idUp = $row["id"];
          $asanaUp = $row["asana"];
          $nameUp = $row["name"];
          $timeUp = $row["time"];
          $projectUp = $row["project"];
        }
        echo "<div class='container'>
        <div class='row'>
          <div class='col-3 gy-2'>
            <a href='index.php'>
              <img src='img/Frame 1.png' class='img-fluid'>
            </a>
          </div>
          </div>
          <div class='row justify-content-center p-3'>
          <div class='width-100%'></div>
          <div class='col-4'>
            <h3>Обновление проекта</h3></div>
            <div class = 'widht-100%'></div>
            <div class = 'col-4'>
                <form method='post' class='form-group'>
                    <input type='hidden' name='id' value='$projectid' />
                    <p> id проекта: $idUp</p>
                    <p>Asana:
                    <input type='text' name='asana' value='$asanaUp' / class='form-control'></p>
                    <p>Название:
                    <input type='text' name='name' value='$nameUp' / class='form-control'></p>
                    <p>Время:
                    <input type='text' name='time' value='$timeUp' / class='form-control'></p>
                    <input type='submit' value='Сохранить' class='btn btn-primary'>
            </div>
            </form>
            </div>";
      }
      else{
        echo "<div>Проект не найден</div>";
      }
       $resultUp->free();
    }
    else{
        echo "Ошибка: " . $connUp->error;
    }
  }
  elseif (isset($_POST["id"]) && isset($_POST["asana"]) && isset($_POST["name"])
&& isset($_POST["time"])) {
    $idUp = $connUp->real_escape_string($_POST["id"]);
    $asanaUp = $connUp->real_escape_string($_POST["asana"]);
    $nameUp = $connUp->real_escape_string($_POST["name"]);
    $timeUp = $connUp->real_escape_string($_POST["time"]);
    $sqlUp = "UPDATE projecttime SET asana = '$asanaUp', name = '$nameUp',
    time = '$timeUp' WHERE id='$idUp'";
    if($resultUp = $connUp->query($sqlUp)){
      header("Location: index.php");
    } else{
      echo "Ошибка" . $conn->error;
    }
  }
else{
  echo "Некорректные данные";
}
$connUp->close();
  ?>
</body>
</html>
