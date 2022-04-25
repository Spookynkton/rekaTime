<?php
if(isset($_POST["id"])){
  $connDel = new mysqli('rekatime', 'root', 'DEUSEXMACHINA27', 'rekatime');
  if($connDel->connect_error){
    die("Ошибка: " . $connDel->connect_error);
  }
  $userid = $connDel->real_escape_string($_POST["id"]);
  $sqlDel = "DELETE FROM projecttime WHERE id = '$userid'";
  if($connDel->query($sqlDel)){
    header("Location: index.php");
  }
  else{
    echo "Ошибка: " . $connDel->error;
  }
  $connDel->close();
}

?>
