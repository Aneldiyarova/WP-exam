<?php
include 'db.php'; // Подключение к базе данных
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хэшируем пароль
    $course_id = $_POST['course_id'];

    $sql = "INSERT INTO student_info (name, email, course, password, course_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $course, $password, $course_id);
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Registration successful!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
</head>
<body>
    <h1>Register as a Student</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="course">Course:</label>
        <input type="text" id="course" name="course" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="course_id">Course ID:</label>
        <input type="number" id="course_id" name="course_id" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
