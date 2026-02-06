<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Manager - EventsAccess</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen">

    @include('store.components.navbar')

    <main class="container mx-auto mt-12 px-4 flex-grow">
        @if (isset($header))
            <header class="bg-white shadow rounded-lg p-4 mb-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $header }}
                </h2>
            </header>
        @endif

        @yield('content')
    </main>

</body>
</html>