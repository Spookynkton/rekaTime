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
  $sql = "INSERT INTO projecttime (asana, name, time) VALUES ('$asana', '$name',
    '$time')";
  if($conn->query($sql)){
    echo "Данные успешно добавлены!";
  } else {
    echo "Ошибка: " . $conn->error;
  }
  $conn->close();
}
?>
