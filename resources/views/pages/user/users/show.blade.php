<x-app-layout>
    <div
        class="mx-auto w-9/12 bg-white border border-gray-200 m-6 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="grid grid-rows-3 grid-flow-col gap-4">
                    <div class="row-span-3">
                        <img class="w-40 h-40 rounded-full shadow-lg" src="{{ asset($user->avatar) }}"
                            alt="Bonnie image" />
                    </div>
                    <div class="col-span-3">{{ $user->name }}</div>
                    <div class="col-span row-span-2">{{ $user->posts_count }} posts</div>
                    <div class="col-span row-span-2">{{ $followersCount }} followers</div>
                    <div class="col-span">{{ $followingCount }} following</div>
                           
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between w-9/12 m-auto flex-wrap">
        @foreach ($user->posts as $post)
            <div
                class="my-2 bg-white w-80 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="{{ route('post.user.show', $post->id) }}">
                    <img class="rounded-t-lg object-cover" src="{{ asset($post->cover) }}" alt="" />
                </a>
                <div class="p-5">
                    <div class="flex justify-between">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $post->title }}
                        </h5>
                        @if (Auth::check() && Auth::user()->id === $post->user_id)
                            <button id="dropdownButton_{{ $post->id }}" data-dropdown-toggle="dropdown"
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
                            <div id="dropdown_{{ $post->id }}"
                                class="absolute left-1/3 bottom z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="dropdownButton_{{ $post->id }}">
                                    <li>
                                        <a href="{{ route('post.edit', $post->id) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                    </li>
                                    <li>
                                        <button href="#"
                                            class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>
                                    </li>
                                </ul>
                            </div>
                            <script>
                                var dropdownButton_{{ $post->id }} = document.getElementById('dropdownButton_{{ $post->id }}');
                                var dropdown_{{ $post->id }} = document.getElementById('dropdown_{{ $post->id }}');

                                dropdownButton_{{ $post->id }}.addEventListener('click', function() {
                                    dropdown_{{ $post->id }}.classList.toggle('hidden');
                                });
                            </script>
                        @endif
                    </div>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ $post->description }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
