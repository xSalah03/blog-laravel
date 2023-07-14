<x-app-layout>
    <div class="pt-5">
        <div
            class="mx-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <input onclick="openModal()" placeholder="What's on your mind..." readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                        @error('description') is-invalid @enderror">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 flex items-center justify-center">
        <div class="absolute bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 z-10">
            <!-- Modal content goes here -->
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-1">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-gray-900 dark:text-gray-100">
                        <h3 class="pb-2">Create your post</h3>
                        <form action='{{ route('post.store') }}' method='POST' enctype='multipart/form-data'>
                            @csrf
                            <div class="mb-6">
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Post title
                                </label>
                                <input type="text" id="title" name="title" value='{{ old('title') }}'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                            @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class='text-red-700'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Post description
                                </label>
                                <input type="text" id="description" name="description"
                                    value='{{ old('description') }}'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                            @error('description') is-invalid @enderror">
                                @error('description')
                                    <span class='text-red-700'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="cover"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Upload cover
                                </label>
                                <input id="cover" type="file" name="cover" value='{{ old('cover') }}'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                            @error('cover') is-invalid @enderror">
                                @error('cover')
                                    <span class='text-red-700'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="countries"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Select a category
                                </label>
                                <select name='category_id' id="countries"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                            @error('category_id') is-invalid @enderror">
                                    <option selected>Choose category</option>
                                    @foreach ($categories as $category)
                                        <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class='text-red-700'>{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div onclick="closeModal()" class="fixed inset-0 bg-black opacity-50 cursor-pointer"></div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
        }
    </script>

    @foreach ($posts as $post)
        <div class="p-5">
            <div
                class="mx-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="{{ route('post.user.show', $post->id) }}">
                    <img class="rounded-t-lg object-cover" src="{{ asset($post->cover) }}" alt="" />
                </a>
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $post->title }}
                        </h5>
                        <h5>
                            @if (Auth::check())
                                @if ($post->user_id !== Auth::user()->id)
                                    @php
                                        $follower = $post->user
                                            ->following()
                                            ->where('user_id', Auth::user()->id)
                                            ->first();
                                    @endphp
                                    @if ($follower && $follower->status === 'confirmed')
                                        <span class="text-gray-500">Following</span>
                                    @elseif ($follower && $follower->status === 'pending')
                                        <span class="text-gray-500">Request Sent</span>
                                    @else
                                        <form action="{{ route('follow.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="follower_id" value="{{ $post->user->id }}">
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Follow
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endif
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
                    <p class="my-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ $post->description }}
                    </p>
                    <div class="flex justify-between items-center">
                        <div>
                            <a href="#"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                {{ $post->category->name }}
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('post.user.show', $post->id) }}">
                                <p class="text-white flex items-center">
                                    Comment(s): {{ $post->comments_count }}
                                    <span class="ml-2">
                                        <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </span>
                                </p>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('user.user.show', $post->user->id) }}">
                                <img class="w-10 h-10 rounded-full shadow-lg object-cover"
                                    src="{{ asset($post->user->avatar) }}" alt="Bonnie image" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
