<?php
function display_ads() {
    $categories = ['Охота', 'Рыбалка', 'Туризм'];

    foreach ($categories as $cat) {
        if (is_dir($cat)) {
            $files = scandir($cat);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $content = file_get_contents("$cat/$file");
                    $lines = explode("\n", $content);
                    $email = str_replace('Email: ', '', $lines[0]);
                    $message = isset($lines[1]) ? str_replace('Текст: ', '', $lines[1]) : '';
                    $title = pathinfo($file, PATHINFO_FILENAME);
                    echo "<tr><td>$email</td><td>$cat</td><td>$title</td><td>$message</td></tr>";
                }
            }
        }
    }
}
?>
