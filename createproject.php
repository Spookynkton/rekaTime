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
    echo "Проект успешно добавлен!";
  } else {
    echo "Ошибка: " . $connP->error;
  }
  $connP->close();
}
?>
