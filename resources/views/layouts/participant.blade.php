<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - EventsAccess</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans antialiased flex flex-col min-h-screen">

    @include('participant.components.navbar')

    <main class="container mx-auto mt-8 px-4 flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-200 py-4 text-center text-sm text-gray-600 mt-auto">
        &copy; {{ date('Y') }} EventsAccess.
    </footer>

</body>
</html>