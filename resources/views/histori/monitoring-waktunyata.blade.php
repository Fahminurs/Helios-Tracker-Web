<!-- Filter Section -->  
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">  
    <div>  
        <label class="block text-sm font-medium text-gray-700 mb-1">Dari Jam</label>  
        <div class="relative">
            <input type="time"  
                   id="timeStartInput"  
                   class="w-full rounded-lg border-gray-300 focus:ring-[#7847EB]"
                   step="1">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                </svg>
            </div>
        </div>
    </div>  
    <div>  
        <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Jam</label>  
        <div class="relative">
            <input type="time"  
                   id="timeEndInput"  
                   class="w-full rounded-lg border-gray-300 focus:ring-[#7847EB]"
                   step="1">
            <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                </svg>
            </div>
        </div>
    </div>  
</div>  

<!-- Search Bar -->  
<div class="relative mb-4">  
    <input type="text"  
           id="waktunyataSearchInput"  
           placeholder="Cari dengan kode perangkat"  
           class="w-full rounded-lg border-gray-300 pl-10 focus:ring-[#7847EB]">  
    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>  
</div>  
<div id="timeSearchButtonContainer" class="mb-4 hidden">  
    <button  
        id="timeSearchButton"  
        class="w-full inline-flex items-center justify-center px-4 py-2 bg-[#7847EB] text-white rounded-lg hover:bg-[#6236c5] transition-colors"  
    >  
        <i class="fas fa-search mr-2"></i>  
        Cari Perangkat berdasarkan waktu  
    </button>  
</div> 

<!-- Device Cards -->  
<div id="waktunyataCardsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 px-4 md:px-0">  
    <!-- Cards will be rendered here -->  
</div>  

<!-- No Data Found -->  
<div id="waktunyataNoDataFound" class="hidden">  
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


