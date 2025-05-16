<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Praise Story' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body>
    <main class="container mx-auto p-4">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
