<x-app-layout>
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
                        <a href="">
                            <img class="w-8 h-8 rounded-full shadow-lg" src={{ asset($post->user->avatar) }}
                                alt="user avatar" />
                        </a>
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
                    <div class="flex items-center mb-2">
                        <img class="w-10 h-10 mr-2 rounded-full" src="{{ asset($comment->user->avatar) }}" alt="user avatar">

                        <span>
                            <p class="text-white p-0 m-0">{{ $comment->user->name }}</p>
                            <p class="text-blue-300 p-0 m-0">It been {{ $comment->created_at->diffForHumans() }}</p>
                        </span>
                    </div>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        {{ $comment->content }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
