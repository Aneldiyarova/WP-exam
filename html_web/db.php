<?php
$servername = "localhost"; // Или ваш сервер
$username = "root";        // Ваш логин от базы данных
$password = "";            // Пароль для базы
$dbname = "university_timetable"; // Имя вашей базы данных

// Подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully"; // Для проверки
?>
