<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    @vite(['resources/css/app.css', 'resources/js/app.js'])  
    <title>Responsive Navigation Bar with Active State</title>  
    <style>  
        /* Custom styles for the icons */  
        .icon {  
            width: 24px; /* Set icon size */  
            height: 24px; /* Set icon size */  
        }  
        /* Active item styles */  
        .nav-item {  
            padding: 8px 12px; /* Padding around the item */  
            border-radius: 12px; /* Rounded corners */  
            transition: background-color 0.3s; /* Smooth transition */  
        }  
        .nav-item.active {  
            background-color: rgba(59, 130, 246, 0.2); /* Light blue background for active item */  
        }  
    </style>  
</head>  
<body style="background-color: white">  
    <!-- Navigation Bar -->  
    <x-navigationbarmobile />
        {{-- Desktop --}}
    <x-navigationbardesktop />    
    <!-- Main Content -->  
    <div class="flex items-center justify-center min-h-screen">  
        <h1 class="text-3xl">Welcome to the App</h1>  
    </div>  

   
</body>  
</html>