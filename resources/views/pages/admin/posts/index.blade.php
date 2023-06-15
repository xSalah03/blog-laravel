@extends('dashboard')

@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('post.create') }}"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none w-60 dark:focus:ring-green-800">
                        <i class="fa-solid fa-plus mr-2"></i>Add new post
                    </a>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        cover
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        views
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        user
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        created at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        updated at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $post->title }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ Str::limit($post->description, 15) }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <img class="w-40" src={{ asset($post->cover) }} alt="post image">
                                        </td>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $post->views }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $post->category->name }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $post->user->name }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $post->created_at->diffForHumans() }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $post->updated_at->diffForHumans() }}
                                        </th>
                                        <td class="px-6 py-4 text-left">
                                            <a href="{{ route('post.show', $post->id) }}"
                                                class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                                <i class="fa-solid fa-eye mx-1"></i>show
                                            </a>
                                            <br>
                                            <a href="{{ route('post.edit', $post->id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <i class="fa-solid fa-pen-to-square mx-1"></i>Edit
                                            </a>
                                            <button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-post-deletion-{{ $post->id }}')"
                                                href="#"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                                <i class="fa-solid fa-trash mx-1"></i>Delete
                                            </button>
                                            <x-modal name="confirm-post-deletion-{{ $post->id }}" :show="$errors->postDeletion->isNotEmpty()"
                                                maxWidth="2xl">
                                                <form method="post" action="{{ route('post.destroy', $post->id) }}"
                                                    class="p-6">
                                                    @csrf
                                                    @method('delete')
                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {{ __('Are you sure you want to delete this post?') }}
                                                    </h2>
                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button
                                                            x-on:click="$dispatch('close', 'confirm-post-deletion-{{ $post->id }}')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>
                                                        <x-danger-button class="ml-3">
                                                            {{ __('Delete Post') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
