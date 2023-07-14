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
                    @if ($user->id == Auth::user()->id)
                        <div class="col-span">{{ $user->name }}</div>
                        <div class="col-span">{{ $user->posts_count }} posts</div>
                        <div class="col-span-3">Into: </div>
                        <div class="col-span">
                            <a href="{{ route('profile.edit') }}">Edit profile</a>
                        </div>
                        <div class="col-span">{{ $followersCount }} followers</div>
                        <div>
                            <div class="col-span">
                                <button onclick="openModal()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-500" width="24"
                                        height="24" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                        <path
                                            d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Modal -->
                            <div id="modal" class="hidden fixed inset-0 flex items-center justify-center">
                                <div class="absolute bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 z-10">
                                    <!-- Modal content goes here -->
                                    <div class="max-w-3xl mx-auto sm:px-6 lg:px-1">
                                        <h3 class="pb-2">Want you log out?</h3>
                                        <div class="mb-6">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <a href="route('logout')"
                                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </a>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div onclick="closeModal()" class="fixed inset-0 bg-black opacity-50 cursor-pointer">
                                </div>
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
                        </div>
                        <div class="col-span">{{ $followingCount }} following</div>
                    @else
                        @if ($isFollowing)
                            @if ($follower && $follower->status == 'confirmed')
                                <div class="col-span">{{ $user->name }}</div>
                                <div class="col-span row-span-2">{{ $user->posts_count }} posts</div>
                                <div class="col-span-2">
                                    <button
                                        class="px-2 inline-block bg-white text-gray-500 dark:text-black dark:hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                                        Following
                                    </button>
                                </div>
                                <div class="col-span row-span-2">{{ $followersCount }} followers</div>
                                <div class="col-span">{{ $followingCount }} following</div>
                            @else
                                <div class="col-span">{{ $user->name }}</div>
                                <div class="col-span row-span-2">{{ $user->posts_count }} posts</div>
                                <div class="col-span-2">
                                    <button
                                        class="px-2 inline-block bg-white text-gray-500 dark:text-black dark:hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                                        Request sent
                                    </button>
                                </div>
                                <div class="col-span row-span-2">{{ $followersCount }} followers</div>
                                <div class="col-span">{{ $followingCount }} following</div>
                            @endif
                        @else
                            <div class="col-span">{{ $user->name }}</div>
                            <div class="col-span row-span-2">{{ $user->posts_count }} posts</div>
                            <div class="col-span-2">
                                <form action="{{ route('follow.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="follower_id" value="{{ $user->id }}">
                                    <button
                                        class="px-2 inline-block bg-blue-500 text-gray-500 dark:text-white dark:hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5">
                                        Follow
                                    </button>
                                </form>
                            </div>
                            <div class="col-span row-span-2">{{ $followersCount }} followers</div>
                            <div class="col-span">{{ $followingCount }} following</div>
                        @endif

                    @endif
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
