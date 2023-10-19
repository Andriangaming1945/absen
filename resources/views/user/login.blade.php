<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi - {{ $title }}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/icons/all.css">
    <style>
        .container {
            position: relative;
        }

        .login-card {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
            position: relative;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .header-img {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 75px;
            border-radius: 50%;
            background-color: white;
            padding: 20px; /* Tambahkan padding di sini */
            z-index: 10;
        }

        .header-img img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body class="bg-danger bg-gradient">
    <div class="container rounded">
        <div class="header-img shadow-sm">
            <img src="/assets/images/logo-telkom.png" alt="Gambar Anda">
        </div>
        <div class="login-card rounded shadow">
            <h2 class="text-center mt-3">User Login</h2>
            @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                <i class="fa-solid fa-circle-info"></i> <span class="ml-2">{{ session('error') }}</span>
            </div>
            @endif
            <form method="post">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="number" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter username">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="/assets/icons/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
