<div class="flex flex-row mt-1 dark:text-gray-100">
    <select {{ $attributes->merge(['class' => "appearance-none cursor-pointer w-full py-2 px-3 border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-700 rounded-none focus:outline-none focus:ring-navy focus:border-navy sm:text-sm"]) }}>
        {{ $slot }}
    </select>
    <svg class="fill-current h-5 w-5 -ml-8 mt-2.5 pointer-events-none cursor-pointer" xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 20 20">
        <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"/>
    </svg>
</div>
