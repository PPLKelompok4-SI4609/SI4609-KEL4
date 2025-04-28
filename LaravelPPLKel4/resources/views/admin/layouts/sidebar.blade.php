<aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-blue-600">FloodRescue</h1>
        <p class="text-sm text-gray-500 mt-1">Admin Panel</p>
    </div>
    <nav class="flex-1 px-4 mt-4 space-y-2">
        <a href="{{ route('admin.laporan.index') }}" 
           class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 transition">
            Dashboard
        </a>
        <a href="{{ route('admin.laporan.index') }}" 
           class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 transition">
            Laporan Banjir
        </a>
        <a href="#" 
           class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 transition">
            Pengaturan
        </a>
    </nav>
    <div class="p-4 border-t border-gray-200">
        <form method="POST" action="#">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded-lg text-gray-700 hover:bg-red-100 hover:text-red-600 transition">
                Logout
            </button>
        </form>
    </div>
</aside>
