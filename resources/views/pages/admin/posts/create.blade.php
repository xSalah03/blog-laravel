@extends('dashboard')

@section('content')
    <div class="py-5">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-1">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action='{{ route('post.store') }}' method='POST' enctype='multipart/form-data'>
                        @csrf
                        <div class="mb-6">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
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
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Post description
                            </label>
                            <input type="text" id="description" name="description" value='{{ old('description') }}'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @error('description') is-invalid @enderror">
                            @error('description')
                                <span class='text-red-700'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="cover" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
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
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
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
@endsection
