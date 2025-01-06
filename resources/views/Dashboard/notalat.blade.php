<div class="min-h-screen flex items-center justify-center lg:mt-0 -mt-20">
    <div class="relative w-full max-w-3xl mx-auto px-2 sm:px-3 lg:px-4">
        <!-- Content Container -->
        <div class="relative bg-[#1a1f3d] rounded-3xl p-6 sm:p-8 lg:p-10 shadow-2xl">
            <!-- Icon Container -->
            <div class="mb-6 sm:mb-8 lg:mb-10">
                <div class="relative mx-auto w-16 sm:w-20 lg:w-24 h-16 sm:h-20 lg:h-24">
                    <!-- Circle with Icon -->
                    <div class="absolute inset-0 bg-[#7847EB] rounded-full flex items-center justify-center transform hover:scale-105 transition-transform">
                        <i class="fas fa-bolt text-2xl sm:text-3xl lg:text-4xl text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Welcome Message -->
            <div class="text-center space-y-4 sm:space-y-5 lg:space-y-6">
                <div class="space-y-3 sm:space-y-4 lg:space-y-5">
                    <div class="flex items-center justify-center gap-2 sm:gap-3 lg:gap-4">
                        <span class="text-yellow-400 text-xl sm:text-2xl lg:text-3xl">⭐</span>
                        <h1 class="text-[12px] sm:text-xl lg:text-2xl font-bold text-white">
                            Selamat datang di Helios Tracker!
                        </h1>
                        <span class="text-yellow-400 text-xl sm:text-2xl lg:text-3xl">⭐</span>
                    </div>
                    <p class="text-gray-300 text-xs sm:text-sm lg:text-lg mx-auto leading-relaxed px-2 sm:px-4 lg:px-6 max-w-2xl">
                        Silakan pilih perangkat jika sudah ada, atau tambahkan perangkat baru untuk memulai perjalanan Anda! 
                        <span class="inline-block animate-bounce">🚀</span>
                    </p>
                </div>

                <!-- Action Button -->
                <div class="pt-4 sm:pt-6 lg:pt-8">
                    <button onclick="window.location.href='{{ route('device-list') }}'"
                            class="group relative inline-flex items-center justify-center 
                                   px-6 sm:px-8 lg:px-10 py-2.5 sm:py-3 lg:py-4
                                   overflow-hidden font-medium transition-all 
                                   bg-[#7847EB] hover:bg-[#6236c5]
                                   text-white rounded-xl
                                   hover:scale-105 transform transition-transform duration-300
                                   shadow-lg">
                        <i class="fas fa-plus-circle text-lg sm:text-xl lg:text-2xl mr-2 sm:mr-2.5 lg:mr-3"></i>
                        <span class="relative text-[13px] sm:text-[14px] lg:text-[15px] font-semibold">Tambah Perangkat</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 1024px) {
        .max-w-3xl {
            max-width: 48rem;
        }
    }
</style>
