<?php
require_once 'includes/functions.php';

// Пример добавления объявления
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    createAd($_POST['email'], $_POST['title'], $_POST['description'], $_POST['category']);
}

// Получение всех объявлений
$ads = getAllAds();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Доска объявлений</title>
</head>
<body>
    <h1>Доска объявлений</h1>
    
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="title" placeholder="Заголовок" required>
        <textarea name="description" placeholder="Описание" required></textarea>
        <input type="text" name="category" placeholder="Категория" required>
        <button type="submit">Добавить объявление</button>
    </form>

    <h2>Список объявлений</h2>
    <?php foreach ($ads as $ad): ?>
        <div>
            <h3><?= htmlspecialchars($ad['title']) ?></h3>
            <p><?= htmlspecialchars($ad['description']) ?></p>
            <p>Категория: <?= htmlspecialchars($ad['category']) ?></p>
            <p>Email: <?= htmlspecialchars($ad['email']) ?></p>
            <p>Дата: <?= $ad['created'] ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>