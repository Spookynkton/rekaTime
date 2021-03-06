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
//фильтр
function filterProject(){
$connFilt = new mysqli('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
if ($connFilt->connect_error){
  echo ("Ошибка".$connFilt->connect_error);
}
  $sqlFilt = "SELECT * FROM projecttime";
  if ($resultFilt = $connFilt->query($sqlFilt)){
    $rowsCountFilt = $resultFilt->num_rows;
    echo "<option selected>Отфильтровать по проекту</option>";
    foreach ($resultFilt as $rowFilt){
    echo "<option name='project' value='" . $rowFilt["project"] . "' >" . $rowFilt["project"] . "</option>";
  }
  $resultFilt->free();
} else {
  echo "Ошибка: " . $conn->error;
}
$connFilt->close();
}
?>


<div class="container">
<div class="row">
  <div class="col-3 gy-2">
    <a href="index.php">
      <img src="img/Frame 1.png" class="img-fluid">
    </a>
  </div>
  <div class="container gy-3">
  <div class="row ">
  <div class="col gy-1">

<?php
// отфильтрованая страница
if(isset($_GET["project"]))
{
  $connFilt = new mysqli('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
  if ($connFilt->connect_error){
    echo ("Ошибка".$connFilt->connect_error);
  }
  $project = $connFilt->real_escape_string($_GET["project"]);
  $sqlFilt = "SELECT * FROM projecttime WHERE project = '$project'";
  echo "<div class='col'>";
  echo "<div class='row align-items-center justify-content-center'>";
  echo "<div class='col-1 border-bottom bg-light'><h5>ID</h5></div>
  <div class='col-1 border-bottom bg-light'><h5>ASANA</h5></div>
  <div class='col-5 border-bottom bg-light'><h5>NAME</h5></div>
  <div class='col-1 border-bottom bg-light'><h5>TIME</h5></div>
  <div class='col-2 border-bottom bg-light'><h5>PROJECT</h5></div>
  <div class='col-1'></div>";
  echo "</div>";
  if($resultFilt = $connFilt->query($sqlFilt)){
    if($resultFilt->num_rows > 0){
      foreach ($resultFilt as $rowFilt){
        $prId = $rowFilt["id"];
        $prAsana = $rowFilt["asana"];
        $prName = $rowFilt["name"];
        $prTime = $rowFilt["time"];
        $prProject = $rowFilt["project"];
        echo "<div class='container'>";
        echo "<div class='row'>";
          echo "<div class='col-1 gy-2 align-self-center text-center'>" . $prId . "</div>";
          echo "<div class='col-1 gy-2 align-self-center text-center text-center d-grid gap-2'>" . "<a target='_blank' href=" . $prAsana. " class='btn btn-outline-danger btn-sm'>". "Асана" . "</a>" ."</div>";
          echo "<div class='col-5 gy-2 align-self-center text-center'>" . $prName . "</div>";
          echo "<div class='col-1 gy-2 align-self-center text-center'>" . $prTime . "</div>";
          echo "<div class='col-2 gy-2 align-self-center text-center'> <div class='border rounded text-center'>" . $prProject . " </div> </div>";
          echo "<div class='col-1 gy-2 align-self-center text-center d-grid gap-2'>" . "<a href='update.php?id=" . $prId . "' class='btn btn-outline-warning btn-sm'>". "Изменить" . "</a>" ."</div>";
        echo "</div>";
        echo "</div>";
      }
    }
    else{
            echo "<div>Задачи с таким проектом не найдены</div>";}
    $resultFilt->free();
  }
  else{
        echo "Ошибка: " . $connFilt->error;
    }
    $connFilt->close();
}
?>
</div>
</div>
</div>

</body>
</html>
