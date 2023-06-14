@extends('dashboard')

@section('content')
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('category.create') }}"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none w-60 dark:focus:ring-green-800">
                        <i class="fa-solid fa-plus mr-2"></i>Add new category
                    </a>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        category name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        cover
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
                                @foreach ($categories as $category)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $category->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <img class="w-40" src={{ asset($category->cover) }} alt="category image">
                                        </td>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $category->created_at->diffForHumans() }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $category->updated_at->diffForHumans() }}
                                        </th>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('category.edit', $category->id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                <i class="fa-solid fa-pen-to-square mx-2"></i>Edit
                                            </a>
                                            <button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-category-deletion-{{ $category->id }}')"
                                                href="#"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                                <i class="fa-solid fa-trash mx-2"></i>Delete
                                            </button>
                                            <x-modal name="confirm-category-deletion-{{ $category->id }}" :show="$errors->categoryDeletion->isNotEmpty()"
                                                maxWidth="2xl">
                                                <form method="post" action="{{ route('category.destroy', $category->id) }}"
                                                    class="p-6">
                                                    @csrf
                                                    @method('delete')
                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {{ __('Are you sure you want to delete this category?') }}
                                                    </h2>
                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button
                                                            x-on:click="$dispatch('close', 'confirm-category-deletion-{{ $category->id }}')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>
                                                        <x-danger-button class="ml-3">
                                                            {{ __('Delete Category') }}
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
