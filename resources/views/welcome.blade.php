<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>oneInfo - Papan Informasi Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E40AF',
                        accent: '#F59E0B'
                    }
                }
            }
        }
    </script>
</head>

<body>
    <div>
        @extends('components.layouts.app')
    </div>
</body>

</html>
