<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
        }

        .nav-link {
            font-size: 1rem;
        }

        .btn-logout {
            background: linear-gradient(90deg, #FF5733, #FFC107);
            color: #fff;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .btn-logout:hover {
            background: linear-gradient(90deg, #FFC107, #FF5733);
            transform: scale(1.05);
        }

        .btn-logout i {
            font-size: 1.2rem;
        }

        .welcome-section {
            margin-top: 50px;
            text-align: center;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .welcome-section p {
            font-size: 1.2rem;
            color: #666;
        }

        .user-info {
            font-size: 0.9rem;
            color: #fff;
            margin-left: 15px;
        }
    </style>
</head>

<body>
<x-navbar active="home" />

    <div class="container welcome-section">
        <h1>Selamat Datang di Tirza Salon</h1>
        <p class="lead">Nikmati layanan terbaik kami untuk perawatan kecantikan Anda.</p>
    </div>
</body>

</html> 