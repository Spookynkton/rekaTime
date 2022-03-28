<?php
    include 'idiorm.php';

    ORM::configure('mysql:host=localhost;dbname=timeng_reka');
    ORM::configure('username', 'root');
    ORM::configure('password', 'DeusExMachina27!');
    ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $link = mysqli_connect('rekatime', 'root', 'DeusExMachina27!', 'timeng_reka');
    if ($link == false){
        echo ("Error: SQL Base drope" . mysqli_connect_error());
    }
    else{
        echo ("SQL - succes!");
    }
    mysqli_set_charset($link, 'utf8');

    function getRequestVar($var, $default=null){
        return isset($_REQUEST[$var])
            ? trim($_REQUEST[$var])
            : $default;
    }
    function esc($str){
        return htmlspecialchars($str, ENT_QUOTES | ENT_IGNORE);
    }

    if(getRequestVar('asana') && getRequestVar('taskname') && getRequestVar('time')){
        $record = ORM::for_table('projecttime')->create();
        $record->asana = getRequestVar('asana');
        $record->name = getRequestVar('taskname');
        $record->time = getRequestVar('time');
        $record->save();
        header('Location:?name='.urldecode(getRequestVar('name')));
    }

    $projecttimeHistory = ORM::for_table('projecttime')
                        ->order_by_asc('id')
                        ->limit(25)
                        ->find_many();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TimeReka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<div class="container-fluid">
    <div class="row"><h3>Reka Time for Client</h3></div>
</div>
<div class="row justify-content-around">
<!-- Данные -->

<div class="col-9 gy-5 ">


    <?php if ($projecttimeHistory):?>
        <?php foreach($projecttimeHistory as $record):?>
            <table class="table bg-light">
                <tbody>
            <td class="col-1 border-start border-top"><?=esc($record->id)?></td>

            <td class="col-1 border-top"><a href="<?=esc($record->asana)?>" target="_blank">Asana</a></td>

            <td class="col-3 border-top"><?=esc($record->name)?></td>

            <td class="col-1 border-top"><?=esc($record->time)?></td>
            <td class="col-1 border-end border-top" ><button for='delete'>Delete</button></td>
            </tbody>
        </table>
        <?php endforeach;?>
    <?php endif;?>


</div>

<!-- Форма -->


<div class="col-2 gy-5">
    <div class="p-3 border bg-light">
        <form action="?" method="post" class="form">
            <div class="form_block">
                <div class="form-group">
                    <label for="asana" class="form-text">Ссылка на Асану:</label>
                    <input type="text" name="asana" class="form-control" value="">
                </div>
                <br>
                <div class="form-group">
                    <label for="taskname" class="form-text">Название задачи:</label>
                    <input type="text" name="taskname" class="form-control" value="">
                </div>
                <br>
                <div class="form-group">
                    <label for="time" class="form-text">Время задачи:</label>
                    <input type="text" name="time" class="form-control" value="">
                </div>
                <br>
                <input type="submit" name="submit" value="Отправить" />
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>
