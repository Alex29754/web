<?php require 'functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Доска объявлений</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Добавить объявление</h1>
    <form action="save.php" method="POST">
        Email: <input type="email" name="email" required><br><br>
        Категория:
        <select name="category">
            <option value="Охота">Охота</option>
            <option value="Рыбалка">Рыбалка</option>
            <option value="Туризм">Туризм</option>
        </select><br><br>
        Заголовок: <input type="text" name="title" required><br><br>
        Текст:<br>
        <textarea name="message" rows="5" cols="40" required></textarea><br><br>
        <button type="submit">Добавить</button>
    </form>

    <h2>Список объявлений</h2>
    <table border="1">
        <tr><th>Email</th><th>Категория</th><th>Заголовок</th><th>Текст</th></tr>
        <?php display_ads(); ?>
    </table>
</body>
</html>
