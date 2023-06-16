@extends('dashboard')

@section('content')
    <div class="py-5">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-1">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action='{{ route('comment.store') }}' method='POST'>
                        @csrf
                        <div class="mb-6">
                            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Write a comment
                            </label>
                            <input type="text" id="content" name="content" value='{{ old('content') }}'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @error('content') is-invalid @enderror">
                            @error('content')
                                <span class='text-red-700'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Select a post
                            </label>
                            <select name='post_id' id="countries"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @error('post_id') is-invalid @enderror">
                                <option selected>Choose post</option>
                                @foreach ($posts as $post)
                                    <option value='{{ $post->id }}'>{{ $post->title }}</option>
                                @endforeach
                            </select>
                            @error('post_id')
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
@endsection
