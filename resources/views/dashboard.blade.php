<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="flex justify-between items-center">
                {{ __('Dashboard') }}
                <a href="{{ route('category.index') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none w-60 dark:focus:ring-blue-800 text-center">
                    Categories: {{ $catCount }}
                </a>
                <a href="{{ route('post.index') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none w-60 dark:focus:ring-blue-800 text-center">
                    Posts: {{ $posCount }}
                </a>
                <a href="{{ route('category.index') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none w-60 dark:focus:ring-blue-800 text-center">
                    Comments:
                </a>
            </div>

        </h2>
    </x-slot>
    @yield('content')
</x-app-layout>
