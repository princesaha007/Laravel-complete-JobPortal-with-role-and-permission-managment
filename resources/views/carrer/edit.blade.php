<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 Post a New Job
        </h2>
    </x-slot>

    <div class="container mx-auto py-10 px-4 max-w-3xl">
        <div class="bg-white shadow-md rounded-md">
            <div class="bg-blue-600 text-white px-6 py-4 rounded-t-md">
                <h4 class="text-lg font-semibold flex items-center gap-2">📝 Post a New Job</h4>
            </div>

            <div class="px-6 py-6">
                {{-- Global validation error message --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('careers.update', $ourCareer->id) }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Job Category --}}
                    <div>
                        <label class="block font-medium mb-1" for="job_category">
                            Job Category <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            id="job_category"
                            name="job_category"
                            required
                            value="{{ old('job_category', $ourCareer->job_category) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        @error('job_category')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Job Title --}}
                    <div>
                        <label class="block font-medium mb-1" for="job_title">
                            Job Title <span class="text-red-600">*</span>
                        </label>
                        <input
                            type="text"
                            id="job_title"
                            name="job_title"
                            required
                            value="{{ old('job_title', $ourCareer->job_title) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        @error('job_title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Job Description --}}
                    <div>
                        <label class="block font-medium mb-1" for="job_description">
                            Job Description <span class="text-red-600">*</span>
                        </label>
                        <textarea
                            id="job_description"
                            name="job_description"
                            rows="4"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >{{ old('job_description', $ourCareer->job_description) }}</textarea>
                        @error('job_description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Key Responsibilities --}}
                    <div>
                        <label class="block font-medium mb-1" for="key_responsibilities">
                            Key Responsibilities
                        </label>
                        <textarea
                            id="key_responsibilities"
                            name="key_responsibilities"
                            rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >{{ old('key_responsibilities', $ourCareer->key_responsibilities) }}</textarea>
                        @error('key_responsibilities')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Skill Requirements --}}
                    <div>
                        <label class="block font-medium mb-1" for="skill_requirement">
                            Skill Requirements
                        </label>
                        <textarea
                            id="skill_requirement"
                            name="skill_requirement"
                            rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >{{ old('skill_requirement', $ourCareer->skill_requirement) }}</textarea>
                        @error('skill_requirement')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Educational Requirements --}}
                    <div>
                        <label class="block font-medium mb-1" for="educational_requirements">
                            Educational Requirements
                        </label>
                        <textarea
                            id="educational_requirements"
                            name="educational_requirements"
                            rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >{{ old('educational_requirements', $ourCareer->educational_requirements) }}</textarea>
                        @error('educational_requirements')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Experience Requirements --}}
                    <div>
                        <label class="block font-medium mb-1" for="experience_requirements">
                            Experience Requirements
                        </label>
                        <textarea
                            id="experience_requirements"
                            name="experience_requirements"
                            rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >{{ old('experience_requirements', $ourCareer->experience_requirements) }}</textarea>
                        @error('experience_requirements')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Salary --}}
                    <div>
                        <label class="block font-medium mb-1" for="salary">
                            Salary
                        </label>
                        <input
                            type="text"
                            id="salary"
                            name="salary"
                            value="{{ old('salary', $ourCareer->salary) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                        @error('salary')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-between items-center">
                        <a
                            href="{{ route('careers.index') }}"
                            class="inline-block px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition"
                        >
                            ← Back to Job List
                        </a>
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition"
                        >
                            ✅ Update Job
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
