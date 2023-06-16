<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div>
                    <div class="text-center">
                        <form action='{{ route('profile.avatar.update', $user->id) }}' method='POST' enctype='multipart/form-data'>
                            @csrf
                            @method('PATCH')
                            <img class="w-20 m-auto" src={{ asset($user->avatar) }} alt="user avatar">
                            <div class="mb-6">
                                <label for="avatar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Upload avatar
                                </label>
                                <input id="avatar" type="file" name="avatar" value='{{ old('avatar') }}'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                            @error('avatar') is-invalid @enderror">
                                @error('avatar')
                                    <span class='text-red-700'>{{ $message }}</span>
                                @enderror
                            </div>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
