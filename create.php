<!DOCTYPE>
<html>
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
<div class="container">
  <div class="row justify-content-md-center align-items-center">
  <?php
      $link = mysqli_connect('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
      if ($link == false){
          echo ("Error: SQL Base drope" . mysqli_connect_error());
      }
      else{
          echo ("");
      }
      mysqli_set_charset($link, 'utf8');

  if (isset($_POST['asana']) && isset($_POST['name']) && isset($_POST['time'])){
    $conn = new mysqli('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
    if ($conn->connect_error){
      echo ("Ошибка".$conn->connect_error);
    }
    $asana = $conn->real_escape_string($_POST['asana']);
    $name = $conn->real_escape_string($_POST['name']);
    $time = $conn->real_escape_string($_POST['time']);
    $project = $conn->real_escape_string($_POST['project']);
    $sql = "INSERT INTO projecttime (asana, name, time, project) VALUES ('$asana', '$name',
      '$time', '$project')";
    if($conn->query($sql)){
      echo "<div class='col-md-auto'><h2 class='display-2'>Данные успешно добавлены!</h2></div>";
      echo "<div class='col-9'> <form action='index.php'>";
      echo "<div class='d-grid gap-2 col-6 mx-auto'>";
      echo "<button class='btn btn-primary'>BACK</button>";
      echo "</div>";
      echo "</form></div>";
    } else {
      echo "Ошибка: " . $conn->error;
    }
    $conn->close();
  }
  ?>
  </div>
</div>
</body>
</html>
