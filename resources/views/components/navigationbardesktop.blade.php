<style>  
    /* Default: sembunyikan sidebar */  
    .sidebar {  
        display: none;  
    }  

    /* Media query untuk desktop saja (min-width: 1024px) */  
    @media (min-width: 1024px) {  
        .sidebar {  
            display: flex;  
            justify-content: space-between;  
            position: fixed;  
            top: 50%;  
            left: 20px;  
            transform: translateY(-50%);  
            width: 90px;  
            height: 976px;  
            max-height: 95vh;  
            background-color: #F3EBE5;  
            border-radius: 1rem;  
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);  
            padding: 1rem; 
            z-index : 2; 
        }  

        /* Custom styles for the active state */  
        .nav-item input:checked + div {  
            @apply bg-black text-white ring-2 ring-white;  
        }  

        .nav-item svg {  
            stroke: black;  
        }  
        .nav-item input:checked + div svg {  
            stroke: white;  
        }   

        .nav-item div:hover svg {  
            stroke: white;  
        }  
    }  
</style>  

<div class="fixed top-1/2 left-5 transform -translate-y-1/2 h-[976px] max-h-[95vh] flex flex-col sidebar w-[80px] bg-[#F3EBE5] rounded-2xl shadow-lg p-4 lg:block hidden">  
    <!-- Top Section -->  
    <div class="flex flex-col items-center space-y-4 mt-3">  
        <!-- Solar Panel Icon -->  
        <img src="{{ Vite::asset('resources/assets/image/logo/logo.png') }}" width="70" height="70" alt="">  
    
        <!-- Download Icon -->  
        <a href="Download">
        <div class="relative flex flex-col items-center">  
            <div class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-white mb-2 relative text-black">  
                <svg xmlns="http://www.w3.org/2000/svg" class="w-[35px] h-[35px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">  
                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>  
                    <path d="M7 11l5 5l5 -5"></path>  
                    <path d="M12 4l0 12"></path>  
                </svg>  
                <span class="top-0 right-0 absolute w-5 h-5  border-2 border-white dark:border-gray-800 rounded-full" style="background-color: #EF98A1;"></span>  
            </div>  
           
        </div> 
    </a> 
 
    </div> 

    <!-- Middle Section -->  
    <div class="flex flex-col items-center space-y-4">  
        <!-- Home Icon -->  
        <label class="nav-item relative flex flex-col items-center cursor-pointer group">  
            <a href="{{ route('main') }}">
                <input type="radio" name="nav" class="sr-only peer" 
                    {{ request()->routeIs('main') || request()->routeIs('device-list') ? 'checked' : '' }}>  
                <div class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-white mb-2 transition-all duration-300 hover:bg-black hover:text-white hover:ring-2 hover:ring-white peer-checked:bg-black peer-checked:text-white peer-checked:ring-2 peer-checked:ring-white">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] h-[30px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">  
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>  
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>  
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>  
                    </svg>  
                </div> 
            </a> 
            <span class="absolute left-[70px] ml-2 top-1/2 -translate-y-1/2 translate-x-2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Home</span>  
        </label>  

        <!-- History Icon -->  
        <label class="nav-item relative flex flex-col items-center cursor-pointer group"> 
            <a href="{{ route('Histori') }}"> 
                <input type="radio" name="nav" class="sr-only peer" {{ request()->routeIs('Histori') ? 'checked' : '' }}>  
                <div class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-white mb-2 transition-all duration-300 hover:bg-black hover:text-white hover:ring-2 hover:ring-white peer-checked:bg-black peer-checked:text-white peer-checked:ring-2 peer-checked:ring-white">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] h-[30px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">  
                        <path d="M12 8l0 4l2 2"></path>  
                        <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5"></path>  
                    </svg>  
                </div>  
            </a> 
            <span class="absolute left-[70px] ml-2 top-1/2 -translate-y-1/2 translate-x-2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">History</span>  
        </label>  
    </div>  

    <!-- Bottom Section -->  
    <div class="flex flex-col items-center">  
        <!-- Settings Icon -->  
        <label class="nav-item relative flex flex-col items-center cursor-pointer group"> 
            <a href="{{ route('settings') }}">  
                <input type="radio" name="nav" class="sr-only peer" {{ request()->routeIs('settings') || request()->routeIs('update-account') || request()->routeIs('update-password') || request()->routeIs('about-app')  ? 'checked' : '' }}>  
                <div class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-white mb-2 transition-all duration-300 hover:bg-black hover:text-white hover:ring-2 hover:ring-white peer-checked:bg-black peer-checked:text-white peer-checked:ring-2 peer-checked:ring-white">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[30px] h-[30px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">  
                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>  
                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>  
                    </svg>  
                </div> 
            </a>  
            <span class="absolute left-[70px] ml-2 top-1/2 -translate-y-1/2 translate-x-2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Settings</span>  
        </label>  
    </div>  
</div>