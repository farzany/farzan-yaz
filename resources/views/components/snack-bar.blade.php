@if (session()->has('success'))
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        id="snackbar"
        class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-10 left-10 z-50 shadow-md"
    >
        <p class="text-white font-work">{{ session('success') }}</p>
    </div>
    @endif

    @if (session()->has('error'))
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        id="snackbar"
        class="fixed bg-red-500 text-white py-2 px-4 rounded-xl bottom-10 left-10 z-50 shadow-md"
    >
        <p class="text-white font-work">{{ session('error') }}</p>
    </div>
@endif