<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Management</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <!-- Navigation menu -->
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('assets.index') }}">Assets</a>
        <a href="{{ route('transactions.index') }}">Transactions</a>
    </nav>

    <div class="container">
        @yield('content')  <!-- Content from child view will be injected here -->
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
