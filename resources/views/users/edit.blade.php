<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users / Edit') }}
            </h2>
            <a href="{{ route('users.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('users.update', $ourUser->id) }}" method="POST">
                        @csrf
                      

                        <div class="mb-4">
                            <label class="block text-lg font-medium text-gray-700 mb-2">Name</label>
                            <input name="name" value="{{ old('name', $ourUser->name) }}" placeholder="Enter Name"
                                type="text"
                                class="border border-gray-300 rounded-lg shadow-sm w-full px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">

                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-lg font-medium text-gray-700 mb-2">Email</label>
                            <input name="email" value="{{ old('email', $ourUser->email) }}" placeholder="Enter Email"
                                type="text"
                                class="border border-gray-300 rounded-lg shadow-sm w-full px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">

                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-lg font-medium text-gray-700 mb-2">Roles</label>
                            <div class="flex flex-wrap gap-4">
                                @foreach($roles as $role)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox"
                                               name="role[]"
                                               value="{{ $role->name }}"
                                               {{ in_array($role->name, $hasRole->toArray()) ? 'checked' : '' }}
                                               class="form-checkbox text-blue-600 rounded border-gray-300" />
                                        <span class="ml-2 text-gray-700">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-md text-sm">
                            Submit
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
