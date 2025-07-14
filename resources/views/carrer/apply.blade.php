<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Apply for this Job') }}
            </h2>
            <a href="{{ route('careers.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
<form action="{{ route('careers.apply.store', $career->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Name -->
    <div class="mb-4">
        <label class="block text-lg font-medium text-gray-700 mb-2">Name</label>
        <input name="name" value="{{ old('name') }}" placeholder="Enter Name"
            type="text"
            class="border border-gray-300 rounded-lg shadow-sm w-full px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">
        @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label class="block text-lg font-medium text-gray-700 mb-2">Email</label>
        <input name="email" value="{{ old('email') }}" placeholder="Enter Email"
            type="text"
            class="border border-gray-300 rounded-lg shadow-sm w-full px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">
        @error('email')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- CV Upload -->
    <div class="mb-4">
        <label class="block text-lg font-medium text-gray-700 mb-2">Upload CV (PDF only)</label>
        <input name="cv" type="file" accept=".pdf"
            class="border border-gray-300 rounded-lg shadow-sm w-full px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">
        @error('cv')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

 
    <button type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-md text-sm">
        Create
    </button>
</form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
