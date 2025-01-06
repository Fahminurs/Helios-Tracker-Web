<!-- Filter Section -->  
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">  
    <div>  
        <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>  
        <div class="relative">
            <input type="date"  
                   id="yearStartInput"  
                   class="w-full rounded-lg border-gray-300 focus:ring-[#7847EB]">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
        </div>
    </div>  
    <div>  
        <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>  
        <div class="relative">
            <input type="date"  
                   id="yearEndInput"  
                   class="w-full rounded-lg border-gray-300 focus:ring-[#7847EB]">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
        </div>
    </div>  
</div>  

<!-- Search Bar -->  
<div class="relative mb-4">  
    <input type="text"  
           id="yearlySearchInput"  
           placeholder="Cari dengan kode perangkat"  
           class="w-full rounded-lg border-gray-300 pl-10 focus:ring-[#7847EB]">  
    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>  
</div>  
<div id="yearSearchButtonContainer" class="mb-4 hidden">  
    <button  
        id="yearSearchButton"  
        class="w-full inline-flex items-center justify-center px-4 py-2 bg-[#7847EB] text-white rounded-lg hover:bg-[#6236c5] transition-colors"  
    >  
        <i class="fas fa-search mr-2"></i>  
        Cari Perangkat berdasarkan tanggal  
    </button>  
</div> 

<!-- Device Cards -->  
<div id="yearlyCardsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 px-4 md:px-0">  
    <!-- Cards will be rendered here -->  
</div>  

<!-- No Data Found -->  
<div id="yearlyNoDataFound" class="hidden">  
    <div class="rounded-xl shadow-sm p-8 text-center">  
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">  
            <i class="fas fa-search text-gray-400 text-xl"></i>  
        </div>  
        <h3 class="text-lg font-medium text-gray-900 mb-2">Data Tidak Ditemukan</h3>  
        <p class="text-gray-500 mb-4">Tidak ada perangkat yang sesuai dengan pencarian Anda</p>  
        <button onclick="clearSearch()"   
                class="inline-flex items-center px-4 py-2 bg-[#7847EB] text-white rounded-lg hover:bg-[#6236c5] transition-colors">  
            <i class="fas fa-redo-alt mr-2"></i>  
            <span>Reset Pencarian</span>  
        </button>  
    </div>  
</div>
