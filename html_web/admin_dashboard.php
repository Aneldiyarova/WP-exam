<?php
session_start();
include 'db.php';

// Проверяем, авторизован ли пользователь как администратор
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Сообщение для обратной связи
$message = "";

// Обработка добавления расписания
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_schedule'])) {
    $course_name = trim($_POST['course_name']);
    $room = trim($_POST['room']);
    $lecturer = trim($_POST['lecturer']);
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $course_id = trim($_POST['course_id']);

    if (empty($course_name) || empty($room) || empty($lecturer) || empty($date) || empty($time) || empty($course_id)) {
        $message = "All fields are required!";
    } else {
        $stmt = $conn->prepare("INSERT INTO courses (name, room, lecturer, date, time, course_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $course_name, $room, $lecturer, $date, $time, $course_id);

        if ($stmt->execute()) {
            $message = "Schedule added successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
        $stmt->close();
    }
}

// Удаление записи
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        $message = "Schedule deleted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .logo {
            max-height: 60px;
        }
        header {
            background: linear-gradient(45deg, #003366, #007bff);
            color: white;
        }
        footer {
            background: linear-gradient(45deg, #003366, #0056b3);
            color: white;
        }
        footer a {
            color: #FFD700;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .navbar-nav .nav-link {
            color: white !important;
        }
        .navbar-nav .nav-link i {
            margin-right: 5px;
        }
        .navbar-nav .nav-link:hover {
            text-decoration: underline;
        }
        .navbar-nav .nav-link.active {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="https://www.unime.it/sites/default/files/logo.png" alt="UNIME Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.html"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="schedule.php"><i class="fas fa-calendar-alt"></i> Timetable</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html"><i class="fas fa-info-circle"></i> About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <h1 class="text-center">Admin Dashboard</h1>
    <h2 class="text-center">Manage Schedule</h2>
    <?php if (isset($message)) echo "<div class='alert alert-info'>$message</div>"; ?>

    <!-- Форма добавления расписания -->
    <form method="POST" action="admin_dashboard.php" class="mb-4">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="course_name" class="form-label">Course Name:</label>
                <input type="text" id="course_name" name="course_name" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="room" class="form-label">Room:</label>
                <input type="text" id="room" name="room" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="lecturer" class="form-label">Lecturer:</label>
                <input type="text" id="lecturer" name="lecturer" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="date" class="form-label">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="time" class="form-label">Time:</label>
                <input type="time" id="time" name="time" class="form-control" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="course_id" class="form-label">Course:</label>
                <select id="course_id" name="course_id" class="form-control" required>
                    <option value="1">Course 1</option>
                    <option value="2">Course 2</option>
                    <option value="3">Course 3</option>
                </select>
            </div>
        </div>
        <button type="submit" name="add_schedule" class="btn btn-primary w-100">Add Schedule</button>
    </form>

    <!-- Таблица с расписанием -->
    <h3>Existing Schedule</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Room</th>
                <th>Lecturer</th>
                <th>Date</th>
                <th>Time</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filter_course = isset($_GET['filter_course']) ? $_GET['filter_course'] : '';
            $sql = "SELECT * FROM courses";

            if (!empty($filter_course)) {
                $sql .= " WHERE course_id = " . intval($filter_course);
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['room']}</td>
                            <td>{$row['lecturer']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['time']}</td>
                            <td>Course {$row['course_id']}</td>
                            <td>
                                <a href='edit_schedule.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='admin_dashboard.php?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?')\">Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No schedule available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<footer class="text-center py-3">
    <p>© 2025 University Portal</p>
    <p><a href="https://www.unime.it" target="_blank">Stay connected: Official Website</a></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>

