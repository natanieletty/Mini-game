<?php
session_start();

// Ініціалізуємо початкові значення життів для обох персонажів
if (!isset($_SESSION['player_hp'])) {
    $_SESSION['player_hp'] = 10;
}
if (!isset($_SESSION['enemy_hp'])) {
    $_SESSION['enemy_hp'] = 10;
}

// Перевіряємо, чи була відправлена форма з атакою
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримуємо введену користувачем відповідь на питання з таблиці множення
    $user_answer = intval($_POST['answer']);

    // Вираховуємо правильну відповідь
    $correct_answer = $_SESSION['num1'] * $_SESSION['num2'];

    // Логіка атаки
    if ($user_answer == $correct_answer) {
        // Зменшуємо життя ворога
        $_SESSION['enemy_hp'] -= rand(1, 4);
    } else {
        // Зменшуємо життя гравця
        $_SESSION['player_hp'] -= rand(1, 4);
    }

    // Перевіряємо кінець гри
    if ($_SESSION['player_hp'] <= 0 || $_SESSION['enemy_hp'] <= 0) {
        // header("Location: game1over.php");
        header("Location: index.php");
        exit();
    }
}

// Генеруємо випадкові числа для таблиці множення
$_SESSION['num1'] = rand(1, 10);
$_SESSION['num2'] = rand(1, 10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гра - Симулятор поєдинку</title>
    <style>
        body {
            font-family: 'Verdana', sans-serif;
            background-color: #d9fcff;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #4b0082;
            margin-top: 20px;
        }
        form {
            margin-top: 20px;
        }
        p {
            margin-top: 10px;
            font-size: 18px;
        }
        .status {
            font-weight: bold;
            margin-top: 30px;
            font-size: 20px;
        }
        .life-status {
            font-size: 18px;
            margin-top: 20px;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        input[type="number"] {
            padding: 10px;
            font-size: 16px;
            width: calc(100% - 22px);
            margin-bottom: 20px;
        }
        button {
            background-color: #aa4de8;
            color: #fff;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #000f73;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Міні-гра - симулятор поєдинку</h1>

    <!-- Питання з таблиці множення -->
    <p>Відповідь на питання: <?php echo $_SESSION['num1'] . " &times; " . $_SESSION['num2'] . " = ?"; ?></p>

    <!-- Форма для відповіді -->
    <form method="post">
        <input type="number" name="answer" required>
        <button type="submit">Атакувати</button>
    </form>

    <!-- Виведення статусу життів -->
    <div class="life-status">
        <p>Ваші життя: <?php echo $_SESSION['player_hp']; ?></p>
        <p>Життя ворога: <?php echo $_SESSION['enemy_hp']; ?></p>
    </div>

    <!-- Виведення статусу битви -->
    <?php
    if ($_SESSION['player_hp'] > 0 && $_SESSION['enemy_hp'] > 0) {
        echo "<div class='status'>Бій триває...</div>";
    } else {
        echo "<div class='status'>Гра закінчена!</div>";
    }
    ?>
</div>
</body>
</html>
