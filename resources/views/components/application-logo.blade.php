<div class="flex items-center">
    <a href="{{ route('home') }}" class="flex items-center">
        <svg class="h-10 w-auto fill-current text-gray-800 dark:text-white" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 12C22.8954 12 22 11.1046 22 10C22 8.89543 22.8954 8 24 8C25.1046 8 26 8.89543 26 10C26 11.1046 25.1046 12 24 12Z" fill="currentColor"/>
            <path d="M24 26C22.8954 26 22 25.1046 22 24C22 22.8954 22.8954 22 24 22C25.1046 22 26 22.8954 26 24C26 25.1046 25.1046 26 24 26Z" fill="currentColor"/>
            <path d="M24 40C22.8954 40 22 39.1046 22 38C22 36.8954 22.8954 36 24 36C25.1046 36 26 36.8954 26 38C26 39.1046 25.1046 40 24 40Z" fill="currentColor"/>
        </svg>
        <span class="ml-2 text-xl font-semibold text-gray-800 dark:text-white">
            {{ config('app.name', 'TeamUp') }}
        </span>
    </a>
</div>
