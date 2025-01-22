<?php
include 'db.php'; // Подключаемся к базе данных

// Проверяем, что данные отправлены через POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы, с обработкой возможных инъекций
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Используем подготовленные выражения для безопасности
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // s означает строковые параметры

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Проверяем роль пользователя
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php"); // Перенаправляем на панель администратора
            exit();
        } elseif ($user['role'] == 'student') {
            header("Location: student_portal.php"); // Перенаправляем на портал студента
            exit();
        }
    } else {
        // Если пользователь не найден
        echo "<p style='color: red; text-align: center;'>Invalid username or password</p>";
        echo "<a href='login.php' style='display: block; text-align: center;'>Try Again</a>";
    }

    $stmt->close(); // Закрываем подготовленное выражение
}

$conn->close(); // Закрываем соединение с базой данных
?>
