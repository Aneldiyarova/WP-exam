<?php
session_start();
include 'db.php';

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Инициализация переменных
$message = "";
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Получение данных записи
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

// Обновление записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_schedule'])) {
    $course_name = trim($_POST['course_name']);
    $room = trim($_POST['room']);
    $lecturer = trim($_POST['lecturer']);
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $course_id = trim($_POST['course_id']);

    if (empty($course_name) || empty($room) || empty($lecturer) || empty($date) || empty($time) || empty($course_id)) {
        $message = "All fields are required!";
    } else {
        $stmt = $conn->prepare("UPDATE courses SET name = ?, room = ?, lecturer = ?, date = ?, time = ?, course_id = ? WHERE id = ?");
        $stmt->bind_param("sssssii", $course_name, $room, $lecturer, $date, $time, $course_id, $id);

        if ($stmt->execute()) {
            $message = "Schedule updated successfully!";
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $message = "Error: " . $conn->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Schedule</h1>
        <?php if ($message) echo "<div class='alert alert-info'>$message</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="course_name" class="form-label">Course Name:</label>
                <input type="text" id="course_name" name="course_name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="room" class="form-label">Room:</label>
                <input type="text" id="room" name="room" class="form-control" value="<?php echo htmlspecialchars($row['room']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lecturer" class="form-label">Lecturer:</label>
                <input type="text" id="lecturer" name="lecturer" class="form-control" value="<?php echo htmlspecialchars($row['lecturer']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date:</label>
                <input type="date" id="date" name="date" class="form-control" value="<?php echo htmlspecialchars($row['date']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Time:</label>
                <input type="time" id="time" name="time" class="form-control" value="<?php echo htmlspecialchars($row['time']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="course_id" class="form-label">Course:</label>
                <select id="course_id" name="course_id" class="form-control" required>
                    <option value="1" <?php if ($row['course_id'] == 1) echo 'selected'; ?>>Course 1</option>
                    <option value="2" <?php if ($row['course_id'] == 2) echo 'selected'; ?>>Course 2</option>
                    <option value="3" <?php if ($row['course_id'] == 3) echo 'selected'; ?>>Course 3</option>
                </select>
            </div>
            <button type="submit" name="update_schedule" class="btn btn-primary">Update</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
