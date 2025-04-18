<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $category = $_POST['category'];
    $title = preg_replace("/[^a-zA-Z0-9а-яА-Я\s]/u", "", $_POST['title']); // без символов
    $message = htmlspecialchars($_POST['message']);

    $folder = $category;
    if (!is_dir($folder)) {
        mkdir($folder);
    }

    $filename = $folder . "/" . $title . ".txt";
    $content = "Email: $email\nТекст: $message";
    file_put_contents($filename, $content);

    header("Location: index.php");
    exit();
}
?>
