<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <style>
        /* resources/css/app.css atau di dalam <style> di layout utama */
        html {
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
            /* biar nggak ada horizontal scroll */
        }

        /* Sidebar tetap nempel di kiri, tidak ikut scroll */
        .fixed-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 256px;
            /* sama dengan w-64 */
            overflow-y: auto;
            /* kalau menu banyak, sidebar sendiri bisa discroll */
            z-index: 50;
        }

        /* Konten utama geser ke kanan biar nggak ketutup sidebar */
        .main-content {
            margin-left: 256px;
            /* sama dengan lebar sidebar */
            min-height: 100vh;
        }

        /* Responsif: di HP sidebar jadi overlay atau collapse */
        @media (max-width: 1024px) {
            .fixed-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .fixed-sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="text-dark bg-gray-50">
    <main>
        {{ $slot }}
    </main>
    @livewireScripts
</body>

</html>
