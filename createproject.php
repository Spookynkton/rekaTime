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
    $linkP = mysqli_connect('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
    if ($linkP == false){
        echo ("Error: SQL Base drope" . mysqli_connect_error());
    }
    else{
        echo ("");
    }
    mysqli_set_charset($linkP, 'utf8');

if (isset($_POST['project'])){
  $connP = new mysqli('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
  if ($connP->connect_error){
    echo ("Ошибка".$connP->connect_error);
  }
  $project = $connP->real_escape_string($_POST['project']);
  $sqlP = "INSERT INTO projectreka (project) VALUES ('$project')";
  if($connP->query($sqlP)){
    echo "<div class='col-md-auto'><h2 class='display-2'>Проект успешно добавлен!</h2></div>";
    echo "<div class='col-9'> <form action='index.php'>";
    echo "<div class='d-grid gap-2 col-6 mx-auto'>";
    echo "<button class='btn btn-primary'>BACK</button>";
    echo "</div>";
    echo "</form></div>";
  } else {
    echo "Ошибка: " . $connP->error;
  }
  $connP->close();
}
?>
