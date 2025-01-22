<?php
session_start();
include 'db.php';

// Проверка авторизации
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

// Получение информации о студенте
$student_id = $_SESSION['id']; // ID пользователя из сессии
$query = "SELECT course_id FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
    $course_id = $student['course_id'];
} else {
    echo "Error: Student not found.";
    exit();
}

// Получение расписания для курса
$query = "SELECT * FROM courses WHERE course_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$schedule = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Your Schedule</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Room</th>
                    <th>Lecturer</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($schedule->num_rows > 0) {
                    while ($row = $schedule->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['room']}</td>
                                <td>{$row['lecturer']}</td>
                                <td>{$row['date']}</td>
                                <td>{$row['time']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No schedule available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
