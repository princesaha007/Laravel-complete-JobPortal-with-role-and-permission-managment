<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ __('Job Details') }}
            </h2>

            <a href="{{ route('careers.index') }}"
               class="px-6 py-2 text-black bg-gray-600 rounded-lg hover:bg-green-700 transition">
                Back to List
            </a>
        </div>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-800">
 
                    <div>
                        <span class="font-semibold">Job Title:</span>
                        <div>{{ $career->job_title }}</div>
                    </div>
 
                    <div>
                        <span class="font-semibold">Company Name:</span>
                        <div>{{ $career->company_name }}</div>
                    </div>
 
                    <div>
                        <span class="font-semibold">Location:</span>
                        <div>{{ $career->location }}</div>
                    </div>
 
                    <div>
                        <span class="font-semibold">Job Type:</span>
                        <div class="capitalize">{{ $career->job_type }}</div>
                    </div>
 
                    <div>
                        <span class="font-semibold">Job Category:</span>
                        <div>{{ $career->job_category }}</div>
                    </div>

                    <div>
                        <span class="font-semibold">Salary Range:</span>
                        <div>{{ $career->salary ?? 'N/A' }}</div>
                    </div>
 
                    <div>
                        <span class="font-semibold">Experience Required:</span>
                        <div>{{ $career->experience_required ? $career->experience_required . ' year(s)' : 'Not specified' }}</div>
                    </div>
 
                    <div>
                        <span class="font-semibold">Education Level:</span>
                        <div>{{ $career->education_level ?? 'N/A' }}</div>
                    </div>
 


                    <div>
                        <span class="font-semibold">Status:</span>
                        <div>
                            <span class="px-2 py-1 rounded text-xs {{ $career->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $career->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
 
                    <div>
                        <span class="font-semibold">Posted At:</span>
                        <div>{{ $career->created_at->format('d-m-Y h:i A') }}</div>
                    </div>
 
                </div>
                <div class="mt-6">
                    <span class="font-semibold block mb-2">Responsibilities:</span>
                    <div class="p-4 rounded-md text-gray-700 text-sm">
                        {!! nl2br(e($career->key_responsibilities)) ?? 'No responsibilities provided.' !!}
                    </div>
                </div>

                <div class="mt-6">
                    <span class="font-semibold block mb-2"> Educational Requirements:</span>
                    <div class="p-4 rounded-md text-gray-700 text-sm">
                        {!! nl2br(e($career->educational_requirements)) ?? 'No requirements provided.' !!}
                    </div>
 
                <div class="mt-6">
                    <span class="font-semibold block mb-2">Job Description:</span>
                    <div class="p-4 rounded-md text-gray-700 text-sm">
                        {!! nl2br(e($career->job_description)) ?? 'No description provided.' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 