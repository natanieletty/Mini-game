<?php
session_start();


// Виводимо повідомлення про результат гри
$result = ($_SESSION['player_hp'] <= 0) ? "Ви програли!" : "Ви перемогли!";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат гри</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d9fcff;
            text-align: center;
        }
        h1 {
            color: #c50404;
        }
        form {
            margin-top: 20px;
        }
        p {
            margin-top: 10px;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #48d4e0;
            color: #000000;
            text-decoration: none;
            border-radius: 5px;
        }


    </style>
</head>
<body>


<h1><?php echo $result; ?></h1>


<p>Ваші життя: <?php echo $_SESSION['player_hp']; ?></p>
<p>Життя ворога: <?php echo $_SESSION['enemy_hp']; ?></p>


<?php
$_SESSION['player_hp']=10;
$_SESSION['enemy_hp'] =10;
?>


<!-- Посилання на початок гри -->
<!-- <p><a href="index.php" class="button">Почати гру заново</a></p> -->
<p><a href="game1over.php" class="button">Почати гру заново</a></p>




</body>
</html>
