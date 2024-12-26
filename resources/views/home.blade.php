<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
            color: black;
            margin-left: 15px;
        }
    </style>
</head>

<body>
<x-navbar active="home" />

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="container welcome-section">
        <h1>Selamat Datang di Tirza Salon</h1>
        <p class="lead">Nikmati layanan terbaik kami untuk perawatan kecantikan Anda.</p>
    </div>
</body>

</html> 