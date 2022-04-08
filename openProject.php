<?php

function openProject(){
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
}
?>
