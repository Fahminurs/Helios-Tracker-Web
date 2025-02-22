<!-- resources/views/components/navigation-bar-mobile.blade.php -->  
<style>  
    /* Custom styles for the icons */  
    .icon {  
        width: 24px;
        height: 24px;
    }  
    /* Active item styles */  
    .nav-item {  
        padding: 8px 12px;
        border-radius: 12px;
        transition: background-color 0.3s;
    }  
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />  
<nav class="fixed bottom-0 left-0 right-0 bg-[#F3EBE5] shadow-lg lg:hidden" style="z-index: 10000;">  
    <div class="flex justify-around py-3">  
        <!-- Home -->
        <a href="{{ route('main') }}" 
           class="flex flex-col items-center text-black stroke-black nav-item {{ request()->routeIs('main') || request()->routeIs('device-list') ? 'bg-black text-white stroke-white px-2 py-1 rounded-full' : '' }}" 
           id="home-item">  
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon w-6 h-6">  
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />  
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />  
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />  
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />  
            </svg>  
            <span class="mt-1">Home</span>  
        </a>  


        <!-- Settings -->
        <a href="{{ route('settings') }}" 
           class="flex flex-col items-center text-black stroke-black nav-item {{ request()->routeIs('settings') || request()->routeIs('update-account') || request()->routeIs('change-password') || request()->routeIs('about-app') ? 'bg-black text-white stroke-white px-2 py-1 rounded-full' : '' }}" 
           id="settings-item">  
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon w-6 h-6">  
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />  
                <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />  
                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />  
            </svg>  
            <span class="mt-1">Settings</span>  
        </a>  
    </div>  
</nav>