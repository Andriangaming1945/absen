<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/icons/all.css">
    <title>Absensi - {{ $title }}</title>
    @vite(['resources/js/app.js'])
</head>
<body class="">

    <div class="mb-5 overflow-hidden">
        <div class="row ps-lg-3">
         @include('layouts.sidebar')

        <main class="col-12 col-lg-10">
            @include('layouts.navbar')
            <div class="bg-white p-3">
                @yield('slot')
            </div>
          </main>
        </div>
      </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="/assets/icons/all.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $('#datatables').DataTable();
    </script>
</body>
</html>
