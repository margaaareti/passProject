<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админка</title>
</head>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@vite(['resources/sass/admin/main.scss'])

<body>
<div class="app d-flex flex-column justify-content-between min-vh-100">

   @include('admin.includes.header')

    <main class="flex-grow-1 py-4">
        @yield('content')
    </main>

{{--    @include('admin.includes.footer')--}}


</div>
</body>
</html>
