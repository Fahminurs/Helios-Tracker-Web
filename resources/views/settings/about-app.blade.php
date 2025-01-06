<!DOCTYPE html>  
<html lang="en" data-theme="light">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Tentang Helios Tracker</title>  
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">  
    @vite(['resources/css/app.css', 'resources/js/app.js'])  
    <style>  
        .container {  
            padding-left: 160px;  
            padding-right: 20px;  
padding-bottom: 100px;
padding-top: 60px;
        }  
        body {  
            font-family: 'Poppins', sans-serif;  
            min-height: 100vh;  
            display: flex;  
            align-items: center;  
        }  
        @keyframes glow {  
            0%, 100% { box-shadow: 0 0 10px rgba(59, 130, 246, 0.5); }  
            50% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.8); }  
        }  
        
        .glow-logo {  
            animation: glow 3s infinite;  
        }  

        @media (max-width: 512px) {
 
            .container {
                padding-left: 0px;  
                padding-right: 0px;  
                padding-top: 10px;
            }
        }
    </style>  
</head>  
<body >  
        <!-- Navigation Bar -->  
        <x-navigationbarmobile />
        <x-navigationbardesktop />   
    <div class="container w-full">  
        <div class="max-w-4xl mx-auto">  
            <div class="card bg-white shadow-xl">  
                <div class="card-body items-center text-center p-8">  
                    <div class="mb-8 flex flex-col items-center">  
                        <img   
                            src="{{ Vite::asset('resources/assets/image/logo/logo.png') }}"   
                            alt="Helios Tracker Logo"   
                            class="w-[156px] h-[156px] md:w-[156px] md:h-[156px] lg:w-[200px] lg:h-[200px] object-contain glow-logo rounded-full mb-6"  
                        >  
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-semibold text-primary mb-4">  
                            Helios Tracker  
                        </h1>  
                    </div> 

                    <div class="text-justify space-y-4 mb-6">  
                        <p class="text-base md:text-lg leading-relaxed text-justify">  
                            Helios Tracker adalah aplikasi inovatif yang dirancang khusus untuk memantau sistem solar tracker dual axis. Dengan teknologi Internet of Things (IoT), aplikasi ini memungkinkan pengguna untuk mengawasi kinerja panel surya secara real-time, memastikan efisiensi maksimum dalam penangkapan sinar matahari. Helios Tracker memberikan data yang akurat dan mendetail mengenai posisi panel, sehingga pengguna dapat mengoptimalkan pengaturan dan meningkatkan produksi energi.  
                        </p>  

                        <p class="text-base md:text-lg leading-relaxed text-justify">  
                            Selain itu, Helios Tracker juga dilengkapi dengan fitur analisis yang membantu pengguna memahami pola penggunaan energi dan mengidentifikasi potensi perbaikan. Dengan antarmuka yang ramah pengguna, aplikasi ini memudahkan pemantauan dan pengelolaan sistem solar tracker dari mana saja dan kapan saja. Dengan Helios Tracker, pengguna dapat memaksimalkan investasi mereka dalam energi terbarukan dan berkontribusi pada keberlanjutan lingkungan.  
                        </p>  
                    </div>  

                    <div class="card-actions justify-center space-x-4 mt-8">  
                        <a href="#" class="btn btn-primary">  
                            <i class="fas fa-globe mr-2"></i> Website  
                        </a>  
                        <a href="#" class="btn btn-secondary">  
                            <i class="fas fa-envelope mr-2"></i> Kontak  
                        </a>  
                    </div>  
                </div>  
            </div>  
        </div>   
    </div>   

    {{-- Flowbite JS (optional) --}}  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>  
</body>  
</html>