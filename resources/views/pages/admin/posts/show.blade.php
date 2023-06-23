@extends('dashboard')

@section('content')
    <div class="p-5">
        <div
            class="mx-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <img class="rounded-t-lg" src="{{ asset($post->cover) }}" alt="" />
            <div class="p-5">
                <div class="relative flex justify-between">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $post->title }}
                    </h5>
                    <button id="dropdownButton" data-dropdown-toggle="dropdown"
                        class=" inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                        type="button">
                        <span class="sr-only">Open dropdown</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="absolute left-1/3 bottom z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2" aria-labelledby="dropdownButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{ $post->description }}
                </p>
                <div class="flex justify-between items-end">
                    <div>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                            {{ $post->category->name }}
                        </a>
                    </div>
                    <div>
                        <img class="w-8 h-8 rounded-full shadow-lg" src="{{ asset($post->user->avatar) }}"
                            alt="user avatar" />
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto max-w-sm mt-5">
            <form action="{{ route('comment.user.store', $post->id) }}" method="POST">
                @csrf
                <div>
                    <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Write a comment
                    </label>
                    <input type="text" id="comment" name="content" value="{{ old('content') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                        @error('content') is-invalid @enderror">
                    @error('content')
                        <span class='text-red-700'>{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </div>
        @foreach ($post->comments as $comment)
            <div
                class="mx-auto my-2 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="p-3">
                    <div class="flex items-center">
                        <img class="w-10 h-10 mr-2 mb-2" src="{{ asset($comment->user->avatar) }}" alt="user avatar">
                        <p class="text-white">
                            {{ $comment->user->name }}
                        </p>
                    </div>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{ $comment->content }}
                    </p>
                    <span class="text-blue-300">It has been {{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection
