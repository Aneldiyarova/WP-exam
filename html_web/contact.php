<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .logo {
            max-height: 50px;
        }

        .main-logo {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        header {
            background: linear-gradient(45deg, #003366, #007bff);
            color: white;
        }

        footer {
            background: linear-gradient(45deg, #003366, #0056b3);
            color: white;
        }

        .navbar-nav .nav-link {
            color: white;
            font-size: 1rem;
            font-weight: 500;
        }

        .navbar-nav .nav-link i {
            margin-right: 5px;
        }

        .navbar-nav .nav-link:hover {
            text-decoration: underline;
        }

        footer a {
            color: #FFD700;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        main {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 800px;
            margin: 40px auto;
        }

        .map {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin: 0 10px;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.3s;
        }

        .social-icons a:hover {
            color: #FFD700;
            transform: scale(1.2);
        }

        .contact-form {
            margin-top: 30px;
            text-align: left;
        }

        .contact-form .btn-primary {
            background: linear-gradient(45deg, #1e90ff, #00bfff);
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-form .btn-primary:hover {
            background: linear-gradient(45deg, #00bfff, #1e90ff);
        }
    </style>
</head>
<body>
    <!-- Шапка -->
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

    <!-- Основной контент -->
    <main>
        <img src="https://international.unime.it/sites/sten/files/styles/large/public/2023-01/logo%20welcome%20point%20unime%20_0.png?itok=tUXnsGG1" alt="University Welcome Point" class="main-logo">
        <h2>Contact Us</h2>
        <p>If you have any questions, feel free to contact us:</p>
        <ul>
            <li><i class="fas fa-envelope"></i> <strong>Email:</strong> unime@university.edu</li>
            <li><i class="fas fa-phone"></i> <strong>Phone:</strong> +39 328 538 3254</li>
            <li><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> Piazza Pugliatti,1,98122</li>
        </ul>
        
        <!-- Карта -->
        <img src="https://www.meconet.org/wp-content/uploads/2024/06/mappa_accademia-1024x623.png" alt="University Location Map" class="map">

        <!-- Социальные сети -->
        <div class="social-icons mt-3">
            <a href="https://www.facebook.com/" target="_blank" class="btn btn-primary"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="https://www.instagram.com/" target="_blank" class="btn btn-danger"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="https://twitter.com/" target="_blank" class="btn btn-info"><i class="fab fa-twitter"></i> Twitter</a>
        </div>

        <!-- Форма обратной связи -->
        <div class="contact-form">
            <h4>Send us a message:</h4>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" class="form-control" placeholder="Your Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" class="form-control" placeholder="Your Email">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea id="message" class="form-control" rows="4" placeholder="Your Message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </main>

    <!-- Футер -->
    <footer class="text-center py-3">
        <p>© 2025 University Portal</p>
        <p><a href="https://www.unime.it" target="_blank">Stay connected: Official Website</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>

