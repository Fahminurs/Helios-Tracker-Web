<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex items-center justify-center min-h-screen">
    @if(session()->has('alert'))
        <x-alert 
            :type="session('alert.type')" 
            :message="session('alert.message')" 
        />
    @endif

    <script>
        // Redirect setelah 2 detik
        setTimeout(() => {
            window.location.href = "{{ session('alert.redirect_url') }}";
        }, 2000);
    </script>
</body>
</html> 