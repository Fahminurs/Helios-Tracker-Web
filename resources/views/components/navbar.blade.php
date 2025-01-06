<div class="fixed lg:left-0 top-0 left-0 right-0 z-50 bg-[#FBF8F6]" style="z-index: 1">
    <div class="p-4 lg:w-[calc(100%-190px)] bg-[#BFF0DB] rounded-none rounded-b-[20px] lg:p-1 mx-0 lg:mx-0 lg:ml-[170px] lg:mt-6 lg:rounded-[15px]">
        <div class="flex flex-col items-center">
            <!-- Logo and Title -->
            <div class="flex justify-between items-center w-full lg:block mb-4 mt-2">
                <h1 class="text-[25px] sm:text-3xl md:text-4xl lg:text-4xl font-bold font-inter text-black lg:text-center lg:w-full [text-shadow:_-1px_-1px_0_#fff,_1px_-1px_0_#fff,_-1px_1px_0_#fff,_1px_1px_0_#fff]">Helios Tracker</h1>
                <img src="{{ Vite::asset('resources/assets/image/logo/logo.png') }}" alt="Logo" class="w-10 h-10 lg:hidden">
            </div>

            <!-- Navigation Tabs -->
            <div class="inline-flex rounded-[15px] p-1 space-x-4 self-center">
                <!-- Main Tab -->
                <a href="{{ route('main') }}" 
                    class="inline-flex items-center w-[180px] h-[40px] text-base md:text-[14px] font-semibold font-poppins rounded-full transition-all max-w-[140px] duration-200 ease-in-out relative
                    {{ request()->is('main*') ? 
                        'text-white bg-black border-2 border-white' : 
                        'text-black bg-[#F3EBE5] font-poppins font-semibold' }}"
                >
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center absolute left-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->is('main*') ? 'text-black' : 'text-gray-700' }}">
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M13.41 10.59l2.59 -2.59" />
                            <path d="M7 12a5 5 0 0 1 5 -5" />
                        </svg>
                    </div>
                    <span class="ml-[60px]">Main</span>
                </a>

                <!-- Device List Tab -->
                <a href="{{ route('device-list') }}" 
                    class="inline-flex items-center w-[180px] h-[40px] text-base md:text-[14px] font-semibold font-poppins rounded-full transition-all duration-200 ease-in-out relative
                    {{ request()->is('device-list*') ? 
                        'text-white bg-black border-2 border-white' : 
                        'text-black bg-[#F3EBE5] font-poppins font-semibold' }}"
                >
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center absolute left-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ request()->is('device-list*') ? 'text-black' : 'text-gray-700' }}">
                            <path d="M15 20h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5" />
                            <path d="M9 17h4.5" />
                            <path d="M19 22v.01" />
                            <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                        </svg>
                    </div>
                    <span class="ml-[60px]">Device List</span>
                </a>
            </div>
        </div>
    </div>
</div>