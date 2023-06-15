<x-app-layout>
    @foreach ($posts as $post)
        <div class="p-5">
            <div
                class="mx-auto max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src={{ asset($post->cover) }} alt="" />
                </a>
                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $post->title }}
                        acquisitions 2021</h5>
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
                            <h4 class="underline-offset-1 text-white">Comment(s): <span></span></h5>
                        </div>
                        <div>
                            <a href="">
                                <img class="w-16 h-16 rounded-full shadow-lg" src={{ asset($post->user->avatar) }}
                                    alt="Bonnie image" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
