<?php
// Подключаем файл с базой данных
include 'db.php';
session_start();

// Проверяем, вошел ли пользователь
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

// Проверяем, установлен ли ID студента
if (!isset($_SESSION['id'])) {
    die("Student ID is not set in the session.");
}

// Для отладки
echo "Connected successfully. Student ID: " . $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo {
            max-height: 60px;
        }
        header {
            background-color: #007bff;
            color: white;
        }
        footer {
            background-color: #003366;
            color: white;
        }
        footer a {
            color: #FFD700;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
        .course-card {
            border: 1px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .course-card h3 {
            color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Шапка -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="https://www.unime.it/sites/default/files/logo.png" alt="UNIME Logo" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="student_dashboard.php">Timetable</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Основной контент -->
    <main class="container mt-5">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>This is your student portal. Below are your course schedules.</p>

        <!-- Карточки с расписанием -->
        <div class="row">
            <?php
            // Получаем расписание, связанное с курсами студента
            $student_id = $_SESSION['id'];
            $sql = "SELECT c.* 
                    FROM courses c
                    INNER JOIN student_courses sc ON c.id = sc.course_id
                    WHERE sc.student_id = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("SQL prepare failed: " . $conn->error);
            }
            $stmt->bind_param("i", $student_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4'>
                            <div class='course-card'>
                                <h3>" . htmlspecialchars($row['name']) . "</h3>
                                <p><strong>Room:</strong> " . htmlspecialchars($row['room']) . "</p>
                                <p><strong>Lecturer:</strong> " . htmlspecialchars($row['lecturer']) . "</p>
                                <p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>
                                <p><strong>Time:</strong> " . htmlspecialchars($row['time']) . "</p>
                            </div>
                          </div>";
                }
            } else {
                echo "<p>No schedule available for your courses.</p>";
            }
            ?>
        </div>
    </main>

    <!-- Футер -->
    <footer class="text-center py-3">
        <p>© 2025 University Portal</p>
        <p><a href="https://www.unime.it" target="_blank">Stay connected: Official Website</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
