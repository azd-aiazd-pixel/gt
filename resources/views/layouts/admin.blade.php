<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - EventsAccess</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pour éviter le saut au chargement */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased flex flex-col min-h-screen">

    @include('admin.components.navbar')

    <main class="container mx-auto pt-24 px-4 sm:px-6 lg:px-8 flex-grow pb-10">
        
        <header class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">
                @yield('header')
            </h2>
        </header>

        @yield('content')
    </main>

</body>
</html>