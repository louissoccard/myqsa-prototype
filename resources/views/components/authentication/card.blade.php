<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-800">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-900 shadow-md overflow-hidden rounded-none">
        <div class="flex justify-center mt-4 mb-6">
            <x-interface.logo width="w-36"></x-interface.logo>
        </div>
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
