<?php include 'db.php'; ?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Массив для отображения названий курсов
$courses_map = [
    1 => "First Year",
    2 => "Second Year",
    3 => "Third Year"
];

// Получение выбранного курса из параметра URL
$selected_course_id = isset($_GET['course']) ? intval($_GET['course']) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Timetable</title>
    <!-- Bootstrap и FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .logo {
            max-height: 60px;
        }
        header {
            background: linear-gradient(90deg, #003366, #007bff);
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
        .btn-primary {
            background: linear-gradient(45deg, #1e90ff, #00bfff);
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #00bfff, #1e90ff);
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .navbar-nav .nav-link {
            color: white !important;
        }
        .navbar-nav .nav-link:hover {
            text-decoration: underline;
        }
        .navbar-nav .nav-link.active {
            text-decoration: underline;
        }
        .course-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .course-buttons .btn {
            width: 200px;
            font-size: 1.2em;
            font-weight: bold;
        }
        .table {
            margin-top: 20px;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
        h2 {
            color: #0056b3;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .no-schedule {
            text-align: center;
            font-size: 1.2em;
            color: #888;
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
        <h1 class="text-center">Timetable</h1>
        <div class="course-buttons mb-4">
            <?php foreach ($courses_map as $id => $name) { ?>
                <a href="schedule.php?course=<?php echo $id; ?>" class="btn btn-primary <?php echo ($selected_course_id === $id) ? 'active' : ''; ?>">
                    <i class="fas fa-graduation-cap"></i> <?php echo htmlspecialchars($name); ?>
                </a>
            <?php } ?>
        </div>

        <?php if ($selected_course_id && array_key_exists($selected_course_id, $courses_map)) { ?>
            <h2>Schedule for <?php echo htmlspecialchars($courses_map[$selected_course_id]); ?></h2>
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
                    $sql = "SELECT * FROM courses WHERE course_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $selected_course_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['id']) . "</td>
                                    <td>" . htmlspecialchars($row['name']) . "</td>
                                    <td>" . htmlspecialchars($row['room']) . "</td>
                                    <td>" . htmlspecialchars($row['lecturer']) . "</td>
                                    <td>" . htmlspecialchars($row['date']) . "</td>
                                    <td>" . htmlspecialchars($row['time']) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='no-schedule'>No schedule available for this course.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="no-schedule">Please select a course to view its schedule.</p>
        <?php } ?>
    </main>

    <footer class="text-center py-3">
        <p>© 2025 University Portal</p>
        <p><a href="https://www.unime.it" target="_blank"><i class="fas fa-link"></i> Visit Official Website</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


