<?php
require_once 'config.php';

function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function getAllAds() {
    $conn = getDBConnection();
    $result = $conn->query("SELECT * FROM ad ORDER BY created DESC");
    $ads = [];
    while($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }
    $conn->close();
    return $ads;
}

function createAd($email, $title, $description, $category) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO ad (email, title, description, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $title, $description, $category);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>